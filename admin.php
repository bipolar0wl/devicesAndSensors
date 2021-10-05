<?php
//require_once('../php/dbSelect.php');
require_once('header.php');

?>
<div class="container">
    <div class="row" style="margin-top: 5px">
<!--        <div class="col-6 mx-auto">-->
        <?php
        if ($_SESSION['logged_user']['status'] > 3) {
            ?>
            <h4 style="margin: 0">Список пользователей</h4>
            <table class="peopleDataTable">
                <thead>
                <tr>
                    <th> Логин </th>
                    <th> Уровень доступа </th>
                    <th> Фамилия </th>
                    <th> Имя </th>
                    <th> Отчество </th>
                    <th> Почта </th>
                    <th> Дата регистрации </th>
                    <th> Действие </th>
                </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                </tfoot>
            </table>
            <div class="col-12 mx-auto edit_user_form" style="display: none"> <!-- Выравнивание по горизонтали -->
                <h4>Изменить данные</h4>
                <input style="display: none" id="edit_user_id" type="text" placeholder="ID" value="0">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group row">
                            <label for="edit_login" class="col-sm-4 col-form-label">Логин</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" id="edit_login" placeholder="Логин" value="<?php echo $_SESSION['logged_user']['login']?>">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="edit_email" class="col-sm-4 col-form-label">Email</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control form-control-sm" id="edit_email" placeholder="Email" value="<?php echo $_SESSION['logged_user']['email']?>">
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
                    </div>
                    <div class="col-6">
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
                        <div class="form-group row edit_password_div" style="display: none">
                            <label for="edit_password_two" class="col-sm-4 col-form-label">Повторите пароль</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control form-control-sm" id="edit_password_two" placeholder="Повторите пароль">
                            </div>
                        </div>
                    </div>
<!--                    <div class="row justify-content-center">-->
<!--                        <button type="submit" class="btn btn-outline-primary center-block" onclick="edit_user()">Подтвердить изменения</button>-->
<!--                    </div>-->
                </div>
                <div class="row justify-content-center">
                    <button type="submit" class="btn btn-outline-primary center-block" onclick="edit_user()">Подтвердить изменения</button>
                </div>
            </div>
            <?php
        }
        ?>
<!--        </div>-->
    </div>
</div>
<?php
include_once("footer.php");
function user_info($user_id, $mysqli){
}
