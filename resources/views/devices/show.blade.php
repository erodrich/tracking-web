@extends('layouts.app')

@section('content')
    <a href="/devices" class="btn btn-secondary">Go Back</a>
    <div class="card">
    <div class="card-body">
        <ul>
            <li>Item: {{$device->imei}}</li>
            <li>Alias: {{$device->alias}}</li>
            <li>Phone number: {{$device->phone}}</li>
            <li>Descripton: {!!$device->description!!}</li>
        </ul>
        <hr>
            <small>Written on {{$device->created_at}} by {{$device->user->name}}</small>
        <hr>
    @if(!Auth::guest())
    @if(Auth::user()->id == $device->user_id)
        <a href="/devices/{{$device->id}}/edit" class="btn btn-primary">Edit</a>
        {!! Form::open(['action'=> ['DevicesController@destroy', $device->id],'method'=>'POST', 'class'=>"pull-right"])!!}
            {{Form::hidden('_method','DELETE')}}
            {{Form::submit('Delete', ['class'=>"btn btn-danger"])}}
        {!! Form::close()!!}
    @endif
    @endif
    </div>
    </div>

    
@endsection