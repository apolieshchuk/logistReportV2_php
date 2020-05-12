// TODO do ajax request on update route for redraw only +++

const ROW_ID = 'rowId_'

// MODALS
function showModalAdd() {
    $('#modalAdd').modal({
        autofocus:false,
        onHide: function () {
            $('.modal-error-box').remove();
            addCarrierSelect(this);
            document.getElementById("modalAdd_form").reset();
        },
        onShow: function () {
            // dropdown
            $('.ui.dropdown').dropdown({
                fullTextSearch: true,
                // showOnFocus: false
                // selectOnBlur: false,
            });
        }
    }).modal('show');
}

function showModalUpdate(id) {
    // change active modal action
    $('#modalUpdate_form').attr('action',`/autos/${id}`)

    // ajax request for get id data
    $.ajax({
        url: `/autos/${id}`,
        contentType: 'application/json',
        success: function (res) {
            // console.log(res);

            // fill inputs data
            $('#modalUpdate-carrier-select').val(res.carrier_id).change();
            $('#modalUpdate-mark-input').val(res.mark);
            $('#modalUpdate-auto-num-input').val(res.auto_num);
            $('#modalUpdate-trail-num-input').val(res.trail_num);
            $('#modalUpdate-surname-input').val(res.driver['surname']);
            $('#modalUpdate-name-input').val(res.driver['name']);
            $('#modalUpdate-father-input').val(res.driver['father']);
            $('#modalUpdate-license-input').val(res.driver['license']);
            $('#modalUpdate-tel-input').val(res.driver['tel']);
            $('#modalUpdate-notes-input').val(res.notes);
        }
    })

    // show modal
    $('#modalUpdate').modal({
        autofocus:false,
        onHide: function () {
            $('.modal-error-box').remove();
            addCarrierSelect(this);
            document.getElementById("modalUpdate_form").reset();
        },
        onShow: function () {
            // dropdown
            $('.ui.dropdown').dropdown({
                fullTextSearch: true,
                // showOnFocus: false
                // selectOnBlur: false,
            });
        }
    }).modal('show');
}

function showModalDelete(id) {
    // change active modal action
    $('#modalDelete_form').attr('action',`/autos/${id}`)

    // ajax request for get id data
    $.ajax({
        url: `/autos/${id}`,
        contentType: 'application/json',
        success: function (res) {
            // Add info in modal
            $('#modalDelete .content span').text(`<< ${res.carrier['name']} ${res.mark} ${res.auto_num} >> `);
        }
    })

    $('.ui.basic.modal')
        .modal('show')
    ;
}

// add new carrier
var modalSelectField;
var modalAddCarrierButton;
function addCarrierInputs(element) {
    // modal field element for adding
    const modalFieldForChange = $(element).parent().parent();

    // add new divs
    modalFieldForChange.append(
        '<div class="eight wide field">' +
        '   <input type="text" name="newCarrierName" placeholder="Назва" required>' +
        '</div>' +
        '<div class="three wide field">' +
        '   <input type="text" name="newCarrierType" placeholder="Форма власності">' +
        '</div>' +
        '<div class="five wide field">' +
        '   <input type="text" name="newCarrierCode" placeholder="ЄДРПОУ">' +
        '</div>'
    );

    // global save and remove selectpicker
    const selectField = modalFieldForChange.children(':first-child');
    modalSelectField = selectField.clone();
    selectField.remove();

    // global save and remove add button
    const addButton = modalFieldForChange.children(':first-child');
    modalAddCarrierButton = addButton.clone();
    addButton.remove();


}

// change inputs on selects
function addCarrierSelect(element) {
    // if we already delete where select fields
    if (!modalSelectField && !modalAddCarrierButton) return;

    // console.log('DOO');

    // modal field element for adding
    const modalFieldForChange = $(element).find('.dynamic-input');

    // clear field for add carrier
    modalFieldForChange.empty();
    // console.log(modalFieldForChange.children());

    // add select divs divs
    modalFieldForChange.append(modalSelectField);
    modalFieldForChange.append(modalAddCarrierButton);
}

// Copy selected rows
function copyAutos() {

    let autos = getSelectedRows();
    if (autos.length === 0) return;

    // Form strings
    let logText = "";
    for (let i = 0; i < autos.length; i++) {
        logText += `${i+1}) `+
        `${autos[i].carrier['name']} `+
        `${autos[i].mark} `+
        `${autos[i].auto_num} `+
        `${autos[i].trail_num} `+
        `${autos[i].driver['surname']} `+
        `${autos[i].driver['name']} `+
        `${autos[i].driver['father']} `+
        `${autos[i].driver['tel']} ` +
        `${autos[i].driver['license']} \n`
    }

    // copy to clipbord
    copyToClipboard(logText);
}

function getSelectedRows() {
    let table = $('#autoTable').DataTable();
    return table.rows( { selected: true }).data();
}

function copyToClipboard(text) {
    const el = document.createElement('textarea');
    el.value = text;
    document.body.appendChild(el);
    el.select();
    document.execCommand('copy');
    document.body.removeChild(el);
}

// clear checked
$('#clearButton').click(function () {

    const table = $("#autoTable").DataTable();

    // clear main input and search buttons
    table
        .search( '' )
        .columns().search( '' )
        .draw();

    // clear columns inputs
    $('.column_search').each(function(i) {
        $(this).val("");
    });
    $('#filterbox').val("");

    // uncheked all
    table.rows().deselect();
})

// Go authos, GO!
$('#goButton').click(function () {
    const autos = getSelectedRows()
    if (autos.length === 0) {
        return alert('Не вибрано жодного авто для відправлення на маршрут');
    }

    // get selected id's
    const ids = [];
    for (let i = 0; i < autos.length; i++) {
        ids.push(autos[i].id);
    }

    // set autos to session
    document.cookie = `ids=${ids}`;

    //save auto id's data in storage and redirect to another route
    window.location = '/go';
})

// data-tables functions
$(document).ready(function() {
    // DataTable
    const table = $('#autoTable').DataTable({
        bAutoWidth: false,
        ajax: '/autos/data-load',
        columns: [
            {data: null, defaultContent: ""},
            {data: 'carrier.name'},
            {data: 'mark'},
            {data: 'auto_num'},
            {data: 'trail_num'},
            {data: 'driver.surname'},
            {data: 'driver.name'},
            {data: 'driver.father'},
            {data: 'driver.tel'},
            {data: 'driver.license'},
            // ACTION BUTTONS
            {'render': function (data, type, full, meta) {
                    return `<div style="display: flex;">`+
                    `<a id="editButton_${full.id}" href="#" >` +
                    `<i class="edit outline icon" style="font-size: 22px"></i>`+
                    `</a>` +
                    `<a id="deleteButton_${full.id}" href="#" >` +
                    `<i class="x icon" style="font-size: 22px"></i>`+
                    `</a> </div>`
                    }
            },
            {data: 'id'},
        ],
        columnDefs: [
            {
                orderable: false,
                className: 'select-checkbox',
                targets:   0
            },
            {
                targets: 11,
                visible: false,
            }
        ],
        // // Set rows IDs
        rowId: function(auto) {
            return ROW_ID + auto.id;
        },
        select: {
            style:    'multi',
            selector: 'td:not(:last-child)'
        },
        order: [[ 11, 'desc' ]], // sort by id
        orderCellsTop: true,
        fixedHeader: true,
        pageLength: 10,
        // scrollX: true,
    });

    // Setup - add a text input to each footer cell
    $('#autoTable thead tr:eq(1) th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" class="column_search" />' );
    } );

    // move filter box outside table
    $("#filterbox").keyup(function() {
        table.search(this.value).draw();
    });

    // filters under columns
    $('#autoTable thead').on( 'keyup', ".column_search",function () {
        table
            .column( $(this).parent().index() )
            .search( this.value )
            .draw();
    } );

    //click event on edit action
    $('#autoTable tbody').on('click','[id^=editButton_]', function (event) {
        event.preventDefault();
        const id = $(this).attr('id').split('_')[1];
        showModalUpdate(id);
    })

    //click event on delete action
    $('#autoTable tbody').on('click','[id^=deleteButton_]', function (event) {
        event.preventDefault();
        const id = $(this).attr('id').split('_')[1];
        showModalDelete(id);
    })
} )

// For fast table load
window.onload = function() {
    // dropdown
    $('.ui.dropdown').dropdown({
        fullTextSearch: true,
        // showOnFocus: false
        // selectOnBlur: false,
    });

    // move pagination
    // var element = $('#childNode').detach();
};

// InputMasks
window.onload = function() {
    // input masks
    $('#modalUpdate-license-input, #modalAdd-license-input').inputmask({"mask": "Посв AAA № 999999"});
    $('#modalUpdate-auto-num-input, #modalUpdate-trail-num-input').inputmask({"mask": "AA 99-99 AA"});
    $('#modalAdd-auto-num-input, #modalAdd-trail-num-input').inputmask({"mask": "AA 99-99 AA"});
    $('#modalUpdate-tel-input, #modalAdd-tel-input').inputmask({"mask": "099-99-99-999"});
};

// update auto SPA update
$('#modalUpdate_form').submit(function(event) {
    event.preventDefault();

    // ajax request for update data in server db
    $.ajax({
        url: $('#modalUpdate_form').attr('action'),
        method: 'PUT',
        data: $('#modalUpdate_form').serialize(),
        // contentType: 'application/json',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content'),
        },
        success: function (res) {
            // redraw data in table
            const table = $('#autoTable').DataTable();

            $resData = JSON.parse(res)['data'];

            table.row('#'+ROW_ID+$resData.id).data($resData).draw();

            // hide modal
            $('#modalUpdate').modal('hide');
        }
    })
});

// delete auto SPA delete
$('#modalDelete_form').submit(function(event) {
    event.preventDefault();

    // ajax request for delete data in server db
    $.ajax({
        url: $('#modalDelete_form').attr('action'),
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content'),
        },
        success: function (res) {
            $resData = JSON.parse(res);

            // remove data in table
            const table = $('#autoTable').DataTable();

            table.row('#'+ROW_ID+$resData.id).remove().draw();

            // hide modal
            $('#modalDelete').modal('hide');
        }
    })
});

