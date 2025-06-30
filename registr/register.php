<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
   <div class="header">
       <h2>Зарегистрироваться</h2>

       <form method="POST" action="register.php">
           <?php include('errors.php'); ?>
           <div class="input-group">
               <label>Username</label>
               <input type="text" placeholder ='Введите имя пользователя' name="username" value="<?php echo $username; ?>">
        </div>
            <div class="input-group">
            <label>Email</label>
            <input type="email" name="email" placeholder ='Введите email' value="<?php echo $email; ?>">
        </div>
        <div class="input-group">
               <label>Password</label>
               <input type="password" placeholder ='Введите пароль' name="password_1">
        </div>  
        <div class="input-group">
               <label>Confirm password</label>
               <input type="password" placeholder ='Повторите пароль' name="password_2">
        </div>  
        <div class="input-group">
            <button type="submit" class="btn" name="reg_user">Зарегистрироваться</button>
        </div>
        <p>
            Allready a number? <a href="login.php">Sign in</a>
        </p>
        </form>
    </body>
    </html>