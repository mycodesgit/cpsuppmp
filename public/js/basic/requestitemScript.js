$(document).on('click', '.prreq-delete', function(e) {
    var id = $(this).val();
    //alert(id);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    });
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "GET",
                url: reqDeleteRoute.replace(':id', id),
                success: function(response) {
                    console.log(response.totalamount);
                    $("#tr-" + id).delay(1000).fadeOut();
                    Swal.fire({
                        title: 'Deleted!',
                        text: 'Successfully Deleted!',
                        icon: 'warning',
                        showConfirmButton: false,
                        timer: 1000
                    });

                    $('#granTotal').text(response.totalamount);
                    $('#cart').DataTable().ajax.reload();
                }
            });
        }
    })
});
