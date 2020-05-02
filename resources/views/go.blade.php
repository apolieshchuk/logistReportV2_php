@extends('layout')

@section('head')

<title>Go</title>
<meta charset="UTF-8">

{{--MY CSS--}}
<link rel="stylesheet" href="/css/go.css">
{{--BOOTSTRAP--}}
{{--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">--}}
{{--BOOTSTRAP-SELECT--}}
{{--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">--}}
{{--SEMANTIC--}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.9/semantic.min.css"/>
<meta name="csrf_token" content="{{ csrf_token() }}" />
@endsection

@section('body')

<div style="display: flex; justify-content: center">

    <a style="height: 38px; align-self: center" href="/" class="ui blue button">Авто</a>

    <div style="display:flex; flex-direction: column; margin: 10px;">
        {{--SELECT PICKER--}}
        <div id="route-select-wrapper" style="margin-bottom: 10px;">
            <select id="routeSelect" class="ui search dropdown" onchange="initRatio()">
                <option value="" selected disabled>Оберіть маршрут</option>
                @foreach($routes as $route)
                    <option value="{{ $route['id'] }}">{{ $route['name'] }}</option>
                @endforeach
            </select>
        </div>

        <div style="text-align: center;">
            <select id="managerSelect" class="ui search dropdown" required disabled>
                <option value="" selected disabled >Оберіть менеджера</option>
                @foreach($managers as $manager)
                    <option value="{{ $manager['id'] }}">{{ $manager['surname'] }}</option>
                @endforeach
            </select>
            <select id="cargoSelect" class="ui search dropdown" required disabled>
                <option value="" selected disabled>Оберіть вантаж</option>
                @foreach($cargos as $cargo)
                    <option value="{{ $cargo['id'] }}">{{ $cargo['name'] }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <button
        onclick="sendReport()"
        style="align-self: center" class="ui blue button" id="goButton2"
    >Відправити</button>
</div>


<hr style="margin-bottom: 20px;">

{{--MAIN TABLE--}}
{{--TODO MOBILE VERSION--}}
<table class="ui celled table" style="width: 80%; margin: auto; min-width: 800px">
    <thead>
        <tr>
            <th>#</th>
            <th class="three wide">Перевізник</th>
            <th class="two wide">Авто</th>
            <th class="two wide">Причеп</th>
            <th class="two wide">Водій</th>
            <th class="one wide">Дата</th>
            <th class="two wide" style="min-width: 80px">Ф2</th>
            <th class="two wide" style="min-width: 80px">Ф1</th>
            <th class="one wide" style="min-width: 80px">Тр</th>
        </tr>
    </thead>
    <tbody>
    @foreach($autos as $key => $auto)
        <tr class="data-row">
            <td class="data-col" data-label="#">{{ $key + 1 }}</td>
            <td class="data-col" data-label="Перевізник"> {{ $auto->carrier['name'] }}</td>
            <td class="data-col" data-label="Авто"> {{ $auto['auto_num'] }}</td>
            <td class="data-col" data-label="Причіп"> {{ $auto['trail_num'] }}</td>
            <td class="data-col" data-label="Водій"> {{ $auto->driver->surname }}</td>
            <td data-label="Дата">
                <div class="ui input" >
                    <input class="data-col" style="padding-right: 2px;padding-left: 2px" type="date" value="{{Carbon\Carbon::tomorrow()->format('Y-m-d') }}">
                </div>
            </td>
            <td data-label="Ф2">
                <div class="ui input" style="padding: 2px" >
                    <input class="data-col data-col-f2" style="padding-right: 5px;padding-left: 5px" type="number" value="0">
                </div>
            </td>
            <td data-label="Ф1">
                <div class="ui input">
                    <input class="data-col data-col-f1" style="padding-right: 5px;padding-left: 5px" type="number" value="0">
                </div>
            </td>
            <td class="data-col data-col-tr"  data-label="Тр">
                <select class="ui search dropdown">
                    <option value="0">НІ</option>
                    <option value="1">ТАК</option>
                </select>
            </td>
            <input type="hidden" class="data-col data-col-carrier-id" value="{{ $auto["carrier_id"] }}">
            <input type="hidden" class="data-col" value="{{ $auto["driver_id"] }}">
        </tr>
    @endforeach
    </tbody>
</table>

@endsection

@section('footer')
{{--MY JS--}}
<script src="/js/go.js"></script>

{{--BOOTSTRAP--}}
{{--<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>--}}
{{--<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>--}}
{{--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>--}}

{{--BOOTSTRAP-SELECT--}}
{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>--}}

{{--JQUERY--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

{{--SEMANTIC--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.9/semantic.min.js"></script>

@endsection

