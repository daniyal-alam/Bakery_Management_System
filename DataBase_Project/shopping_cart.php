<?php

include 'connection.php';

if(isset($_POST['update_update_btn'])){
   $update_value = $_POST['update_quantity'];
   $update_id = $_POST['update_quantity_id'];
   $update_quantity_query = mysqli_query($link, "UPDATE `cart` SET quantity = '$update_value' WHERE id = '$update_id'");
   if($update_quantity_query){
      header('location:shopping_cart.php');
   };
};

if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($link, "DELETE FROM `cart` WHERE id = '$remove_id'");
   header('location:shopping_cart.php');
};

if(isset($_GET['delete_all'])){
   mysqli_query($link, "DELETE FROM `cart`");
   header('location:shopping_cart.php');
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
    <link rel="stylesheet" href='stylecart.css'>
    <link rel="stylesheet" href="queries.css" />
    <link rel="stylesheet" href="generalcart.css" />
    <link rel='stylesheet' type='text/css' media='screen' href='cart.css'>
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
          <li><a class="main-nav-link nav-cta" href="shopping_cart.php" id="cart">Cart <span><?php echo $row_count; ?></span></a></li>
        </ul>
      </nav>
      <button class="btn-mobile-nav">
        <ion-icon class="icon-mobile-nav" name="menu-outline"></ion-icon>
        <ion-icon class="icon-mobile-nav" name="close-outline"></ion-icon>
      </button>
    </header>
<body>
<div class="container">

<section class="shopping-cart">

   <h1 class="heading-featured-in">shopping cart</h1>

   <table>

      <thead>
         <th>image</th>
         <th>name</th>
         <th>price</th>
         <th>quantity</th>
         <th>total price</th>
         <th>action</th>
      </thead>

      <tbody>

         <?php 
         
         $select_cart = mysqli_query($link, "SELECT * FROM `cart`");
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
         ?>

         <tr>
            <td><img src="img/<?php echo $fetch_cart['img']; ?>" height="100" alt=""></td>
            <td><?php echo $fetch_cart['prod_name']; ?></td>
            <td>RS<?php echo number_format($fetch_cart['price']); ?>/-</td>
            <td>
               <form action="" method="post">
                  <input type="hidden" name="update_quantity_id"  value="<?php echo $fetch_cart['id']; ?>" >
                  <input type="number" name="update_quantity" min="1"  value="<?php echo $fetch_cart['quantity']; ?>" >
                  <input type="submit" value="update" name="update_update_btn">
               </form>   
            </td>
            <td>RS<?php echo $sub_total = $fetch_cart['price'] * $fetch_cart['quantity']; ?>/-</td>
            <td><a href="shopping_cart.php?remove=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('Remove item from cart?')" class="delete-btn"> Remove</a></td>
         </tr>
         <?php
            $grand_total += $sub_total;  
            };
         };
         ?>
         <tr class="table-bottom">
            <td><a href="products.php" class="option-btn" style="margin-top: 0;">continue shopping</a></td>
            <td colspan="3">Grand total</td>
            <td>RS <?php echo $grand_total; ?>/-</td>
            <td><a href="shopping_cart.php?delete_all" onclick="return confirm('Are you sure you want to delete all?');" class="delete-btn">Delete all</a></td>
         </tr>

      </tbody>

   </table>

   <div class="checkout-btn">
      <a href="checkout.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">Procced to checkout</a>
   </div>
</section>
</div>
</body>