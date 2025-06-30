<div class="products" id="products">
        <div class="container">
            <h3 class="products-title">Каталог животных</h3>
            <div class="products-cards">
                <?php
                require "mysqli_connect.php";
                $one=$mysqli->query("SELECT * FROM  animals");
                while($row=mysqli_fetch_assoc($one)) {
                    echo'
                    <div class="product-item">
                    <img class="logo" src="img/logo.svg">
                        <form action="more.php" method="POST">
                        <input type="hidden" name="posted" value="'.$row["id"].'">
                        <img class="card-img" src="img/'.$row["img"].'">
                        <h3 class="card-title" name="name">'.$row["name"].'</h3>
                        <p class="card-text categories">'.$row["category"].'</p>
                        <p class="card-text">'.$row["descr"].'</p>
                        <p class="card-price">'.$row["price"].' р.</p>
                        <input type="submit" class="button" value="Купить">
                        </form>
                    </div>
                    ';
                }
                ?>
            </div>
        </div>
    </div>