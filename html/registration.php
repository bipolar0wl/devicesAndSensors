<?php

?>
<div name="registration" class="registration" align="center" style="border: 1px">
    <form id="registration">
        <table>
            <tr>
                <td>Логин</td><td><input type="text" required id="regLogin" name="regLogin" placeholder="Введите логин"></td>
            </tr>
            <tr>
                <td>Пароль</td><td><input type="password" required id="regPassword" name="regPassword" placeholder="Введите пароль"></td>
            </tr>
            <tr>
                <td>Повторите пароль</td><td><input type="password" required id="regPasswordRepeat" name="regPasswordRepeat" placeholder="Повторите пароль"></td>
            </tr>
            <tr>
                <td>Фамилия</td><td><input type="text" id="regSurname" name="regSurname" required placeholder="Введите фамилию"></td>
            </tr>
            <tr>
                <td>Имя</td><td><input type="text" id="regName" name="regName" required placeholder="Введите имя"></td>
            </tr>
            <tr>
                <td>Отчество</td><td><input type="text" id="regPatronymic" name="regPatronymic" required placeholder="Введите отчество"></td>
            </tr>
            <tr>
                <td>Email</td><td><input type="email" id="regEmail" name="regEmail" placeholder="Введите Email"></td>
            </tr>
        </table>
    </form>
    <button id="sign_up" class="sensor-btn" onclick="registration()">Зарегистрироваться</button>
</div>