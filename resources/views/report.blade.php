@extends('layout')

@section('head')
<title>Report</title>
<meta name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">


<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="/css/report.css?{{ time() }}">
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">

{{--SEMANTIC--}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.9/semantic.min.css"/>

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

{{--MODAL EDIT AUTO --}}
<div id="modalUpdate" class="ui modal"
     style="padding: 0 20px 20px 20px; width: 500px">
    <i class="close icon"></i>
    <div class="header">
        Змінити звіт
    </div>
    @if($errors->any())
        <div class="ui negative message modal-error-box">
            <p>{{ $errors->first() }}</p>
        </div>
    @endif
    <form id="modalUpdate_form" class="ui form" method="POST" action="/report/{?}">
        @method('PUT')
        @csrf
        <h4 class="ui dividing header">Маршрут</h4>
        <div class="field">
            <div class="two fields">
                <div class="six wide field">
                    <input id="modalUpdate-date-input" type="date" placeholder="Дата">
                </div>
                <div class="ten wide field">
                    <select id="modalUpdate-route-select" class="ui search dropdown">
                        <option value="" selected disabled>Оберіть маршрут</option>
                        @foreach($routes as $route)
                            <option value="{{ $route['id'] }}">{{ $route['name'] }}</option>
                        @endforeach
                    </select>
{{--                    <input type="text" placeholder="Маршрут">--}}
                </div>
            </div>
            <div class="two fields">
                <div class="eight wide field">
                    <select id="modalUpdate-manager-select" class="ui search dropdown" style="margin-bottom: 10px" required>
                        <option value="" selected disabled >Оберіть менеджера</option>
                        @foreach($managers as $manager)
                            <option value="{{ $manager['id'] }}">{{ $manager['surname'] }}</option>
                        @endforeach
                    </select>
{{--                    <input type="text" placeholder="Менеджер">--}}
                </div>
                <div class="eight wide field">
                    <select id="modalUpdate-cargo-select" class="ui search dropdown" required>
                        <option value="" selected disabled>Оберіть вантаж</option>
                        @foreach($cargos as $cargo)
                            <option value="{{ $cargo['id'] }}">{{ $cargo['name'] }}</option>
                        @endforeach
                    </select>
{{--                    <input type="text" placeholder="Вантаж">--}}
                </div>
            </div>
        </div>
        <h4 class="ui dividing header">Перевізник</h4>
        <div class="field">
            <div class="three fields">
                <div class="seven wide field">
                    <select name='carrier_id' id="modalUpdate-carrier-select" class="ui search dropdown" required>
                        <option value="" selected disabled>Перевізник</option>
                        @foreach($carriers as $carrier)
                            <option value="{{ $carrier['id'] }}">{{ $carrier['name'] }}</option>
                        @endforeach
                    </select>
{{--                    <input type="text" placeholder="Перевізник">--}}
                </div>
                <div class="four wide field">
                    <input id="modalUpdate-auto_num-input" type="text" placeholder="Гос№ авто">
                </div>
                <div id="dr_surn-select-wrapper" class="five wide field">
                    <select name='driver_id' id="modalUpdate-dr_surn-select" class="ui search dropdown" required>
                        <option value="" selected disabled>Водій</option>
                        @foreach($drivers as $driver)
                            <option value="{{ $driver['id'] }}">{{ $driver['surname']." ".$driver['name'] }}</option>
                        @endforeach
                    </select>
{{--                    <input type="text" placeholder="Прізвище">--}}
                </div>
            </div>
        </div>
        <h4 class="ui dividing header">Тариф</h4>
        <div class="field">
            <div class="three fields">
                <div class="six wide field">
                    <input id="modalUpdate-f2-input"  type="number" placeholder="Ф2">
                </div>
                <div class="six wide field">
                    <input id="modalUpdate-f1-input" type="number" placeholder="Ф1">
                </div>
                <div id="tr-select-wrapper" class="four wide field">
                    <select id="modalUpdate-tr-select" class="ui search dropdown">
                        <option value="0">НІ</option>
                        <option value="1">ТАК</option>
                    </select>
                </div>
            </div>
            <div class="field">
                <input id="modalUpdate-notes-input"  type="text" placeholder="Замітки">
            </div>
        </div>
    </form>
</div>

{{--MODAL DELETE AUTO--}}
<div id="modalDelete" class="ui basic modal">
    <div class="ui icon header">
        <i class="trash icon"></i>
        Видалити звіт
    </div>
    <div class="content">
        <p>Чи дійсно ви хочете видалити звіт <span></span>з бази даних?</p>
    </div>
    <div class="actions">
        <form id="modalDelete_form" action="/report/?" method="POST">
            @csrf
            @method('DELETE')
            <div class="ui green basic cancel inverted button">
                <i class="remove icon"></i>
                Ні
            </div>
            <button style="background-color: rgba(0,0,0,0); border: none; padding: 0;outline: none">
                <div class="ui red ok inverted button" style="margin-right: 0;">
                    <i class="checkmark icon"></i>
                    Так
                </div>
            </button>
        </form>
    </div>
</div>
@endsection

@section('footer')
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="/js/report.js?{{ time() }}"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>

{{--SEMANTIC--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.9/semantic.min.js"></script>

@endsection

