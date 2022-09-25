@extends('layouts.users.app')

@section('title', 'HHMMS | Transactions')

@section('content')

<div class="d-flex justify-content-between align-items-center p-2 my-3 text-white bg-secondary rounded shadow-sm">
    <div class="lh-1">
        <h1 class="h5 mb-0 text-white lh-1">Transactions List</h1>
    </div>
    <button class="btn btn-outline-dark btn-sm float-right create" value="new_service" data-bs-target="#getModal" data-bs-toggle="modal" title="New Service" style="visibility: hidden">New Transaction</button>
</div>

  @include('includes.error_display')

<div class="my-3 p-3 bg-body rounded shadow-sm">
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Receipt#</th>
                <th scope="col">Car No</th>
                <th scope="col" nowrap>Customer Name</th>
                <th scope="col">Car Model</th>
                <th scope="col">Charge</th>
                <th scope="col">Paid</th>
                <th scope="col">Balance</th>
                <th scope="col">Date</th>
                <th scope="col">Staff</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
                @forelse ($services as $key => $service)
                    <tr>
                        @php
                            $count = \App\Models\CarServiceRequest::where('service_no', $service->service_no)->count();
                        @endphp
                        <td>{{ ++$key }}</td>
                        <td align="right">{{ $service->receipt_no }}</td>
                        <td>{{ $service->car_no }}</td>
                        <td>{{ $service->customer->customer_name }}</td>
                        <td>{{ $service->customer->car_model }}</td>
                        <td>{{ formatCedisAmount($service->ser_charge) }}</td>
                        <td>{{ formatCedisAmount($service->amount_paid) }}</td>
                        <td>{{ formatCedisAmount($service->balance) }}</td>
                        <td>{{ formatDate($service->updated_at) }}</td>
                        <td>{{ getUsername($service->updated_by) }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="reprint_receipt/{{ $service->service_id }}" class="btn btn-info btn-sm print" title="Reprint Receipt">Print</a>
                                @if ($service->status === 0)
                                    <button class="btn btn-secondary btn-sm pay" value="{{ $service->service_no }}" data-bs-target="#getModal" data-bs-toggle="modal" title="Make Payment">Pay</button> 
                                @endif
                                
                                <button class="btn btn-success btn-sm edit" value="{{ $service->service_id }}" data-bs-target="#getModal" data-bs-toggle="modal" title="Edit Details">Edit</button>
                                
                                @if (Auth()->user()->user_level != 'User')
                                    <button class="btn btn-danger btn-sm delete" value="{{ $service->service_id }}" data-bs-toggle="modal" data-bs-target="#comfirm-delete" role="button">Del</button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10">No data Found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@include('modals.medium-modal')
@include('modals.confirm-modal')

  @push('scripts')
    <script>
        window.onload = function(){
            $('#search').focus();

        // Table filter
            $('#search').keyup(function(){  
                search_table($(this).val());  
            });  
            function search_table(value){  
                $('#employee_table tr').each(function(){  
                    var found = 'false';  
                    $(this).each(function(){  
                        if($(this).text().toLowerCase().indexOf(value.toLowerCase()) >= 0){  
                            found = 'true';  
                        }  
                    });  
                    if(found == 'true'){  
                        $(this).show();  
                    }  
                    else{  
                        $(this).hide();  
                    }  
                });  
            }  

            $('#getModal').on('shown.bs.modal', function () {

                // $('#car_no').focus();

                @include('includes.service_payment_balance_check')

            });

            // $(document).on('click', '.create', function(){
            //     $('.modal-title').text('Add New Service');

            //     var createModal=$(this).val();
            //     $.get('create-modal/'+createModal, function(result) {
                    
            //         $(".modal-body").html(result);
                    
            //     })
            // });

            $(document).on('click', '.pay', function(){
                $('.modal-title').text('Service Payment');

                var viewModal=$(this).val();
                $.get('edit-modal/service_payment/'+viewModal, function(result) {
                    
                    $(".modal-body").html(result);
                    
                })
            });

            $(document).on('click', '.edit', function(){
                $('.modal-title').text('Edit Payment Details');

                var editModal=$(this).val();
                $.get('edit-modal/edit_service_payment/'+editModal, function(result) {
                    
                    $(".modal-body").html(result);
                    
                })
            });

            $(document).on('click', '.delete', function(){
                $('.modal-title').text('Delete Confirmation');
        
                var id=$(this).val();
                $.get('delete-modal/delete_service/'+id, function(result) {
                    
                    $(".modal-body").html(result);
                    
                })
            });
        };
        
    </script>
    
@endpush
  
@endsection
