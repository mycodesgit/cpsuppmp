    $(document).ready(function() {
        var dataTable = $('#prapproved').DataTable({
            "ajax": {
                "url": allApprovedRoute,
                "type": "GET",
            },
            responsive: true,
            lengthChange: true,
            searching: true,
            paging: true,
            "columns": [
                // {data: 'id', name: 'id', orderable: false, searchable: false},
                // {data: 'receipt_control'},
                {data: 'campus_abbr'},
                {data: 'pr_no'},
                {data: 'type_request',
                        render: function(data, type, row) {
                        switch(parseInt(data)) {
                            case 1:
                                return 'Purchase Request';
                            case 2:
                                return 'POW';
                            case 3:
                                return 'Letter Request';
                            case 4:
                                return 'Others';
                            default:
                                return 'Unknown Status';
                        }
                    },
                },
                {data: 'office_abbr'},
                {data: 'purpose_name'},
                {data: 'category_name'},
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
                            case 7:
                                return '<span class="badge badge-success">PR has been Approved</span>';
                            case 8:
                                return '<span class="badge badge-primary">PR has been Received</span>';
                            default:
                                return '<span class="badge badge-secondary">Unknown Status</span>';
                        }
                    },
                },
                {data: 'pid',
                    render: function(data, type, row) {
                        if (type === 'display') {
                            var dropdown = '<div class="d-inline-block">' +
                                '<a class="btn btn-success btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown"></a>' +
                                '<div class="dropdown-menu">' +
                                    '<a href="' + approvedAllListViewRoute + '/' + data + '" class="dropdown-item btn-edit">' +
                                        '<i class="fas fa-eye"></i> View PR' +
                                    '</a>' +
                                    '<a href="' + approvedAllListViewRoute + '/' + data + '" class="dropdown-item btn-edit">' +
                                        '<i class="fas fa-eye"></i> Received PR' +
                                    '</a>' +
                                    '<a href="' + approvedAllListViewRoute + '/' + data + '" class="dropdown-item btn-edit">' +
                                        '<i class="fas fa-trash"></i> Purchase' +
                                    '</a>' +
                                '</div>' +
                            '</div>';
                            return dropdown;
                        } else {
                            return data;
                        }
                    },
                },
            ],
            // initComplete: function(settings, json) {
            //     var api = this.api();
            //     api.column(0, {search: 'applied', order: 'applied'}).nodes().each(function(cell, i) {
            //         cell.innerHTML = i + 1;
            //     });
            // },
            // "createdRow": function (row, data, dataIndex) {
            //     $(row).attr('id', 'tr-' + data.id);
            // }
        });
        setInterval(function () {
            dataTable.ajax.reload(null, false);
        }, 5000);
    });