<script type="text/javascript">
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
            $.get(allPendingBudgetRoute, function (data) {
                $('#pendingBudCount').text(data.pendBudCount);
            });
            $.get(userPendingCountRoute, function (data) {
                $('#pendingUserCount').text(data.pendUserCount);
            });
        }
        setInterval(updatePendingCount, 5000);
    });
</script>