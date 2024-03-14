
$(function () {
    $('#form1Search').validate({
        rules: {
            start_date: {
                required: true
            },
            end_date: {
                required: true
            },
            cat_id: {
                required: true
            },
        },
        messages: {
            start_date: {
                required: "Select Start Date"
            },
            end_date: {
                required: "Select End Date"
            },
            cat_id: {
                required: "Select Category"
            },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.col-md-2, .col-md-6').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
    });
});
