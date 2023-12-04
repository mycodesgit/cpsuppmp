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
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#modal-purpose">
                            <i class="fas fa-plus"></i> Add New
                        </button>
                    </h3>
                </div>

                <!-- Modal -->
                @include('request.add.modal')
                <div class="card-body">
                    <div>
                        <table id="example1" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Purpose</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th width="10%">Action</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                @php $no = 1; @endphp
                                @foreach($repurpose as $data)
                                <tr id="tr-{{ $data->id }}">
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $data->purpose_name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($data->created_at)->format('F j, Y') }}</td>
                                    <td>
                                        @php
                                            switch($data->pstatus) {
                                                case 1:
                                                    echo '<span class="badge badge-info">Ongoing</span>';
                                                    break;
                                                case 2:
                                                    echo '<span class="badge badge-warning">Pending</span>';
                                                    break;
                                                case 3:
                                                    echo '<span class="badge badge-danger">Decline</span>';
                                                    break;
                                                case 4:
                                                    echo '<span class="badge badge-success">Accepted</span>';
                                                    break;
                                                default:
                                                    echo '<span class="badge badge-secondary">Unknown Status</span>';
                                            }
                                        @endphp
                                    </td>
                                    <td>
                                        <a href="{{ route('prCreateRequest', encrypt($data->id)) }}" class="btn btn-info btn-xs btn-edit" data-id="{{ $data->id }}">
                                            <i class="fas fa-exclamation-circle"></i>
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