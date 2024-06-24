    $(document).ready(function() {
        var dataTable = $('#pruserapproved').DataTable({
            "ajax": {
                "url": userApprovedRoute,
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
                {data: 'cpdate',
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
                            case 7:
                                return '<span class="badge badge-success">PR has been Approved</span>';
                            case 8:
                                return '<span class="badge badge-default bg-teal">PR has been Received</span>';
                            case 9:
                                return '<span class="badge badge-default bg-yellow">For Canvassing</span>';
                            case 10:
                                return '<span class="badge badge-default bg-orange">PR Canvassed</span>';
                            case 11:
                                return '<span class="badge badge-default bg-blue">For Philgeps Posting</span>';
                            case 12:
                                return '<span class="badge badge-default bg-gray">PR Posted</span>';
                            case 13:
                                return '<span class="badge badge-default bg-gray-dark">Bidding</span>';
                            case 14:
                                return '<span class="badge badge-default bg-purple">For Consolidation</span>';
                            case 15:
                                return '<span class="badge badge-default bg-pink">Awarded</span>';
                            case 16:
                                return '<span class="badge badge-default bg-red">Purchased</span>';
                            default:
                                return '<span class="badge badge-secondary">Unknown Status</span>';
                        }
                    },
                },
                {data: 'pid',
                    render: function(data, type, row) {
                        if (type === 'display') {
                            var link = '<a href="' + approvedListViewRoute + '/' + data + '" class="btn btn-success btn-xs btn-edit">' +
                                '<i class="fas fa-eye"></i> View PR' +
                                '</a>';
                            return link;
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