{{--MODAL EDIT AUTO --}}
<div id="modalUpdate" class="ui modal "
     style="padding: 0 20px 20px 20px; width: 500px">
    <i class="close icon"></i>
    <div class="header">
        Змінити авто
    </div>
    @if($errors->any())
        <div class="ui negative message modal-error-box">
            <p>{{ $errors->first() }}</p>
        </div>
    @endif
    <form id="modalUpdate_form" class="ui form" method="POST" action="/autos/?">
        @method('PUT')
        <h4 class="ui dividing header">Автомобіль</h4>
        <div class="field">
            <label>Перевізник</label>
            <div id="modalUpdate-carrier" class="two fields dynamic-input">
                <div class="fourteen wide field">
                    <select name='carrier_id' id="modalUpdate-carrier-select" class="ui search dropdown" required>
                        <option value="" selected disabled>Перевізник</option>
                        @foreach($carriers as $carrier)
                            <option value="{{ $carrier['id'] }}">{{ $carrier['name'] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="two wide field">
                    <i class="plus square icon"
                       onclick="addCarrierInputs(this)"
                       style="font-size:36px; color:#2185d0; cursor: pointer"></i>
                </div>
            </div>
        </div>
        <div class="field">
            <label>Авто</label>
            <div class="three fields">
                <div class="field">
                    <input type="text" id="modalUpdate-mark-input" name="mark" placeholder="Марка авто">
                </div>
                <div class="field">
                    <input id="modalUpdate-auto-num-input" type="text" name="auto_num" placeholder="Номер авто" required>
                </div>
                <div class="field">
                    <input id="modalUpdate-trail-num-input" type="text" name="trail_num" placeholder="Номер причепу">
                </div>
            </div>
        </div>
        <h4 class="ui dividing header">Водій</h4>
        <div class="field">
            <label>ПІБ</label>
            <div class="three fields">
                <div class="field">
                    <input id="modalUpdate-surname-input" type="text" name="dr_surn" placeholder="Прізвище">
                </div>
                <div class="field">
                    <input id="modalUpdate-name-input" type="text" name="dr_name" placeholder="Ім`я">
                </div>
                <div class="field">
                    <input id="modalUpdate-father-input" type="text" name="dr_fath" placeholder="По-батькові">
                </div>
            </div>
        </div>
        <div class="field">
            <label>Додаткова інформація</label>
            <div class="two fields">
                <div class="field">
                    <input id="modalUpdate-license-input" type="text" name="license" placeholder="Посвідчення">
                </div>
                <div class="field">
                    <input id="modalUpdate-tel-input" type="text" name="tel" placeholder="Телефон">
                </div>
            </div>
            <div class="field">
                <input id="modalUpdate-notes-input" type="text" name="notes" placeholder="Замітки">
            </div>
        </div>
        <div class="actions">
            <button type="button" class="ui deny button">Відмінити</button>
            <input type="submit" class="ui blue button" value="Зберегти" style="margin: auto">
        </div>
    </form>
</div>
