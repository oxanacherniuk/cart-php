<?php
require "../mysqli_connect.php";
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

$one = null;
if(isset($_GET['category'])) {
    $cat = $_GET['category'];
    $one=$mysqli->query("SELECT * FROM animals WHERE category='$cat'");
} else {
    $one=$mysqli->query("SELECT * FROM animals");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Mr.Lapkin</title>
</head>

<body>
<div class="menu" style="background: white; padding: 40px 0;">
    <nav class="navbar">
        <div class="container" style="display: flex; justify-content: space-between; align-items: center;">
        <a href="#" class="navbar-brand"><img src="../img/logo.svg"></a>
            <div class="collspase navbar-collspace">
                <ul class="navbar-nav" style="display: flex; margin-top: 0px;">
                    <li class="nav-item" style="list-style-type: none;">
                        <a href="" class="nav-link" style="text-decoration: none; color: #000; font-weight: 500; font-size: 20px;">Главная</a>
                    </li>
                    <li class="nav-item" style="list-style-type: none;">
                        <a href="" class="nav-link" style="text-decoration: none; color: #000; font-weight: 500; font-size: 20px; margin-left: 40px;">Каталог</a>
                    </li>
                    <!-- <?php if(isset($_SESSION['username'])):?>
                        <li class="nav-item">
                            <a href="">
                            <?php
                            echo $_SESSION['sucess'];
                            unset($_SESSION['sucess']) ?>
                            </a>
                        </li>
                    <?php endif;?> -->
                    <?php if(isset($_SESSION['username'])):?>
                        <li class="nav-item" style="list-style-type: none; color: #FF82C2;  font-weight: 500; font-size: 20px; margin-left: 40px;">
                        <?php echo $_SESSION['username'];?>
                        <a href="../main.php?logout='1'" class="nav-link" style="text-decoration: none; color: #000; font-weight: 500; font-size: 20px; margin-left: 40px;">Выйти</a>
                        </li>
                    <?php else : echo '<li class="nav-item" style="list-style-type: none;">
                        <a href="register.php" class="nav-link" style="text-decoration: none; color: #000; font-weight: 500; font-size: 20px; margin-left: 40px;">Зарегистрироваться</a>
                    </li>'?> 
                    <?php endif;?>
                </ul>
            </div>
        </div>
    </nav>
</div>
            <div class="container features">
                <div class="categoryButtons" style="display: flex; max-width: 400px; padding-bottom: 30px;">
                    <a href="main.php" class="btn btn-danger button" style="text-decoration: none; margin: auto; padding:10px 15px; width: 82px">Все</a>
                    <a href="main.php?category=cats" class="btn btn-outline-danger button" style="text-decoration: none; margin: auto; padding:10px 15px; width: 82px">Cats</a>
                    <a href="main.php?category=dogs" class="btn btn-outline-danger button" style="text-decoration: none; margin: auto; padding:10px 15px; width: 82px">Dogs</a>
                    <a href="main.php?category=birds" class="btn btn-outline-danger button" style="text-decoration: none; margin: auto; padding:10px 15px; width: 82px">Birds</a>
                </div>
            </div>
            <div class="products">
                <div class="container">
                <h3 class="products-title">Каталог животных</h3>
                <div class="products-cards">
            <?php
                foreach($one as $row) {
                    echo '
                    <div class="product-item">
                        <img class="logo" src="../img/logo.svg">
                        <form action="../more.php" method="POST">
                            <input type="hidden" name="posted" value="'.$row["id"].'">
                            <img src="../img/'.$row["img"].'" alt="" class="card-img">
                            <h3 class="card-title" name="name">'.$row["name"].'</h3>
                            <p class="card-text">'.$row["descr"].'</p>
                            <p class="card-text categories">'.$row["category"].'</p>
                            <p class="card-price">'.$row["price"].'</p>
                            <p><a type="button" href="../addToCart.php?id='.$row["id"].'" class="btn button">Добавить в корзину</a></p>
                        </form>
                    </div>
                    ';}
                ?>
                </div>
            </div>
        </div>

</body>

</html>