@extends('admin.index')
@section('styles')
    <link href="{{ url('/master/css/admin.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="{{ url('/master/css/home.css') }}" rel="stylesheet">
    <link href="{{ url('/master/css/holiday.css') }}" rel="stylesheet">
@endsection
@section('content')
    <main>
        <div class="form-user">
            <div class="form-text">
                <p class="position">Количество пользователей:</p>
                <p class="position">{{$totalUsers}}</p>
            </div>
        </div>
        <div class="form-user">
            <div class="form-text">
                <p class="position">Количество праздников:</p>
                <p class="position">{{$totalHolidays}}</p>
            </div>
        </div>
        <div class="form-user">
            <div class="form-text">
                <p class="position">Количество праздников которые понравились пользователям:</p>
                <p class="position">{{$totalUserHolidays}}</p>
            </div>
        </div>
        <div class="form-user">
            <div class="form-text">
                <p class="position">Количество праздников которые добавили пользователи:</p>
                <p class="position">{{$totalUserPrivateis}}</p>
            </div>
        </div>
    </main>

@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
@endsection
@endsection