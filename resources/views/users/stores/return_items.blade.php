@extends('layouts.users.app')

@section('title', 'HHMMS | Returned Items')

@section('content')

<div class="d-flex justify-content-between align-items-center p-2 my-3 text-white bg-secondary rounded shadow-sm">
    <div class="lh-1">
        <h1 class="h5 mb-0 text-white lh-1">Returned Items List</h1>
    </div>
    <button class="btn btn-outline-dark btn-sm float-right create" value="new_return" data-bs-target="#getlargeModal" data-bs-toggle="modal" title="New Return">New Return</button>
</div>

  @include('includes.error_display')

<div class="my-3 p-3 bg-body rounded shadow-sm">
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Invoice #</th>
                <th scope="col">Car #</th>
                <th scope="col">Customer Name</th>
                <th scope="col">Total Amount</th>
                <th scope="col">Date</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
                @forelse ($items as $key => $item)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $item->invoice_no }}</td>
                        <td>{{ $item->car_no }}</td>
                        <td>{{ $item->customer->customer_name }}</td>
                        <td>{{ formatCedisAmount($item->total_amount) }}</td>
                        <td>{{ formatDate($item->transaction_date) }}</td>
                        <td>
                            <div class="btn-group">
                                {{-- <button class="btn btn-success btn-sm edit" value="{{ $item->transaction_id }}" data-bs-target="#getlargeModal" data-bs-toggle="modal" title="Edit Details">Edit</button> --}}
                                <button class="btn btn-success btn-sm view" value="{{ $item->return_id }}" data-bs-target="#getlargeModal" data-bs-toggle="modal" title="View Details">View</button>
                                <button class="btn btn-danger btn-sm delete" value="{{ $item->return_id }}" data-bs-toggle="modal" data-bs-target="#comfirm-delete" role="button">Del</button>
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
@php
    $items = json_encode($item_array);
@endphp

@include('modals.large-modal')
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

            $('#getlargeModal').on('shown.bs.modal', function () {
                
                $('#car_no').focus();

                // console.log(document.getElementsByName('car_no'));

                $(function(){
                    $(".add-all-input").on("click", function(){
                        var items = $('#items').val();
                        
                        // Array for all labs to check if labs exists
                        var items_array = [];

                        items_array.push(<?=$items ?>);

                        if(items == ''){
                            alert('Empty items Selected');
                        } else if(items_array[0].includes(items)){
    
                            $.ajax({
                                type:'GET',
                                url:"get-item-info",
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: {
                                    items
                                    },
                                success:function(data) {
                                    if($(".products").length < 10){
                                        $(".products").append(
                                            `<div class="row mt-2">
                                                <div class="col-md-6">
                                                    <select class="form-control form-control-border bg-white" name="items_list[]" placeholder=" " style="height: 35px;"><option>${items}</option></select>
                                                </div>
                                                <div class="col-md-1">
                                                    <input class="form-control form-control-border bg-white stock" name="stock[]" type="number" value="${data.stock}" placeholder=" " style="height: 35px; padding: 0px; text-align: center" readonly>
                                                </div>
                                                <div class="col-md-1">
                                                    <input class="form-control form-control-border bg-white price" name="unit_price[]" type="number" value="${data.unit_price}" placeholder=" " style="height: 35px; padding: 0px; text-align: center" readonly>
                                                </div>
                                                <div class="col-md-1">
                                                    <input type="text" class="form-control form-control-border bg-white quantity" name="quantity[]" required placeholder=" " style="height: 35px; padding: 0px; text-align: center" >
                                                </div>
                                                <div class="col-md-2">
                                                    <input type="text" class="form-control form-control-border bg-white sub_total" name="amount[]" readonly placeholder=" " style="height: 35px; text-align: right" >
                                                </div>
                                                <div class="col-md-1">
                                                    <button type="button" class="btn btn-danger bottn_delete">Del</button>
                                                </div>
                                            </div>`
                                        );
                                        
                                    }
                                    
                                }
                            });
                            
                            console.log('TRUE');
                            document.querySelector('.add-input').style.display='none';
                
                        } else {
                            console.log('FALSE');
                            alert('Selected Item is not on the List');
                        }

                        $('#items').val('');
                        
                    });
                });

                $('#car_no').bind('change',function(){   
                    var car_no = $('#car_no').val();
                    
                    $.ajax({
                        type:'GET',
                        url:"get-car-info",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            car_no
                            },
                        success:function(data) {
                            if(data.customer_id === 'No_data'){
                                toastr.options =
                                {
                                "closeButton" : true,
                                "progressBar" : true
                                }
                                toastr.error("Customer not registered");

                                $("#car_no").val("");
                                $("#car_model").val("");
                                $("#customer_name").val("");
                                $("#customer_id").val(""); 
                                $("#customer_contact").val("");
                                $('#car_no').focus();
                            }
                            else {
                                $("#car_model").val(data.car_model);
                                $("#customer_name").val(data.customer_name);
                                $("#customer_id").val(data.customer_id); 
                                $("#customer_contact").val(data.customer_contact);
                            }
                        }
                    });
                });

                 // Add all amounts
                function TotalAmount(){
                    var totalAmount = 0;
                    $('.sub_total').each(function(i, e){
                        var s_total = $(this).val() - 0;

                        totalAmount += s_total;
                    });

                    $('.total_amount').val(totalAmount.toFixed(2));
                }

                $('.getTotalAmount').delegate('.quantity', 'keyup', function(){
                    var div = $(this).parent().parent();
                    var qty = div.find('.quantity').val() - 0;
                    var price = div.find('.price').val() - 0;
                    var total = qty * price;
                    div.find('.sub_total').val(total.toFixed(2));
                    TotalAmount();
                });

                // Checking quantity with stock
                $('.getTotalAmount').delegate('.quantity', 'keyup', function(){
                    var div = $(this).parent().parent();
                    var qty = div.find('.quantity').val() - 0;
                    var stock = div.find('.stock').val() - 0;
                    if(stock < qty){
                        alert('Quantity Entered is Greater than Quantity in Stock!!');
                        div.find('.quantity').val('');
                        div.find('.quantity').focus;
                    }
                    else if(qty == 0){
                        // alert('Quantity Entered should not be Zero (0)!!');
                        div.find('.quantity').val('');
                        div.find('.quantity').focus;
                    }
                });

                // delete row and subtract from total amount
                $('.getTotalAmount').delegate('.bottn_delete', 'click', function(){
                    var div = $(this).parent().parent();
                    var sub_total = div.find('.sub_total').val() - 0;
                    var total_amount = $('.total_amount').val() - 0;
                    var new_total = total_amount - sub_total;

                    $('.total_amount').val(new_total.toFixed(2));
                    //  alert(price);
                    div.remove();
                });


            });

            $(document).on('click', '.create', function(){
                $('.modal-title').text('Add New Transaction');

                var createModal=$(this).val();
                $.get('create-modal/'+createModal, function(result) {
                    
                    $(".modal-body").html(result);
                    
                })
            });

            $(document).on('click', '.view', function(){
                $('.modal-title').text('Returned Items Details');

                var editModal=$(this).val();
                $.get('view-modal/view_return/'+editModal, function(result) {
                    
                    $(".modal-body").html(result);
                    
                })
            });

            $(document).on('click', '.delete', function(){
                $('.modal-title').text('Delete Confirmation');
        
                var id=$(this).val();
                $.get('delete-modal/delete_return/'+id, function(result) {
                    
                    $(".modal-body").html(result);
                    
                })
            });
        };
        
    </script>
    
@endpush
  
@endsection
