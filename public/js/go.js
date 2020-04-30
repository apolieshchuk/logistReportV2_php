window.onload = function(){
    $('.ui.dropdown').dropdown({
        fullTextSearch: true,
        // selectOnBlur: false,
    });
}

async function initRatio() {
    const route_id = $('#routeSelect').val();

    try {
        const cargo = await getRatio(10, 'route', route_id, 'cargo');
        const manager = await getRatio(10, 'route', route_id, 'manager');
        const f2 = await getRatio(10, 'route', route_id, 'f2');
        const f1 = await getRatio(10, 'route', route_id, 'f1');
        const tr = await getRatio(10, 'route', route_id, 'tr');

        // change dropboxes and inputs
        $('#cargoSelect').val(cargo).change();
        $('#managerSelect').val(manager).change();
        $('.data-col-f2').val(f2);
        $('.data-col-f1').val(f1);
        $('.data-col-tr .search select').val(tr).change();

        // activate dropboxes
        $('.dropdown.selection').removeClass('disabled');
    } catch (err) {
        console.log("Ошибка при импорте 'ратио'\n" + err.message)
    }

}

/**
 * Get ratio one model to another
 *
 * input ->
 * {
 *  amount: N
 *  object: Model
 *  subject: Model
 *  (optional) moreObjects: { object, value}
 * }
 *
 */
function getRatio(amount, object, value_id, subject, moreObjects = []) {

    return $.ajax({
        url: '/report/ratio',
        type: 'GET',
        contentType: 'json',
        data: {
            amount,
            object,
            value_id,
            subject
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
