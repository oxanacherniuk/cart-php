<?php include ('server.php') ?>
<!DOCTYPE html>
<html>
<head>
    <title>Вход</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="header">
        <h2>Войти</h2>
    </div>

    <form action="login.php" method="post">
    <?php include ('errors.php'); ?>
    <div class="input-group">
        <label>Username</label>
        <input type="text" name="username" >
    </div>
    <div class="input-group" >
        <label>Password</label>
        <input type="password" name="password" >
    </div>
    <div class="input-group">
        <button type="submit" class="btn" name="login_user">Войти</button>
    </div>
    <p>
        Not yet a member? <a href="register.php">Sign up</a>
    </p>
    </form>
</body>
</html>