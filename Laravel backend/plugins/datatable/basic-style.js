$(document).ready(function() {
    $('table.mat-datatable').DataTable();
    $('table.default-datatable').DataTable();
    // Alternative pagination
    $('table.datatable-pagination').DataTable({
        pagingType: "simple",
        language: {
            paginate: {'next': 'Next &rarr;', 'previous': '&larr; Prev'}
        }
    });
} );