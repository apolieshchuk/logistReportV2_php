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
