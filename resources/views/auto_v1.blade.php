@extends('layout')

@section('head')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.css">
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/bootstrap-table@1.16.0/dist/extensions/filter-control/bootstrap-table-filter-control.css">
@endsection

@section('body')
    <div class="container" style="max-width: 100%">
        <h1>База даних авто ГК "ФС"</h1>

        <div id="toolbar">
            <select class="form-control">
                <option value="">Export Basic</option>
                <option value="all">Export All</option>
                <option value="selected">Export Selected</option>
            </select>
        </div>

        <table id="table" class="table table-striped table-bordered table-hover table-sm"
               style="table-layout: fixed"
               data-toggle="table"
               data-search="true"
               data-show-columns="true"
               data-copy-delimiter=" "
               data-filter-control="true"
               data-show-export="true"
               data-click-to-select="true"
               data-pagination="true"
               data-show-copy-rows="true"
               data-cookie="true"
               data-cookie-id-table="saveId"
               data-toolbar="#toolbar">
            <thead>
            <tr>
                <th data-field="state" data-checkbox="true"></th>
                <th data-width="180" data-field="name" data-filter-control="input" data-sortable="true">Назва</th>
                <th data-width="80" data-field="mark" data-filter-control="input" data-sortable="true">Марка</th>
                <th data-width="110" data-field="auto_num" data-filter-control="input" data-sortable="true">№авт</th>
                <th data-width="110" data-field="trail_num" data-filter-control="input" data-sortable="true">№прич</th>
                <th data-width="110" data-field="dr_surn" data-filter-control="input" data-sortable="true">Прiзвище</th>
                <th data-width="110" data-field="dr_name" data-filter-control="input" data-sortable="true">Iмя</th>
                <th data-width="130" data-field="dr_fath" data-filter-control="input" data-sortable="true">По-батьк</th>
                <th data-width="130" data-field="tel" data-filter-control="input" data-sortable="true">Тел</th>
                <th data-field="notes" data-filter-control="input" data-sortable="true">Замiтки</th>
            </tr>
            </thead>
            <tbody>
            @foreach($autos as $auto)
            <tr>
                <td class="bs-checkbox"><input data-index="{{ $auto['id'] }}" name="btSelectItem" type="checkbox"></td>
                <td>{{ $auto->carrier['name'] }}</td>
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
    </div>
@endsection

@section('footer')
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.16.0/dist/extensions/filter-control/bootstrap-table-filter-control.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.16.0/dist/extensions/copy-rows/bootstrap-table-copy-rows.js"></script>
@endsection

