@extends('layout')

@section('head')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="/css/auto.css">
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">

{{--SEMANTIC--}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.9/semantic.min.css"/>

{{--SEMANTIC UI / DATA TABLES--}}
{{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.css"/>--}}
{{--<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.semanticui.min.css"/>--}}

<meta name="csrf_token" content="{{ csrf_token() }}" />
@endsection

@section('body')

<div style="padding: 0 10px; display: flex; flex-direction: column">
{{--    <header style="margin-bottom: 10px; display: flex; justify-content: center">--}}
{{--        <button class="ui teal button" id="clearButton">Очистити</button>--}}
{{--        <button class="ui teal button" id="copyButton">Копіювати</button>--}}
{{--        <button class="ui teal button" id="goButton">Відправити</button>--}}
{{--        <form action="/report"><input class="ui teal button" type="submit" value="Звіт"></form>--}}
{{--    </header>--}}
    <div
        style="margin-bottom: 10px; width: 500px; align-self: center; margin-top: 10px"
        class="four ui buttons" >
        <button class="ui blue button" id="clearButton">Очистити</button>
        <button class="ui blue button" id="copyButton" onclick="copyAutos()">Копіювати</button>
        <button class="ui blue button" id="goButton">Відправити</button>
        <form action="/report">
            <input style="border-bottom-left-radius: 0; border-top-left-radius: 0"
                   class="ui blue button" type="submit" value="Звіт">
        </form>
    </div>
    <nav style="margin-bottom: 10px; text-align: center" class="navbar navbar-default" role="navigation">
        <div style="text-align: center" class="navbar-text ui input">
            <input style="height: 35px" type="text" id="filterbox" placeholder="Пошук">
        </div>
    </nav>
    <hr style="width: 100%; height: 1px">
    <table id="autoTable" class="display cell-border" style="width:100%;">
        <thead>
        <tr>
            <th></th>
            <th>Перевізник</th>
            <th>Марка</th>
            <th>№авт</th>
            <th>№прич</th>
            <th>Прiзвище</th>
            <th>Iмя</th>
            <th>По-батьк</th>
            <th>Тел</th>
            <th>Посвідчення</th>
{{--            <th style="display: none">id</th>--}}
        </tr>
        <tr id="filter-col">
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
{{--            <th style="display: none">id</th>--}}
        </tr>
        </thead>
        <tfoot>
        <tr>
            <th></th>
            <th>Перевізник</th>
            <th>Марка</th>
            <th>№авт</th>
            <th>№прич</th>
            <th>Прiзвище</th>
            <th>Iмя</th>
            <th>По-батьк</th>
            <th>Тел</th>
            <th>Посвідчення</th>
{{--            <th style="display: none">id</th>--}}
        </tr>
        </tfoot>
    </table>
</div>
@endsection

@section('footer')

{{--JQUERY--}}
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

{{--MY STYLE--}}
<script src="/js/auto.js"></script>

{{--DATATABLES--}}
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>

{{--SEMANTIC--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.9/semantic.min.js"></script>

{{--SEMANTIC UI / DATA TABLES--}}
{{--<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>--}}
{{--<script src="https://cdn.datatables.net/1.10.20/js/dataTables.semanticui.min.js"></script>--}}


@endsection

