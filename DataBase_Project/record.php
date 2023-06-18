<?php

include 'connection.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link rel="stylesheet" href="./assets/css/simple-line-icons.css">
    <link
      href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />
    <link rel="shortcut icon" type="x-icon" href="./img/logos/cake_logo.png">
    <link rel='stylesheet' type='text/css' media='screen' href="record.css">
    <link rel="stylesheet" href='style_record_copy.css'>
    <link rel="stylesheet" href="queries.css" />
    <link rel="stylesheet" href="general_record_copy.css" />
    <script src='ps.js'></script> 
    
    <title>DLS Bakers</title>
</head>
<body>
    <header class="header">
      <a href="#">
        <img class="logo" alt="DLS logo" src="img/logos/cake_logo.png" />
      </a>

      <nav class="main-nav">
        <ul class="main-nav-list">
          <li><a class="main-nav-link" href="http://localhost/DataBase_Project/index.php#dashboard">Dashboard</a></li>
        </ul>
      </nav>

      <button class="btn-mobile-nav">
        <ion-icon class="icon-mobile-nav" name="menu-outline"></ion-icon>
        <ion-icon class="icon-mobile-nav" name="close-outline"></ion-icon>
      </button>
    </header>


</body>
    <div class="container">
        <h1>Select a record</h1>
        <div class="button-container">
            <a href="record.php?button=button1">Products</a>
            <a href="record.php?button=button2">Customers</a>
            <a href="record.php?button=button3">Orders</a>
            <a href="record.php?button=button4">Cust_Pro</a>
            <a href="record.php?button=button5">Log Records</a>
        </div>
    </div>

    <?php
                // Check if a button is selected
                if (isset($_GET['button'])) {
                    $selectedButton = $_GET['button'];

                    // Apply the condition based on the selected button
                    if ($selectedButton === "button1") {
                        $select_products = mysqli_query($link, "SELECT * FROM `products`");
                        if(mysqli_num_rows($select_products) > 0){
                            ?>
                            <section class="product_table">
        <table>
            <thead>
                <th>Product Image</th>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Category ID</th>
                <th>Supplier ID</th>
                <th>Price</th>
                <th>Mfg.date</th>
                <th>Exp.date</th>
            </thead>
            <tbody>

            <?php

                            while($row = mysqli_fetch_assoc($select_products)){
                              ?>
                              <tr>
                                 <td><img src="img/<?php echo $row['img']; ?>" height="100" width="120" alt=""></td>
                                 <td><?php echo $row['prod_id']; ?></td>
                                 <td><?php echo $row['prod_name']; ?></td>
                                 <td><?php echo $row['cat_id']; ?></td>
                                 <td><?php echo $row['sup_id']; ?></td>
                                 <td>Rs <?php echo $row['price']; ?>/-</td>
                                 <td><?php echo $row['mfg_date']; ?></td>
                                 <td><?php echo $row['exp_date']; ?></td>
                              </tr>
                     
                              <?php
                                 };    
                                 }
                    } elseif ($selectedButton === "button2") {
                        $select_customer = mysqli_query($link, "SELECT * FROM `customer`");
                        if(mysqli_num_rows($select_customer) > 0){
                            ?>
                            <section class="product_table">
        <table>
            <thead>
                <th>Customer ID</th>
                <th>Product ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>City</th>
                <th>Payment</th>
                <th>Total Products</th>
                <th>Price</th>
                <th>Order_date</th>
            </thead>
            <tbody>

            <?php

                            while($row = mysqli_fetch_assoc($select_customer)){
                              ?>
                              <tr>
                                 <td><?php echo $row['customer_id']; ?></td>
                                 <td><?php echo $row['prod_id']; ?></td>
                                 <td><?php echo $row['fname']; ?></td>
                                 <td><?php echo $row['lname']; ?></td>
                                 <td><?php echo $row['email']; ?></td>
                                 <td><?php echo $row['ph_number']; ?></td>
                                 <td><?php echo $row['address']; ?></td>
                                 <td><?php echo $row['city']; ?></td>
                                 <td><?php echo $row['payment']; ?></td>
                                 <td><?php echo $row['total_products']; ?></td>
                                 <td>RS: <?php echo $row['total_price']; ?>/-</td>
                                 <td><?php echo $row['order_date']; ?></td>
                              </tr>
                     
                              <?php
                                 };    
                                 }
                    } elseif ($selectedButton === "button3") {
                        $select_order = mysqli_query($link, "SELECT * FROM `orders`");
                        if(mysqli_num_rows($select_order) > 0){
                            ?>
                            <section class="product_table">
        <table>
            <thead>
                <th>Order ID</th>
                <th>Customer ID</th>
                <th>Order_date</th>
            </thead>
            <tbody>

            <?php

                            while($row = mysqli_fetch_assoc($select_order)){
                              ?>
                              <tr>
                                 <td><?php echo $row['order_id']; ?></td>
                                 <td><?php echo $row['customer_id']; ?></td>
                                 <td><?php echo $row['order_date']; ?></td>
                              </tr>
                     
                              <?php
                                 };    
                                 }
                    } elseif ($selectedButton === "button4") {
                        $select_multi = mysqli_query($link, "SELECT * FROM `cust_pro`");
                        if(mysqli_num_rows($select_multi) > 0){
                            ?>
                            <section class="product_table">
        <table>
            <thead>
                <th>Order Detail ID</th>
                <th>Order ID</th>
                <th>Customer ID</th>
                <th>Product ID</th>
            </thead>
            <tbody>

            <?php

                            while($row = mysqli_fetch_assoc($select_multi)){
                              ?>
                              <tr>
                                 <td><?php echo $row['orderdetailID']; ?></td>
                                 <td><?php echo $row['order_id']; ?></td>
                                 <td><?php echo $row['customer_id']; ?></td>
                                 <td><?php echo $row['prod_id']; ?></td>
                              </tr>
                     
                              <?php
                                 };    
                                 }
                    } elseif ($selectedButton === "button5") {
                        $select_logs = mysqli_query($link, "SELECT * FROM `log_record`");
                        if(mysqli_num_rows($select_logs) > 0){
                            ?>
                            <section class="product_table">
        <table>
            <thead>
                <th>ID</th>
                <th>Action</th>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Cat ID</th>
                <th>Sup ID</th>
                <th>Old Price</th>
                <th>New Price</th>
                <th>Time</th>
            </thead>
            <tbody>

            <?php

                            while($row = mysqli_fetch_assoc($select_logs)){
                              ?>
                              <tr>
                                 <td><?php echo $row['id']; ?></td>
                                 <td><?php echo $row['action']; ?></td>
                                 <td><?php echo $row['prod_id']; ?></td>
                                 <td><?php echo $row['prod_name']; ?></td>
                                 <td><?php echo $row['cat_id']; ?></td>
                                 <td><?php echo $row['sup_id']; ?></td>
                                 <td><?php echo $row['old_price']; ?></td>
                                 <td><?php echo $row['new_price']; ?></td>
                                 <td><?php echo $row['timestamp']; ?></td>
                              </tr>
                     
                              <?php
                                 };    
                                 }
                    }
                }
                ?>
            </tbody>
        </table>
    </section>
            
</body>