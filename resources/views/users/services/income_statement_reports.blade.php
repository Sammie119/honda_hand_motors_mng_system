@extends('layouts.users.app')

@section('title', 'HHMMS | Income Statement')

@section('content')

<div class="d-flex justify-content-between align-items-center p-2 my-3 text-white bg-secondary rounded shadow-sm">
    <div class="lh-1">
        <h1 class="h5 mb-0 text-white lh-1">Income Statement</h1>
    </div>
    <button class="btn btn-outline-dark btn-sm float-right" style="visibility: hidden">Add Expenditure</button>
</div>

@include('includes.error_display')

<div class="my-3 p-3 bg-body rounded shadow-sm">

    <form action="get_pharmacy_report" method="POST" autocomplete="off">
        @csrf
        <div class="row">
            <div class="col-4">
                <div class="form-floating mb-3 mb-md-0">
                    <select name="report_type" id="report_type" class="form-control form-control-border" required>
                        <option value="" selected disabled>Select Report Type</option>
                        <option value="IncomeStatement">Income Statement Report</option>
                        
                    </select>
                    <label>Amount</label>
                </div>
            </div>
            <div class="col-4">
                <div class="form-floating mb-3 mb-md-0">
                    <select name="report_month" id="report_month" class="form-control form-control-border" required>
                        <option value="" selected disabled>Select Reporting Month</option>
                        <option>January</option>
                        <option>February</option>
                        <option>March</option>
                        <option>April</option>
                        <option>May</option>
                        <option>June</option>
                        <option>July</option>
                        <option>August</option>
                        <option>September</option>
                        <option>October</option>
                        <option>November</option>
                        <option>December</option>
                    </select>
                    <label for="recipient-name" class="control-label">Reporting Month:</label>
                </div>
            </div>
            <div class="col-4">
                <div class="form-floating mb-3 mb-md-0">
                    <select name="report_year" id="report_year" class="form-control form-control-border" required>
                        <option value="" selected disabled>Select Reporting Year</option>
                        <?php 
                        for($i = 2022; $i <= date('Y'); $i++){
                            echo "<option>$i</option>";
                        }
                        ?>
                    </select>
                    <label for="recipient-name" class="control-label">Reporting Year:</label>
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
            if(document.getElementById('report_month').value == '' && document.getElementById('report_year').value == '' && document.getElementById('report_type').value == ''){
                document.getElementById('gif_load').style.display = 'none';
            }
            else{
                document.getElementById('gif_load').style.display = 'block';
            }
        });
    </script> 
    
@endpush
  
@endsection
