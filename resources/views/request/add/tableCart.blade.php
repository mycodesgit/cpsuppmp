<table id="example1" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th width="5%">#</th>
                                        <th>Description</th>
                                        <th>Unit</th>
                                        <th>Qty</th>
                                        <th>Cost</th>
                                        <th>Total Cost</th>
                                        <th width="10%">#</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                    @php $no = 1; $grandTotal = 0; @endphp
                                    @foreach($selecteditem as $req)
                                    <tr id="tr-{{ $req->iid }}">
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $req->item_descrip }}</td>
                                        <td>{{ $req->unit_name }}</td>
                                        <td>{{ $req->qty }}</td>
                                        <td>{{ number_format($req->item_cost, 2, '.', ',') }}</td>
                                        <td>{{ number_format($req->total_cost, 2, '.', ',') }}</td>
                                        <td>
                                            <button value="{{ $req->iid }}" class="btn btn-outline-danger btn-sm prreq-delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                        @if(is_numeric(str_replace(',', '', $req->total_cost)))
                                            @php $grandTotal += str_replace(',', '', $req->total_cost); @endphp
                                        @endif
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="6" style="text-align: right;"><strong>Grand Total:</strong></td>
                                        <td style="background-color: #e9e9e9"><strong id="granTotal">{{ number_format($grandTotal, 2) }}</strong></td>
                                    </tr>
                                </tbody>
                            </table>