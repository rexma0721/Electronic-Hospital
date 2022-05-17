$(document).ready(function() {
    // Single row selection
    var singleSelect = $('.datatable-selection-single').DataTable();
    $('.datatable-selection-single tbody').on('click', 'tr', function() {
        if ($(this).hasClass('success')) {
            $(this).removeClass('success');
        }
        else {
            singleSelect.$('tr.success').removeClass('success');
            $(this).addClass('success');
        }
    });
     // Multiple rows selection
    $('.datatable-selection-multiple').DataTable();
    $('.datatable-selection-multiple tbody').on('click', 'tr', function() {
        $(this).toggleClass('success');
    });
} );