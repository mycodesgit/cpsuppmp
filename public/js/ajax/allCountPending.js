$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function updatePendingCount() {
        $.get(allPendingCountRoute, function (data) {
            $('#pendingCount').text(data.pendCount);
        });
    }
    setInterval(updatePendingCount, 5000);
});