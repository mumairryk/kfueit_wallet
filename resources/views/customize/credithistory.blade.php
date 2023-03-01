@extends('layouts.master')
@section('page_title', 'Credit History')
@section('custom_css')
@endsection
@section('page-title','Credit History')
@section('breadcrumb','Credit History')
@section('content')
    <style>
        td {
            text-align: center;
            vertical-align: middle;
        }

        tr {
            text-align: center;
            vertical-align: middle;
        }
    </style>

    <div class="container">
        <h3>Credit Transactions</h3>
        <table class="table table-striped datatable-button-html5-columns table-bordered  table-hover">
            <thead>
            <tr>
                <th>Sr#</th>
                <th>Transaction ID</th>
                <th>Service type</th>
                <th>service desc</th>
                <th>Debit</th>

                <th>Date</th>
            </tr>
            </thead>
            <tbody>
            @php($sr = 1)
            @php($total_debit = 0)
            @php($total_credit = 0)
            @foreach($userTransactions as $transaction)
                <tr
                    @if($transaction->service_desc == NULL)
                        style="background-color: #8ac248"
                    @else
                        style="background-color:indianred"
                    @endif
                >
                    <td>{{ $sr }}</td>
                    <td>
                        <a href="{{ route('getsingledata', ['id' => $transaction->id]) }}" id="btn_single_trans"
                           target="_blank" style="color: #0b2e13">
                            {{ $transaction->id }} </a>
                    </td>

                    <td>{{ $transaction->service_desc ?? 'PR' }}</td>
                    <td>{{ $transaction->desc }}</td>


                    @if($transaction->credit == 0)
                        <td></td>
                    @else
                        <td>{{ $transaction->credit }}</td>
                    @endif
                    <td>{{ $transaction->created_at }}</td>
                </tr>
                @php($sr=$sr+1)

                @php($total_credit=$total_credit+$transaction->credit)
            @endforeach

            </tbody>
        </table>
        <table class="table table-striped">
            <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>Total</td>
                <td>{{$total_credit}}</td>
                <td></td>
                <td></td>
            </tr>

            </tbody>
        </table>
    </div>

@endsection

@section('custom_js')
    <script src="{{ asset('master-demo') }}/global_assets/js/plugins/tables/datatables/datatables.min.js"></script>
    <script src="{{ asset('master-demo') }}/global_assets/js/plugins/forms/selects/select2.min.js"></script>
    <script
        src="{{ asset('master-demo') }}/global_assets/js/plugins/tables/datatables/extensions/jszip/jszip.min.js"></script>
    <script
        src="{{ asset('master-demo') }}/global_assets/js/plugins/tables/datatables/extensions/pdfmake/pdfmake.min.js"></script>
    <script
        src="{{ asset('master-demo') }}/global_assets/js/plugins/tables/datatables/extensions/pdfmake/vfs_fonts.min.js"></script>
    <script
        src="{{ asset('master-demo') }}/global_assets/js/plugins/tables/datatables/extensions/buttons.min.js"></script>
    <script src="{{ asset('master-demo') }}/global_assets/js/demo_pages/datatables_extension_buttons_html5.js"></script>
@endsection

