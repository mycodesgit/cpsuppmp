$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function updateUserApprovedCount() {
        $.get(userApprovedCountRoute, function (data) {
            $('#approvedUserCount').text(data.approvedUserCount);
        });
    }
    setInterval(updateUserApprovedCount, 5000);
});