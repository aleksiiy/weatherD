@extends('admin.index')
@section('styles')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ url('master/css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ url('master/css/holiday.css') }}">
    <link rel="stylesheet" href="{{ url('css/bootstrap-slider.min.css') }}">
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
                {!! Form::label('Плавающая дата', '') !!}
                <input type="checkbox" class="js-switch" name="floating">
            </div>
            <div class="form-group">
                <div class='input-group date'>
                    <input type='text' required name="date" class="form-control"/>
                    <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
                </div>
            </div>
            <div class="form-group">
                <div class='input-group date'>
                    <input type='text' name="date_to" class="form-control"/>
                    <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
                </div>
            </div>
            <div class="form-group">
                <div class="color">
                    {!! Form::label('date_color', 'Цвет даты') !!}
                </div>
                <input type="hidden" name="date_color" value="#000000">
                @foreach($colors as $color)
                    <span
                            data-color="{{ $color }}"
                            class="color-picker date_color @if($color == '#000000') active @endif"
                            style="background-color: {{ $color }}"></span>
                @endforeach
            </div>
            <div class="form-group">
                <div class="color">
                    {!! Form::label('date_color', 'Цвет названия') !!}
                </div>
                <input type="hidden" name="name_color" value="#000000">
                @foreach($colors as $color)
                    <span
                            data-color="{{ $color }}"
                            class="color-picker name_color @if($color == '#000000') active @endif"
                            style="background-color: {{ $color }}"></span>
                @endforeach
            </div>
            <div class="form-group">
                <div class="form-group" style="margin-top: 30px; margin-bottom: 15px;">
                    <div class="opacity">
                        {!! Form::label('date_color', 'Прозрачность картинки') !!}
                    </div>
                    <input id="opacity" name="opacity" type="text" data-slider-min="0"
                           data-slider-tooltip="always" data-slider-tooltip_position="bottom"
                           data-slider-max="1" data-slider-step="0.01" data-slider-value="1"/>
                </div>
                <div class="help">
                    {!! Form::label('date_color', '(0 - невидимый, 1 - видимый)') !!}
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