<?php
require_once('php/dbSelect.php');
$select_sql = ('SELECT * FROM users WHERE login = "'.$_POST["login"].'" AND password = "'.$_POST["password"].'"');
$result = mysqli_query($mysqli, $select_sql);
$user = mysqli_fetch_assoc($result);
if ($user) {
    $_SESSION['logged_user'] = $user;
}
?>
<nav class="navbar navbar-expand-md navbar-light bg-light">
    <a class="navbar-brand" href="/">Приборы и датчики</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbar">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Меню</a>
                <div class="dropdown-menu" aria-labelledby="dropdown">
                    <div class="dropright" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <a tabindex="-1" class="dropdown-item" href="#" id="dropdown02">Просмотр и добавление информации</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown02">
                            <?php
                            if ($_SESSION['logged_user']['status'] > 1) {
                            ?>
                                <a class="dropdown-item" onclick="open_page('product.php?id=0&product_type=sensor')" href="#">Добавить датчик</a>
                                <a class="dropdown-item" onclick="open_page('product.php?id=0&product_type=device')" href="#">Добавить прибор</a>
                            <?php
                            }
                            ?>
<!--                            <a class="dropdown-item" onclick="open_page('product.php?id=0&product_type=sensor')" href="#">Добавить датчик</a>-->
<!--                            <a class="dropdown-item" onclick="open_page('product.php?id=0&product_type=device')" href="#">Добавить прибор</a>-->
                            <div class="dropdown-divider"></div>
                            <div class="dropdown-header" class=""><b>Общие параметры</b></div>
                            <a class="dropdown-item" onclick="sub_info(1)">Производители</a>
                            <a class="dropdown-item" onclick="sub_info(2)">Литература</a>
                            <a class="dropdown-item" onclick="sub_info(3)">Среда измерения</a>
                            <a class="dropdown-item" onclick="sub_info(4)">Область применения</a>
                            <a class="dropdown-item" onclick="sub_info(5)">Технология изготовления</a>
                            <a class="dropdown-item" onclick="sub_info(6)">Принцип действия</a>
                            <div class="dropdown-header" class="font-weight-bold"><b>Параметры датчиков</b></div>
                            <a class="dropdown-item" onclick="sub_info(7)">Тип датчика</a>
                            <a class="dropdown-item" onclick="sub_info(8)">Чувствительный элемент</a>
                            <a class="dropdown-item" onclick="sub_info(9)">Характер выходного сигнала</a>
                            <a class="dropdown-item" onclick="sub_info(10)">Характер преобразования сигнала</a>
                            <div class="dropdown-header" class="font-weight-bold"><b>Параметры приборов</b></div>
                            <a class="dropdown-item" onclick="sub_info(11)">Тип прибора</a>
                            <a class="dropdown-item" onclick="sub_info(12)">Назначение</a>
                            <a class="dropdown-item" onclick="sub_info(13)">Способ управления</a>
                            <a class="dropdown-item" onclick="sub_info(14)">Воспроизведение измеряемой величины</a>
                        </div>
                    </div>
                    <?php
                    if ($_SESSION['logged_user']['status'] > 3) {
                        echo '<a class="dropdown-item" href="admin.php">Администрирование</a>';
                        echo '<a class="dropdown-item" href="docs/Инструкция%20администратора.docx" target="_blank">Посмотреть инструкцию администратора</a>';
                    }
                    echo '<a class="dropdown-item" href="docs/Инструкция%20по%20эксплуатации.docx" target="_blank">Посмотреть инструкцию пользователя</a>';
                    ?>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/">На главную <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Аккаунт</a>
                <div class="dropdown-menu">
                    <div class="dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="dropdown-item-text">
                            <div class="form-col">
                                <?php
                                if ($_SESSION['logged_user']) {
                                    ?>
                                    <div class="form-group">
                                        <label>Вход выполнен</label>
                                        <label class="text-nowrap">
                                            <?php echo $_SESSION['logged_user']['surname']?>
                                            <?php echo mb_substr($_SESSION['logged_user']['name'], 0, 1)?>.
                                            <?php echo mb_substr($_SESSION['logged_user']['patronymic'], 0, 1)?>.
                                        </label>
                                    </div>
                                    <div class="form-group text-nowrap">
                                        <button class="btn btn-outline-primary" onclick="sign_out()">Выйти</button>
                                        <button class="btn btn-outline-primary" onclick="open_page('options.php')">Настроить</button>
                                    </div>
                                    <?php
                                }else{
                                    ?>
                                    <div class="form-group">
                                        <label>Логин</label>
                                        <input type="text" id="auth_login" class="form-control" placeholder="Логин">
                                    </div>
                                    <div class="form-group">
                                        <label>Пароль</label>
                                        <input type="password" id="auth_password" class="form-control" placeholder="Пароль">
                                    </div>
                                    &nbsp;
                                    <div class="form-group text-nowrap">
                                        <button type="button" onclick="authorization()" class="btn btn-outline-primary">Войти</button>
                                        <button type="submit" onclick="open_page('registration.php')" class="btn btn-outline-primary">Зарегистрироваться</button>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        <a href="docs/Инструкция%20по%20эксплуатации.docx" target="_blank">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z"/>
            </svg>
        </a>&nbsp;&nbsp;&nbsp;
        <input type="checkbox" checked id="dayNight" data-toggle="toggle">
    </div>
</nav>
<!--    <script type="text/javascript" src="js/dayNight.js"></script>-->
<!--    <script type="text/javascript" src="libs/bootstrap-4.5.0-dist/js/bootstrap.bundle.js"></script>-->
<script>
    $('#dayNight').bootstrapToggle({
        on: '<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-brightness-high-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">' +
        '<path d="M12 8a4 4 0 1 1-8 0 4 4 0 0 1 8 0z"/>' +
        '<path fill-rule="evenodd" d="M8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>' +
        '</svg>',
        off: '<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-moon" fill="currentColor" xmlns="http://www.w3.org/2000/svg">' +
        '<path fill-rule="evenodd" d="M14.53 10.53a7 7 0 0 1-9.058-9.058A7.003 7.003 0 0 0 8 15a7.002 7.002 0 0 0 6.53-4.47z"/>' +
        '</svg>',
    })
</script>
<?php
//$data = array(
//    'navbar' => '<p>hello</p>',
//);
//echo json_encode($data, JSON_UNESCAPED_UNICODE);