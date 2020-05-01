window.onload = function(){
    $('.ui.dropdown').dropdown({
        fullTextSearch: true,
        // selectOnBlur: false,
    });
}

async function initRatio3() {
    const route_id = $('#routeSelect').val();

    try {
        const data = [];

        /* RATIO CARGO AND MANAGER */
        data.push(createRatio(10, 'route', route_id, 'cargo'));
        data.push(createRatio(10, 'route', route_id, 'manager'));

        /* FOR EACH DATA-ROW */
        $('.data-row').each(async function(i) {
            console.log($(this).find('.data-col-f2').val());
            // console.log($(this).find('data-col-f1'));
            // console.log($(this).find('data-col-f2'));
        })

    } catch (err) {
        console.log("Ошибка при импорте 'ратио'\n" + err.message)
    }

}

async function initRatio2() {
    const route_id = $('#routeSelect').val();

    try {
        const data = [];

        /* RATIO CARGO AND MANAGER */
        data.push(createRatio(10, 'route', route_id, 'cargo'));
        data.push(createRatio(10, 'route', route_id, 'manager'));

        const carrierIds = $(`.data-col-carrier-id`);
        //f2
        $('.data-col-f2').each(async function(i) {
            data.push(createRatio(10, 'route', route_id, 'f2', [{
                object: 'carrier',
                value: carrierIds.eq(i).val()
            }]));
            // $(this).val(f2);
        })

        //f1
        $('.data-col-f1').each(async function(i) {
            data.push(createRatio(10, 'route', route_id, 'f1', [{
                object: 'carrier',
                value: carrierIds.eq(i).val()
            }]));
            // $(this).val(f1);
        })

        //tr
        $('.data-col-tr .search select').each(async function(i) {
            data.push(createRatio(10, 'route', route_id, 'tr', [{
                object: 'carrier',
                value: carrierIds.eq(i).val()
            }]));
            // $(this).val(tr).change();
        })

        console.log(data);
        let responseData = await getRatio2({data: data});
        responseData = JSON.parse(responseData).data;

        // change values
        // change dropboxes and inputs
        $('#cargoSelect').val(responseData[0]).change(); // cargo
        $('#managerSelect').val(responseData[1]).change(); // manager
        // activate dropboxes
        $('.dropdown.selection').removeClass('disabled');

        // change another classes
        console.log(responseData)
        //f2
        $('.data-col-f2').each(async function(i) {
            $(this).val(responseData[2 + i]);
        })

        //f1
        $('.data-col-f1').each(async function(i) {
            $(this).val(responseData[3]);
        })

        //tr
        $('.data-col-tr .search select').each(async function(i) {

            $(this).val(responseData[4]).change();
        })


        console.log();
        // console.log(responseData);
        // // change dropboxes and inputs
        // $('#cargoSelect').val(cargo).change();
        // $('#managerSelect').val(manager).change();
        //
        // // activate dropboxes
        // $('.dropdown.selection').removeClass('disabled');
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
function createRatio(amount, object, value_id, subject, moreObjects = []) {
    return {
        amount,
        object,
        value_id,
        subject,
        moreObjects
    }
}

async function initRatio() {
    const route_id = $('#routeSelect').val();

    try {
        /* RATIO CARGO AND MANAGER */
        const cargo = await getRatio(10, 'route', route_id, 'cargo');
        const manager = await getRatio(10, 'route', route_id, 'manager');

        // change dropboxes and inputs
        $('#cargoSelect').val(cargo).change();
        $('#managerSelect').val(manager).change();

        // activate dropboxes
        $('.dropdown.selection').removeClass('disabled');

        const carrierIds = $(`.data-col-carrier-id`);
        //f2
        $('.data-col-f2').each(async function(i) {
            const f2 = await getRatio(10, 'route', route_id, 'f2', [{
                object: 'carrier',
                value: carrierIds.eq(i).val()
            }]);
            $(this).val(f2);
        })

        //f1
        $('.data-col-f1').each(async function(i) {
            const f1 = await getRatio(10, 'route', route_id, 'f1', [{
                object: 'carrier',
                value: carrierIds.eq(i).val()
            }]);
            $(this).val(f1);
        })

        //tr
        $('.data-col-tr .search select').each(async function(i) {
            const tr = await getRatio(10, 'route', route_id, 'tr', [{
                object: 'carrier',
                value: carrierIds.eq(i).val()
            }]);
            $(this).val(tr).change();
        })
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
function getRatio2(data) {
    return $.ajax({
        url: '/report/ratio',
        type: 'GET',
        // dataType: 'json',
        contentType: 'application/json',
        // processData: false,
        data: data,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
        }
    });

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
    // console.log(JSON.stringify(moreObjects));
    const data = {
        amount,
        object,
        value_id,
        subject,
        moreObjects
    }

    // console.log(data);

    return $.ajax({
        url: '/report/ratio',
        type: 'GET',
        contentType: 'json',
        data: data,
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
