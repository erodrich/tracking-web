@extends('layouts.app')

@section('content')
    <h1>Create Device</h1>
    {!! Form::open(['action' => ['DevicesController@update',$device->id],'method'=>'POST', 'enctype'=>'multipart/form-data']) !!}
        <div class="form-group">
        {{Form::label('imei','Imei')}}
        {{Form::text('imei', $device->imei ,['class'=>'form-control','placeholder'=>'Imei'])}}
        </div>
        <div class="form-group">
        {{Form::label('alias','Alias')}}
        {{Form::text('alias', $device->alias ,['class'=>'form-control','placeholder'=>'Alias'])}}
        </div>
        <div class="form-group">
        {{Form::label('phone','Phone number')}}
        {{Form::text('phone', $device->phone ,['class'=>'form-control','placeholder'=>'+00 123456789'])}}
        </div>
        <div class="form-group">
        {{Form::label('description','Description')}}
        {{Form::textarea('description', $device->description ,['id'=> 'article-ckeditor','class'=>'form-control','placeholder'=>'Description'])}}
        </div>
        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit('Submit',['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}

@endsection