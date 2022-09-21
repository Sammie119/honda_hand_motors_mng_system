@extends('layouts.users.app')

@section('title', 'Home')

@section('content')

  <div class="d-flex align-items-center p-3 my-3 text-white bg-purple rounded shadow-sm">
    <div class="lh-1">
    <h1 class="h6 mb-0 text-white lh-1">Page Title</h1>
    </div>
  </div>

  <div class="my-3 p-3 bg-body rounded shadow-sm">
    <table class="table table-striped table-hover">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">First</th>
        <th scope="col">Last</th>
        <th scope="col">Handle</th>
        </tr>
    </thead>
    <tbody>
        <tr>
        <th scope="row">1</th>
        <td>Mark</td>
        <td>Otto</td>
        <td>@mdo</td>
        </tr>
        <tr>
        <th scope="row">2</th>
        <td>Jacob</td>
        <td>Thornton</td>
        <td>@fat</td>
        </tr>
        <tr>
        <th scope="row">3</th>
        <td>Larry the Bird</td>
        <td>Larry the Birdngfhgfhgfhgfhghghgb</td>
        <td>@twitter</td>
        </tr>
    </tbody>
    </table>
  </div>
  
@endsection