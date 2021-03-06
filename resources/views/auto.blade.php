@extends('layout')

@section('head')
    <title>Autos</title>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    {{--DATATABLES--}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="/css/auto.css?{{ time() }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">

    {{--DATATABLES EDITOR KasperOlesen/DataTable-AltEditor--}}
    {{--<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.1.2/css/buttons.dataTables.min.css"/>--}}
    {{--<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.0.2/css/responsive.dataTables.min.css"/>--}}

    {{--JQUERY--}}
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

    {{--SOME ICONS AND FONTS --}}
    {{--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">--}}
    {{--<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">--}}
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">--}}

    {{--SEMANTIC--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.9/semantic.min.css"/>

    {{--BOOTSTRAP--}}
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">--}}

    {{--SEMANTIC UI / DATA TABLES--}}
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.css"/>--}}
    {{--<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.semanticui.min.css"/>--}}

    {{--    FONT AWESOME--}}
    {{--<script src="https://kit.fontawesome.com/b437789619.js" crossorigin="anonymous"></script>--}}

    <meta name="csrf_token" content="{{ csrf_token() }}" />
@endsection

@section('body')

    {{--MAIN--}}
    <div style="padding: 0 10px; display: flex; flex-direction: column;">
        {{--    HEADER MENU--}}
        <div id="header-menu"
             style="margin-bottom: 10px; width: 800px; align-self: center; margin-top: 10px;"
             class="five ui buttons" >
            <button class="ui blue button" onclick="showModalAdd()" id="addAutoButton">
                <i class="plus circle icon" style="font-size:24px"></i> <span>Додати</span>
            </button>
            <button class="ui blue button" id="clearButton">
                <i class="erase icon" style="font-size:24px"></i><span>Очистити</span></button>
            <button class="ui blue button" id="copyButton" onclick="copyAutos()">
                <i class="copy outline icon" style="font-size:24px"></i><span>Копіювати</span></button>
            <button class="ui blue button" id="goButton">
                <i class="share icon" style="font-size:24px"></i><span>Відправити</span></button>
            <button class="ui blue button" onclick="location='/report'" id="reportButton">
                <i class="list icon" style="font-size:24px"></i><span>Звіт</span></button>
        </div>
        {{--    SEARCH INPUT--}}
        <nav style="margin-bottom: 10px; text-align: center;"
             class="navbar navbar-default" role="navigation">
            <div style="text-align: center" class="navbar-text ui input">
                <input style="height: 35px" type="text" id="filterbox" placeholder="Пошук">
            </div>
        </nav>
        <hr style="width: 100%; height: 1px">
        {{--    MAIN TABLE--}}
        <div  style="overflow: auto">
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
                    <th>Дії</th>
{{--                    <th>id</th>--}}
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
                    <th></th>
{{--                    <th>id</th>--}}
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
                    <th>Дії</th>
{{--                    <th>id</th>--}}
                </tr>
                </tfoot>
            </table>
        </div>
    </div>

    {{--    MODALS--}}
    @include('modals.addAuto')
    @include('modals.editAuto')
    @include('modals.deleteAuto')


@endsection

@section('footer')

    {{--MY STYLE--}}
    <script src="/js/auto.js?{{ time() }}"></script>

    {{--DATATABLES--}}
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>

    {{--DATATABLES EDITOR CellEdit--}}
    {{--<script src="/js/dataTables.cellEdit.js"></script>--}}

    {{--DATATABLES EDITOR KasperOlesen/DataTable-AltEditor--}}
    {{--<script src="/js/dataTables.altEditor.free.js"></script>--}}
    {{--<script src="https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.min.js"></script>--}}
    {{--<script src="https://cdn.datatables.net/select/1.1.2/js/dataTables.select.min.js"></script>--}}
    {{--<script src="https://cdn.datatables.net/responsive/2.0.2/js/dataTables.responsive.min.js"></script>--}}

    {{--SEMANTIC--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.9/semantic.min.js"></script>

    {{--SEMANTIC UI / DATA TABLES--}}
    {{--<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>--}}
    {{--<script src="https://cdn.datatables.net/1.10.20/js/dataTables.semanticui.min.js"></script>--}}

    {{--BOOTSTRAP--}}
    {{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>--}}

    {{--    INPUT MASK--}}
    <script src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>

    {{--HANDLE FORM ERRORS (AFTER JS INCLUDE)--}}
    @if($errors->any())
        @if(session('modal') === 'store')
            <script type="text/javascript">
                showModalAdd()
            </script>
        @endif
        @if(session('modal') === 'update')
            <script type="text/javascript">
                showModalUpdate({{session('id')}});
            </script>
        @endif
    @endif
@endsection
