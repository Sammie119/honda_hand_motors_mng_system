@extends('layouts.users.app')

@section('title', 'HHMMS | Home')

@section('content')

<div class="d-flex justify-content-between align-items-center p-2 my-3 text-white bg-secondary rounded shadow-sm">
    <div class="lh-1">
        <h1 class="h5 mb-0 text-white lh-1">Customers List</h1>
    </div>
    <button class="btn btn-outline-dark btn-sm float-right create" value="new_customer" data-bs-target="#getModal" data-bs-toggle="modal" title="New Customer">Add Customer</button>
</div>

  @include('includes.error_display')

<div class="my-3 p-3 bg-body rounded shadow-sm">
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Car No</th>
                <th scope="col">Owner Name</th>
                <th scope="col">Driver Name</th>
                <th scope="col">Car Model</th>
                <th scope="col">Fuel</th>
                <th scope="col">Driver Tel</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
                @forelse ($customers as $key => $customer)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $customer->car_no }}</td>
                        <td>{{ $customer->customer_name }}</td>
                        <td>{{ $customer->driver_name }}</td>
                        <td>{{ $customer->car_model }}</td>
                        <td>{{ $customer->fuel }}</td>
                        <td>{{ $customer->driver_contact }}</td>
                        <td>
                            <div class="btn-group">
                                {{-- <button class="btn btn-info btn-sm view" value="{{ $customer->customer_id }}" data-bs-target="#getModal" data-bs-toggle="modal" title="View Details">View</button> --}}
                                <button class="btn btn-success btn-sm edit" value="{{ $customer->customer_id }}" data-bs-target="#getModal" data-bs-toggle="modal" title="Edit Details">Edit</button>
                                <button class="btn btn-danger btn-sm delete" value="{{ $customer->customer_id }}" data-bs-toggle="modal" data-bs-target="#comfirm-delete" role="button">Del</button>
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

                $('.staff').focus();

                $('.staff').bind('change',function(){   
                    var staff = $('.staff').val();
                    // var staff_id = document.querySelector('.staff_id').value;
                    
                    $.ajax({
                        type:'GET',
                        url:"get-staff-info",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            staff
                            },
                        success:function(data) {
                            if(data === ''){
                                return;
                            }
                            else {
                                $("#position").val(data.position);
                                $("#basic_salary").val(data.salary);
                                $("#staff_id").val(data.staff_id);
                            }
                        }
                    });
                });

            });

            $(document).on('click', '.create', function(){
                $('.modal-title').text('Add New Customer');

                var createModal=$(this).val();
                $.get('create-modal/'+createModal, function(result) {
                    
                    $(".modal-body").html(result);
                    
                })
            });

            $(document).on('click', '.view', function(){
                $('.modal-title').text('View Customer Details');

                var viewModal=$(this).val();
                $.get('view-modal/view_customer/'+viewModal, function(result) {
                    
                    $(".modal-body").html(result);
                    
                })
            });

            $(document).on('click', '.edit', function(){
                $('.modal-title').text('Edit Customer Details');

                var editModal=$(this).val();
                $.get('edit-modal/edit_customer/'+editModal, function(result) {
                    
                    $(".modal-body").html(result);
                    
                })
            });

            $(document).on('click', '.delete', function(){
                $('.modal-title').text('Delete Confirmation');
        
                var id=$(this).val();
                $.get('delete-modal/delete_customer/'+id, function(result) {
                    
                    $(".modal-body").html(result);
                    
                })
            });
        };
        
    </script>
    
@endpush
  
@endsection
