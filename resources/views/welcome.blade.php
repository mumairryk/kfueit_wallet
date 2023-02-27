@extends('layouts.master')
@section('page_title', 'Welcome')
@section('content')
    <?php
    //echo "<pre>";print_r($userTransactions);

    ?>
    <div class="row">
        <div class="col-lg-4">

            <!-- Members online -->
            <div class="card bg-teal-400">
                <div class="card-body">
                    <div class="d-flex">
                        <h3 id="bal_id" class="font-weight-semibold mb-0">{{$balance}}</h3>
                        <span class="badge bg-teal-800 badge-pill align-self-center ml-auto"></span>
                    </div>

                    <div>
                        Available balance
                        <div class="font-size-sm opacity-100">

                            <button type="button" class="btn btn-default btn-sm" id="myBtn">Add Balance</button>
                        </div>
                    </div>
                </div>

                <div class="container-fluid">
                    <div id="members-online">
                        <svg width="193.328125" height="50">
                            <g>
                                <rect class="d3-random-bars" width="5.569122942386831" x="2.386766975308642" height="45"
                                      y="5" style="fill: rgba(255, 255, 255, 0.5);"></rect>
                                <rect class="d3-random-bars" width="5.569122942386831" x="10.342656893004115"
                                      height="27.500000000000004" y="22.499999999999996"
                                      style="fill: rgba(255, 255, 255, 0.5);"></rect>
                                <rect class="d3-random-bars" width="5.569122942386831" x="18.298546810699587"
                                      height="35" y="15" style="fill: rgba(255, 255, 255, 0.5);"></rect>
                                <rect class="d3-random-bars" width="5.569122942386831" x="26.254436728395063"
                                      height="37.5" y="12.5" style="fill: rgba(255, 255, 255, 0.5);"></rect>
                                <rect class="d3-random-bars" width="5.569122942386831" x="34.210326646090536"
                                      height="32.5" y="17.5" style="fill: rgba(255, 255, 255, 0.5);"></rect>
                                <rect class="d3-random-bars" width="5.569122942386831" x="42.16621656378601"
                                      height="32.5" y="17.5" style="fill: rgba(255, 255, 255, 0.5);"></rect>
                                <rect class="d3-random-bars" width="5.569122942386831" x="50.12210648148148"
                                      height="47.5" y="2.5" style="fill: rgba(255, 255, 255, 0.5);"></rect>
                                <rect class="d3-random-bars" width="5.569122942386831" x="58.07799639917695"
                                      height="27.500000000000004" y="22.499999999999996"
                                      style="fill: rgba(255, 255, 255, 0.5);"></rect>
                                <rect class="d3-random-bars" width="5.569122942386831" x="66.03388631687243" height="25"
                                      y="25" style="fill: rgba(255, 255, 255, 0.5);"></rect>
                                <rect class="d3-random-bars" width="5.569122942386831" x="73.98977623456791" height="45"
                                      y="5" style="fill: rgba(255, 255, 255, 0.5);"></rect>
                                <rect class="d3-random-bars" width="5.569122942386831" x="81.94566615226339" height="30"
                                      y="20" style="fill: rgba(255, 255, 255, 0.5);"></rect>
                                <rect class="d3-random-bars" width="5.569122942386831" x="89.90155606995886"
                                      height="37.5" y="12.5" style="fill: rgba(255, 255, 255, 0.5);"></rect>
                                <rect class="d3-random-bars" width="5.569122942386831" x="97.85744598765433" height="50"
                                      y="0" style="fill: rgba(255, 255, 255, 0.5);"></rect>
                                <rect class="d3-random-bars" width="5.569122942386831" x="105.8133359053498"
                                      height="42.5" y="7.5" style="fill: rgba(255, 255, 255, 0.5);"></rect>
                                <rect class="d3-random-bars" width="5.569122942386831" x="113.76922582304528"
                                      height="40" y="10" style="fill: rgba(255, 255, 255, 0.5);"></rect>
                                <rect class="d3-random-bars" width="5.569122942386831" x="121.72511574074075"
                                      height="35" y="15" style="fill: rgba(255, 255, 255, 0.5);"></rect>
                                <rect class="d3-random-bars" width="5.569122942386831" x="129.68100565843622"
                                      height="30" y="20" style="fill: rgba(255, 255, 255, 0.5);"></rect>
                                <rect class="d3-random-bars" width="5.569122942386831" x="137.63689557613168"
                                      height="40" y="10" style="fill: rgba(255, 255, 255, 0.5);"></rect>
                                <rect class="d3-random-bars" width="5.569122942386831" x="145.59278549382717"
                                      height="40" y="10" style="fill: rgba(255, 255, 255, 0.5);"></rect>
                                <rect class="d3-random-bars" width="5.569122942386831" x="153.54867541152262"
                                      height="40" y="10" style="fill: rgba(255, 255, 255, 0.5);"></rect>
                                <rect class="d3-random-bars" width="5.569122942386831" x="161.5045653292181"
                                      height="27.500000000000004" y="22.499999999999996"
                                      style="fill: rgba(255, 255, 255, 0.5);"></rect>
                                <rect class="d3-random-bars" width="5.569122942386831" x="169.46045524691357"
                                      height="47.5" y="2.5" style="fill: rgba(255, 255, 255, 0.5);"></rect>
                                <rect class="d3-random-bars" width="5.569122942386831" x="177.41634516460906"
                                      height="50" y="0" style="fill: rgba(255, 255, 255, 0.5);"></rect>
                                <rect class="d3-random-bars" width="5.569122942386831" x="185.3722350823045" height="30"
                                      y="20" style="fill: rgba(255, 255, 255, 0.5);"></rect>
                            </g>
                        </svg>
                    </div>
                </div>
            </div>
            <!-- /members online -->
        </div>
    </div>
@endsection

<div class="form-group">
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content col-md-6">

                <div class="modal-body" style="">
                    <form method="post" action="{{route('challan.store') }}" class="form-horizontal m-t-30">
                        @csrf
                        <div class="col-md-12" style="padding-left:0px;">

                            <div class="col-md-12 form-group" style="padding-left:0px;">
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
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span
                            class="glyphicon glyphicon-remove"></span> Cancel
                    </button>

                </div>
            </div>

        </div>
    </div>
</div>
</div>

@section('custom_js')
    <script>
        $(document).ready(function () {
            setInterval(function () {
                ajax_call();
            }, 5000);
            ajax_call();
        });

        function ajax_call() {
            $.ajax({
                type: 'GET',
                url: "{{ route('welcome') }}",
                data: 'JSON',
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    $("#bal_id").html(data);
                },
                error: function (data) {
                    console.log(data);
                }
            });
        }

        // setInterval(function() {
        //     displayHello(5, 10);
        // }, 1000);
        //
        function displayHello() {
            let x = a * b;
            alert(x);
        }
    </script>

@endsection


