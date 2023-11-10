
$(function () {
    $('#office').validate({
        rules: {
            office_name: {
                required: true
            },
            office_abbr: {
                required: true
            },
        },
        messages: {
            office_name: {
                required: "Please Enter Office Name"
            },
            office_abbr: {
                required: "Please Enter Office Abbreviation"
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
