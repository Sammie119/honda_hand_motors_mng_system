@extends('layouts.users.app')

@section('title', 'HHMMS | Car Report')

@section('content')

<div class="d-flex justify-content-between align-items-center p-2 my-3 text-white bg-secondary rounded shadow-sm">
    <div class="lh-1">
        <h1 class="h5 mb-0 text-white lh-1">Specific Car Report</h1>
    </div>
    <button class="btn btn-outline-dark btn-sm float-right" style="visibility: hidden">Add Expenditure</button>
</div>

@include('includes.error_display')

<div class="my-3 p-3 bg-body rounded shadow-sm">

    <div class="row">
        <div class="col-4" style="margin: auto;">
            <div class="form-floating mb-3 mb-md-0">
                <input type="text" name="car_no" id="car_no" class="form-control form-control-border" placeholder=" " required>
                <label>Car Number</label>
            </div>
        </div>
    </div>

    <div class="row mt-4 mb-4">
        <button type="button" class="btn btn-primary" id="submit">Generate</button>
    </div>

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Date</th>
                <th scope="col">Car #</th>
                <th scope="col">Customer Name</th>
                <th scope="col">Engineer Name</th>
                <th scope="col">Charge</th>
                <th scope="col">Amount Paid</th>
                <th scope="col">Balance</th>
            </tr>
        </thead>
        <tbody id="car_info">
            <tr>
                <td colspan="8">No Data Found</td>
            </tr>
        </tbody>
    </table> 

    <div>
        <form action="income_accounts_report" method="POST">
            @csrf
            <input type="hidden" name="report_type" value="Car_info">
            <input type="hidden" name="car_info" id="car_information">
            <button type="submit" class="btn btn-primary btn-sm" style="margin-left: 96%">Print</button>
        </form>
    </div> 
    
</div>

@push('scripts')
    <script>
        window.onload = function(){
            $('#car_no').focus();

            $('#submit').bind('click',function(){   
                var car_no = $('#car_no').val();

                $('#car_information').val(car_no);
                
                $.ajax({
                    type:'GET',
                    url:"car-info",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        car_no
                        },
                    success:function(data) {
                        if(data === ''){
                            $("#car_info").empty();
                            $("#car_info").html("<tr><td colspan='8'>No data Found</td></tr>");
                        }
                        else {
                            $("#car_info").empty();
                            $("#car_info").html(data);
                        }
                    }
                });
            });

            
        };
        
    </script>
    
@endpush
  
@endsection
