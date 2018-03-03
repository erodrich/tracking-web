@extends('layouts.app')

@section('gmaps-style')
    <!-- Styles -->
    {!! $data['map']['js'] !!}
    <script
        src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"
        integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30="
        crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


@endsection

@section('content')

<div class="container">

        <p>Date: <input type="text" id="datepicker"></p>
    <div class="row justify-content-center">
        <div class="col-md">
            <div class="card">
                <div class="card-header">Routes</div>

                {!! $data['map']['html'] !!}

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(!empty($data['msg']))
                    <p>{{$data['msg']}}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script>

$("#datepicker").datepicker({
      dateFormat: "yy-mm-dd",
      onSelect: function(dateText) {
        $(this).change();
      }
    })
    .change(function() {
      window.location.href =  this.value;
    });

</script>
@endsection