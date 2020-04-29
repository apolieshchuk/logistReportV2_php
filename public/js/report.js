const NUM_OF_COLUMNS = 10; // and id as last col

// Copy selected rows
$('#copyButton').click(function () {

    let autos = getSelectedRows();
    if (autos.length === 0) return;

    // we don't need id row
    autos.forEach( (auto) => {
        auto.pop();
    });

    // replace in readable format
    const find = ',';
    const re = new RegExp(find, 'g');

    // copy to clipbord
    copyToClipboard(autos.join("\n").replace(re,' '));
})

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
    // Setup - add a text input to each footer cell
    $('#autoTable thead tr:eq(1) th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" class="column_search" />' );
    } );

    // DataTable
    const table = $('#autoTable').DataTable({
        bAutoWidth: false,
        // bPaginate: false,
        columnDefs: [
            {
                orderable: false,
                className: 'select-checkbox',
                targets:   0,
            }
        ],
        select: {
            style:    'multi',
            // selector: 'td:first-child'
        },
        order: [[ 1, 'asc' ]],
        orderCellsTop: true,
        fixedHeader: true,
        pageLength: 10,
        ajax: '/data-load',
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
