@extends('layout')

@section('head')

<title>Table V01</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
{{--MY CSS--}}
<link rel="stylesheet" href="/css/go.css">
{{--BOOTSTRAP--}}
{{--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">--}}
{{--BOOTSTRAP-SELECT--}}
{{--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">--}}
{{--SEMANTIC--}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.9/semantic.min.css"/>
@endsection

@section('body')

{{--SELECT PICKER--}}
<div style="text-align: center; margin: 20px;">
    <select class="ui search dropdown">
        <option value="Виберіть маршрут">Виберіть маршрут</option>
        @foreach($routes as $route)
            <option value="{{ $route['id'] }}">{{ $route['name'] }}</option>
        @endforeach
    </select>
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
            <th class="two wide" style="min-width: 80px">Ф1</th>
            <th class="two wide" style="min-width: 80px">Ф2</th>
            <th class="one wide" style="min-width: 80px">Тр</th>
        </tr>
    </thead>
    <tbody>
    @foreach($autos as $key => $auto)
        <tr>
            <td data-label="#">{{ $key + 1 }}</td>
            <td data-label="Перевізник"> {{ $auto->carrier['name'] }}</td>
            <td data-label="Авто"> {{ $auto['auto_num'] }}</td>
            <td data-label="Причіп"> {{ $auto['trail_num'] }}</td>
            <td data-label="Водій"> {{ $auto->driver->surname }}</td>
            <td data-label="Дата">
                <div class="ui input" >
                    <input style="padding-right: 2px;padding-left: 2px" type="date">
                </div>
            </td>
            <td data-label="Ф1">
                <div class="ui input" style="padding: 2px" >
                    <input style="padding-right: 5px;padding-left: 5px" type="text">
                </div>
            </td>
            <td data-label="Ф2">
                <div class="ui input">
                    <input style="padding-right: 5px;padding-left: 5px" type="text">
                </div>
            </td>
            <td data-label="Тр">
                <div class="ui input">
                    <input style="padding-right: 5px;padding-left: 5px" type="text">
                </div>
            </td>
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

{{--SEMANTIC--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.9/semantic.min.js"></script>

@endsection

