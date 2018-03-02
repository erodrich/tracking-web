@extends('layouts.app')

@section('gmaps-style')
    <!-- Styles -->
    {!! $data['map']['js'] !!}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                {!! $data['map']['html'] !!}

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-striped">
                        <tr>
                            <th>Alias</th>
                            <th>Imei</th>
                            <th>Teléfono</th>
                            <th></th>
                        </tr>
                        @if(count($data['devices']) > 0)
                        @foreach($data['devices'] as $device)
                        <tr>
                        <td><a href="/devices/{{$device->id}}/route/{{date('Y-m-d')}}">{{$device->alias}}</a></td>                            
                            <td>{{$device->imei}}</td>
                            <td>{{$device->phone}}</td>
                        </tr>
                        @endforeach
                        @else
                            <p>You have no devices.</p>
                        @endif

                    </table>
                    {{--  @foreach($data['locations'] as $location)
                    <tr>                            
                        <td>{{$location->id}}</td>
                    </tr>
                    @endforeach  --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
