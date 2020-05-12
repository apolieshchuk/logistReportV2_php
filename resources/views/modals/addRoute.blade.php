{{--MODAL ADD ROUTE --}}
<div id="modalAddRoute" class="ui modal "
     style="padding: 0 20px 20px 20px; width: 550px">
    <i class="close icon"></i>
    <div class="header">
        Додати маршрут
    </div>
    @if($errors->any())
        <div class="ui negative message modal-error-box">
            <p>{{ $errors->first() }}</p>
        </div>
    @endif
    <form id="modalAddRoute_form" class="ui form" method="POST" action="/go">
        @csrf
        <div class="field" style="margin-top: 10px;">
            <div class="three fields">
                <div class="seven wide field">
                    <label for="modalAddRoute-from"> Пункт відправлення </label>
                    <input type="text"  id="modalAddRoute-from" required
                           name="from" placeholder="Пункт відправлення"
                    value="{{ old('from') }}">
                </div>
                <div class="seven wide field">
                    <label for="modalAddRoute-to"> Пункт врибуття </label>
                    <input type="text"  id="modalAddRoute-to"  required
                           name="to" placeholder="Пункт прибуття" value="{{ old('to') }}">
                </div>
                <div class="three wide field">
                    <label for="modalAddRoute-km"> км </label>
                    <input type="text"  id="modalAddRoute-km"  required
                           name="km" placeholder="км"
                           @if(!$errors->has('km'))
                                value="{{ old('km') }}"
                           @endif
                           >
                </div>
            </div>
        </div>
        <div class="actions" style="text-align: center">
            <div class="ui deny button" style="width: 130px;">
                Відмінити
            </div>
            <button type="submit" class="ui blue button" style="width: 130px;">
                Додати
            </button>
        </div>
    </form>
</div>

