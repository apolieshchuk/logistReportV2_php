// checked checkboxes copy
$('#copyButton').click(function () {
    let checkedAutos = [];
    $('[id^=checkBox_]:checkbox:checked').each(function () {
        let id = $(this).attr("id").split('_')[1];
        checkedAutos.push(id);
    })
    console.log(checkedAutos);
})

// data-tables functions
$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#autoTable tfoot th').each( function () {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    } );

    // DataTable
    var table = $('#autoTable').DataTable({
        "bAutoWidth": false,
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
} )

// For fast table load
window.onload = function() {
    document.getElementById("autoTable").style.display = 'block';
};
