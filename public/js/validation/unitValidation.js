
$(function () {
    $('#unit').validate({
        rules: {
            unit_name: {
                required: true
            },
        },
        messages: {
            unit_name: {
                required: "Please Enter Unit"
            },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.col-md-12').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
    });
});
