@extends('layout')

@section('head')

<title>Table V01</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
{{--MY CSS--}}
<link rel="stylesheet" href="/css/go.css">
{{--BOOTSTRAP--}}
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
{{--BOOTSTRAP-SELECT--}}
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
{{--SEMANTIC--}}
{{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.9/semantic.min.css"/>--}}
@endsection

@section('body')

{{--SELECT PICKER--}}
<div style="text-align: center">
    <label for="selectpicker"> Маршрут </label>
    <select class="selectpicker">
        <option value="">State</option>
        <option data-tokens="ketchup mustard">Hot Dog, Fries and a Soda</option>
        <option data-tokens="mustard">Burger, Shake and a Smile</option>
        <option data-tokens="frosting">Sugar, Spice and all things nice</option>
    </select>
</div>

<hr>

{{--MAIN TABLE--}}

<table class="table table-striped" style="width: 80%; margin: auto;
 table-layout: fixed">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Перевізник</th>
        <th scope="col">Авто</th>
        <th scope="col">Причеп</th>
        <th scope="col">Водій</th>
        <th scope="col">Дата</th>
        <th scope="col">Ф1</th>
        <th scope="col">Ф2</th>
        <th scope="col">Тр</th>
    </tr>
    </thead>
    <tbody>
    @foreach($autos as $key => $auto)
        <tr>
            <th scope="row">{{ $key + 1 }}</th>
            <td> {{ $auto->carrier['name'] }}</td>
            <td> {{ $auto['auto_num'] }}</td>
            <td> {{ $auto['trail_num'] }}</td>
            <td> {{ $auto['dr_surn'] }}</td>
            <td>
                <input type="date">
            </td>
            <td>
                <input type="text">
            </td>
            <td>
                <input type="text">
            </td>
            <td>
                <input type="text">
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
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

{{--BOOTSTRAP-SELECT--}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

{{--SEMANTIC--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.9/semantic.min.js"></script>--}}
@endsection

