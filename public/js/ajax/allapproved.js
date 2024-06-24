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
                            var dropdown = '<div class="d-inline-block">' +
                                '<a class="btn btn-success btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown"></a>' +
                                '<div class="dropdown-menu">' +
                                    '<a href="' + approvedAllListViewRoute + '/' + data + '" class="dropdown-item btn-edit">' +
                                        '<i class="fas fa-eye"></i> View PR' +
                                    '</a>';

                                    if (userRole === 'Checker') {
                                        dropdown += '<a href="' + approvedReceivedViewRoute + '/' + data + '" class="dropdown-item received-pr" data-id="' + data + '">' +
                                                        '<i class="fas fa-check"></i> Received PR ' +
                                                    '</a>';
                                    }
                                    if (userRole === 'Checker') {
                                        dropdown += '<a href="' + approvedCanvassingViewRoute + '/' + data + '" class="dropdown-item canvassing-pr" data-id="' + data + '">' +
                                                        '<i class="fa-regular fa-file-lines"></i> For Canvassing ' +
                                                    '</a>';
                                    }

                                    if (userRole === 'Checker') {
                                        dropdown += '<a href="' + approvedCanvassedViewRoute + '/' + data + '" class="dropdown-item canvassed-pr" data-id="' + data + '">' +
                                                        '<i class="fa-solid fa-cart-flatbed-suitcase"></i> Canvassed ' +
                                                    '</a>';
                                    }

                                    if (userRole === 'Checker') {
                                        dropdown += '<a href="' + approvedPostingViewRoute + '/' + data + '" class="dropdown-item posting-pr" data-id="' + data + '">' +
                                                        '<i class="fa-solid fa-envelopes-bulk"></i> For Posting ' +
                                                    '</a>';
                                    }

                                    if (userRole === 'Checker') {
                                        dropdown += '<a href="' + approvedPostedViewRoute + '/' + data + '" class="dropdown-item posted-pr" data-id="' + data + '">' +
                                                        '<i class="fa-solid fa-address-book"></i> Posted ' +
                                                    '</a>';
                                    }

                                    if (userRole === 'Checker') {
                                        dropdown += '<a href="' + approvedBiddingViewRoute + '/' + data + '" class="dropdown-item bidding-pr" data-id="' + data + '">' +
                                                        '<i class="fa-solid fa-person-chalkboard"></i> Bidding ' +
                                                    '</a>';
                                    }

                                    if (userRole === 'Checker') {
                                        dropdown += '<a href="' + approvedConsolidationViewRoute + '/' + data + '" class="dropdown-item consolidation-pr" data-id="' + data + '">' +
                                                        '<i class="fa-brands fa-get-pocket"></i> For Consolidation ' +
                                                    '</a>';
                                    }

                                    if (userRole === 'Checker') {
                                        dropdown += '<a href="' + approvedAwardViewRoute + '/' + data + '" class="dropdown-item awarded-pr" data-id="' + data + '">' +
                                                        '<i class="fa-solid fa-award"></i> Awarded ' +
                                                    '</a>';
                                    }

                                    if (userRole === 'Checker') {
                                        dropdown += '<a href="' + approvedPurchasedViewRoute + '/' + data + '" class="dropdown-item purchased-pr" data-id="' + data + '">' +
                                                        '<i class="fas fa-dolly"></i> Purchased ' +
                                                    '</a>';
                                    }

                                    
                                    dropdown += '</div>' +
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