<?php
//require_once('../php/dbSelect.php');
require_once('header.php');

?>
    <div class="container">
        <div class="row align-items-center h-100"> <!-- Выравнивание по вертикали -->
            <div class="col-6 mx-auto"> <!-- Выравнивание по горизонтали -->
<!--                <form autocomplete="off">-->
<!--                    <fieldset>-->
                        <legend style="text-align: left">Информация о пользователе</legend>
                        <input style="display: none" id="edit_user_id" type="text" placeholder="Логин" value="<?php echo $_SESSION['logged_user']['user_id']?>">
                        <div class="form-group row">
                            <label for="edit_login" class="col-sm-4 col-form-label">Логин</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" id="edit_login" placeholder="Логин" value="<?php echo $_SESSION['logged_user']['login']?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="edit_surname" class="col-sm-4 col-form-label">Фамилия</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" id="edit_surname" placeholder="Фамилия" value="<?php echo $_SESSION['logged_user']['surname']?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="edit_name" class="col-sm-4 col-form-label">Имя</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" id="edit_name" placeholder="Имя" value="<?php echo $_SESSION['logged_user']['name']?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="edit_patronymic" class="col-sm-4 col-form-label">Отчество</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" id="edit_patronymic" placeholder="Отчество" value="<?php echo $_SESSION['logged_user']['patronymic']?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="edit_email" class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control form-control-sm" id="edit_email" placeholder="Email" value="<?php echo $_SESSION['logged_user']['email']?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Дата регистрации</label>
                            <div class="col-sm-8">
                                <input disabled type="datetime" class="form-control form-control-sm" placeholder="" value="<?php echo $_SESSION['logged_user']['regDate']?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="edit_password_check" class="col-sm-4 col-form-label">Сменить пароль</label>
                            <div class="col-sm-8">
                                <input type="checkbox" onchange="edit_password(this)" class="form-control form-control-sm" id="edit_password_check">
                            </div>
                        </div>
                        <div class="form-group row edit_password_div" style="display: none">
                            <label for="edit_password_one" class="col-sm-4 col-form-label">Новый пароль</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control form-control-sm" id="edit_password_one" placeholder="Новый пароль">
                            </div>
                        </div>
                        <div class="form-group row edit_password_div" style="display: none">
                            <label for="edit_password_two" class="col-sm-4 col-form-label">Повторите пароль</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control form-control-sm" id="edit_password_two" placeholder="Повторите пароль">
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <button type="submit" class="btn btn-outline-primary center-block" onclick="edit_user()">Подтвердить изменения</button>
                        </div>
<!--                    </fieldset>-->
<!--                </form>-->
            </div>
        </div>
    </div>
<!--<div>-->
<!--    <div style="text-align: center">-->
<!--        <fieldset style="text-align: right">-->
<!--            <legend style="text-align: left">Информация о пользователе</legend>-->
<!--            <table>-->
<!--                <tr>-->
<!--                    <input style="display: none" id="edit_user_id" type="text" placeholder="Логин" value="--><?php //echo $_SESSION['logged_user']['user_id'] ?><!--">-->
<!--                    <td><label style="width: 120px">Логин</label></td><td><input id="edit_login" type="text" placeholder="Логин" value="--><?php //echo $_SESSION['logged_user']['login'] ?><!--"></td>-->
<!--                    <td><label style="width: 160px">email</label></td><td><input id="edit_email" type="email" placeholder="email" value="--><?php //echo $_SESSION['logged_user']['email'] ?><!--"></td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td><label style="width: 120px">Фамилия</label></td><td><input id="edit_surname" type="text" placeholder="Фамилия" value="--><?php //echo $_SESSION['logged_user']['surname'] ?><!--"></td>-->
<!--                    <td><label style="width: 160px">Дата регистрации</label></td><td><input type="datetime" disabled value="--><?php //echo $_SESSION['logged_user']['regDate'] ?><!--"></td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td><label style="width: 120px">Имя</label></td><td><input id="edit_name" type="text" placeholder="Имя" value="--><?php //echo $_SESSION['logged_user']['name'] ?><!--"></td>-->
<!--                    <td><label style="width: 160px">Уровень доступа</label></td><td><input type="text" disabled value="--><?php //echo $_SESSION['logged_user']['status'] ?><!--"></td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td><label style="width: 120px">Отчество</label></td><td><input id="edit_patronymic" type="text" placeholder="Отчество" value="--><?php //echo $_SESSION['logged_user']['patronymic'] ?><!--"></td>-->
<!--                    <td><label style="width: 160px">Сменить пароль</label></td><td><input onchange="edit_password(this)" id="edit_password_check" type="checkbox"></td>-->
<!--                </tr>-->
<!--                <tr hidden id="edit_password_div">-->
<!--                    <td><label style="width: 120px">Новый пароль</label></td><td><input id="edit_password_one" type="password" placeholder="Новый пароль" value="--><?php //?><!--"></td>-->
<!--                    <td><label style="width: 160px">Повторите пароль</label></td><td><input id="edit_password_two" type="password" placeholder="Повторите пароль" value="--><?php //?><!--"></td>-->
<!--                </tr>-->
<!--            </table>-->
<!--            <button style="margin-right: 5px; vertical-align: sub" onclick="edit_user()">Подтвердить изменения</button>-->
<!--        </fieldset><br>-->
<!--    </div>-->
<!--</div>-->
<?php
require_once('footer.php');
function user_info($user_id, $mysqli){
}
