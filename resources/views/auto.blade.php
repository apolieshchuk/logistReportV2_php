@extends('layout')

@section('head')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="/css/auto.css">
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
@endsection

@section('body')
    <header>
        <button class="button" id="clearButton">Очистити</button>
        <button class="button" id="copyButton">Копіювати</button>
    </header>
    <table id="autoTable" class="display" style="width:100%;
     table-layout: fixed; display: none">
        <thead>
            <tr>
                <th style="width: 5px"></th>
                <th style="width: 180px">Назва</th>
                <th style="width: 30px">Марка</th>
                <th style="width: 110px">№авт</th>
                <th style="width: 110px">№прич</th>
                <th style="width: 110px">Прiзвище</th>
                <th style="width: 110px">Iмя</th>
                <th style="width: 130px">По-батьк</th>
                <th style="width: 130px">Тел</th>
                <th>Замiтки</th>
            </tr>
            <tr>
                <th style="width: 5px"></th>
                <th style="width: 180px">Назва</th>
                <th style="width: 30px">Марка</th>
                <th style="width: 110px">№авт</th>
                <th style="width: 110px">№прич</th>
                <th style="width: 110px">Прiзвище</th>
                <th style="width: 110px">Iмя</th>
                <th style="width: 130px">По-батьк</th>
                <th style="width: 130px">Тел</th>
                <th>Замiтки</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th style="width: 5px"></th>
                <th style="width: 180px">Назва</th>
                <th style="width: 30px">Марка</th>
                <th style="width: 110px">№авт</th>
                <th style="width: 110px">№прич</th>
                <th style="width: 110px">Прiзвище</th>
                <th style="width: 110px">Iмя</th>
                <th style="width: 130px">По-батьк</th>
                <th style="width: 130px">Тел</th>
                <th>Замiтки</th>
            </tr>
        </tfoot>
        <tbody>
        @foreach($autos as $auto)
            <tr>
                <td>
{{--                    <input class="css-checkbox" id="checkBox_{{ $auto['id'] }}" type="checkbox">--}}
{{--                    <label for="checkBox_{{ $auto['id'] }}" class="css-label lite-blue-check"></label>--}}
                </td>
                <td>{{ $auto['name'] }}</td>
                <td>{{ $auto['mark'] }}</td>
                <td>{{ $auto['auto_num'] }}</td>
                <td>{{ $auto['trail_num'] }}</td>
                <td>{{ $auto['dr_surn'] }}</td>
                <td>{{ $auto['dr_name'] }}</td>
                <td>{{ $auto['dr_fath'] }}</td>
                <td>{{ $auto['tel'] }}</td>
                <td>{{ $auto['notes'] }}</td>
            </tr>
        @endforeach
        </tbody>

    </table>
@endsection

@section('footer')
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="/js/auto.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
@endsection

