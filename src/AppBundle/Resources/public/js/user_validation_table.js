$(document).ready(function () {
    $('#user-validation-table').DataTable({
        responsive: true,
        searching: false,
        lengthChange: false,
        info: false,
        pageLength: 5,
        order: [],
        columnDefs: [ {
            targets  : 'no-sort',
            orderable: false
        }]
    });
});
