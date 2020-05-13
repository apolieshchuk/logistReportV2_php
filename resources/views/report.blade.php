@extends('layout')

@section('head')
<title>Report</title>
<meta name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

{{--JQUERY--}}
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="/css/report.css?{{ time() }}">
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">

{{--SEMANTIC--}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.9/semantic.min.css"/>

{{--DATA TABLES--}}
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/>

<meta name="csrf_token" content="{{ csrf_token() }}" />
@endsection

@section('body')
{{--MAIN TABLE--}}
<div style="padding: 15px 10px">
    <header style="margin-bottom: 10px; display: flex; justify-content: space-between">

        <nav style="text-align: center"
             class="navbar navbar-default" role="navigation">
            <div style="text-align: center" class="navbar-text ui input">
                <input style="height: 35px" type="text" id="filterbox" placeholder="Пошук">
            </div>
        </nav>

        <form action="/report" method="GET" style="display: flex">
            <div class="ui input" style="margin-right: 10px;">
                <label style="align-self: center; margin-right: 10px;" for="start-date">Від</label>
                <input type="date" id="from"
                       value="{{ request('report_from') ?? config('constants.report_from') }}"
                       name="report_from">
            </div>
           <div class="ui input" style="margin-right: 10px;">
               <label style="align-self: center; margin-right: 10px;" for="end-date">До</label>
               <input type="date" class="ui input" id="to"
                      value="{{ request('report_to') ?? Carbon\Carbon::tomorrow()->format('Y-m-d') }}"
                      name="report_to">
           </div>
            <button class="ui blue button" style="height: 38px;" type="submit">
                <i class="calendar check icon" style="font-size:24px"></i><span>Змінити дату</span>
            </button>
        </form>

        <a id="autoButton" style="align-self: center" href="/" class="ui blue button">Авто</a>

    </header>

    <hr>
{{--    MAIN TABLE--}}
    <div class="table-wrapper" style="overflow: auto">
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
                <th>Водій</th>
                <th>Ф2</th>
                <th>Ф1</th>
                <th>Тр</th>
                <th>Замітки</th>
                <th>Дії</th>
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
                <th>Водій</th>
                <th>Ф2</th>
                <th>Ф1</th>
                <th>Тр</th>
                <th>Замітки</th>
                <th>Дії</th>
            </tr>
            </tfoot>
        </table>
    </div>
</div>


{{--MODALS--}}
@include('modals.editReport')
@include('modals.deleteReport')

@endsection

@section('footer')
<script src="/js/report.js?{{ time() }}"></script>

{{--DATA TABLES--}}
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>


{{--SEMANTIC--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.9/semantic.min.js"></script>

{{--INPUT MASK--}}
<script src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>

{{--HANDLE FORM ERRORS (AFTER JS INCLUDE)--}}
@if($errors->any())
    <script type="text/javascript">
        showModalUpdate({{session('id')}});
    </script>
@endif
@endsection

