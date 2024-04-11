
$(function () {
    $('#budremark').validate({
        rules: {
            status: {
                required: true
            },
            financing_source: {
                required: true
            },
            fund_cluster: {
                required: true
            },
            fund_category: {
                required: true
            },
            fund_auth: {
                required: true
            },
            specific_fund: {
                required: true
            },
            reason: {
                required: true
            },
            allotment: {
                required: true
            },
            account_code: {
                required: true
            },
            amount: {
                required: true
            },
            purproject: {
                required: true
            },
            progactproject: {
                required: true
            },
            allotbuget: {
                required: true
            },
        },
        messages: {
            status: {
                required: "Select Status for Action Taken"
            },
            financing_source: {
                required: "Select Financial Source"
            },
            fund_cluster: {
                required: "Select Fund Cluster"
            },
            fund_category: {
                required: "Select Fund Category"
            },
            fund_auth: {
                required: "Select Authorization"
            },
            specific_fund: {
                required: "Please Enter Specific"
            },
            reason: {
                required: "Plase Enter reason for action taken"
            },
            allotment: {
                required: "Select Allotment"
            },
            account_code: {
                required: "Plase Enter Code"
            },
            amount: {
                required: "Plase Enter Amount"
            },
            purproject: {
                required: "Plase Enter Purpose of Project"
            },
            progactproject: {
                required: "Plase Enter Program /Activity / Project"
            },
            allotbuget: {
                required: "Plase Enter Budget Allotment"
            },
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.col-md-4, .col-md-6, .col-md-12').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
    });
});
