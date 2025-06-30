<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/form.css">
    <title>Mr.Lapkin</title>
</head>
<body>
    <div class="block">
        <div class="form-buy">
        <form class="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <input type="text" name="name" placeholder="Введите ФИО">
                <input type="tel" name="tel" placeholder="Введите телефон">
                <input type="text" name="text" placeholder="Введите кол-во друзей">
                <button id="button" onclick="modal()" class="button-form">Отправить</button>
        </form>
    </div>
    <div class="block-modal">
    <div class="modal-window">
        <div class="modal-window">
        <p class="modal-window__text">Заявка отправлена.</p>
        <p class="modal-window__text">Мы вам обязательно перезвоним!</p>
        </div>
        <button id="close" class="banner__button to-send button-form" style="margin-top: 30px;" onclick="location.href='main.php'">Закрыть</button>
        </div>
    </div>
    <?php
    require "mysqli_connect.php";
        $name=$_POST['name'];
        $text=$_POST['text'];
        $tel=$_POST['tel'];
        $insert_row=$mysqli->query("INSERT INTO application (fio, phone, kol) VALUES('$name', '$tel', '$text')");
    ?>
    </div>
    <script src="scripts/form.js"></script>
</body>
</html>