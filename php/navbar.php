<?php
require_once('dbSelect.php');
$select_sql = ('SELECT * FROM users WHERE login = "'.$_POST["login"].'" AND password = "'.$_POST["password"].'"');
$result = mysqli_query($mysqli, $select_sql);
$user = mysqli_fetch_assoc($result);
if ($user) {
    $_SESSION['logged_user'] = $user;
}
?>
<nav class="navbar navbar-expand-md navbar-light bg-light">
    <a class="navbar-brand">Приборы и датчики</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbar">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Меню</a>
                <div class="dropdown-menu" aria-labelledby="dropdown04">
                    <div class="dropright" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <a tabindex="-1" class="dropdown-item" href="#" id="dropdown02">Добавить данные</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown02">
                            <a class="dropdown-item" onclick="open_page('product.php?id=0&product_type=sensor')" href="#">Добавить датчик</a>
                            <a class="dropdown-item" onclick="open_page('product.php?id=0&product_type=device')" href="#">Добавить прибор</a>
                            <div class="dropdown-divider"></div>
                            <div class="dropdown-header" class="font-weight-bold">Общие параметры</div>
                            <a class="dropdown-item" onclick="sub_info(1)">Производители</a>
                            <a class="dropdown-item" onclick="sub_info(2)">Литература</a>
                            <a class="dropdown-item" onclick="sub_info(3)">Среда измерения</a>
                            <a class="dropdown-item" onclick="sub_info(4)">Область применения</a>
                            <a class="dropdown-item" onclick="sub_info(5)">Технология изготовления</a>
                            <a class="dropdown-item" onclick="sub_info(6)">Принцип действия</a>
                            <div class="dropdown-header" class="font-weight-bold">Параметры датчиков</div>
                            <a class="dropdown-item" onclick="sub_info(7)">Тип датчика</a>
                            <a class="dropdown-item" onclick="sub_info(8)">Чувствительный элемент</a>
                            <a class="dropdown-item" onclick="sub_info(9)">Характер выходного сигнала</a>
                            <a class="dropdown-item" onclick="sub_info(10)">Характер преобразования сигнала</a>
                            <div class="dropdown-header" class="font-weight-bold">Параметры приборов</div>
                            <a class="dropdown-item" onclick="sub_info(11)">Тип прибора</a>
                            <a class="dropdown-item" onclick="sub_info(12)">Назначение</a>
                            <a class="dropdown-item" onclick="sub_info(13)">Способ управления</a>
                            <a class="dropdown-item" onclick="sub_info(14)">Воспроизведение измеряемой величины</a>
                        </div>
                    </div>
                    <?php
                    if ($_SESSION['logged_user']['status'] > 3)
                        echo '<a class="dropdown-item" href="admin.php">Администрирование</a>'
                    ?>
                    <a class="dropdown-item" href="help.php">Посмотреть справку</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php">На главную <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="index.php"><? echo $_SESSION['logged_user']['login'] ?><span class="sr-only">(current)</span></a>
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
                                        <input type="text" id="auth_login" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Пароль</label>
                                        <input type="password" id="auth_password" class="form-control">
                                    </div>
                                    <div class="form-group text-nowrap">
                                        <button type="button" onclick="authorization()" class="btn btn-outline-primary">Войти</button>
                                        <button type="submit" onclick="open_page('registration.php')" class="btn btn-outline-primary">Зарегестрироваться</button>
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
        <input type="checkbox" checked id="dayNight" data-toggle="toggle">
    </div>
</nav>
<?php
//$data = array(
//    'navbar' => '<p>hello</p>',
//);
//echo json_encode($data, JSON_UNESCAPED_UNICODE);