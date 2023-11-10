
$(function () {
    $('#requestpr').validate({
        rules: {
            category_id: {
                required: true
            },
            unit_id: {
                required: true
            },
            item_id: {
                required: true
            },
            qty: {
                required: true
            },
            item_cost: {
                required: true
            },
            total_cost: {
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
            item_id: {
                required: "Please Select Item"
            },
            qty: {
                required: "Please Enter Qty"
            },
            item_cost: {
                required: "Please Enter Item Cost"
            },
            total_cost: {
                required: "Please Enter Total Cost"
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
