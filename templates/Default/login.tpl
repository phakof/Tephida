<div class="miniature_box">
    <div class="miniature_pos" style="width:230px">
        <div class="miniature_title fl_l apps_box_text">Войти</div>
        <div class="clear"></div>
        <form method="POST" action="">
            <div class="" style="padding: 10px;">Электронный адрес</div>
            <input style="width: 90%;padding: 10px;" type="text" name="email" id="log_email" class="inplog"
                   maxlength="50">
            <div class="" style="padding: 10px;">Пароль</div>
            <input style="width: 90%;padding: 10px;" type="password" name="password" id="log_password" class="inplog"
                   maxlength="50">
            <div class="logpos">
                <div class="button_div">
                    <button name="log_in" id="login_but" style="width:138px">Войти</button>
                </div>
                <div style="margin-top:5px"><a href="/restore" onclick="Page.Go(this.href); return false">Не можете
                        войти?</a></div>
            </div>
        </form>
        <div class="clear" style="height: 20px"></div>
        <div class="button_div fl_r">
            <button onClick="viiBox.clos('login_box', 1)">Отмена</button>
        </div>
        <div class="clear"></div>
    </div>
</div>