<?php
require_once("header.php");
?>
<div class="container h-100">
    <div class="row align-items-center h-100">
        <div class="col-6 mx-auto">
            <form>
                <div class="form-group row">
                    <label for="regLogin" class="col-sm-4 col-form-label">Логин</label>
                    <div class="col-sm-8">
<!--                        <input type="text" class="form-control" id="regLogin" placeholder="Логин" onkeyup="this.value = this.value.replace(/[а-яА-ЯёЁ -0-9]/g,'')">-->
                        <input type="text" class="form-control" id="regLogin" placeholder="Логин" onkeyup="this.value = this.value.replace(/[^a-zA-Z0-9]/g, '')">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="regPassword" class="col-sm-4 col-form-label">Пароль</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="regPassword" placeholder="Пароль">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="regPasswordRepeat" class="col-sm-4 col-form-label">Повторите пароль</label>
                    <div class="col-sm-8">
                        <input type="password" class="form-control" id="regPasswordRepeat" placeholder="Повторите пароль">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="regSurname" class="col-sm-4 col-form-label">Фамилия</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="regSurname" placeholder="Фамилия">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="regName" class="col-sm-4 col-form-label">Имя</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="regName" placeholder="Имя">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="regPatronymic" class="col-sm-4 col-form-label">Отчество</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="regPatronymic" placeholder="Отчество">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="regEmail" class="col-sm-4 col-form-label">Email</label>
                    <div class="col-sm-8">
                        <input type="email" class="form-control" id="regEmail" placeholder="Email">
                    </div>
                </div>
            </form>
            <div class="row justify-content-center" style="margin-top: 10px">
                <button type="submit" id="sign_up" class="btn btn-outline-primary center-block" onclick="registration()">Зарегистрироваться</button>
            </div>
        </div>
        <style>
            .form-group{
                margin-top: 4px;
            }
        </style>
    </div>
</div>
<?php
require_once("footer.php");