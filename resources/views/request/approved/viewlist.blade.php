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
            <div class="card card-success card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                        <li class="nav-item ml-1">
                            <a class="nav-link active" id="custom-tabs-one-tab" data-toggle="pill" href="#custom-tabs-one" role="tab" aria-controls="custom-tabs-one" aria-selected="true">Table</a>
                        </li>
                        <li class="nav-item ml-1">
                            <a class="nav-link" id="custom-tabs-two-tab" data-toggle="pill" href="#custom-tabs-two" role="tab" aria-controls="custom-tabs-two" aria-selected="false">PDF</a>
                        </li>
                        
                        @if(Auth::user()->role =='Budget Officer')
                        <li class="nav-item ml-1">
                            <a class="nav-link" id="custom-tabs-three-tab" data-toggle="pill" href="#custom-tabs-three" role="tab" aria-controls="custom-tabs-three" aria-selected="false">Remarks</a>
                        </li>
                        @endif

                        <li class="nav-item ml-1">
                            <a class="nav-link" id="custom-tabs-four-tab" data-toggle="pill" href="#custom-tabs-four" role="tab" aria-controls="custom-tabs-four" aria-selected="false">Track</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-four-tabContent">
                        <div class="tab-pane fade show active" id="custom-tabs-one" role="tabpanel" aria-labelledby="custom-tabs-one-tab">
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
                                    </tr>
                                </thead>
                                <tbody id="tbody">
                                    @php $no = 1; $grandTotal = 0; @endphp
                                    @foreach($appItem as $data)
                                    <tr id="tr-{{ $data->iid }}">
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $data->category_name }}</td>
                                        <td>{{ $data->unit_name }}</td>
                                        <td>{{ $data->item_name }}</td>
                                        <td>{{ $data->item_cost }}</td>
                                        <td>{{ $data->qty }}</td>
                                        <td>{{ $data->total_cost }}</td>
                                        @if(is_numeric(str_replace(',', '', $data->total_cost)))
                                            @php $grandTotal += str_replace(',', '', $data->total_cost); @endphp
                                        @endif
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="6" style="text-align: right;"><strong>Grand Total:</strong></td>
                                        <td style="background-color: #e9e9e9"><strong id="granTotal">{{ number_format($grandTotal, 2) }}</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane fade" id="custom-tabs-two" role="tabpanel" aria-labelledby="custom-tabs-two-tab" style="margin-top: -15px">
                            <iframe src="{{ route('PDFprApproved', encrypt($data['purpose_id'])) }}" width="100%" height="500"></iframe>
                        </div>

                        <div class="tab-pane fade" id="custom-tabs-three" role="tabpanel" aria-labelledby="custom-tabs-three-tab">
                            <form action="" class="form-horizontal" method="post" id="addItem">
                                @csrf
                                {{-- <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <label>Notes:</label>
                                            <input type="text" name="note" value="" oninput="var words = this.value.split(' '); for(var i = 0; i < words.length; i++){ words[i] = words[i].substr(0,1).toUpperCase() + words[i].substr(1); } this.value = words.join(' ');" class="form-control">
                                            <span style="font-size: 8pt;">(Optional)</span>
                                        </div>
                                    </div>
                                </div> --}}

                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <label>Remarks:</label>
                                            <select class="form-control" name="status">
                                                <option disabled selected> --- Select ---</option>
                                                <option value="4">Approved</option>
                                                <option value="2">Pending</option>
                                                <option value="3">Decline</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-secondary">
                                                <i class="fas fa-check"></i> Submit
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-four" role="tabpanel" aria-labelledby="custom-tabs-four-tab" style="margin-top: -15px">
                            <div class="timeline timeline-inverse">
                                <div class="time-label">
                                    
                                </div>
                                <div>
                                    <i class="fas fa-check bg-green"></i>
                                    <div class="timeline-item">
                                        <span class="time" style="font-weight: bold;">
                                                <i class="far fa-clock"></i>
                                                @if (!$appItem->isEmpty())
                                                    {{ $appItem[0]->created_at->format('F j, Y h:i:s A') }}
                                                @endif
                                            </span>
                                        <h5 class="timeline-header">Purchase Request Submitted</h5>
                                    </div>
                                </div>

                                @php
                                    $item = $appItem->first();
                                @endphp

                                @if ($item)
                                    @if ($item->status == '4')
                                        <div>
                                            <i class="fas fa-check bg-green"></i>
                                            <div class="timeline-item">
                                                <span class="time" style="font-weight: bold;">
                                                    <i class="far fa-clock"></i>
                                                    {{ $item->updated_at->format('F j, Y h:i:s A') }}
                                                </span>
                                                <h5 class="timeline-header">Purchase Request has Approved</h5>
                                            </div>
                                        </div>
                                     @elseif ($item->status == '3')
                                        <div>
                                            <i class="fas fa-clock bg-warning"></i>
                                            <div class="timeline-item">
                                                <h5 class="timeline-header">Pending in Budget Office</h5>
                                                <div class="timeline-body">
                                                Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                                weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                                jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                                quora plaxo ideeli hulu weebly balihoo...
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div>
                                            <i class="fas fa-clock bg-warning"></i>
                                            <div class="timeline-item">
                                                <h5 class="timeline-header">Waiting for Approval in Budget Office</h5>
                                            </div>
                                        </div>
                                    @endif
                                @endif

                                @if ($item)
                                    @if ($item->status == '5')
                                        <div>
                                            <i class="fas fa-check bg-green"></i>
                                            <div class="timeline-item">
                                                <span class="time" style="font-weight: bold;">
                                                    <i class="far fa-clock"></i>
                                                    {{ $item->updated_at->format('F j, Y h:i:s A') }}
                                                </span>
                                                <h5 class="timeline-header">Purchase Request has Approved</h5>
                                            </div>
                                        </div>
                                    @else
                                        <div>
                                            <i class="fas fa-clock bg-warning"></i>
                                            <div class="timeline-item">
                                                <h5 class="timeline-header">Waiting for Approval in President Office</h5>
                                            </div>
                                        </div>
                                    @endif
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</div>





@endsection