@extends('layout')

@section('head')
<title>Report</title>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="/css/report.css">
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">

{{--SEMANTIC--}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.9/semantic.min.css"/>

@endsection

@section('body')

<div style="padding: 15px 10px">
    <header style="margin-bottom: 10px; display: flex; justify-content: space-between">

        <nav style="margin-bottom: 10px; text-align: center"
             class="navbar navbar-default" role="navigation">
            <div style="text-align: center" class="navbar-text ui input">
                <input style="height: 35px" type="text" id="filterbox" placeholder="Пошук">
            </div>
        </nav>

        <form action="/report" method="GET">
            <div class="ui input" style="margin-right: 10px;">
                <label style="align-self: center; margin-right: 10px;" for="start-date">Від</label>
                <input type="date" id="from"
                       value="{{ request('report_from') ?? config('constants.report_from') }}"
                       name="report_from">
            </div>
           <div class="ui input" style="margin-right: 10px;">
               <label style="align-self: center; margin-right: 10px;" for="end-date">До</label>
               <input type="date" class="ui input" id="to"
                      value="{{Carbon\Carbon::tomorrow()->format('Y-m-d') }}"
                      name="report_to">
           </div>
            <input class="ui blue button" type="submit" value="Змінити дату">
        </form>

        <form action="/" >
            <input class="ui blue button" type="submit" value="Авто">
        </form>

    </header>

    <hr>

    <table id="autoTable" class="display cell-border" style="width: 100%;">
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
        </tr>
        <tr>
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
            <th></th>
            <th></th>
            <th></th>
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
        </tr>
        </tfoot>
    </table>
</div>
@endsection

@section('footer')
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="/js/report.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>

{{--SEMANTIC--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.9/semantic.min.js"></script>

@endsection

