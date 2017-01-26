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
                                    <img style="opacity: {{$holiday->opacity}} " src="{{ $holiday->image_url }}"
                                         width="90px" height="50px;">
                                @else
                                    <i class="fa fa-file-image-o fa-2x" style="color:#53a17e;" aria-hidden="true"></i>
                                @endif
                            </td>
                            <td>
                                <p class="text_holides" style="padding-left: 10px; color:{{ $holiday->name_color }};
                                @if(($holiday->name_color) == ('#ffffff'))
                                        text-shadow: 0 1px 8px #000000;
                                @endif
                                        ">
                                    @if($holiday->name_ru != '')
                                        {{ $holiday->name_ru }}
                                    @else
                                        {{ $holiday->name_kz }}
                                    @endif
                                </p>
                            </td>

                            <td class="setting">
                                <a href="/admin/holiday/update/{{$holiday->id}}"
                                   data-toggle="tooltip"
                                   data-placement="bottom"
                                   data-original-title="Редактировать">
                                    <i class="fa fa-pencil-square fa-2x"></i>
                                </a>

                                <a href="#"
                                   class="clone"
                                   data-toggle="tooltip"
                                   data-placement="bottom"
                                   data-original-title="Скопировать"
                                   data-holiday_id="{{$holiday->id}}">
                                    <i class="fa fa-clone fa-2x"></i>
                                </a>

                                <a href="/admin/holiday/destroy/{{$holiday->id}}" style="color: red;"
                                   data-toggle="tooltip"
                                   data-placement="bottom"
                                   data-original-title="Удалить">
                                    <i class="fa fa-trash fa-2x"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <h2>Праздники отсуцтвуют</h2>
                @endif
                </tbody>
            </table>
            <div class="modal fade" tabindex="-1" id="cloneHolidayModal" role="dialog"
                 aria-labelledby="cloneHolidayModal">
                <div class="modal-dialog modal-sm" role="document">
                    {!! Form::open(['route' => ['holiday.clone', ]])  !!}
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                        aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Сделать копию праздника</h4>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="holiday_id">
                            {!! Form::select('category', $categories, [
                                'id' => 'category',
                                'class' => 'chosen-select form-control'
                            ]) !!}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                            <button type="submit" class="btn btn-primary">Скопировать</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    </main>
@endsection
@section('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script>
        $('.clone').click(function () {
            var holiday_id = $(this).data('holiday_id');
            $("#cloneHolidayModal input[name=holiday_id]").val(holiday_id);
            $('#cloneHolidayModal').modal('show');
        });
    </script>
@endsection