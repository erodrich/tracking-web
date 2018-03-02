@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">My Devices</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="/devices/create" class="btn btn-primary">Create Device</a>

                    <table class="table table-striped">
                        <tr>
                            <th>Imei</th>
                            <th>Alias</th>
                            <th>Teléfono</th>
                            <th></th>
                            <th></th>
                        </tr>
                        @if(count($devices) > 0)
                        @foreach($devices as $device)
                        <tr>
                            <td><a href="/devices/{{$device->id}}">{{$device->imei}}</a></td>
                            <td>{{$device->alias}}</td>
                            <td>{{$device->phone}}</td>
                            <td><a href="/devices/{{$device->id}}/edit" class="btn btn-default">Edit</a></td>
                            <td>
                                {!! Form::open(['action'=> ['DevicesController@destroy', $device->id],'method'=>'POST', 'class'=>"pull-right"])!!}
                                    {{Form::hidden('_method','DELETE')}}
                                    {{Form::submit('Delete', ['class'=>"btn btn-danger"])}}
                                {!! Form::close()!!}
                            </td>
                        </tr>
                        @endforeach
                        @else
                            <p>You have no devices.</p>
                        @endif

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection