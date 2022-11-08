@extends('layouts.users.app')

@section('title', 'HHMMS | Home')

@section('content')

<div class="d-flex justify-content-between align-items-center p-2 my-3 text-white bg-secondary rounded shadow-sm">
    <div class="lh-1">
        <h1 class="h5 mb-0 text-white lh-1">Home</h1>
    </div>
    <button class="btn btn-outline-dark btn-sm" style="visibility: hidden">add</button>
</div>

  @include('includes.error_display')

  <div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary text-white mb-1">
            <div class="card-body">Staff Number: <strong>12</strong></div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="#">View Details</a>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-warning text-white mb-1">
            <div class="card-body">Registered Customers: <strong>{{ \App\Models\Customer::count() }}</strong></div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                {{-- <a class="small text-white stretched-link" href="{{ route('customers') }}">View Details</a> --}}
                <a class="small text-white stretched-link" href="#">View Details</a>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-success text-white mb-1">
            <div class="card-body">Services Rendered: <strong>{{ \App\Models\CarServiceRequest::where('amount_paid', 0)->count() }}</strong></div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                {{-- <a class="small text-white stretched-link" href="{{ route('services') }}">View Details</a> --}}
                <a class="small text-white stretched-link" href="#">View Details</a>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-danger text-white mb-1">
            <div class="card-body">Number of Store Items: <strong>{{ \App\Models\Item::count() }}</strong></div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="#">View Details</a>
                {{-- <a class="small text-white stretched-link" href="{{ route('items') }}">View Details</a> --}}
            </div>
        </div>
    </div>
</div>

  <div class="my-3 p-3 bg-body rounded shadow-sm">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th scope="col" colspan="5">Masters List</th>
            </tr>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Position</th>
                <th scope="col">Contact</th>
            </tr>
        </thead>
        <tbody>

            @foreach (\App\Models\Staff::where('position', 'Master')->orderBy('name')->get() as $key => $master)
                <tr>
                    <th scope="row">{{ ++$key }}</th>
                    <td>{{ $master->name }}</td>
                    <td>{{ $master->position }}</td>
                    <td>{{ $master->mobile }}</td>
                </tr>
            @endforeach
            
        </tbody>
    </table>
  </div>
  
@endsection