@extends('layouts.master')

@section('body')
<div class="container-fluid">
    <div class="row" style="padding-top: 100px;">
        <div class="col-lg-2">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title" style="font-size: 17pt"></h5>
                    @include('partials.control_requestSidebar')
                </div>
            </div>
        </div>
        <div class="col-lg-10">
            <div class="card">
                <div class="card-body">
                    <form class="form-horizontal" method="post" id="requestpr">
                        @csrf

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <label>Category:</label>
                                    <select  id="category-dropdown" name="category_id" onchange="categor(this.value)" class="form-control select2bs4" data-placeholder="Select Category" style="width: 100%;">
                                        <option value="">-- Select --</option>
                                        @foreach ($category as $cat)
                                        <option value="{{ $cat->id }}">
                                            {{ $cat->category_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group" id="row-1">
                            <div class="form-row">
                                <div class="col-md-2">
                                    <label>Unit:</label>
                                    <select id="unit" name="unit_id" class="form-control select2bs4" data-placeholder="Select Unit" style="width: 100%;">
                                        <option value="">-- Select --</option>
                                        @foreach ($unit as $u)
                                        <option value="{{ $u->id }}">
                                            {{ $u->unit_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div id="account-div" class="col-md-4">
                                    <label>Item:</label>
                                    <select id="item" name="item_id" data-placeholder="Select Item" class="form-control select2bs4" style="width: 100%;">
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <label>Unit Cost:</label>
                                    <input type="text" id="item_cost" name="item_cost" onkeyup="formatNumber(this); calculateTotalCost()" class="form-control form-control-md">
                                </div>

                                <div class="col-md-1">
                                    <label>Qty.:</label>
                                    <input type="text" name="qty" class="form-control form-control-md" oninput="this.value = this.value.replace(/[^0-9]/g, '')" onkeyup="calculateTotalCost()">
                                </div>

                                <div class="col-md-2">
                                    <label>Total Cost:</label>
                                    <input type="text" name="total_cost" onkeyup="formatNumber(this);" class="form-control form-control-md">
                                </div>

                                <div>
                                    <label><br></label><br>
                                    <button type="button" class="btn btn-success btn-sm">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-12">
                                    <button type="#" class="btn btn-success">
                                        <i class="fas fa-plus"></i> Add
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <hr>
                    <div>
                        <table id="" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Category</th>
                                    <th>Unit</th>
                                    <th>Item</th>
                                    <th>Unit Cost</th>
                                    <th>Qty</th>
                                    <th>Total Cost</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function itemList(val){
        alert(val);
    }
</script>

<script>
function formatNumber(input) {
    const value = input.value.replace(/[^\d.]/g, '');
    const formattedValue = value.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    input.value = formattedValue;
}
</script>

<script>
function calculateTotalCost() {
    const qtyInput = document.getElementsByName('qty')[0];
    const itemCostInput = document.getElementsByName('item_cost')[0];
    const qty = parseFloat(qtyInput.value) || 0;
    const itemCost = parseFloat(itemCostInput.value.replace(/[^\d.]/g, '')) || 0;
    const totalCost = qty * itemCost;
    const formattedTotalCost = totalCost.toLocaleString();
    document.getElementsByName('total_cost')[0].value = formattedTotalCost;
}
</script>

<script>
function categor(val) {
    var categoryId = val;

    var urlTemplate = "{{ route('getItemsByCategory', [':id']) }}";
    var url = urlTemplate.replace(':id', categoryId);
    
    if (categoryId) {
        $.ajax({
            url: url,
            type: "GET",
            success: function(response) {
                console.log(response);
                $('#item').empty();
                $('#item').append("<option value=''></option>");
                $('#item').append(response.options);
            }
        })
        $("#item").on("change", function() {
            var selectedCategory = $(this).find(':selected');
            var selectedItemId = selectedCategory.val();
            var item_cost = selectedCategory.data('item-cost');
            $("#item_cost").val(item_cost);
        });
    }
};
</script>



@endsection