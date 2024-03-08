$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function updateUserPendingCount() {
        $.get(userPendingCountRoute, function (data) {
            $('#pendingUserCount').text(data.pendUserCount);
        });
    }
    setInterval(updateUserPendingCount, 5000);
});