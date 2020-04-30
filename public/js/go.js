window.onload = function(){
    $('.ui.dropdown').dropdown({ fullTextSearch: true });
}

function sendReport() {
    // get autos info
    let autos = []
    $(".data-row").each(function(i) {
        let rowData= [];
        const row = $(this);
        const cols = row.find('.data-col');
        $(cols).each(function(i) {
            const $dataCol = $(this).is('input') ? $(this).val() : $(this).text();
            rowData.push($dataCol);
        });
        autos.push(rowData)
    });

    // pack request post data
    const data = [];
    autos.forEach((auto) => {
        data.push({
            date: auto[5],
            manager_id: $('#managerSelect option:selected').val(),
            cargo_id: $('#cargoSelect option:selected').val(),
            route_id: $('#routeSelect option:selected').val(),
            carrier_id: auto[9],
            auto_num: auto[2],
            trail_num: auto[3],
            driver_id: auto[10],
            f2: auto[6],
            f1: auto[7],
            tr: auto[8],
        });
    })

    // console.log(data);

    $.ajax( {
        type: "POST",
        url: '/report',
        data: JSON.stringify(data),
        contentType: "json",
        processData: false,
        //dataType: "json",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        },
        success: function (res) {
            console.log(JSON.stringify(data));
            console.log(res);
            alert("Авто відправлено на маршрут")
            window.location = '/';
        },
        error: function (xhr, status, error) {
            var err = JSON.parse(xhr.responseText);
            alert("Помилка при додаванні авто на маршрут\n" + err.message)
        },
    })
}
