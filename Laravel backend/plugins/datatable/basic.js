$(document).ready(function() {
    $('table.datatable-default').DataTable();
    $('table.datatable-pagination').DataTable({
        pagingType: "simple",
        language: {
            paginate: {'next': 'Next &rarr;', 'previous': '&larr; Prev'}
        }
    });
    // Datatable with saving state
    $('.datatable-save-state').DataTable({
        stateSave: true
    });
    // Scrollable datatable
    $('.datatable-scroll-y').DataTable({
        autoWidth: true,
        scrollY: 300
    });
} );