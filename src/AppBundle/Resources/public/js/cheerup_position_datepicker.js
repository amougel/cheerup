$(document).ready(function () {
    $('.cheerup-position-datepicker').datepicker({
        inputs: $('.range_input'),
        format: 'MM yyyy',
        viewMode: 'years',
        minViewMode: 'months',
        language: 'fr'
    });
});
