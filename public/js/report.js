// MODALS
function showModalDelete(id) {
    // change active modal action
    $('#modalDelete_form').attr('action',`/report/${id}`)

    $('.ui.basic.modal')
        .modal('show')
    ;
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
        // bPaginate: false,
        select: {
            style:    'multi',
            selector: 'td:not(:last-child)'
        },
        // order: [[ 1, 'desc' ]],
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
            // {data: 'trail_num'},
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
                    return data === '1' ? 'так' : 'ні'
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
        alert('В розробці...')
        // const id = $(this).attr('id').split('_')[1];
        // showModalUpdate(id);
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
