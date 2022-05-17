$(document).ready(function() {
   	// Default ordering example
    $('.datatable-sorting').DataTable({
        order: [3, "desc"]
    });
     // Multi column ordering
    $('.datatable-multi-sorting').DataTable({
        columnDefs: [{
            targets: [0],
            orderData: [0, 1]
        }, {
            targets: [1],
            orderData: [1, 0]
        }, {
            targets: [4],
            orderData: [4, 0]
        }, {
            orderable: false,
            width: '100px',
            targets: [5]
        }]
    });
     // Sequence control
    $('.datatable-sequence-control').dataTable( {
        "aoColumns": [
            null,
            null,
            {"orderSequence": ["asc"]},
            {"orderSequence": ["desc", "asc", "asc"]},
            {"orderSequence": ["desc"]},
            null
        ]
    });
     // Complex headers with sorting
    $('.datatable-complex-header').DataTable({
        columnDefs: []
    });

} );