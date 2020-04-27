const NUM_OF_COLUMNS = 9;

// checked checkboxes copy
$('#copyButton').click(function () {
    let table = $('#autoTable').DataTable();

    let data = table.rows( { selected: true }).data();

    let autos = [];
    for (let row = 0; row < data.length; row++){
        let auto = [];
        auto.push(row + 1 + ")"); // #
        for (let col = 1; col < NUM_OF_COLUMNS + 1; col++) {
            auto.push(data[row][col]);
        }
        // auto.push("\n"); // \n
        autos.push(auto);
    }
    // console.log(autos);

    // replace in readable format
    const find = ',';
    const re = new RegExp(find, 'g');
    copyToClipboard(autos.join("\n").replace(re,' '));
})

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
    // clear storage
    // sessionStorage.removeItem('autos');

    // uncheked all
    $('#autoTable').DataTable().rows().deselect();
    // console.log(table.rows().deselect());
    // table.columns().checkboxes.deselect(true);
    // $('[id^=checkBox_]:checkbox:checked').prop('checked', false);
})


// data-tables functions
$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#autoTable thead tr:eq(1) th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" class="column_search" />' );
    } );
    // $('#autoTable tfoot th').each( function () {
    //     var title = $(this).text();
    //     $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    // } );

    // DataTable
    const table = $('#autoTable').DataTable({
        "bAutoWidth": false,
        columnDefs: [ {
            orderable: false,
            className: 'select-checkbox',
            targets:   0
        } ],
        select: {
            style:    'multi',
            selector: 'td:first-child'
        },
        order: [[ 1, 'asc' ]],
        orderCellsTop: true,
        fixedHeader: true,
        pageLength: 10
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

    $( '#autoTable thead'  ).on( 'keyup', ".column_search",function () {

        table
            .column( $(this).parent().index() )
            .search( this.value )
            .draw();
    } );
} )

// For fast table load
window.onload = function() {
    // clear storage
    // sessionStorage.removeItem('autos');

    // change autoTable vision
    document.getElementById("autoTable").style.display = 'block';
    $wnd.$(".dataTables_scrollFoot").detach().insertBefore($wnd.$('.dataTables_scrollHead'));

};


// copy to session storage clicked checkboxes
// $('[id^=checkBox_]').click(function () {
//     // console.log(document.getElementById("myCheck").checked);
//     // get checked array from session
//     let checkedAutos = JSON.parse(sessionStorage.getItem("autos")) || [];
//     // get clicked item id
//     let id = $(this).attr("id").split('_')[1];
//
//     // if box is checked
//     if ($(this).is(':checked')){
//         // and not exists in session storage
//         if (!checkedAutos.includes(id)) {
//             checkedAutos.push(id);
//         }
//     } else { // if uncheked
//         const idForRemove = checkedAutos.indexOf(id);
//         if (idForRemove !== -1) checkedAutos.splice(idForRemove, 1);
//     }
//
//     window.sessionStorage.setItem("autos", JSON.stringify(checkedAutos));
//     console.log(JSON.parse(sessionStorage.getItem("autos")));
// })
