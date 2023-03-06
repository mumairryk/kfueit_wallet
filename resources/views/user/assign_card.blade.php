@extends('layouts.master')
@section('page_title', 'Assign Rfid')
@section('page-title','Assign Rfid')
@section('breadcrumb','Assign Rfid')
@section('user_main_layout_select', 'nav-item-open nav-item-expanded')
@section('user_main_layout_select', 'active')
@section('user_sub_manu_layout_select', 'active')
@section('action_btn')
    <a class="btn btn-outline-info btn-sm" href="{{route('welcome')}}" > <i class="icon-home4 mr-2"></i>Back</a>
@endsection
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="card border-success">
                <div class="card-header alpha-success text-success-800 border-bottom-success header-elements-inline">
                    <h6 class="card-title">Assign Rfid</h6>
                    <div class="header-elements">
                        <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse"></a>
                        </div>
                    </div>
                </div>
                <form action="{{route('assign.card',['uuid'=>$user->id])}}" method="POST" class="form">
                    @csrf
                    <div class="card-body">
                        <div class="">
                            <div class="row">
                                <div class="col-lg-12 ">
                                    <div class="form-group subject">
                                        <label class="control-label">&nbsp;{{ trans('Assign Rfid') }}:*</label>
                                        <input type="text" name="rfid" id="rfid" class="form-control" value="{{old('rfid')}}" required placeholder="Enter rfid">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white d-flex justify-content-between align-items-center">
                        <button type="submit" class="btn bg-blue">Save</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

@endsection
