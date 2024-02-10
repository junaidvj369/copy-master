@extends('layouts.layout')
@section('pageTitle', 'Manage Enquiry')
@section('Description', '')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Enquiry List</h4>
                    <div class="table-responsive">
                        <table id="enquiry_table" data-route={{route('admin.enquiry.datatable')}} class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Service</th>
                                    <th>Message</th>
                                </tr>
                            </thead>
                            <tbody id="enquiry_tbody">

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

<script src="{{ asset('assets/admin/enquiry/index.js') }}"></script>

@endpush