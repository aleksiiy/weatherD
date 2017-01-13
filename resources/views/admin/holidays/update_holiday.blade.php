@extends('admin.index')
@section('styles')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ url('master/css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ url('master/css/holiday.css') }}">
    <link rel="stylesheet" href="{{ url('css/bootstrap-slider.min.css') }}">
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
                {!! Form::label('Плавающая дата', '') !!}
                <input type="checkbox" class="js-switch" name="floating"
                       @if($holiday->floating) checked="checked" @endif>
            </div>
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
            <div class="form-group">
                <div class="color">
                    {!! Form::label('date_color', 'Цвет даты') !!}
                </div>
                <input type="hidden" name="date_color" value="{{ $holiday->date_color }}">
                @foreach($colors as $color)
                    <span
                            data-color="{{ $color }}"
                            class="color-picker date_color @if($holiday->date_color == $color) active @endif"
                            style="background-color: {{ $color }}" ></span>
                @endforeach
            </div>
            <div class="form-group">
                <div class="color">
                {!! Form::label('name_color', 'Цвет названия') !!}
                </div>
                    <input type="hidden" name="name_color" value="{{ $holiday->name_color }}">
                @foreach($colors as $color)
                    <span
                            data-color="{{ $color }}"
                            class="color-picker name_color @if($holiday->name_color == $color) active @endif"
                            style="background-color: {{ $color }}" ></span>
                @endforeach
            </div>
            <div class="form-group" style="margin-top: 30px; margin-bottom: 15px;">
                <div class="opacity">
                    {!! Form::label('date_color', 'Прозрачность картинки') !!}
                </div>
                <input id="opacity" name="opacity" type="text" data-slider-min="0"
                       data-slider-tooltip="always" data-slider-tooltip_position="bottom"
                       data-slider-max="1" data-slider-step="0.01" data-slider-value="{{ $holiday->opacity }}"/>
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
    <script type="text/javascript" src="{{url('master/js/bootstrap-slider.js')}}"></script>
    <script>
        $(function () {
            $('.input-group.date').datetimepicker({
                format: 'MM-DD'
            });
            $('.date_color').click(function () {
                $('input[name="date_color"]').val($(this).data('color'));
                $('.date_color').removeClass('active');
                $(this).addClass('active');
            });
            $('.name_color').click(function () {
                $('input[name="name_color"]').val($(this).data('color'));
                $('.name_color').removeClass('active');
                $(this).addClass('active');
            });
            $('#opacity').slider({
                formatter: function (value) {
                    return value;
                }
            });
        });
    </script>
@endsection