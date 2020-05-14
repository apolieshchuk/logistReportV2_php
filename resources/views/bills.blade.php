@extends('layout')

@section('head')
{{--    BOOTSTRAP TABLES--}}
<link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
@endsection

@section('body')
    <table data-toggle="table">
        <thead>
        <tr>
            <th>№рах</th>
            <th>Дата рах</th>
            <th>Сума</th>
            <th>Дата отримання оригіналів</th>
            <th>Перевізник</th>
            <th>Дата оплати</th>
            <th>Замітки</th>
            <th>Дата погодження</th>
            <th>Платник</th>
            <th>Маршрут</th>
        </tr>
        </thead>
        <tbody>
        @foreach($bills as $bill)
            <tr>
                <td>{{ $bill->num }}</td>
                <td>{{ $bill->bills_date }}</td>
                <td>{{ $bill->sum }}</td>
                <td>{{ $bill->originals_date }}</td>
                <td>{{ $bill->carrier->name }}</td>
                <td>{{ $bill->payed_date }}</td>
                <td>{{ $bill->notes }}</td>
                <td>{{ $bill->approval_date }}</td>
                <td>{{ $bill->payer->name }}</td>
                <td>{{ $bill->route->name }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection

@section('footer')
{{--    BOOTSTRAP TABLES--}}
<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.js"></script>
@endsection
