    $(document).ready(function() {
        var dataTable = $('#example').DataTable({
            "ajax": {
                "url": allPendingRoute,
                "type": "GET",
            },
            responsive: true,
            lengthChange: true,
            searching: true,
            paging: true,
            "columns": [
                {data: 'id', name: 'id', orderable: false, searchable: false},
                {data: 'office_abbr'},
                {data: 'purpose_name'},
                {data: 'created_at',
                    render: function (data, type, row) {
                        if (type === 'display') {
                            return moment(data).format('MMMM D, YYYY');
                        } else {
                            return data;
                        }
                    }
                },
                {data: 'pstatus',
                        render: function(data, type, row) {
                        switch(parseInt(data)) {
                            case 1:
                                return '<span class="badge badge-info">Ongoing</span>';
                            case 2:
                                return '<span class="badge badge-warning">Pending</span>';
                            case 3:
                                return '<span class="badge badge-danger">Decline</span>';
                            case 4:
                                return '<span class="badge badge-success">Accepted</span>';
                            default:
                                return '<span class="badge badge-secondary">Unknown Status</span>';
                        }
                    },
                },
                {data: 'pid',
                    render: function(data, type, row) {
                        if (type === 'display') {
                            var link = '<a href="' + pendingAllListViewRoute + '/' + data + '" class="btn btn-info btn-xs btn-edit">' +
                                '<i class="fas fa-eye"></i> View PR' +
                                '</a>';
                            return link;
                        } else {
                            return data;
                        }
                    },
                },



            ],
            initComplete: function(settings, json) {
                var api = this.api();
                api.column(0, {search: 'applied', order: 'applied'}).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1;
                });
            },
            "createdRow": function (row, data, dataIndex) {
                $(row).attr('id', 'tr-' + data.id);
            }
        });
        setInterval(function () {
            dataTable.ajax.reload(null, false);
        }, 5000);
    });