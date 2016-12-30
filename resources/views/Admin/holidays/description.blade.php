@extends('admin.index')
@section('styles')
    <link rel="stylesheet" href="{{ url('master/css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ url('master/css/holiday.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
@endsection
@section('content')
    <main>
        @foreach($description as $descrip)
            <h1>{{ $descrip->name_ru }}</h1>
            <h2>{{ $descrip->description_ru }}</h2>
            <h2>{{ $descrip->date }}</h2>
            <img href="{{ url( $descrip->image ) }}" style="width: 100px; height: 100px;">
      @endforeach
    </main>
@endsection
@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="{{ url('master/js/moment.min.js') }}"></script>
    <script src="{{ url('master/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $(function () {
            $('#datepicker').datetimepicker({
                format: 'DD/MM'
            });
        });
    </script>
@endsection