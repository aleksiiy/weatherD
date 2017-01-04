@extends('admin.index')
@section('styles')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ url('master/css/holiday.css') }}">
@endsection
@section('content')
    <main>

        <div>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Картинка</th>
                    <th>Название праздника</th>
                    <th class="setting">Инструменты</th>
                </tr>
                </thead>
                <tbody>
                @if(!$holidays->isEmpty())
                    @foreach($holidays as $holiday)
                        <tr>
                            <td>
                                <img src="{{ $holiday->image }}" width="70px" height="50px;">
                            </td>
                            <td>
                                <a href="/admin/category/{{$holiday->id}}" class="text_holides">
                                    {{ $holiday->name_ru }}
                                </a>
                            </td>

                            <td class="setting">
                                <a href="/admin/holiday/update/{{$holiday->id}}" class="fa fa-pencil-square"
                                   aria-hidden="true"></a>

                                <a href="/admin/holiday/destroy/{{$holiday->id}}" style="color: red;" class="fa fa-trash"
                                   aria-hidden="true"></a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <h2>Категории отсуцтвуют</h2>
                @endif
                </tbody>
            </table>
        </div>

    </main>
@endsection
@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
@endsection