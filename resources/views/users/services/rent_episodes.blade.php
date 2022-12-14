@extends('layouts.users.app')

@section('title', 'HHMMS | Rents')

@section('content')

<div class="d-flex justify-content-between align-items-center p-2 my-3 text-white bg-secondary rounded shadow-sm">
    <div class="lh-1">
        <h1 class="h5 mb-0 text-white lh-1">Rent Episodes</h1>
    </div>
     <input type="search" class="form-control" style="width: 40%" placeholder="Search..." id="search">
    <button class="btn btn-outline-dark btn-sm float-right create" value="new_rent" data-bs-target="#getModal" data-bs-toggle="modal" title="New Rent">Add Rent</button>
</div>

  @include('includes.error_display')

<div class="my-3 p-3 bg-body rounded shadow-sm">
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Master</th>
                <th scope="col">Contact</th>
                <th scope="col">Month, Year</th>
                <th scope="col">Amount</th>
                <th scope="col">Date</th>
                <th scope="col">Staff</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody id="employee_table">
                @forelse ($rents as $key => $rent)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $rent->staff->name }}</td>
                        <td>{{ $rent->staff->mobile }}</td>
                        <td>{{ $rent->month_year }}</td>
                        <td>{{ formatCedisAmount($rent->amount) }}</td>
                        <td>{{ formatDate($rent->rent_date) }}</td>
                        <td>{{ getUsername($rent->updated_by) }}</td>
                        <td>
                            <div class="btn-group">
                                {{-- <button class="btn btn-info btn-sm view" value="{{ $customer->customer_id }}" data-bs-target="#getModal" data-bs-toggle="modal" title="View Details">View</button> --}}
                                <button class="btn btn-success btn-sm edit" value="{{ $rent->rent_id }}" data-bs-target="#getModal" data-bs-toggle="modal" title="Edit Details">Edit</button>
                                <button class="btn btn-danger btn-sm delete" value="{{ $rent->rent_id }}" data-bs-toggle="modal" data-bs-target="#comfirm-delete" role="button">Del</button>
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

            });

            $(document).on('click', '.create', function(){
                $('.modal-title').text('Add New Rent');

                var createModal=$(this).val();
                $.get('create-modal/'+createModal, function(result) {
                    
                    $(".modal-body").html(result);
                    
                })
            });

            $(document).on('click', '.edit', function(){
                $('.modal-title').text('Edit Rent Details');

                var editModal=$(this).val();
                $.get('edit-modal/edit_rent/'+editModal, function(result) {
                    
                    $(".modal-body").html(result);
                    
                })
            });

            $(document).on('click', '.delete', function(){
                $('.modal-title').text('Delete Confirmation');
        
                var id=$(this).val();
                $.get('delete-modal/delete_rent/'+id, function(result) {
                    
                    $(".modal-body").html(result);
                    
                })
            });
        };
        
    </script>
    
@endpush
  
@endsection
