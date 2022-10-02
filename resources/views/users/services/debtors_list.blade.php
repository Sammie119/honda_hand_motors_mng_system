@extends('layouts.users.app')

@section('title', 'HHMMS | Debtors List')

@section('content')

<div class="d-flex justify-content-between align-items-center p-2 my-3 text-white bg-secondary rounded shadow-sm">
    <div class="lh-1">
        <h1 class="h5 mb-0 text-white lh-1">Debtors List</h1>
    </div>
    <button class="btn btn-outline-dark btn-sm float-right" style="visibility: hidden">Add Expenditure</button>
</div>

@include('includes.error_display')

<div class="my-3 p-3 bg-body rounded shadow-sm">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Car #</th>
                <th scope="col">Customer Name</th>
                <th scope="col">Engineer Name</th>
                <th scope="col">Charge</th>
                <th scope="col">Amount Paid</th>
                <th scope="col">Balance</th>
                <th scope="col">Date</th>
            </tr>
        </thead>
        <tbody>
            @php
                $debtors_list = [];
            @endphp
            @foreach ($debtors as $key => $debtor)
                @if (($debtor->ser_charge - $debtor->amount_paid) > 0)
                    @php
                        $debtors_list[] = $debtor;
                    @endphp
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{$debtor->car_no }}</td>
                        <td>{{ $debtor->customer->customer_name }}</td>
                        <td>{{ $debtor->engineer }}</td>
                        <td>{{ formatCedisAmount($debtor->ser_charge) }}</td>
                        <td>{{ formatCedisAmount($debtor->amount_paid) }}</td>
                        <td>{{ formatCedisAmount($debtor->ser_charge - $debtor->amount_paid) }}</td>
                        <td>{{ formatDate($debtor->service_date) }}</td>
                    </tr>
                @endif
            @endforeach

            @php
                $debtors = json_encode($debtors_list);
            @endphp
        </tbody>
    </table>    
    <div>
        <form action="income_accounts_report" method="POST">
            @csrf
            <input type="hidden" name="report_type" value="Debtors">
            <input type="hidden" name="debtors" value="{{ $debtors }}">
            <button type="submit" class="btn btn-primary btn-sm" style="margin-left: 96%">Print</button>
        </form>
    </div>
</div>
  
@endsection
