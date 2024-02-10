@extends('layouts.layout')
@section('pageTitle', 'Manage Service')
@section('Description', '')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Service List</h4>
                    <a href="{{route('admin.service.create') }}"><button type="button" class="btn mb-1 btn-primary float-right">Add Subject </button></a>
                    <div class="table-responsive">
                        <table id="service_table" data-route={{route('admin.service.datatable')}} class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Exam</th>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="service_tbody">

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- #/ container -->
@endsection

@push('js')

<script src="{{ asset('assets/admin/service/index.js') }}"></script>

@endpush