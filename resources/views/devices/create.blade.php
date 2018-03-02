@extends('layouts.app')

@section('content')
    <h1>Create Device</h1>
    {!! Form::open(['action' => 'DevicesController@store','method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
        <div class="form-group">
        {{Form::label('imei','Imei')}}
        {{Form::text('imei','',['class'=>'form-control','placeholder'=>'Imei'])}}
        </div>
        <div class="form-group">
        {{Form::label('alias','Alias')}}
        {{Form::text('alias','',['class'=>'form-control','placeholder'=>'Alias'])}}
        </div>
        <div class="form-group">
        {{Form::label('phone','Phone number')}}
        {{Form::text('phone','',['class'=>'form-control','placeholder'=>'+00 123456789'])}}
        </div>
        <div class="form-group">
        {{Form::label('description','Description')}}
        {{Form::textarea('description','',['id'=> 'article-ckeditor','class'=>'form-control','placeholder'=>'Description'])}}
        </div>
        {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}

@endsection