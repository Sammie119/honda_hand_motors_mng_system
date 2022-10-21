@extends('layouts.users.app')

@section('title', 'HHMMS | Transactions Payments')

@section('content')

<div class="d-flex justify-content-between align-items-center p-2 my-3 text-white bg-secondary rounded shadow-sm">
    <div class="lh-1">
        <h1 class="h5 mb-0 text-white lh-1">Transactions Payment List</h1>
    </div>
    <button class="btn btn-outline-dark btn-sm float-right create" value="new_transaction" data-bs-target="#getlargeModal" data-bs-toggle="modal" title="New Transaction" style="visibility: hidden">New Transaction</button>
</div>

  @include('includes.error_display')

<div class="my-3 p-3 bg-body rounded shadow-sm">
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Receipt #</th>
                <th scope="col">Car #</th>
                <th scope="col">Customer Name</th>
                <th scope="col">Total Amount</th>
                <th scope="col">Amount Paid</th>
                <th scope="col">Balance</th>
                <th scope="col">Date</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
                @forelse ($transactions as $key => $transaction)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $transaction->receipt_no }}</td>
                        <td>{{ $transaction->car_no }}</td>
                        <td>{{ $transaction->customer->customer_name }}</td>
                        <td>{{ formatCedisAmount($transaction->total_amount) }}</td>
                        <td>{{ formatCedisAmount($transaction->amount_paid) }}</td>
                        <td>{{ formatCedisAmount($transaction->balance) }}</td>
                        <td>{{ formatDate($transaction->transaction_date) }}</td>
                        <td>
                            <div class="btn-group">
                                <button class="btn btn-secondary btn-sm payment" value="{{ $transaction->invoice_no }}" data-bs-target="#getModal" data-bs-toggle="modal" title="Make Payment">Pay</button>
                                <a href="print_receipt/{{ $transaction->transaction_id }}" class="btn btn-info btn-sm print" title="Print Receipt">Print</a>
                                <button class="btn btn-danger btn-sm delete" value="{{ $transaction->transaction_id }}" data-bs-toggle="modal" data-bs-target="#comfirm-delete" role="button">Del</button>
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
                
                $('#car_no').focus();

            });

            $(document).on('click', '.payment', function(){
                $('.modal-title').text('Make Payment');

                var editModal=$(this).val();
                $.get('edit-modal/store_payment/'+editModal, function(result) {
                    
                    $(".modal-body").html(result);
                    
                })
            });

            $(document).on('click', '.delete', function(){
                $('.modal-title').text('Delete Confirmation');
        
                var id=$(this).val();
                $.get('delete-modal/delete_transaction_receipt/'+id, function(result) {
                    
                    $(".modal-body").html(result);
                    
                })
            });
        };
        
    </script>
    
@endpush
  
@endsection
