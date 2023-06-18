<?php

include 'connection.php';
if(isset($_POST['order_btn'])){

    $customer_id = $_POST['cust_id'];
    $order_id = $_POST['order_id'];
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $email = $_POST['email'];
    $number = $_POST['phone'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $code = $_POST['code'];
    $payment = $_POST['payment'];
    $order_date = $_POST['order_date'];
 
    $cart_query = mysqli_query($link, "SELECT * FROM `cart`");
    $price_total = 0;
    if(mysqli_num_rows($cart_query) > 0){
       while($product_item = mysqli_fetch_assoc($cart_query)){
          $product_name[] = $product_item['prod_name'] .' ('. $product_item['quantity'] .') ';
          $product_id[] = $product_item['prod_id'];
          $product_price = $product_item['price'] * $product_item['quantity'];
          $price_total += $product_price;
       };
    }
    
    $query = "SELECT COUNT(*) as count FROM customer WHERE customer_id = '$customer_id'";
    $result = mysqli_query($link, $query);

    if ($result) {
    $row = mysqli_fetch_assoc($result);
    $count = $row['count'];

    if ($count > 0) {
        $total_product = implode(', ',$product_name);
        $prod_id = implode(' ',$product_id);
        $detail_query1 = mysqli_query($link, "INSERT INTO `orders`(order_id, customer_id, order_date) values ('$order_id','$customer_id', '$order_date')") or die('query failed');
        $detail_query2 = mysqli_query($link, "INSERT INTO `cust_pro`(order_id, customer_id, prod_id) values ('$order_id','$customer_id', '$prod_id')") or die('query failed');
    } else {
        $total_product = implode(', ',$product_name);
        $prod_id = implode(' ',$product_id);
        $detail_query = mysqli_query($link, "INSERT INTO `customer`(customer_id, prod_id, fname, lname, email, ph_number, address, city, code, payment, order_date, total_products, total_price) VALUES('$customer_id', '$prod_id', '$fname', '$lname', '$email', '$number', '$address', '$city', '$code', '$payment', '$order_date', '$total_product','$price_total')") or die('query failed');
        $detail_query1 = mysqli_query($link, "INSERT INTO `orders`(order_id, customer_id, order_date) values ('$order_id','$customer_id', '$order_date')") or die('query failed');
        $detail_query2 = mysqli_query($link, "INSERT INTO `cust_pro`(order_id, customer_id, prod_id) values ('$order_id','$customer_id', '$prod_id')") or die('query failed');
    }
} 

    if($cart_query){
       echo "
       <div class='order-message-container'>
       <div class='message-container'>
          <h3>thank you for shopping!</h3>
          <div class='order-detail'>
             <span>".$total_product."</span>
             <span class='total'> Total : RS ".$price_total."/-  </span>
          </div>
          <div class='customer-details'>
             <p>Order ID: <span>".$order_id. "</span> </p>
             <p>Customer ID: <span>".$customer_id. "</span> </p>
             <p>Name: <span>".$fname. " ".$lname."</span> </p>
             <p>Number: <span>".$number."</span> </p>
             <p>Email: <span>".$email."</span> </p>
             <p>Address: <span>".$address.", ".$city.", - ".$code."</span> </p>
             <p>Payment mode: <span>".$payment."</span> </p>
             <p>Order date: <span>".$order_date."</span> </p>
          </div>
             <a href='products.php' class='btn'>Continue Shopping</a>
             <a href='http://localhost/DataBase_Project/index.php#dashboard' class='btn'>Exit</a>
          </div>
       </div>
       ";
    }
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DLS Bakers</title>
    <link rel="shortcut icon" type="x-icon" href="./img/logos/cake_logo.png">
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" type="text/css" href="checkout.css">
    <link rel="stylesheet" href="./assets/css/simple-line-icons.css">
    <link rel="stylesheet" href="queriescart.css" />
    <link rel="stylesheet" href="generalcart1.css" />
    <script>
        function orderconfirmation() {
            alert("Your order was successfully placed. Thank You for ordering HUST Fabrics! You will receive a mail form www.hustfabrics.com.pk in which all information are given related your total payment and product tracking. For any further query you can visit our website www.hustfabrics.com.pk")
        }

        function subscription() {
			alert("Thanks for subscribing to our newsletter!");
		}

        function validateemail() {
            var form = document.getElementById('form');
            var email = document.getElementById('Email').value;
            var text = document.getElementById('text');
            var pattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;

            if(email.match(pattern)) {
                form.classList.add("valid");
                form.classList.remove("invalid");
                text.innerHTML = "Your Email Address is Valid.";
                text.style.color = "red";
            } 
            else {
                form.classList.remove("valid");
                form.classList.add("invalid");
                text.innerHTML = "Please Enter Valid Email Address.";
                text.style.color = "red";
            }
            }

        function validateproductcode() {
            var form = document.getElementById('form');
            var productcode = document.getElementById('Product Code').value;
            var text = document.getElementById('prod-code');
            var pattern = /SK/;

            if(productcode.match(pattern)) {
                form.classList.add("valid");
                form.classList.remove("invalid");
                text.innerHTML = "Your Product Code is Valid";
                text.style.color = "red";
            } 
            else {
                form.classList.remove("valid");
                form.classList.add("invalid");
                text.innerHTML = "Please Enter Valid Product Code";
                text.style.color = "red";
            }

            if(email == "") {
                form.classList.remove("valid");
                form.classList.remove("invalid");
                text.innerHTML = "";
                text.style.color = "#00ff00";
            }
        }
    </script>
</head>
<body>
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

    <h1 class="heading-featured-in">Complete your order</h1>
    <form id="form" action="" method="post">
    <div class="display-order">
      <?php
         $select_cart = mysqli_query($link, "SELECT * FROM `cart`");
         $total = 0;
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = $fetch_cart['price'] * $fetch_cart['quantity'];
            $grand_total = $total += $total_price;
      ?>
      <span><?= $fetch_cart['prod_name']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
      <?php
         }
      }else{
         echo "<div class='display-order'><span>your cart is empty!</span></div>";
      }
      ?>
      <span class="grand-total"> grand total : RS<?= $grand_total; ?>/- </span>
   </div>
        
        <div id="info-left">
        <div id="ship-add">
            <i class="icon-bag"></i>
            <p>Shipping Address</p>
        </div>

        <div class="user-box">
            <label for="customer id">Customer ID</label ><br>
            <input type="text" id="customer id" name="cust_id" required="">
        </div>

        <div class="user-box">
            <label for="order id">Order ID</label ><br>
            <input type="text" id="order id" name="order_id" required="">
        </div>

        <div class="user-box">
            <label for="First Name">First Name</label ><br>
            <input type="text" id="First Name" name="first_name" required="">
        </div>

        <div class="user-box">
            <label for="Last Name">Last Name</label ><br>
            <input type="text" id="Last Name" name="last_name" required="">
        </div>

        <div class="user-box">
            <label for="Email">Email</label ><br>
            <input type="email" id="Email" required="" name="email" onkeydown="validateemail()">
            <span id="text"></span>
        </div>

        <div class="user-box">
            <label for="Phone Number">Phone Number</label ><br>
            <input type="tel" id="Phone Number" placeholder="03xx-xxxxxxx" name="phone" required="">
        </div>

        <div class="user-box">
            <label for="Address">Address</label ><br>
            <input type="text" id="Address" name="address" required="">
        </div>

        <div class="user-box">
            <label for="City">City</label ><br>
            <input type="text" id="City" name="city" required="">
        </div>

        <div class="user-box">
            <label for="Postal Code">Postal Code</label ><br>
            <input type="text" id="Postal Code" name="code" required="">
        </div>

        <div class="user-box">
            <label for="payment">Payment Method</label ><br>
            <input type="text" id="payment" name="payment" required="">
        </div>

        <div class="user-box">
            <label for="date">Order Date</label><br>
            <input type="date" name="order_date" required="">
        </div>
       

        <div id="btn">
                <button type="submit" value="order now" name="order_btn" >Place Order</button>
        </div>
    </div>
    </form>
    
</body>
</html>