@extends('layouts.master')
@section('page_title', 'Assign Rfid')
@section('custom_css')
@endsection
@section('page-title','Assign Rfid')
@section('breadcrumb','Assign Rfid')
@section('action_btn')
    <a class="btn btn-outline-info btn-sm" href="{{route('welcome')}}" > <i class="icon-home4 mr-2"></i>Back</a>
@endsection
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card border-success">
                <div class="card-header alpha-success text-success-800 border-bottom-success header-elements-inline">
                    <h6 class="card-title">Change Password</h6>
                    <div class="header-elements">
                        <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse"></a>
                        </div>
                    </div>
                </div>
                <form action="{{route('assign.card')}}" method="POST" class="form">
                    @csrf
                    <div class="card-body">
                        <div class="">
                            <div class="row">
                                <div class="col-lg-12 ">
                                    <div class="form-group subject">
                                        <label class="control-label">&nbsp;{{ trans('Old Password') }}:*</label>
                                        <input type="password" name="oldpassword" id="oldpassword" class="form-control" value="{{old('oldpassword')}}" required placeholder="Enter Old Password">
                                    </div>
                                </div>
                                <div class="col-lg-12 ">
                                    <div class="form-group subject">
                                        <label class="control-label">&nbsp;{{ trans('New Password') }}:*</label>
                                        <input type="password" name="newpassword" id="newpassword" class="form-control"  value="{{old('newpassword')}}"  required placeholder="Enter new Password">
                                    </div>
                                </div>
                                <div class="col-lg-12 ">
                                    <div class="form-group subject">
                                        <label class="control-label">&nbsp;{{ trans('Confirm Password') }}:*</label>
                                        <input type="password" name="confirmpassword" id="confirmpassword" class="form-control"  value="{{old('confirmpassword')}}"  required placeholder="Enter confirm Password">
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                    <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                        <button type="submit" class="btn bg-blue">Update Password</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

@endsection
