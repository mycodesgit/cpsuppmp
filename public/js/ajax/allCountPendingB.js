$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function updateBudPendingCount() {
        $.get(allPendingBudgetCountRoute, function (data) {
            $('#pendingBudCount').text(data.pendBudCount);
        });
    }
    setInterval(updateBudPendingCount, 5000);
});