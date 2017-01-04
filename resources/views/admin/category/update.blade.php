@extends('admin.index')
@section('content')
    <main>
        {!! Form::model($update,[
                   'method' => 'post',
                   'url' => '/admin/category/edit/'.$update->id,
                   'enctype' => 'multipart/form-data'
           ]) !!}
        {!! Form::label('email', 'Название события на русском', ['style' => 'margin: 10px 10px 0 30px;']) !!}
        {!! Form::text('name_ru', null,['class' => 'form-control','required', 'style' => 'margin:10px 30px; width:60%;', 'placeholder' => 'Название категории на русском']) !!}

        {!! Form::label('email', 'Название события на казахском', ['style' => 'margin: 10px 10px 0 30px;']) !!}
        {!! Form::text('name_kz', null,['class' => 'form-control','required', 'style' => 'margin:10px 30px; width:60%;', 'placeholder' => 'Название категории на казахском']) !!}
        {!! Form::submit('Update', ['class' => 'form-control', 'style' => 'margin:10px 30px; width:60%;']) !!}
        {!! Form::close() !!}
    </main>
@endsection