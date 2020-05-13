// TODO do ajax request on update route for redraw only
const ROW_ID = 'rowId_'

// MODALS
function showModalDelete(id) {
    // change active modal action
    $('#modalDelete_form').attr('action',`/report/${id}`)

    $('.ui.basic.modal')
        .modal('show')
    ;
}

function showModalUpdate(id) {
    // change active modal action
    $('#modalUpdate_form').attr('action',`/report/${id}`)

    // ajax request for get id data
    $.ajax({
        url: `/report/${id}`,
        contentType: 'application/json',
        success: function (res) {
            // fill inputs data

            // $('#modalUpdate-mark-input').val(res.mark);
            $('#modalUpdate-date-input').val(res.date);
            $('#modalUpdate-auto_num-input').val(res.auto_num);
            $('#modalUpdate-carrier-select').val(res.carrier_id).change();
            $('#modalUpdate-cargo-select').val(res.cargo_id).change();
            $('#modalUpdate-manager-select').val(res.manager_id).change();
            $('#modalUpdate-route-select').val(res.route_id).change();
            // $('#modalUpdate-trail-num-input').val(res.trail_num);
            $('#modalUpdate-dr_surn-select').val(res.driver_id).change();
            $('#modalUpdate-f1-input').val(res.f1);
            $('#modalUpdate-f2-input').val(res.f2);
            $('#modalUpdate-tr-select').val(res.tr).change();
            // $('#modalUpdate-name-input').val(res.driver['name']);
            // $('#modalUpdate-father-input').val(res.driver['father']);
            // $('#modalUpdate-license-input').val(res.driver['license']);
            // $('#modalUpdate-tel-input').val(res.driver['tel']);
            $('#modalUpdate-notes-input').val(res.notes);
        }
    })

    // show modal
    $('#modalUpdate').modal({
        autofocus:false,
        onHide: function () {
            $('.modal-error-box').remove();
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

// Dropdown
window.onload = function(){
    $('.ui.dropdown').dropdown({
        fullTextSearch: true,
        // selectOnBlur: false,
    });
}

// clear checked
$('#clearButton').click(function () {
    // uncheked all
    $('#autoTable').DataTable().rows().deselect();
})

// Go authos, GO!
$('#goButton').click(function () {
    const autos = getSelectedRows()
    if (autos.length === 0) {
        return alert('Не вибрано жодного авто для відправлення на маршрут');
    }

    // get selected id's
    const ids = autos.map( (auto) => {
        return auto.pop();
    });

    // console.log({ 'autos': autos});

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
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'print'
        ],
        // bPaginate: false,
        select: {
            style:    'multi',
            selector: 'td:not(:last-child)'
        },
        // order: [[ 1, 'desc' ]],
        // // Set rows IDs
        rowId: function(auto) {
            return ROW_ID + auto.id;
        },
        orderCellsTop: true,
        fixedHeader: true,
        pageLength: 10,
        ajax: `/report/data-load?report_from=${$('#from').attr('value')}&report_to=${$('#to').attr('value')}`,
        columns: [
            {data: null, defaultContent: ""},
            {data: 'date'},
            {data: 'manager.surname'},
            {data: 'cargo.name'},
            {data: 'route.name'},
            {data: 'carrier.name'},
            {data: 'auto_num'},
            {data: 'driver.surname'},
            {data: 'f2'},
            {data: 'f1'},
            {data: 'tr'},
            {data: 'notes'},
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
        ],
        columnDefs: [
            {
                orderable: false,
                className: 'select-checkbox',
                targets:   0,
            },
            { targets : [10],
                render : function (data, type, row) {
                    return data === 1 ? 'так' : 'ні'
                }
            }
        ],
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
    $( '#autoTable thead'  ).on( 'keyup', ".column_search",function () {
        table
            .column( $(this).parent().index() )
            .search( this.value )
            .draw();
    } );

    //click event on edit action
    $('#autoTable tbody').on('click','[id^=editButton_]', function (event) {
        event.preventDefault();
        // alert('В розробці...')
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
    // change autoTable vision
    // document.getElementById("autoTable").style.display = 'block';
};

// InputMasks
window.onload = function() {
    $('#modalUpdate-auto_num-input').inputmask({"mask": "AA 99-99 AA"});
};

// update report SPA update
$('#modalUpdate_form').submit(function(event) {
    event.preventDefault();

    // ajax request for update data in server db
    $.ajax({
        url: $('#modalUpdate_form').attr('action'),
        method: 'PUT',
        data: $('#modalUpdate_form').serialize(),
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
