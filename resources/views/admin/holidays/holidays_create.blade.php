@extends('admin.index')
@section('styles')
    <link rel="stylesheet" href="{{ url('master/css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ url('master/css/holiday.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
@endsection
@section('content')
    <main>
        <div>
            <a href="/admin/show">
                <button type="button" class="button">
                    Просмотреть праздники
                </button>
            </a>
        </div>
        {!! Form::open([
        'method' => 'PATCH',
        'class' => 'content_box',
        'enctype'=> 'multipart/form-data',
        ]) !!}
        <div class="box_form">
            <div class="form-group">
                <div>
                    {!! Form::text('name_kz', null, ['class' => 'control-label', 'required', 'placeholder' => 'Название события на казахском']) !!}
                </div>
                <div>
                    {!! Form::textarea('description_kz', null, ['class' => 'control-label','required',  'placeholder' => 'Описания события на кахском']) !!}
                </div>
            </div>
            <div class="form-group">
                <div>
                    {!! Form::text('name_ru', null, ['class' => 'control-label', 'placeholder' => 'Название события на русском']) !!}
                </div>
                <div>
                    {!! Form::textarea('description_ru', null, ['class' => 'control-label',  'placeholder' => 'Описание события на русском']) !!}
                </div>
                <div>
                    {!! Form::file('image', ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>

        <div class="box_form">
            <div class="form-group">
                <div class='input-group date' id='datepicker'>
                    <input type='text' required name="date" class="form-control"/>
                    <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
                </div>
            </div>
            {!! Form::submit('Сoхранить', ['class' => 'form-control']) !!}
        </div>
        {!! Form::close() !!}
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
                format: 'MM-DD'
            });
        });
    </script>
@endsection