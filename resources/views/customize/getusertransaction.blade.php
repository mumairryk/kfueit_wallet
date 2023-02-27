@extends('layouts.master')
@section('page_title', 'Welcome')
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
        <h3>Financial Transactions</h3>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Sr#</th>
                <th>Transaction ID</th>
                <th>Service_type</th>
                <th>service_desc</th>
                <th>Debit</th>
                <th>Credit</th>
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
                    @if($transaction->debit == 0)
                        <td></td>
                    @else
                        <td>{{ $transaction->debit }}</td>
                    @endif

                    @if($transaction->credit == 0)
                        <td></td>
                    @else
                        <td>{{ $transaction->credit }}</td>
                    @endif
                    <td>{{ $transaction->created_at }}</td>
                </tr>
                @php($sr=$sr+1)
                @php($total_debit=$total_debit+$transaction->debit)
                @php($total_credit=$total_credit+$transaction->credit)
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>Total</td>
                <td>{{$total_debit}}</td>
                <td>{{$total_credit}}</td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td>Balance</td>
                <td>{{$total_debit-$total_credit}}</td>
                <td></td>
                <td></td>
            </tr>
            </tbody>
        </table>
    </div>

    {{--<script--}}
    {{--$("#btn_single_trans").click(function(){--}}
    {{--alert(''hello);--}}
    {{--});--}}
    {{--</script>--}}
@endsection
