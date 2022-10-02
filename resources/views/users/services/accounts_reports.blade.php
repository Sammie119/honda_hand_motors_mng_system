@extends('layouts.users.app')

@section('title', 'HHMMS | Accounts Report')

@section('content')

<div class="d-flex justify-content-between align-items-center p-2 my-3 text-white bg-secondary rounded shadow-sm">
    <div class="lh-1">
        <h1 class="h5 mb-0 text-white lh-1">Accounts Report</h1>
    </div>
    <button class="btn btn-outline-dark btn-sm float-right" style="visibility: hidden">Add Expenditure</button>
</div>

@include('includes.error_display')

<div class="my-3 p-3 bg-body rounded shadow-sm">

    <form action="income_accounts_report" method="POST" autocomplete="off">
        @csrf
        <div class="row">
            <div class="col-4">
                <div class="form-floating mb-3 mb-md-0">
                    <select name="report_type" id="report_type" class="form-control form-control-border" required>
                        <option value="" selected disabled>Select Report Type</option>
                        <option value="Accounts">Accounts Report</option>
                        <option value="PettyCash">Petty Cash Report</option>
                        <option value="CashBook">Cash Book Report</option>
                        <option value="MainLabour">Main Labour Report</option>
                        <option value="RentAccount">Rent Account Report</option>
                        <option value="LabourIncome">Labour Income</option>
                    </select>
                    <label>Amount</label>
                </div>
            </div>
            <div class="col-4">
                <div class="form-floating mb-3 mb-md-0">
                    <input class="form-control" id="report_from" name="report_from" type="date" max="{{ date('Y-m-d') }}" required placeholder=" " />
                    <label>Repert From</label>
                </div>
            </div>
            <div class="col-4">
                <div class="form-floating mb-3 mb-md-0">
                    <input class="form-control" id="report_from" name="report_to" type="date" max="{{ date('Y-m-d') }}" required placeholder=" " />
                    <label>Repert To</label>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <button type="submit" style="margin-left: auto;" class="btn btn-primary float-right load">Submit</button>
        </div>
    </form>
    <div class="d-flex justify-content-center">
        <ul class="list-group list-group-flush" id="gif_load" style="display: none">
            <li class="list-group-item d-flex justify-content-center"><img src="{{ asset('public/assets/images/loading.gif') }}" id="gif_load" height="100px" alt="Loading"></li>
            <li class="list-group-item d-flex justify-content-center"><h4 style="font-weight: bolder;" id="lab">Report Loading....</h4></li>
            <li class="list-group-item d-flex justify-content-center"><small style="font-weight: bolder;" id="lab">This will take about 5 minutes</small></li>
        </ul>
    </div>
    
</div>



@push('scripts')
    <script>
        $('.load').click(function () {
            if(document.getElementById('report_from').value == '' && document.getElementById('report_from').value == '' && document.getElementById('report_type').value == ''){
                document.getElementById('gif_load').style.display = 'none';
            }
            else{
                document.getElementById('gif_load').style.display = 'block';
            }
        });
    </script> 
    
@endpush
  
@endsection
