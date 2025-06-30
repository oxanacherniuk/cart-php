<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/more.css">
    <title>Mr.Lapkin</title>
</head>

<body>
    <div class="card">
        <div class="container">
            <div class="card-box">
                <?php
                require "mysqli_connect.php";
                $id=$_POST['posted'];
                $one=$mysqli->query("SELECT * FROM animals where id like $id");
                while($row=mysqli_fetch_assoc($one)) {
                    echo'
                    <div class="product-item">
                        <div class="image">
                            <img class="product-item__img" src="img/'.$row["img"].'">
                        </div>
                        <div class="info">
                            <h3 class="product-item__title" name="name">'.$row["name"].'</h3>
                            <p class="product-item__text">'.$row["descr"].'</p>
                            <p class="product-item__price">'.$row["price"].' p.</p>
                            <p><a type="button" href="addToCart.php?id='.$row["id"].'" class="btn button">Добавить в корзину</a></p>
                        </div>
                    </div>
                    ';}
                ?>
            </div>
        </div>
    </div>
    <script src="scripts/script.js"></script>
</body>

</html>