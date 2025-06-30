<?php
session_start();

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login.php");
    exit(); 
}

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "Сначала вы должны войти в систему";
    header('location: login.php');
    exit();
}

?>
<!DOCTYPE html>
<html>
<head>
    <title> ГЛАВНАЯ </title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="header">
        <h2>Главная страница</h2>
    </div>
    <div class="content">
        <?php if (isset($_SESSION['success'])) : ?>
            <div class="error success">
                <h3>
                    <?php
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                    ?>
                </h3>
            </div>
        <?php endif ?>
        <?php if (isset($_SESSION['username'])) : ?>

            <p>Добро пожаловать, <strong><?php echo $_SESSION['username']; ?></strong></p>
            <p><a href="index1.php?logout='1'" style="color: red">Выход из системы</a> </p>
        <?php endif ?>
    </div>

</body>
</html>