{{--MODAL EDIT AUTO --}}
<div id="modalUpdate" class="ui modal"
     style="padding: 0 20px 20px 20px; width: 550px">
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
        <h4 class="ui dividing header">Маршрут</h4>
        <div class="field">
            <div class="two fields">
                <div class="six wide field">
                    <input name="date" id="modalUpdate-date-input" type="date" placeholder="Дата">
                </div>
                <div class="ten wide field">
                    <select name='route_id' id="modalUpdate-route-select" class="ui search dropdown">
                        <option value="" selected disabled>Оберіть маршрут</option>
                        @foreach($routes as $route)
                            <option value="{{ $route['id'] }}">{{ $route['name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="two fields">
                <div class="eight wide field">
                    <select name='manager_id' id="modalUpdate-manager-select" class="ui search dropdown" style="margin-bottom: 10px" required>
                        <option value="" selected disabled >Оберіть менеджера</option>
                        @foreach($managers as $manager)
                            <option value="{{ $manager['id'] }}">{{ $manager['surname'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="eight wide field">
                    <select name='cargo_id' id="modalUpdate-cargo-select" class="ui search dropdown" required>
                        <option value="" selected disabled>Оберіть вантаж</option>
                        @foreach($cargos as $cargo)
                            <option value="{{ $cargo['id'] }}">{{ $cargo['name'] }}</option>
                        @endforeach
                    </select>
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
                </div>
                <div class="four wide field">
                    <input name='auto_num' id="modalUpdate-auto_num-input" type="text" placeholder="Гос№ авто">
                </div>
                <div id="dr_surn-select-wrapper" class="five wide field">
                    <select name='driver_id' id="modalUpdate-dr_surn-select" class="ui search dropdown" required>
                        <option value="" selected disabled>Водій</option>
                        @foreach($drivers as $driver)
                            <option value="{{ $driver['id'] }}">{{ $driver['surname']." ".$driver['name'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <h4 class="ui dividing header">Тариф</h4>
        <div class="field">
            <div class="three fields">
                <div class="six wide field">
                    <input id="modalUpdate-f2-input"  name='f2' type="number" placeholder="Ф2">
                </div>
                <div class="six wide field">
                    <input id="modalUpdate-f1-input" name='f1' type="number" placeholder="Ф1">
                </div>
                <div id="tr-select-wrapper" class="four wide field">
                    <select id="modalUpdate-tr-select" name='tr' class="ui dropdown">
                        <option value="0">НІ</option>
                        <option value="1">ТАК</option>
                    </select>
                </div>
            </div>
            <div class="field">
                <input id="modalUpdate-notes-input"  name='notes' type="text" placeholder="Замітки">
            </div>
        </div>
        <div class="actions">
            <button type="button" class="ui deny button">Відмінити</button>
            <input type="submit" class="ui blue button" value="Зберегти" style="margin: auto">
        </div>
    </form>
</div>
