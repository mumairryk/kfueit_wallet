@extends('layouts.master')
@section('page_title', 'Welcome')
@section('custom_css')
    <!-- Core JS files -->
    <script src="{{asset('master-demo')}}/global_assets/js/main/jquery.min.js"></script>
    <script src="{{asset('master-demo')}}/global_assets/js/main/bootstrap.bundle.min.js"></script>
    <script src="{{asset('master-demo')}}/global_assets/js/plugins/loaders/blockui.min.js"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script src="{{asset('master-demo')}}/global_assets/js/plugins/visualization/d3/d3.min.js"></script>
    <script src="{{asset('master-demo')}}/global_assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
    <script src="{{asset('master-demo')}}/global_assets/js/plugins/forms/styling/switchery.min.js"></script>
    <script src="{{asset('master-demo')}}/global_assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
    <script src="{{asset('master-demo')}}/global_assets/js/plugins/ui/moment/moment.min.js"></script>
    <script src="{{asset('master-demo')}}/global_assets/js/plugins/pickers/daterangepicker.js"></script>
    <script src="{{asset('master-demo')}}/global_assets/js/demo_pages/dashboard.js"></script>

    <script src="{{asset('master-demo')}}/global_assets/js/plugins/extensions/jquery_ui/interactions.min.js"></script>
    <script src="{{asset('master-demo')}}/global_assets/js/plugins/extensions/jquery_ui/touch.min.js"></script>


{{--    <script src="{{asset('master-demo')}}/assets/js/app.js"></script>--}}
    <script src="{{asset('master-demo')}}/global_assets/js/demo_pages/content_cards_draggable.js"></script>

    <script src="{{asset('master-demo')}}/global_assets/js/main/jquery.min.js"></script>
    <script src="{{asset('master-demo')}}/global_assets/js/main/bootstrap.bundle.min.js"></script>
    <script src="{{asset('master-demo')}}/global_assets/js/plugins/loaders/blockui.min.js"></script>
    <!-- /theme JS files -->
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-3">
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
                    <div id="members-online"></div>
                </div>
            </div>
            <!-- /members online -->
        </div>
        <div class="col-lg-3">
            <!-- Today's revenue -->
            <div class="card bg-blue-400" >
                <div class="card-body">
                    <div class="d-flex" id="userDebit">
                        <h3 class="font-weight-semibold mb-0">{{@$userDebit}}</h3>
                        <div class="list-icons ml-auto">
                        </div>
                    </div>

                    <div>
                        User Debit Amount
                    </div>
                </div>

                <div id="today-revenue"></div>
            </div>
            <!-- /today's revenue -->

        </div>
        <div class="col-lg-3">
            <!-- Today's revenue -->
            <div class="card bg-info-400">
                <div class="card-body">
                    <div class="d-flex" id="userCredit">
                        <h3 class="font-weight-semibold mb-0">{{@$userCredit}}</h3>
                        <div class="list-icons ml-auto">
                        </div>
                    </div>

                    <div>
                        User Credit Amount
                    </div>
                </div>

                <div id="un-paid-vochar"></div>
            </div>
            <!-- /today's revenue -->
        </div>
        <div class="col-lg-3">

            <!-- Current server load -->
            <div class="card bg-pink-400">
                <div class="card-body">
                    <div class="d-flex" id="userPendingChallah">
                        <h3 class="font-weight-semibold mb-0">{{@$userPendingChallah}}</h3>
                    </div>
                    <div>
                        User Pending Challah Amount
                    </div>
                </div>

                <div id="server-load"></div>
            </div>
            <!-- /current server load -->

        </div>
    </div>

    <div class="row row-sortable">
        <div class="col-md-12">
            <!-- Marketing campaigns -->
            <div class="card">
                <div class="card-header bg-white header-elements-inline">
                    <h6 class="card-title">Top Five Transactions</h6>
                    <div class="header-elements">
                        <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse"></a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <thead>
                        <tr>
                            <th>Sr#</th>
                            <th>Transaction ID</th>
                            <th>Service Type</th>
                            <th>Service Desc</th>
                            <th>Debit</th>
                            <th>Credit</th>
                            <th>Credit	Date</th>
                        </tr>
                        </thead>
                        <tbody id="tbody">
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /marketing campaigns -->
            <div class="card">
                <div class="card-header bg-white header-elements-inline">
                    <h6 class="card-title">Top Five Credit</h6>
                    <div class="header-elements">
                        <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse"></a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <thead>
                        <tr>
                            <th>Sr#</th>
                            <th>Transaction ID</th>
                            <th>Service Type</th>
                            <th>Service Desc</th>
                            <th>Debit</th>
                            <th>Credit</th>
                            <th>Credit	Date</th>
                        </tr>
                        </thead>
                        <tbody id="c-tbody">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-white header-elements-inline">
                    <h6 class="card-title">Top Five Pending Challah</h6>
                    <div class="header-elements">
                        <div class="list-icons">
                            <a class="list-icons-item" data-action="collapse"></a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table text-nowrap">
                        <thead>
                        <tr>
                            <th>Sr#</th>
                            <th>Transaction ID</th>
                            <th>Service Type</th>
                            <th>Service Desc</th>
                            <th>Debit</th>
                            <th>Credit</th>
                            <th>Credit	Date</th>
                        </tr>
                        </thead>
                        <tbody id="p-tbody">
                        </tbody>
                    </table>
                </div>
            </div>
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
            // setInterval(function () {
            //     ajax_call();
            // }, 5000);
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
                    $("#bal_id").html(data['balance']);
                    let html = '';
                    $.each(data['userTransactions'], function (key, value) {
                        var date = new Date(value['created_at']);
                        var options = {day: 'numeric', month: 'short', year: 'numeric'};
                        var formattedDate = date.toLocaleDateString(undefined, options);
                        html += '<tr>';
                        html += ' <td><span class="text-muted">' + ++key + '</span></td>';
                        html += '<td><span class="text-muted">' + value['id'] + '</span></td>';
                        html += '<td><span class="">' + ((value['service_desc'] === null) ? 'PR' : value['service_desc']) + '</span></td>';
                        html += '<td><span class="">' + ((value['desc'] === null) ? ' ' : value['service_desc']) + '</span></td>';
                        html += '<td><span class="font-weight-semibold mb-0">' + ((value['debit'] === 0) ? ' ' : value['debit']) + '</span></td>';
                        html += '<td><span class="font-weight-semibold mb-0">' + ((value['credit'] === 0) ? ' ' : value['credit']) + '</span></td>';
                        html += '<td><span class="badge bg-blue">' + formattedDate + '</span></td>';
                        html += '</tr>';
                    });
                    $('#tbody').html(html);
                    var html1 = "";
                    $.each(data['userPendingChallahData'], function (key, value) {
                        console.log(value['debit']);
                        var date = new Date(value['created_at']);
                        var options = {day: 'numeric', month: 'short', year: 'numeric'};
                        var formattedDate = date.toLocaleDateString(undefined, options);
                        html1 += '<tr>';
                        html1 += ' <td><span class="text-muted">' + ++key + '</span></td>';
                        html1 += '<td><span class="text-muted">' + value['id'] + '</span></td>';
                        html1 += '<td><span class="">' + ((value['service_desc'] === null) ? 'PR' : value['service_desc']) + '</span></td>';
                        html1 += '<td><span class="">' + ((value['desc'] === null) ? ' ' : value['service_desc']) + '</span></td>';
                        html1 += '<td><span class="font-weight-semibold mb-0">' + value['debit'] + '</span></td>';
                        html1 += '<td><span class="font-weight-semibold mb-0"></span></td>';
                        html1 += '<td><span class="badge bg-blue">' + formattedDate + '</span></td>';
                        html1 += '</tr>';
                    });
                    $('#p-tbody').html(html1);
                    var htmlc = "";
                    $.each(data['userCreditData'], function (key, value) {
                        var date = new Date(value['created_at']);
                        var options = {day: 'numeric', month: 'short', year: 'numeric'};
                        var formattedDate = date.toLocaleDateString(undefined, options);
                        htmlc += '<tr>';
                        htmlc += ' <td><span class="text-muted">' + ++key + '</span></td>';
                        htmlc += '<td><span class="text-muted">' + value['id'] + '</span></td>';
                        htmlc += '<td><span class="">' + ((value['service_desc'] === null) ? 'PR' : value['service_desc']) + '</span></td>';
                        htmlc += '<td><span class="">' + ((value['desc'] === null) ? ' ' : value['service_desc']) + '</span></td>';
                        htmlc += '<td><span class="font-weight-semibold mb-0"></span></td>';
                        htmlc += '<td><span class="font-weight-semibold mb-0">' + value['credit'] + '</span></td>';
                        htmlc += '<td><span class="badge bg-blue">' + formattedDate + '</span></td>';
                        htmlc += '</tr>';
                    });
                    $('#c-tbody').html(htmlc);
                    $('#userDebit').html('<h3 class="font-weight-semibold mb-0">' + data['userDebit'] + '</h3>')
                    $('#userCredit').html('<h3 class="font-weight-semibold mb-0">' + data['userCredit'] + '</h3>')
                    $('#userPendingChallah').html('<h3 class="font-weight-semibold mb-0">' + data['userPendingChallah'] + '</h3>')
                },
                error: function (data) {
                    console.log(data);
                }
            });
        }

        function displayHello() {
            let x = a * b;
            alert(x);
        }
    </script>

@endsection


