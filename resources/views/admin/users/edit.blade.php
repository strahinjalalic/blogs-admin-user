@extends('layouts.admin')

@section('content')
    <h1>Edit User</h1>

   <div class="row">
    <div class="col-sm-3">
        <img src="{{ $user->photo ? $user->photo->file : 'https://via.placeholder.com/250x250' }}" height="250" width="250" alt="" class="responsive img-rounded">
    </div>


    <div class="col-sm-9">
        {!! Form::model($user, ['method'=>'PATCH', 'action'=>['AdminUsersController@update', $user->id], 'files'=>true]) !!}

            {{csrf_field()}} 

            <div class="form-group">
                {!! Form::label('name', 'Name: ') !!}
                {!! Form::text('name', null, ['class'=>'form-control'],) !!}
            </div>
            <div class="form-group">
                    {!! Form::label('email', 'E-mail: ') !!}
                    {!! Form::email('email', null, ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                    {!! Form::label('password', 'Password: ') !!}
                    {!! Form::password('password', ['class'=>'form-control']) !!}
            </div>
            <div class="form-group">
                        {!! Form::label('role_id', 'Role: ') !!}
                        {!! Form::select('role_id', [1 => 'Administrator', 2 => 'Author', 3 =>'Subscriber'], null, ['placeholder'=>'Choose role', 'class'=>'form-control']); !!}
            </div>
            <div class="form-group">
                    {!! Form::label('photo_id', 'File: ') !!}
                    {!! Form::file('photo_id', null, ['class'=>'form-control']) !!}
                </div>
            <div class="form-group">
                    {!! Form::label('status', 'Status: ') !!}
                    {!! Form::select('status', [1 => 'Active', 0 => 'Not Active'], null, ['class'=>'form-control']); !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Edit User', ['class'=>'btn btn-primary']) !!}
            </div>
        {!! Form::close() !!}    
    </div>
</div> 

@include('includes.form_errors')

@endsection