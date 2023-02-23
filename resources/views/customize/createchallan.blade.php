@extends('layouts.master')
@section('page_title', 'Welcome')
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
