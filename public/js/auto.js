
// Copy selected rows
function copyAutos() {

    let autos = getSelectedRows();
    if (autos.length === 0) return;

    // console.log(autos);

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
};

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
    // Setup - add a text input to each footer cell
    $('#autoTable thead tr:eq(1) th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" class="column_search" />' );
    } );

    // DataTable
    const table = $('#autoTable').DataTable({
        bAutoWidth: false,
        ajax: '/data-load',
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
        ],
        columnDefs: [ {
            orderable: false,
            className: 'select-checkbox',
            targets:   0
        } ],
        select: {
            style:    'multi',
            // selector: 'td:first-child'
        },
        order: [[ 1, 'asc' ]],
        orderCellsTop: true,
        fixedHeader: true,
        pageLength: 10,
        // deferRender: true,
    });


    // Apply the search
    table.columns().every( function () {
        var that = this;

        $( 'input', this.footer() ).on( 'keyup change clear', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
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
} )

// For fast table load
window.onload = function() {
    // change autoTable vision
    // document.getElementById("autoTable").style.display = 'block';
};
