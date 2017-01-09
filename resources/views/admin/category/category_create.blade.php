@extends('admin.index')
@section('styles')
    <link href="{{ url('/master/css/admin.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
@endsection
@section('content')
    <main>
        <div>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th><b>Категория</b></th>
                    <th class="setting"><b>Инструменты</b></th>
                </tr>
                </thead>
                <tbody>
                @if(!$categories->isEmpty())
                    @foreach($categories as $category)
                        <tr>
                            <td>
                                <a href="/admin/category/{{$category->id}}" class="text_holides">
                                    {{ $category->name_ru }}
                                </a>
                            </td>
                            <td class="setting">
                                <a href="/admin/category/update/{{$category->id}}" class="fa fa-pencil-square fa-2x"
                                   aria-hidden="true"></a>
                                @if($category->id > '5')
                                    <a href="/admin/category/destroy/{{$category->id}}" class="fa fa-trash fa-2x"
                                       aria-hidden="true"></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <h2>Категории отсуцтвуют</h2>
                @endif
                </tbody>
            </table>
        </div>
        <div>
            {!! Form::open([
                    'method' => 'PATCH',
                    'url' => '/admin/category_create',
                    'enctype' => 'multipart/form-data'
            ]) !!}
            {!! Form::text('name_ru', null,['class' => 'form-control','required','style' => 'margin:10px 30px; width:60%;', 'placeholder' => 'Название категории на русском']) !!}
            {!! Form::text('name_kz', null,['class' => 'form-control','required', 'style' => 'margin:10px 30px; width:60%;', 'placeholder' => 'Іс-шара тақырыбы қазақ']) !!}
            {!! Form::submit('Submit', ['class' => 'form-control', 'style' => 'margin:10px 30px; width:60%;']) !!}
            {!! Form::close() !!}
        </div>
    </main>

@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
@endsection
@endsection