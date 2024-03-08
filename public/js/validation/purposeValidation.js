
$(function () {
    $('#purposepr').validate({
        rules: {
            cat_id: {
                required: true
            },
            purpose_name: {
                required: true
            },
        },
        messages: {
            cat_id: {
                required: "Please Select Category"
            },
            purpose_name: {
                required: "Enter PR Purpose"
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
