@extends('layouts.master')

@section('body')

<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: #187744;
        border-color: #187744;
        color: #fff;
        padding: 0 10px;
        margin-top: 0.31rem;
    }
</style>
<div class="container-fluid">
    <div class="row" style="padding-top: 100px;">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        {{-- <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-user">
                            <i class="fas fa-user-plus"></i> Add New
                        </button> --}}
                    </h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example1" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Campus</th>
                                    <th>Office</th>
                                    <th>Office Head</th>
                                    <th>PPMP</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="tbody">
                                @php $no = 1; @endphp
                                @foreach($userppmp as $data)
                                <tr id="tr-{{ $data->uid }}">
                                    <td width="15">{{ $no++ }}</td>
                                    <td>{{ $data->campus_name }}</td>
                                    <td>{{ $data->office_abbr }}</td>
                                    <td>{{ $data->fname }} {{ $data->lname }}</td>
                                    <td>
                                        @if($data->ppmp_categories)
                                            @foreach(json_decode($data->ppmp_categories) as $categoryId)
                                                <span class="badge badge-info">{{ \App\Models\Category::find($categoryId)->category_name }}</span>,
                                            @endforeach
                                        @endif
                                    </td>

                                    <td width="15">
                                        <button class="btn btn-success btn-xs btn-edit"
                                            data-toggle="modal"
                                            data-target="#modal-userppmp{{ $data->uid }}"
                                            data-event-id="{{ $data->uid }}"
                                            data-categories="{{ json_encode($data->ppmp_categories) }}">
                                            <i class="fas fa-exclamation-circle"></i>
                                        </button>

                                    </td>
                                </tr>
                                @include('ppmp.modal_ppmp')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection