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

    <form action="income_accounts_report" method="POST" autocomplete="off">
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
                <div class="row">
                    <div class="col-6">
                        <div class="form-floating mb-3 mb-md-0">
                            <select name="report_month_from" id="report_month_from" class="form-control form-control-border" required>
                                <option value="" selected disabled>--Select Month--</option>
                                <option value="01">January</option>
                                <option value="02">February</option>
                                <option value="03">March</option>
                                <option value="04">April</option>
                                <option value="05">May</option>
                                <option value="06">June</option>
                                <option value="07">July</option>
                                <option value="08">August</option>
                                <option value="09">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                            <label for="recipient-name" class="control-label">Report Month From:</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating mb-3 mb-md-0">
                            <select name="report_year_from" id="report_year_from" class="form-control form-control-border" required>
                                <option value="" selected disabled>--Select Year--</option>
                                <?php 
                                for($i = 2022; $i <= date('Y'); $i++){
                                    echo "<option>$i</option>";
                                }
                                ?>
                            </select>
                            <label for="recipient-name" class="control-label">Report Year From:</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="row">
                    <div class="col-6">
                        <div class="form-floating mb-3 mb-md-0">
                            <select name="report_month_to" id="report_month_to" class="form-control form-control-border" required>
                                <option value="" selected disabled>--Select Month--</option>
                                <option value="01">January</option>
                                <option value="02">February</option>
                                <option value="03">March</option>
                                <option value="04">April</option>
                                <option value="05">May</option>
                                <option value="06">June</option>
                                <option value="07">July</option>
                                <option value="08">August</option>
                                <option value="09">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                            <label for="recipient-name" class="control-label">Report Month To:</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-floating mb-3 mb-md-0">
                            <select name="report_year_to" id="report_year_to" class="form-control form-control-border" required>
                                <option value="" selected disabled>--Select Year--</option>
                                <?php 
                                for($i = 2022; $i <= date('Y'); $i++){
                                    echo "<option>$i</option>";
                                }
                                ?>
                            </select>
                            <label for="recipient-name" class="control-label">Report Year To:</label>
                        </div>
                    </div>
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
            if(document.getElementById('report_month_from').value == '' && document.getElementById('report_year_to').value == '' && document.getElementById('report_type').value == ''){
                document.getElementById('gif_load').style.display = 'none';
            }
            else{
                document.getElementById('gif_load').style.display = 'block';
            }
        });
    </script> 
    
@endpush
  
@endsection
