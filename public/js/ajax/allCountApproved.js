$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function updateApprovedCount() {
        $.get(allApprovedCountRoute, function (data) {
            $('#approvedCount').text(data.approvedCount);
        });
    }
    setInterval(updateApprovedCount, 5000);
});