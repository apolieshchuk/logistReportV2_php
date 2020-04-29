@extends('layout')

@section('head')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="/css/auto.css">
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
<meta name="csrf_token" content="{{ csrf_token() }}" />
@endsection

@section('body')
    <header style="margin-bottom: 10px">
        <button class="button" id="clearButton">Очистити</button>
        <button class="button" id="copyButton">Копіювати</button>
        <button class="button" id="goButton">Відправити</button>
    </header>

    <nav style="margin-bottom: 10px;" class="navbar navbar-default" role="navigation">
        <div style="text-align: center" class="navbar-text">
            <span style="font-size: 25px">Пошук:</span> <input style="height: 25px" type="text" id="filterbox">
        </div>
    </nav>

    <table id="autoTable" class="display" style="width:100%;">
        <thead>
            <tr>
                <th></th>
                <th>Назва</th>
                <th>Марка</th>
                <th>№авт</th>
                <th>№прич</th>
                <th>Прiзвище</th>
                <th>Iмя</th>
                <th>По-батьк</th>
                <th>Тел</th>
                <th>Посвідчення</th>
                <th style="display: none">id</th>
            </tr>
            <tr>
                <th></th>
                <th>Назва</th>
                <th>Марка</th>
                <th>№авт</th>
                <th>№прич</th>
                <th>Прiзвище</th>
                <th>Iмя</th>
                <th>По-батьк</th>
                <th>Тел</th>
                <th>Посвідчення</th>
                <th style="display: none">id</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th></th>
                <th>Назва</th>
                <th>Марка</th>
                <th>№авт</th>
                <th>№прич</th>
                <th>Прiзвище</th>
                <th>Iмя</th>
                <th>По-батьк</th>
                <th>Тел</th>
                <th>Посвідчення</th>
                <th style="display: none">id</th>
            </tr>
        </tfoot>
{{--        <tbody>--}}
{{--        @foreach($autos as $auto)--}}
{{--            <tr>--}}
{{--                <td></td>--}}
{{--                <td>{{ $auto->carrier['name'] }}</td>--}}
{{--                <td>{{ $auto['mark'] }}</td>--}}
{{--                <td>{{ $auto['auto_num'] }}</td>--}}
{{--                <td>{{ $auto['trail_num'] }}</td>--}}
{{--                <td>{{ $auto->driver->surname }}</td>--}}
{{--                <td>{{ $auto->driver->name }}</td>--}}
{{--                <td>{{ $auto->driver->father }}</td>--}}
{{--                <td>{{ $auto->driver->tel }}</td>--}}
{{--                <td>{{ $auto->driver->license }}</td>--}}
{{--                <td style="display: none">{{ $auto['id'] }}</td>--}}
{{--            </tr>--}}
{{--        @endforeach--}}
{{--        </tbody>--}}
    </table>
@endsection

@section('footer')
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="/js/auto.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
@endsection

