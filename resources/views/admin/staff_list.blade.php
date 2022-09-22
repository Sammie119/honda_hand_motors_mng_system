@extends('layouts.admin.app')

@section('title', 'HHMMS | Staff')

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Staff List</h1>
            {{-- <input class="form-control float-right" type="search" placeholder="Search" aria-label="Search" style="width: 20%"> --}}
            <button class="btn btn-outline-dark create" value="new_staff" data-bs-target="#getModal" data-bs-toggle="modal" title="New Staff">Add Staff</button>
        </div>

        @include('includes.error_display')

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Position</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Address</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                    @forelse ($staffs as $key => $staff)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $staff->name }}</td>
                            <td>{{ $staff->position }}</td>
                            <td>{{ $staff->mobile }}</td>
                            <td>{{ $staff->address }}</td>
                            <td>
                                <div class="btn-group">
                                    {{-- <button class="btn btn-info btn-sm view" value="{{ $staff->staff_id }}" data-bs-target="#getModal" data-bs-toggle="modal" title="View Details">View</button> --}}
                                    <button class="btn btn-success btn-sm edit" value="{{ $staff->staff_id }}" data-bs-target="#getModal" data-bs-toggle="modal" title="Edit Details">Edit</button>
                                    <button class="btn btn-danger btn-sm delete" value="{{ $staff->staff_id }}" data-bs-toggle="modal" data-bs-target="#comfirm-delete" role="button">Del</button>
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
                    $('.modal-title').text('Add New Staff');

                    var createModal=$(this).val();
                    $.get('create-modal/'+createModal, function(result) {
                        
                        $(".modal-body").html(result);
                        
                    })
                });

                $(document).on('click', '.view', function(){
                    $('.modal-title').text('View Staff Details');

                    var viewModal=$(this).val();
                    $.get('view-modal/view_staff/'+viewModal, function(result) {
                        
                        $(".modal-body").html(result);
                        
                    })
                });

                $(document).on('click', '.edit', function(){
                    $('.modal-title').text('Edit Staff Details');

                    var editModal=$(this).val();
                    $.get('edit-modal/edit_staff/'+editModal, function(result) {
                        
                        $(".modal-body").html(result);
                        
                    })
                });

                $(document).on('click', '.delete', function(){
                    $('.modal-title').text('Delete Confirmation');
            
                    var id=$(this).val();
                    $.get('delete-modal/delete_staff/'+id, function(result) {
                        
                        $(".modal-body").html(result);
                        
                    })
                });
            };
            
        </script>
        
    @endpush

@endsection