
$(function () {
    $('#item').validate({
        rules: {
            category_id: {
                required: true
            },
            unit_id: {
                required: true
            },
            item_name: {
                required: true
            },
            item_descrip: {
                required: true
            },
            item_cost: {
                required: true
            },
        },
        messages: {
            category_id: {
                required: "Please Select Category"
            },
            unit_id: {
                required: "Please Select Unit"
            },
            item_name: {
                required: "Please Enter Item Name"
            },
            item_descrip: {
                required: "Please Enter Item Description"
            },
            item_cost: {
                required: "Please Enter Item Cost"
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
