@extends('layout')

@section('head')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="/css/report.css">
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
@endsection

@section('body')
    <header style="margin-bottom: 10px">
        <form action="/report" method="GET">
            <label for="start-date">Від</label>
            <input type="date" value="{{ config('constants.report_from') }}" name="start-date">
            <label for="end-date">До</label>
            <input type="date" value="{{ config('constants.report_to') }}" name="end-date">
            <input type="submit">
        </form>
{{--        <button class="button" id="clearButton">Очистити</button>--}}
{{--        <button class="button" id="copyButton">Копіювати</button>--}}
{{--        <button class="button" id="goButton">Відправити</button>--}}
    </header>

    <nav style="margin-bottom: 10px;" class="navbar navbar-default" role="navigation">
        <div style="text-align: center" class="navbar-text">
            <span style="font-size: 25px">Пошук:</span> <input style="height: 25px" type="text" id="filterbox">
        </div>
    </nav>

    <table id="autoTable" class="display nowrap" style="width: 100%;">
        <thead>
            <tr>
                <th></th>
                <th>Дата</th>
                <th>Менеджер</th>
                <th>Вантаж</th>
                <th>Маршрут</th>
                <th>Перевізник</th>
                <th>#Авт</th>
                <th>#Прич</th>
                <th>Водій</th>
                <th>Ф2</th>
                <th>Ф1</th>
                <th>Тр</th>
                <th>Замітки</th>
                <th style="display: none">id</th>
            </tr>
            <tr>
                <th></th>
                <th>Дата</th>
                <th>Менеджер</th>
                <th>Вантаж</th>
                <th>Маршрут</th>
                <th>Перевізник</th>
                <th>#Авт</th>
                <th>#Прич</th>
                <th>Водій</th>
                <th>Ф2</th>
                <th>Ф1</th>
                <th>Тр</th>
                <th>Замітки</th>
                <th style="display: none">id</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th></th>
                <th>Дата</th>
                <th>Менеджер</th>
                <th>Вантаж</th>
                <th>Маршрут</th>
                <th>Перевізник</th>
                <th>#Авт</th>
                <th>#Прич</th>
                <th>Водій</th>
                <th>Ф2</th>
                <th>Ф1</th>
                <th>Тр</th>
                <th>Замітки</th>
                <th style="display: none">id</th>
            </tr>
        </tfoot>
{{--        <tbody>--}}
{{--        @foreach($reports as $report)--}}
{{--            <tr>--}}
{{--                <td></td>--}}
{{--                <td>{{ $report->date }}</td>--}}
{{--                <td>{{ $report->manager->surname }}</td>--}}
{{--                <td>{{ $report->cargo->name }}</td>--}}
{{--                <td>{{ $report->route->name }}</td>--}}
{{--                <td>{{ $report->carrier->name }}</td>--}}
{{--                <td>{{ $report->auto_num }}</td>--}}
{{--                <td>{{ $report->trail_num }}</td>--}}
{{--                <td>{{ $report->driver->surname }}</td>--}}
{{--                <td>{{ $report->f2 }}</td>--}}
{{--                <td>{{ $report->f1 }}</td>--}}
{{--                <td>{{ $report->tr }}</td>--}}
{{--                <td>{{ $report->notes }}</td>--}}
{{--                <td style="display: none">{{ $report->id }}</td>--}}
{{--            </tr>--}}
{{--        @endforeach--}}
{{--        </tbody>--}}
    </table>
@endsection

@section('footer')
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="/js/report.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
@endsection

