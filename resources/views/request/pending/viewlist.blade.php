@extends('layouts.master')

@section('body')
<div class="container-fluid">
    <div class="row" style="padding-top: 100px;">
        <div class="col-lg-2">
            <div class="card">
                @if(Auth::user()->role=='Budget Officer')
                    @include('partials.control_requestBudSidebar')
                @else
                    @include('partials.control_requestSidebar')
                @endif
            </div>
        </div>
        <div class="col-lg-10">
            <div class="card card-success card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs" id="custom-tabs-five-tab" role="tablist">
                        <li class="nav-item ml-1">
                            <a class="nav-link active" id="custom-tabs-one-tab" data-toggle="pill" href="#custom-tabs-one" role="tab" aria-controls="custom-tabs-one" aria-selected="true">Table</a>
                        </li>
                        <li class="nav-item ml-1">
                            <a class="nav-link" id="custom-tabs-two-tab" data-toggle="pill" href="#custom-tabs-two" role="tab" aria-controls="custom-tabs-two" aria-selected="false">Purchase Request PDF</a>
                        </li>

                        <li class="nav-item ml-1">
                            <a class="nav-link" id="custom-tabs-three-tab" data-toggle="pill" href="#custom-tabs-three" role="tab" aria-controls="custom-tabs-three" aria-selected="false">Receipt & Action Slip</a>
                        </li>
                        
                        @if(Auth::user()->role =='Budget Officer')
                        <li class="nav-item ml-1">
                            <a class="nav-link" id="custom-tabs-four-tab" data-toggle="pill" href="#custom-tabs-four" role="tab" aria-controls="custom-tabs-four" aria-selected="false">Remarks</a>
                        </li>
                        @endif

                        @if(Auth::user()->role =='Procurement Officer' || Auth::user()->role =='Checker')
                        <li class="nav-item ml-1">
                            <a class="nav-link" id="custom-tabs-five-tab" data-toggle="pill" href="#custom-tabs-five" role="tab" aria-controls="custom-tabs-five" aria-selected="false">Remarks</a>
                        </li>
                        @endif

                        <li class="nav-item ml-1">
                            <a class="nav-link" id="custom-tabs-six-tab" data-toggle="pill" href="#custom-tabs-six" role="tab" aria-controls="custom-tabs-six" aria-selected="false">Track PR Status</a>
                        </li>

                        <li class="nav-item ml-1">
                            <a class="nav-link" id="custom-tabs-seven-tab" data-toggle="pill" href="#custom-tabs-seven" role="tab" aria-controls="custom-tabs-seven" aria-selected="false">POW Attachment</a>
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
                                    @foreach($pendItem as $data)
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
                            @php
                                $currentRoute = request()->route()->getName();
                            @endphp

                            @if ($currentRoute == 'pendingListView')
                                <iframe src="{{ route('PDFprPending', encrypt($data['purpose_id'])) }} #toolbar=0" width="100%" height="500"></iframe>
                            @elseif ($currentRoute == 'pendingAllListView')
                                <iframe src="{{ route('PDFprAllPending', encrypt($data['purpose_id'] ?? '')) }} #toolbar=0" width="100%" height="500"></iframe>
                            @else
                                <iframe src="{{ route('PDFprPending', encrypt($data['purpose_id'])) }}" width="100%" height="500"></iframe>
                            @endif
                        </div>

                        <div class="tab-pane fade" id="custom-tabs-three" role="tabpanel" aria-labelledby="custom-tabs-three-tab" style="margin-top: -15px">
                            @php
                                $currentRoute = request()->route()->getName();
                            @endphp

                            @if ($currentRoute == 'pendingListView')
                                <iframe src="{{ route('PDFrbarasPending', encrypt($data['purpose_id'])) }} #toolbar=0" width="100%" height="500"></iframe>
                            @elseif ($currentRoute == 'pendingAllListView')
                                <iframe src="{{ route('PDFrbarasAllPending', encrypt($data['purpose_id'] ?? '')) }} #toolbar=0" width="100%" height="500"></iframe>
                            @else
                                <iframe src="{{ route('PDFrbarasAllPending', encrypt($data['purpose_id'])) }}" width="100%" height="500"></iframe>
                            @endif
                        </div>

                        <div class="tab-pane fade" id="custom-tabs-four" role="tabpanel" aria-labelledby="custom-tabs-four-tab">
                            <form action="{{ route('approvedPR') }}" class="form-horizontal" method="post" id="budremark">
                                @csrf
                                
                                <input type="hidden" name="purpose_id" value="{{ encrypt($data->purpose_id ?? '') }}">

                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-4">
                                            <label>Action Taken:</label>
                                            <select class="form-control" name="status">
                                                <option disabled selected> --- Select ---</option>
                                                <option value="7">Approved</option>
                                                <option value="2">Not Recommended</option>
                                                <option value="3">Return To Client</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Financing Source:</label>
                                            <select class="form-control" name="financing_source">
                                                <option disabled selected> --- Select ---</option>
                                                <option value="1">General Fund (MDS Fund)</option>
                                                <option value="2">Off-Budget Fund</option>
                                                <option value="3">Custodial Fund</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Fund Cluster:</label>
                                            <select class="form-control" name="fund_cluster">
                                                <option disabled selected> --- Select ---</option>
                                                <option value="1">Regular Agency Fund</option>
                                                <option value="2">Internally-Generated Income</option>
                                                <option value="3">Business Type Income</option>
                                                <option value="4">Trust Fund</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-4">
                                            <label>Fund Category:</label>
                                            <select class="form-control" name="fund_category">
                                                <option disabled selected> --- Select ---</option>
                                                <option value="1">Specific Budget of NGAs</option>
                                                <option value="2">Special Purpose Funds</option>
                                                <option value="3">Retained Income / Funds</option>
                                                <option value="5">Revolving Funds</option>
                                                <option value="6">Trust Fund</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Authorization:</label>
                                            <select class="form-control" name="fund_auth">
                                                <option disabled selected> --- Select ---</option>
                                                <option value="1">New gen. Appropriations (Current Year Budget)</option>
                                                <option value="2">Continuing Appropriations (Prior Year's Budget)</option>
                                                <option value="3">Automatic Approprations</option>
                                                <option value="4">Retained Income/Funds</option>
                                                <option value="5">Revolving Funds</option>
                                                <option value="6">Trust Receipts</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Specific Fund/Income Source:</label>
                                            <input type="text" name="specific_fund" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <label>Reason to Action Taken:</label>
                                            <input type="text" name="reason" class="form-control">
                                            <span class="text-danger" style="font-size: 8pt">(Optional)</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-4">
                                            <label>Allotment Class:</label>
                                            <select class="form-control" name="allotment">
                                                <option disabled selected> --- Select ---</option>
                                                <option value="1">MOOE</option>
                                                <option value="2">CO</option>
                                            </select>
                                        </div>

                                        <div class="col-md-4">
                                            <label>Account Code:</label>
                                            <input type="text" name="account_code" class="form-control">
                                        </div>

                                        <div class="col-md-4">
                                            <label>Amount:</label>
                                            <input type="number" name="amount" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <label>Purpose/Project:</label>
                                            <input type="text" name="purproject" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <label>Program/Activity/Project</label>
                                            <input type="text" name="progactproject" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-4">
                                            <label>Allotment / Budget Available:</label>
                                            <input type="number" name="allotbuget" class="form-control">
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

                        <div class="tab-pane fade" id="custom-tabs-five" role="tabpanel" aria-labelledby="custom-tabs-five-tab">
                            <form action="{{ route('checkingPR') }}" class="form-horizontal" method="post" id="addItem">
                                @csrf
                                
                                <input type="hidden" name="purpose_id" value="{{ encrypt($data->purpose_id ?? '') }}">

                                <div class="row">
                                    <div class="col-4">
                                        <span class="badge badge-secondary p-2 mb-2 w-100" style="font-size: 14pt;">PR Status:</span>
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <select class="form-control form-control-sm" name="status">
                                                        <option disabled selected>Select</option>
                                                        
                                                        @php
                                                            $reqitem = $pendItem->first();
                                                        @endphp

                                                        <option value="3" @if (old('status') == 3 || ($reqitem->status == '4' && old('status') == 0)) {{ 'selected' }} @endif>
                                                            Return to Client
                                                        </option>
                                                        <option value="4" @if (old('status') == 4 || $reqitem->status == '4') {{ 'selected' }} @endif>
                                                            Checking PR
                                                        </option>
                                                        <option value="5" @if (old('status') == 5 || $reqitem->status == '5') {{ 'selected' }} @endif>
                                                            Checking PPMP
                                                        </option>
                                                        <option value="6" @if (old('status') == 6 || $reqitem->status == '6') {{ 'selected' }} @endif>
                                                            Endorse PR to Budget Office
                                                        </option>
                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <span class="badge badge-secondary p-2 mb-2 w-100" style="font-size: 14pt;">PPMP Remarks Verification:</span>
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    @foreach($pendItem as $index => $item)
                                                        @if($index === 0)
                                                            <input type="text" name="ppmp_remarks" value="{{ old('ppmp_remarks', $item->ppmp_remarks) }}" class="form-control form-control-sm">
                                                        @endif
                                                    @endforeach

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <span class="badge badge-secondary p-2 mb-2 w-100" style="font-size: 14pt;">PR Remarks Status:</span>
                                        <div class="form-group">
                                            <div class="form-row">
                                                <div class="col-md-12">
                                                    <select class="form-control form-control-sm" name="prstatus">
                                                        <option disabled selected>Select</option>
                                                        <option value="1" @if (old('prstatus') == 1 || ($pendItem->isNotEmpty() && $pendItem[0]->prstatus == '1')) {{ 'selected' }} @endif>With PPMP</option>
                                                        <option value="2" @if (old('prstatus') == 2 || ($pendItem->isNotEmpty() && $pendItem[0]->prstatus == '2')) {{ 'selected' }} @endif>Without PPMP</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-secondary">
                                                <i class="fas fa-save"></i> Save
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-six" role="tabpanel" aria-labelledby="custom-tabs-six-tab" style="margin-top: -15px">
                            <div class="timeline timeline-inverse">
                                <div class="time-label">
                                    
                                </div>
                                <div>
                                    <i class="fas fa-check bg-green"></i>
                                    <div class="timeline-item">
                                        <span class="time" style="font-weight: bold;">
                                                <i class="far fa-clock"></i>
                                                @if (!$pendItem->isEmpty())
                                                    {{ \Carbon\Carbon::parse($pendItem[0]->purpose_created_at)->format('F j, Y h:i:s A') }}
                                                @endif
                                            </span>
                                        <h5 class="timeline-header">Purchase Request Submitted</h5>
                                    </div>
                                </div>

                                @php
                                    $item = $pendItem->first();
                                @endphp

                                @if ($item)
                                    @if (in_array($item->status, ['4', '5', '6']))
                                        <div>
                                            <i class="fas fa-check bg-green"></i>
                                            <div class="timeline-item">
                                                <span class="time" style="font-weight: bold;">
                                                    <i class="far fa-clock"></i>
                                                    {{ \Carbon\Carbon::parse($item->itemrq_updated_at)->format('F j, Y h:i:s A') }}
                                                </span>
                                                <h5 class="timeline-header">Checking PR</h5>
                                                <div class="timeline-body">
                                                    {{ $item->ppmp_remarks }}
                                                </div>
                                            </div>
                                        </div>
                                    @elseif ($item->status == '3')
                                        <div>
                                            <i class="fas fa-check bg-danger"></i>
                                            <div class="timeline-item">
                                                <h5 class="timeline-header">Remarks from Procurement Office</h5>
                                                <div class="timeline-body">
                                                    {{ $item->ppmp_remarks }}
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div>
                                            <i class="fas fa-clock bg-warning"></i>
                                            <div class="timeline-item">
                                                <h5 class="timeline-header">Pending in Procurement Office</h5>
                                            </div>
                                        </div>
                                    @endif
                                @endif

                                @if ($item)
                                    @if (in_array($item->status, ['5', '6']))
                                        <div>
                                            <i class="fas fa-check bg-green"></i>
                                            <div class="timeline-item">
                                                <span class="time" style="font-weight: bold;">
                                                    <i class="far fa-clock"></i>
                                                    {{ \Carbon\Carbon::parse($item->itemrq_updated_at)->format('F j, Y h:i:s A') }}
                                                </span>
                                                <h5 class="timeline-header">Checking PR if it is included in PPMP</h5>
                                            </div>
                                        </div>
                                    @else
                                        <div>
                                            <i class="fas fa-clock bg-warning"></i>
                                            <div class="timeline-item">
                                                <h5 class="timeline-header">Waiting for PPMP Checking</h5>
                                            </div>
                                        </div>
                                    @endif
                                @endif

                                @if ($item)
                                    @if (in_array($item->status, ['6']))
                                        <div>
                                            <i class="fas fa-check bg-green"></i>
                                            <div class="timeline-item">
                                                <span class="time" style="font-weight: bold;">
                                                    <i class="far fa-clock"></i>
                                                    {{ \Carbon\Carbon::parse($item->itemrq_updated_at)->format('F j, Y h:i:s A') }}
                                                </span>
                                                <h5 class="timeline-header">Purchase Request has Approved by the Procurement Office</h5>
                                            </div>
                                        </div>
                                    @else
                                        <div>
                                            <i class="fas fa-clock bg-warning"></i>
                                            <div class="timeline-item">
                                                <h5 class="timeline-header">Waiting for Approval in Procurement</h5>
                                            </div>
                                        </div>
                                    @endif
                                @endif

                                @if ($item)
                                    @if ($item->status == 7)
                                        <div>
                                            <i class="fas fa-check bg-green"></i>
                                            <div class="timeline-item">
                                                <span class="time" style="font-weight: bold;">
                                                    <i class="far fa-clock"></i>
                                                    {{ \Carbon\Carbon::parse($item->itemrq_updated_at)->format('F j, Y h:i:s A') }}
                                                </span>
                                                <h5 class="timeline-header">Purchase Request has Approved by the Budget Office</h5>
                                            </div>
                                        </div>
                                    @else
                                        <div>
                                            <i class="fas fa-clock bg-warning"></i>
                                            <div class="timeline-item">
                                                <h5 class="timeline-header">Waiting for Budget Office Approval</h5>
                                            </div>
                                        </div>
                                    @endif
                                @endif

                            </div>
                        </div>

                        <div class="tab-pane fade" id="custom-tabs-seven" role="tabpanel" aria-labelledby="custom-tabs-seven-tab">
                            @if($docFile && $docFile->doc_file)
                                <iframe src="{{ asset('storage/' . $docFile->doc_file) }} #toolbar=0" style="width:100%; height:500px;"></iframe>
                            @else
                                <div>
                                    <ul class="mailbox-attachments d-flex align-items-stretch clearfix">
                                        <li class="fileattached">
                                            <span class="mailbox-attachment-icon"><i class="far fa-file-pdf"></i></span>
                                            <div class="mailbox-attachment-info">
                                                <span class="mailbox-attachment-name"><center>No PDF File uploaded</center></span>
                                                <span class="mailbox-attachment-size clearfix mt-1">
                                                </span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</div>

@endsection