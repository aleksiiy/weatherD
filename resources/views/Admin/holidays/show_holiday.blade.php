@extends('admin.index')
@section('styles')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ url('master/css/holiday.css') }}">
@endsection
@section('content')
    <main>

        <div class="form-group">
            <ul class="dropdown">
                <li class="dropdown-top">
                    <a class="dropdown-top">Январь</a>
                    <ul class="dropdown-inside">
                        @foreach($holidays as $holiday)
                            <?php $rest = substr($holiday->date, 3, 4)?>
                            @if($rest == '01')
                                <li><a href="/admin/description/{{$holiday->id}}" class="description">{{ $holiday->name_ru }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>
        <div class="form-group">
            <ul class="dropdown">
                <li class="dropdown-top">
                    <a class="dropdown-top">Февраль</a>
                    <ul class="dropdown-inside">
                        @foreach($holidays as $holiday)
                            <?php $rest = substr($holiday->date, 3, 4)?>
                            @if($rest == '02')
                                <li><a href="/admin/description/{{$holiday->id}}" class="description">{{ $holiday->name_ru }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>
        <div class="form-group">
            <ul class="dropdown">
                <li class="dropdown-top">
                    <a class="dropdown-top">Март</a>
                    <ul class="dropdown-inside">
                        @foreach($holidays as $holiday)
                            <?php $rest = substr($holiday->date, 3, 4)?>
                            @if($rest == '03')
                                <li><a href="/admin/description/{{$holiday->id}}" class="description">{{ $holiday->name_ru }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>
        <div class="form-group">
            <ul class="dropdown">
                <li class="dropdown-top">
                    <a class="dropdown-top">Апрель</a>
                    <ul class="dropdown-inside">
                        @foreach($holidays as $holiday)
                            <?php $rest = substr($holiday->date, 3, 4)?>
                            @if($rest == '04')
                                <li><a href="/admin/description/{{$holiday->id}}" class="description">{{ $holiday->name_ru }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>
        <div class="form-group">
            <ul class="dropdown">
                <li class="dropdown-top">
                    <a class="dropdown-top">Май</a>
                    <ul class="dropdown-inside">
                        @foreach($holidays as $holiday)
                            <?php $rest = substr($holiday->date, 3, 4)?>
                            @if($rest == '05')
                                <li><a href="/admin/description/{{$holiday->id}}" class="description">{{ $holiday->name_ru }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>
        <div class="form-group">
            <ul class="dropdown">
                <li class="dropdown-top">
                    <a class="dropdown-top">Июнь</a>
                    <ul class="dropdown-inside">
                        @foreach($holidays as $holiday)
                            <?php $rest = substr($holiday->date, 3, 4)?>
                            @if($rest == '06')
                                <li><a href="/admin/description/{{$holiday->id}}" class="description">{{ $holiday->name_ru }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>
        <div class="form-group">
            <ul class="dropdown">
                <li class="dropdown-top">
                    <a class="dropdown-top">Июль</a>
                    <ul class="dropdown-inside">
                        @foreach($holidays as $holiday)
                            <?php $rest = substr($holiday->date, 3, 4)?>
                            @if($rest == '07')
                                <li><a href="/admin/description/{{$holiday->id}}" class="description">{{ $holiday->name_ru }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>
        <div class="form-group">
            <ul class="dropdown">
                <li class="dropdown-top">
                    <a class="dropdown-top">Август</a>
                    <ul class="dropdown-inside">
                        @foreach($holidays as $holiday)
                            <?php $rest = substr($holiday->date, 3, 4)?>
                            @if($rest == '08')
                                <li><a href="/admin/description/{{$holiday->id}}" class="description">{{ $holiday->name_ru }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>
        <div class="form-group">
            <ul class="dropdown">
                <li class="dropdown-top">
                    <a class="dropdown-top">Сентябрь</a>
                    <ul class="dropdown-inside">
                        @foreach($holidays as $holiday)
                            <?php $rest = substr($holiday->date, 3, 4)?>
                            @if($rest == '09')
                                <li><a href="/admin/description/{{$holiday->id}}" class="description">{{ $holiday->name_ru }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>
        <div class="form-group">
            <ul class="dropdown">
                <li class="dropdown-top">
                    <a class="dropdown-top">Октябырь</a>
                    <ul class="dropdown-inside">
                        @foreach($holidays as $holiday)
                            <?php $rest = substr($holiday->date, 3, 4)?>
                            @if($rest == '10')
                                <li><a href="/admin/description/{{$holiday->id}}" class="description">{{ $holiday->name_ru }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </li>
            </ul>

        </div>
        <div class="form-group">
            <ul class="dropdown">
                <li class="dropdown-top">
                    <a class="dropdown-top">Ноябырь</a>
                    <ul class="dropdown-inside">
                        @foreach($holidays as $holiday)
                            <?php $rest = substr($holiday->date, 3, 4)?>
                            @if($rest == '11')
                                <li><a href="/admin/description/{{$holiday->id}}" class="description">{{ $holiday->name_ru }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>
        <div class="form-group">
            <ul class="dropdown">
                <li class="dropdown-top">
                    <a class="dropdown-top">Декабрь</a>
                    <ul class="dropdown-inside">
                        @foreach($holidays as $holiday)
                            <?php $rest = substr($holiday->date, 3, 4)?>
                            @if($rest == '12')
                                <li><a href="/admin/description/{{$holiday->id}}" class="description">{{ $holiday->name_ru }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </li>
            </ul>
        </div>

    </main>
@endsection
@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
@endsection