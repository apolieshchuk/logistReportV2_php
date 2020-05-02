const NUM_OF_COLUMNS = 10; // and id as last col

function getSelectedRows() {
    let table = $('#autoTable').DataTable();
    // objects
    let data = table.rows( { selected: true }).data();

    // move from objects to array
    let autos = [];
    for (let row = 0; row < data.length; row++){
        let auto = [];
        auto.push(row + 1 + ")");
        for (let col = 1; col < NUM_OF_COLUMNS + 1; col++) {
            auto.push(data[row][col]);
        }
        autos.push(auto);
    }
    return autos;
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
            // selector: 'td:first-child'
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
    $( "#autoTable tfoot input"  ).on( 'keyup', ".column_search",function () {
        table
            .column( $(this).parent().index() )
            .search( this.value )
            .draw();
    } );

    // Apply the search
    // table.columns().every( function () {
    //     var that = this;
    //
    //     $( 'input', this.footer() ).on( 'keyup change clear', function () {
    //         if ( that.search() !== this.value ) {
    //             that
    //                 .search( this.value )
    //                 .draw();
    //         }
    //     } );
    // } );

} )

// For fast table load
window.onload = function() {
    // change autoTable vision
    // document.getElementById("autoTable").style.display = 'block';
};

