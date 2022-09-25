@extends('layouts.admin.app')

@section('title', 'HHMMS | User')

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Users List</h1>
            <button class="btn btn-outline-dark create" value="new_user" data-bs-target="#getModal" data-bs-toggle="modal" title="New User">Add User</button>
        </div>

        @include('includes.error_display')

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Level</th>
                    <th scope="col">Department</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                    @forelse ($users as $key => $user)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->mobile_no }}</td>
                            <td>{{ $user->user_level }}</td>
                            <td>{{ $user->department }}</td>
                            <td>
                                <div class="btn-group">
                                    {{-- <button class="btn btn-info btn-sm view" value="{{ $user->user_id }}" data-bs-target="#getModal" data-bs-toggle="modal" title="View Details">View</button> --}}
                                    <button class="btn btn-success btn-sm edit" value="{{ $user->user_id }}" data-bs-target="#getModal" data-bs-toggle="modal" title="Edit Details">Edit</button>
                                    <button class="btn btn-danger btn-sm delete" value="{{ $user->user_id }}" data-bs-toggle="modal" data-bs-target="#comfirm-delete" role="button">Del</button>
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
    </main>

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

                });

                $(document).on('click', '.create', function(){
                    $('.modal-title').text('Add New User');

                    var createModal=$(this).val();
                    $.get('create-modal/'+createModal, function(result) {
                        
                        $(".modal-body").html(result);
                        
                    })
                });

                $(document).on('click', '.edit', function(){
                    $('.modal-title').text('Edit User Details');

                    var editModal=$(this).val();
                    $.get('edit-modal/edit_user/'+editModal, function(result) {
                        
                        $(".modal-body").html(result);
                        
                    })
                });

                $(document).on('click', '.delete', function(){
                    $('.modal-title').text('Delete Confirmation');
            
                    var id=$(this).val();
                    $.get('delete-modal/delete_user/'+id, function(result) {
                        
                        $(".modal-body").html(result);
                        
                    })
                });
            };
            
        </script>
        
    @endpush

@endsection