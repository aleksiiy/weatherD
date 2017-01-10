@extends('admin.index')
@section('styles')
    <link rel="stylesheet" href="{{ url('master/css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ url('master/css/holiday.css') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
@endsection
@section('content')
    <main>

        {!! Form::model($holiday,[
        'method' => 'post',
        'class' => 'content_box',
        'enctype'=> 'multipart/form-data',
        'url' => 'admin/holiday/edit/'. $holiday->id
        ]) !!}
        <div class="box_form">
            <div class="form-group">
                <div>{!! Form::label('email', 'Название события на казахском' , ['style' => 'margin-top: 10px;']) !!}
                    {!! Form::text('name_kz', null, ['class' => 'control-label' ,'required','style' => 'margin-top: 1px;',  'placeholder' => 'Название события на казахском']) !!}
                </div>
                <div>
                    {!! Form::label('email', 'Описание события на казахском' , ['style' => 'margin-top: 10px;']) !!}
                    {!! Form::textarea('description_kz', null, ['class' => 'control-label' , 'required', 'style' => 'margin-top: 1px;','placeholder' => 'Описание события на казахском']) !!}
                </div>
            </div>
            <div class="form-group">
                <div>
                    {!! Form::label('email', 'Название события на русском', ['style' => 'margin-top: 10px;']) !!}
                    {!! Form::text('name_ru', null, ['class' => 'control-label', 'style' => 'margin-top: 1px;' , 'placeholder' => 'Название события на русском']) !!}
                </div>
                <div>
                    {!! Form::label('email', 'Описание события на русском' , ['style' => 'margin-top: 10px;']) !!}
                    {!! Form::textarea('description_ru', null, ['class' => 'control-label' ,'style' => 'margin-top: 1px;', 'placeholder' => 'Описание события на русском']) !!}
                </div>
                <div>
                    @if($holiday->image != null)
                        <img src="{{ $holiday->image_url }}" width="50px" height="50px;">
                    @else
                        <i class="fa fa-file-image-o fa-2x" style="color:#53a17e;" aria-hidden="true"></i>
                    @endif
                    {!! Form::file('image', ['class' => 'form-control']) !!}
                </div>
            </div>
        </div>

        <div class="box_form">
            <div class="form-group">
                <div class='input-group date'>
                    <input type='text' required name="date" value="{{ $holiday->date }}" class="form-control"/>
                    <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
                </div>
            </div>
            <div class="form-group">
                <div class='input-group date'>
                    <input type='text' name="date_to" value="{{ $holiday->date_to }}" class="form-control"/>
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
            $('.input-group.date').datetimepicker({
                format: 'MM-DD'
            });
        });
    </script>
@endsection