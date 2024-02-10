@extends('layouts.layout')
@section('pageTitle', 'Add Subject')
@section('content')


<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title custom-card_title">Add service</h4>
                    <div class="basic-form">
                        <form data-action="{{route('admin.service.store')}}" data-redirect="{{route('admin.service.store')}}" id="service_form">
                            <div class="form-group row">
                                <label for="admin_name" class="col-sm-2 col-form-label">Service name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" id="name" placeholder="Service Name" class="form-control" autocomplete="off">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="admin_name" class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <!--begin::Switch-->
                                    <label class="form-check form-switch form-check-custom form-check-solid">
                                        <!--begin::Input-->
                                        <input class="form-check-input" name="status" type="checkbox" value="1" checked id="status" />

                                        <!--end::Input-->

                                    </label>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">@lang('Save')</button>
                                    <a class="btn btn-primary" href="{{route('admin.service.index')}}">Cancel</a>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script src="{{ asset('assets/js/validator/jquery.validate.min.js') }}"></script>
<script src="{{ asset('assets/js/validator/additional-methods.min.js') }}"></script>

<script src="{{  asset('assets/admin/service/add.js') }}"></script>


@endpush