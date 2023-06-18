<?php

include 'connection.php';

if(isset($_POST['add_to_cart'])){
  $prod_id = $_POST['prod_id'];
  $product_name = $_POST['prod_name'];
  $product_price = $_POST['prod_price'];
  $product_image = $_POST['prod_img'];
  $product_quantity = 1;

  $select_cart = mysqli_query($link, "SELECT * FROM cart WHERE prod_name = '$product_name'");

  if(mysqli_num_rows($select_cart) > 0){
    $message = 'Product already added to cart';
    echo '<script>';
    echo 'alert("' . $message . '");';
    echo '</script>';
  }else{
     $insert_product = mysqli_query($link, "INSERT INTO cart(prod_id, prod_name, price, img, quantity) VALUES('$prod_id', '$product_name', '$product_price', '$product_image', '$product_quantity')");
     $message = 'Product added to cart successfully';
     echo '<script>';
     echo 'alert("' . $message . '");';
     echo '</script>';
  }
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link rel="stylesheet" href="./assets/css/simple-line-icons.css">
    <link
      href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <link rel="shortcut icon" type="x-icon" href="./img/logos/cake_logo.png">
    <link rel="stylesheet" href='style copy.css'>
    <link rel="stylesheet" href="queries.css" />
    <link rel="stylesheet" href="general copy.css" />
    <link rel='stylesheet' type='text/css' media='screen' href='styleproduct.css'>
    <title>DLS Bakers</title>
</head>
<header class="header">
      <a href="#">
        <img class="logo" alt="DLS logo" src="img/logos/cake_logo.png" />
      </a>

      <?php
      
      $select_rows = mysqli_query($link, "SELECT * FROM `cart`") or die('query failed');
      $row_count = mysqli_num_rows($select_rows);

      ?>

      <nav class="main-nav">
        <ul class="main-nav-list">
          <li><a class="main-nav-link" href="http://localhost/DataBase_Project/index.php#dashboard">Dashboard</a></li>
          <li><a class="main-nav-link" href="http://localhost/DataBase_Project/addproduct.php">Add Products</a></li>
          <li><a class="main-nav-link" href="http://localhost/DataBase_Project/products.php">View Products</a></li>
          <li><a class="main-nav-link" href="#About">About</a></li>
          <li><a class="main-nav-link nav-cta" href="http://localhost/DataBase_Project/shopping_cart.php" id="cart">Cart <span><?php echo $row_count; ?></span></a></li>
        </ul>
      </nav>

      <button class="btn-mobile-nav">
        <ion-icon class="icon-mobile-nav" name="menu-outline"></ion-icon>
        <ion-icon class="icon-mobile-nav" name="close-outline"></ion-icon>
      </button>
    </header>
<body>
    <div class="container">
         <section class="products">

            <h1 class="heading-featured-in"> Products </h1>
            <div class="contbox">
                <?php
                $select_products = mysqli_query($link, "SELECT * FROM `products`");

                if(mysqli_num_rows($select_products) > 0){
                    while($fetch_product = mysqli_fetch_assoc($select_products)){

                ?>

                <form action="" method="post">
                    <div class="box" >
                        <img src="img/<?php echo $fetch_product['img']; ?>" alt="">
                        <h2 ><?php echo $fetch_product['prod_name']; ?></h2>
                        <div class="price">Rs <?php echo $fetch_product['price']; ?>/-</div>
                        <input type="hidden" name="prod_id" value="<?php echo $fetch_product['prod_id']; ?>">
                        <input type="hidden" name="prod_name" value="<?php echo $fetch_product['prod_name']; ?>">
                        <input type="hidden" name="prod_price" value="<?php echo $fetch_product['price']; ?>">
                        <input type="hidden" name="prod_img" value="<?php echo $fetch_product['img']; ?>">
                        <input type="submit" class="btn-cart" value="Add to cart" name="add_to_cart">
                    </div>
                </form>
                <?php
                     };
                    };
                ?>
            </div>
         </section>
    </div>
    <script src='script.js'></script> 
</body>
</html>