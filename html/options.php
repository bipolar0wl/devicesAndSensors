<?php
//require_once('../php/dbSelect.php');
require_once('../header.php');

?>
<div>
    <div style="text-align: center">
        <fieldset style="text-align: right">
            <legend style="text-align: left">Информация о пользователе</legend>
            <table>
                <tr>
                    <input style="display: none" id="edit_user_id" type="text" placeholder="Логин" value="<?php echo $_SESSION['logged_user']['user_id'] ?>">
                    <td><label style="width: 120px">Логин</label></td><td><input id="edit_login" type="text" placeholder="Логин" value="<?php echo $_SESSION['logged_user']['login'] ?>"></td>
                    <td><label style="width: 160px">email</label></td><td><input id="edit_email" type="email" placeholder="email" value="<?php echo $_SESSION['logged_user']['email'] ?>"></td>
                </tr>
                <tr>
                    <td><label style="width: 120px">Фамилия</label></td><td><input id="edit_surname" type="text" placeholder="Фамилия" value="<?php echo $_SESSION['logged_user']['surname'] ?>"></td>
                    <td><label style="width: 160px">Дата регистрации</label></td><td><input type="datetime" disabled value="<?php echo $_SESSION['logged_user']['regDate'] ?>"></td>
                </tr>
                <tr>
                    <td><label style="width: 120px">Имя</label></td><td><input id="edit_name" type="text" placeholder="Имя" value="<?php echo $_SESSION['logged_user']['name'] ?>"></td>
                    <td><label style="width: 160px">Уровень доступа</label></td><td><input type="text" disabled value="<?php echo $_SESSION['logged_user']['status'] ?>"></td>
                </tr>
                <tr>
                    <td><label style="width: 120px">Отчество</label></td><td><input id="edit_patronymic" type="text" placeholder="Отчество" value="<?php echo $_SESSION['logged_user']['patronymic'] ?>"></td>
                    <td><label style="width: 160px">Сменить пароль</label></td><td><input onchange="edit_password(this)" id="edit_password_check" type="checkbox"></td>
                </tr>
                <tr hidden id="edit_password_div">
                    <td><label style="width: 120px">Новый пароль</label></td><td><input id="edit_password_one" type="password" placeholder="Новый пароль" value="<?php ?>"></td>
                    <td><label style="width: 160px">Повторите пароль</label></td><td><input id="edit_password_two" type="password" placeholder="Повторите пароль" value="<?php ?>"></td>
                </tr>
            </table>
            <button style="margin-right: 5px; vertical-align: sub" onclick="edit_user()">Подтвердить изменения</button>
        </fieldset><br>
        <?php
        if ($_SESSION['logged_user']['status'] > 3) {
            ?>
            <fieldset>
                <legend style="text-align: left">Список пользователей</legend>
                <table class="peopleDataTable" style="max-width: 90vw">
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
            </fieldset>
            <?php
        }
        ?>
    </div>
</div>
<?php
function user_info($user_id, $mysqli){
}
