@extends('layouts.admin')

@section('content')

<h1>Users</h1>

@if(Session::has('deleted_user')) 
  <p class='bg-danger'>{{ session('deleted_user') }}</p>  
@endif

<table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Photo</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Status</th>
        <th>Created</th>
        <th>Updated</th>
        <th>Edit</th>
      </tr>
    </thead>
    <tbody>
        @if($users)   
        @foreach ($users as $user)
          <tr>
            <td>{{$user->id}}</td>
            <td><img height="100" width="100" src="{{$user->photo ? $user->photo->file : 'https://via.placeholder.com/100x100' }}" alt=""></td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->role->name}}</td>
            <td>{{$user->status == 1 ? 'Active' : 'Not Active'}}</td>
            <td>{{$user->created_at->diffForHumans()}}</td>
            <td>{{$user->updated_at->diffForHumans()}}</td>
            <td> <a href="/admin/users/{{$user->id}}/edit">Edit</a> </td>
          </tr>      
        @endforeach
       @endif 
    </tbody>
  </table>
@endsection