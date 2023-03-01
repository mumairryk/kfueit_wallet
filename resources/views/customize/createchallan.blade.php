@extends('layouts.master')
@section('page_title', 'Generate Challan')
@section('custom_css')
@endsection
@section('page-title','Generate Challan')
@section('breadcrumb','Generate Challan')
@section('action_btn')
    <a class="btn btn-outline-info btn-sm" href="{{route('welcome')}}" > <i class="icon-home4 mr-2"></i>Back</a>
@endsection
@section('content')
    <form method="post" action="{{route('challan.store') }}" class="form-horizontal m-t-30">
        @csrf
        <div class="col-md-12" style="padding-left:0px;">

            <div class="col-md-6 form-group" style="padding-left:0px;">
                <div class="form-group">
                    <label for="inp-status" class="">Select Amount</label>
                    <select name="amount" class="form-control" required="">
                        <option value="100">100</option>
                        <option value="200">200</option>
                        <option value="500">500</option>
                        <option value="1000">1000</option>
                        <option value="5000">5000</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Generate Challan</button>
            </div>

        </div>
    </form>
@endsection
