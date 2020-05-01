window.onload = function(){
    $('.ui.dropdown').dropdown({
        fullTextSearch: true,
        // selectOnBlur: false,
    });
}

async function initRatio3() {
    const route_id = $('#routeSelect').val();

    try {
        // const data = [];

        /* RATIO CARGO AND MANAGER */
        const res = await getRatio(10,route_id);
        // change dropboxes and inputs
        $('#cargoSelect').val(JSON.parse(res)['cargo_id']).change();
        $('#managerSelect').val(JSON.parse(res)['manager_id']).change();

        // activate dropboxes
        $('.dropdown.selection').removeClass('disabled');

        /* FOR EACH DATA-ROW */
        $('.data-row').each(async function(i) {
            const carrier_id = $(this).find('.data-col-carrier-id').val();
            const res = await getRatio(10,route_id,'carrier', carrier_id);
            const resData = JSON.parse(res);

            $(this).find('.data-col-f1').val(resData['f1'] ?? 0);
            $(this).find('.data-col-f2').val(resData['f2'] ?? 0);
            $(this).find('.data-col-tr .search select').val(resData['tr'] ?? 0).change();
        })

    } catch (err) {
        console.log("Ошибка при импорте 'ратио'\n" + err.message)
    }

}

function getRatio (amount, route_id, subject = null, subject_id = null ) {
    return $.ajax({
        url: '/report/ratio',
        type: 'GET',
        contentType: 'application/json',
        data: {
            amount,
            route_id,
            subject,
            subject_id
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        }
    });
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

    console.log(autos)

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
            tr: auto[8] === 'НІ' ? 0 : 1,
        });
    })

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
