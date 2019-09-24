@extends('layouts.admin')

@section('content')
    <h1>Posts</h1>

  <table class="table table-striped">
    <thead>
        <tr>
        <th>ID</th>
        <th>Post author</th>
        <th>Photo</th>
        <th>Category</th>
        <th>Title</th>
        <th>Body</th>
        <th>Created</th>
        <th>Updated</th>
        {{-- <th>Edit</th> --}}
        </tr>
    </thead>
    <tbody>
        @if($posts)   
        @foreach ($posts as $post)
            <tr>
            <td>{{$post->id}}</td>
            <td>{{$post->user->name}}</td>
            <td> <img height="50" src="{{$post->photo ? $post->photo->file : 'https://via.placeholder.com/200x200'}}" alt=""> </td>        
            <td>{{$post->category_id}}</td>
            <td>{{$post->title}}</td>
            <td>{{$post->body}}</td>
            <td>{{$post->created_at->diffForHumans()}}</td>
            <td>{{$post->updated_at->diffForHumans()}}</td>
            {{-- <td> <a href="/admin/users/{{$user->id}}/edit">Edit</a> </td> --}}
            </tr>      
        @endforeach
        @endif 
    </tbody>
  </table>
@endsection