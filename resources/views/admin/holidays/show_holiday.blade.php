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
                    <th><b>Картинка</b></th>
                    <th><b>Название праздника</b></th>
                    <th class="setting"><b>Инструменты</b></th>
                </tr>
                </thead>
                <tbody>
                @if(!$holidays->isEmpty())
                    @foreach($holidays as $holiday)
                        <tr>
                            <td>
                                @if($holiday->image != null)
                                <img src="{{ $holiday->image_url }}" width="50px" height="50px;">
                                  @else
                                    <i class="fa fa-file-image-o fa-2x" style="color:#53a17e;" aria-hidden="true"></i>
                                @endif
                            </td>
                            <td>
                                <p class="text_holides">
                                    @if($holiday->name_ru != '')
                                    {{ $holiday->name_ru }}
                                        @else
                                    {{ $holiday->name_kz }}
                                    @endif
                                </p>
                            </td>

                            <td class="setting">
                                <a href="/admin/holiday/update/{{$holiday->id}}" class="fa fa-pencil-square fa-2x"
                                   aria-hidden="true"></a>

                                <a href="/admin/holiday/destroy/{{$holiday->id}}" style="color: red;" class="fa fa-trash fa-2x"
                                   aria-hidden="true"></a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <h2>Праздники отсуцтвуют</h2>
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