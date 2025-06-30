<?php 
require 'mysqli_connect.php';
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $one = "SELECT * FROM animals where id='$id'";
    $result = $mysqli -> query($one);
    if($row = $result -> fetch_assoc()) {
        $ID = $row['id'];
        $IMAGE = $row['img'];
        $NAME = $row['name'];
        $PRICE = $row['price'];
        $COUNT = $row['colvo'];

        $TotalPRICE = $PRICE * $COUNT;

        $one = "Insert into korzina (product_name, product_price, product_image, qty, total_price) values ('$NAME', '$PRICE', '$IMAGE', '$COUNT', '$TotalPRICE')";
        //$result = $mysqli -> execute_query($one);
        if($mysqli->query($one)) {
            echo "Данные успешно добавлены";
        } else {
            echo "Ошибка: " . $mysqli->error;
        }
        header("Location: addToCart.php");
    }
}
if(isset($_GET['Delete'])) {
    $idName = $_GET['idName'];
    $one = "DELETE FROM korzina WHERE id='$idName'";
    $result = $mysqli -> query($one);
}
if(isset($_POST["newQty"])) {
    $id = $_POST["id"];
    $qty = $_POST["newQty"];
    $one = "SELECT * FROM animals where id='$id'";
    $one = "UPDATE korzina SET qty = ".$qty." WHERE id = ".$id;
    if(!$mysqli->query($one)) {
        echo "Ошибка: " .$mysqli->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Mr.Lapkin</title>
</head>
<body>
<div class="menu" style="background: white; padding: 40px 0;">
    <nav class="navbar">
        <div class="container" style="display: flex; justify-content: space-between; align-items: center;">
        <a href="#" class="navbar-brand"><img src="img/logo.svg"></a>
            <div class="collspase navbar-collspace">
                <ul class="navbar-nav" style="display: flex; margin-top: 0px;">
                    <li class="nav-item" style="list-style-type: none;">
                        <a href="" class="nav-link" style="text-decoration: none; color: #000; font-weight: 500; font-size: 20px;">Главная</a>
                    </li>
                    <li class="nav-item" style="list-style-type: none;">
                        <a href="" class="nav-link" style="text-decoration: none; color: #000; font-weight: 500; font-size: 20px;">Каталог</a>
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
                        <li class="nav-item" style="list-style-type: none; color: #FF82C2;  font-weight: 500; font-size: 20px;">
                        <?php echo $_SESSION['username'];?>
                        <a href="../main.php?logout='1'" class="nav-link" style="text-decoration: none; color: #000; font-weight: 500; font-size: 20px;">Выйти</a>
                        </li>
                    <?php else : echo '<li class="nav-item" style="list-style-type: none;">
                        <a href="register.php" class="nav-link" style="text-decoration: none; color: #000; font-weight: 500; font-size:20px;">Зарегистрироваться</a>
                    </li>'?> 
                    <?php endif;?>
                </ul>
            </div>
        </div>
    </nav>
</div>
<div class="table-responsive mt-2">
    <table class="table table-bordered table-striped text-center">
        <thead>
            <tr>
                <td colspan="7">
                    <h4 class="text-center text-info m-0">Твой друг в корзине!</h4>
                </td>
            </tr>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Product</th>
                <th>Price</th>
                <th>Count</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        require 'mysqli_connect.php';
        $stmt = $mysqli->prepare(('SELECT * from korzina'));
        $stmt->execute();
        $result = $stmt->get_result();
        $grand_total = 0;
        while($row = $result->fetch_assoc()):
        ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <input type="hidden" class="pid" value="<?= $row['id'] ?>">
            <td><img src="<?= 'img/'.$row['product_image'].'' ?>" width="50"></td>
            <td><?= $row['product_name'] ?></td>
            <td><i class="fas fa-rupee-sign"></i>&nbsp;&nbsp;<?= number_format($row['product_price'], 2); ?></td>
            <input type="hidden" class="pprice" data-cart-id="<?= $row['id'] ?>" value="<?= $row['product_price'] ?>">
            <td>
                <form action="addToCart.php" method="post" class="d-flex flex-column justify-content-center align-items-center gap-1">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <input type="number" name="newQty" class="form-control itemQty" data-cart-id="<?= $row['id'] ?>" value="<?= $row['qty'] ?>" style="width: 75px;">
                    <button type="submit" class="btn btn-primary fs-6">Изменить</button>
                </form>
            </td>
            <td><i class="fas fa-rupee-sign"></i>&nbsp;&nbsp;<label class="total-price-item" data-cart-id="<?= $row['id'] ?>"><?= number_format($row['product_price']*$row["qty"],2) ?></label></td>
            <td>
                <form>
                    <button name="Delete" type="submit">Удалить</button>
                    <input name="idName" class="visually-hidden" type="number" value="<?= $row['id'] ?>">
                </form>
            </td>
        </tr>
        <?php $grand_total += $row['product_price']*$row["qty"]; ?>
        <?php endwhile; ?>
        <tr>
            <td colspan="3"><a href="registr/home.php" class="btn btn-success">Continue Shopping</a></td>
            <td colspan="2"><b>Grand Total</b></td>
            <td><b><i class="fas fa-rupee-sign"></i>&nbsp;&nbsp;<label id="grand-total-price"><?= number_format($grand_total, 2) ?></label></b></td>
            <td><a href="checkout.php" class="btn btn-info <?= ($grand_total > 1) ? '' : 'disabled'; ?>">Checkout</a></td>
        </tr>
        </tbody>
    </table>
</div>
<script src="script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>