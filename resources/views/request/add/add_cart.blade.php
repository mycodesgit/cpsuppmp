@extends('layouts.master')

@section('body')
<div class="container-fluid">
    <div class="row" style="padding-top: 100px;">
        <div class="col-lg-2">
            <div class="card">
                @include('partials.control_requestSidebar')
            </div>
        </div>
        <div class="col-lg-10">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Select Items in {{ $items->first()->category_name }} Category</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-default btn-sm" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="example1" class="table table-hover">
                                <thead class="bg-light">
                                    <tr>
                                        <th width="5%" style="visibility: ;">#</th>
                                        <th>Description</th>
                                        <th>Unit</th>
                                        <th>Cost</th>
                                        <th width="10%">#</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                    @php $no = 1; @endphp
                                    @foreach($items as $itemdata)
                                    <tr id="tr-{{ $itemdata->id }}">
                                        <td style="visibility: ;">{{ $itemdata->unit_id_alias }}</td>
                                        <td>{{ $itemdata->item_descrip }}</td>
                                        <td>{{ $itemdata->unit_name }}</td>
                                        <td>{{ number_format($itemdata->item_cost, 2, '.', ',') }}</td>
                                        <td>
                                            <a href="" class="btn btn-outline-success btn-sm btn-selectitem" data-toggle="modal" data-target="#itemModal" data-id="{{ $itemdata->id }}">
                                                <i class="fa-solid fa-cart-shopping"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="itemModal" tabindex="-1" role="dialog" aria-labelledby="itemModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="itemModalLabel">Add to Cart</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" action="{{ route('prCreate') }}" id="requestpr">
                                @csrf

                                <input type="hidden" name="category_id" value="{{ $purpose->cat_id }}">
                                <input type="hidden" name="user_id" value="{{ $purpose->user_id }}">
                                <input type="hidden" name="campid" value="{{ $purpose->camp_id }}">
                                <input type="hidden" name="off_id" value="{{ $purpose->office_id }}">
                                <input type="hidden" name="transaction_no" value="{{ $purpose->id }}">
                                <input type="hidden" name="purpose_id" value="{{ $purpose->id }}">
                                <input type="hidden" name="item_id">
                                <input type="hidden" name="unit_id">

                                <div class="form-group mt-2">
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <label><span class="badge badge-secondary">Item</span></label>
                                            <input type="text" name="item_name" class="form-control form-control-sm" readonly>
                                        </div>

                                        <div class="mt-2 col-md-12">
                                            <label><span class="badge badge-secondary">Unit</span></label>
                                            <input type="text" name="unit_name" class="form-control form-control-sm" readonly>
                                        </div>

                                        <div class="mt-2 col-md-12">
                                            <label><span class="badge badge-secondary">Item Cost</span></label>
                                            <input type="text" name="item_cost" class="form-control form-control-sm" onkeyup="formatNumber(this); calculateTotalCost()" readonly>
                                        </div>

                                        <div class="mt-2 col-md-4">
                                            <label><span class="badge badge-secondary">Quantity</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <button class="btn btn-outline-secondary" type="button" onclick="decrementQuantity()">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                </div>
                                                <input type="text" name="qty" id="quantityInput" class="form-control form-control-md" value="1" oninput="this.value = this.value.replace(/[^0-9]/g, '')" onkeyup="calculateTotalCost()">
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary" type="button" onclick="incrementQuantity()">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mt-2 col-md-8">
                                            <label>Total Cost:</label>
                                            <input type="text" name="total_cost" onkeyup="formatNumber(this);" class="form-control form-control-md">
                                        </div>

                                        <div class="col-md-12">
                                            <label>&nbsp;</label>
                                            <button type="submit" class="form-control form-control-sm btn btn-outline-success btn-sm">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">List of your Selected Items in {{ $items->first()->category_name }} Category</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
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
                            <form id="updateStatusForm" action="{{ route('savePR') }}" method="POST">
                                @csrf
                                <input type="hidden" name="purpose_id" value="{{ encrypt($req->purpose_id ?? '') }}">
                                <button class="btn btn-success float-right" {{ $grandTotal == 0 ? 'disabled' : '' }}>
                                    <i class="fas fa-save"></i> Submit PR
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
function formatNumber(input) {
    const value = input.value.replace(/[^\d.]/g, '');
    const formattedValue = value.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    input.value = formattedValue;
}
</script>

<script>
    function incrementQuantity() {
        var quantityInput = document.getElementById('quantityInput');
        var currentQuantity = parseInt(quantityInput.value) || 0;
        quantityInput.value = currentQuantity + 1;
        calculateTotalCost();
    }

    function decrementQuantity() {
        var quantityInput = document.getElementById('quantityInput');
        var currentQuantity = parseInt(quantityInput.value) || 1;
        quantityInput.value = currentQuantity > 1 ? currentQuantity - 1 : 1;
        calculateTotalCost();
    }

    function calculateTotalCost() {
        const qtyInput = document.getElementsByName('qty')[0];
        const itemCostInput = document.getElementsByName('item_cost')[0];
        const qty = parseFloat(qtyInput.value) || 0;
        const itemCost = parseFloat(itemCostInput.value.replace(/[^\d.]/g, '')) || 0;
        const totalCost = qty * itemCost;
        const formattedTotalCost = totalCost.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ','); // Modified line
        document.getElementsByName('total_cost')[0].value = formattedTotalCost;
    }

    </script>


<script>
    var reqDeleteRoute = "{{ route('itemreqDelete', ['id' => ':id']) }}";
</script>



@endsection