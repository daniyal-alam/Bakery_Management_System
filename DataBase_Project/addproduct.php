<?php

include 'connection.php';

if(isset($_POST['add_prod'])){
    $prod_id = $_POST['prod_id'];
    $prod_name = $_POST['prod_name'];
    $cat_id = $_POST['cat_id'];
    $cat_name = $_POST['cat_name'];
    $sup_id = $_POST['sup_id'];
    $sup_name = $_POST['sup_name'];
    $date_man = $_POST['date_man'];
    $date_exp = $_POST['date_exp'];
    $prod_price = $_POST['prod_price'];
    $prod_img = $_FILES['prod_img']['name'];
    $prod_img_tmp_name = $_FILES['prod_img']['tmp_name'];
    $prod_img_folder = 'img/'.$prod_img ;

     $insert_query = "INSERT INTO products(prod_id, prod_name, cat_id, sup_id, mfg_date, exp_date, price, img)
     VALUES ('$prod_id', '$prod_name', '$cat_id', '$sup_id', '$date_man', '$date_exp', '$prod_price', '$prod_img')";
     
     $result = mysqli_query($link, $insert_query) or die('Query failed');

     if ($insert_query) {
        move_uploaded_file($prod_img_tmp_name, $prod_img_folder);
        $message = 'Product added successfully';
        echo '<script>';
        echo 'alert("' . $message . '");';
        echo '</script>';
    } else {
        $message = 'Could not add the product';
        echo '<script>';
        echo 'alert("' . $message . '");';
        echo '</script>';
    }
};

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_query = mysqli_query($link, "DELETE FROM products WHERE prod_id = $delete_id ") or die('query failed');
    if ($delete_query) {
        $message = 'Product has been deleted';
        echo '<script>';
        echo 'alert("' . $message . '");';
        echo 'window.location.href = "addproduct.php";'; // Redirect to addproduct.php
        echo '</script>';
    } else {
        $message = 'Product could not be deleted';
        echo '<script>';
        echo 'alert("' . $message . '");';
        echo 'window.location.href = "addproduct.php";'; // Redirect to addproduct.php
        echo '</script>';
    };
};

if(isset($_POST['update_product'])){
   $update_p_id = $_POST['update_p_id'];
   $update_p_name = $_POST['update_p_name'];
   $update_p_price = $_POST['update_p_price'];
   $update_p_img = $_FILES['update_p_img']['name'];
   $update_p_img_tmp_name = $_FILES['update_p_img']['tmp_name'];
   $update_p_img_folder = 'img/'.$update_p_img;

   $update_query = mysqli_query($link, "UPDATE products SET prod_name = '$update_p_name', price = '$update_p_price', img = '$update_p_img' WHERE prod_id = '$update_p_id'");

   if($update_query){
        move_uploaded_file($update_p_img_tmp_name, $update_p_img_folder);
        $message = 'Product has been Updated';
        echo '<script>';
        echo 'alert("' . $message . '");';
        echo 'window.location.href = "addproduct.php";'; // Redirect to addproduct.php
        echo '</script>';
   }else{
        $message = 'Product could not be updated';
        echo '<script>';
        echo 'alert("' . $message . '");';
        echo 'window.location.href = "addproduct.php";'; // Redirect to addproduct.php
        echo '</script>';
   }
}
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
    <link rel='stylesheet' type='text/css' media='screen' href="product.css">
    <link rel="stylesheet" href='style copy.css'>
    <link rel="stylesheet" href="queries.css" />
    <link rel="stylesheet" href="general copy.css" />
    <script src='ps.js'></script> 
    
    <title>DLS Bakers</title>
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
          <li><a class="main-nav-link" href="http://localhost/DataBase_Project/index.php">Home</a></li>
          <li><a class="main-nav-link" href="http://localhost/DataBase_Project/index.php#dashboard">Dashboard</a></li>
          <li><a class="main-nav-link" href="http://localhost/DataBase_Project/products.php">View Products</a></li>
          <li><a class="main-nav-link" href="http://localhost/DataBase_Project/record.php">Record</a></li>
          <li><a class="main-nav-link nav-cta" href="shopping_cart.php" id="cart">Cart <span><?php echo $row_count; ?></span></a></li>
        </ul>
      </nav>

      <button class="btn-mobile-nav">
        <ion-icon class="icon-mobile-nav" name="menu-outline"></ion-icon>
        <ion-icon class="icon-mobile-nav" name="close-outline"></ion-icon>
      </button>
    </header>

    <div class="container">
        <section id="form">
            <form action="" method="post" class="add_product_form" enctype="multipart/form-data">
                <h3>ADD PRODUCT</h3>
                <div class="divs">
                    <div class="dives">
                        <input type="number" name="prod_id"placeholder="Product ID" class="ibox" required>
                    </div>
                    <div class="dives">
                        <input type="text" name="prod_name"placeholder="Product name" class="ibox" required>
                    </div>
                </div>

                <div class="divs">
                    <div class="dives">
                        <input type="number" name="cat_id" placeholder="Category ID" class="ibox" required>
                </div>
                    <div class="dives">
                        <input type="text" name="cat_name" placeholder="Category Name" class="ibox" required>
                    </div>
                </div>

                <div class="divs">
                    <div class="dives">
                        <input type="number" name="sup_id" placeholder="Supplier ID" class="ibox" required>
                </div>
                    <div class="dives">
                        <input type="text" name="sup_name" placeholder="Supplier Name" class="ibox" required>
                    </div>
                </div>

                <div class="divs">
                    <div class="dives">
                        <label class="labelbox">Mfg.Date <input type="date" name="date_man" class="ibox1" required></label>
                </div>
                    <div class="dives">
                        <label class="labelbox">Exp.Date <input type="date" name="date_exp" class="ibox1" required></label>
                    </div>
                </div>
            
                <input type="number" name="prod_price" min="0" placeholder="Enter product price" class="ibox2" required>
                <input type="file" name="prod_img" accept="image/png, image/jpg, image/jpeg" class="ibox2" required>
                <input type="submit" value="Add Product" name="add_prod" class="btn">
            </form>
        </section>

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
                <th>Action</th>
            </thead>
        <tbody>

         <?php
            $select_products = mysqli_query($link, "SELECT * FROM `products`");
            if(mysqli_num_rows($select_products) > 0){
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
            <td>
               <a href="addproduct.php?delete=<?php echo $row['prod_id']; ?>" class="delete-btn" onclick="return confirm('Are your sure you want to delete this Product?');">Delete </a>
               <a href="addproduct.php?edit=<?php echo $row['prod_id']; ?>" class="option-btn">Update</a>
            </td>
         </tr>

         <?php
            };    
            }
            else{
               echo "<div class='empty'>No product added</div>";
            };
         ?>
        </tbody>

        </table>
    </section>

    <section class="edit_contform">
    <?php
    if(isset($_GET['edit'])){
        $edit_id = $_GET['edit'];
        $edit_query = mysqli_query($link, "SELECT * FROM `products` WHERE prod_id = $edit_id");
        if(mysqli_num_rows($edit_query) > 0) {
            while($fetch_edit = mysqli_fetch_assoc($edit_query)) {
    ?>

    <form action="" method="post" enctype="multipart/form-data">
        <h3>Update Product</h3>
      <img src="img/<?php echo $fetch_edit['img']; ?>" height="200" alt="">
      <input type="hidden" name="update_p_id" value="
      <?php echo $fetch_edit['prod_id']; ?>">
      <input type="text" class="box" required name="update_p_name" value="
      <?php echo $fetch_edit['prod_name'];?>">
      <input type="number" min="0" class="box" required name="update_p_price" value="
      <?php echo $fetch_edit['price'];?>">
      <input type="file" class="box" required name="update_p_img" accept="image/png, image/jpg, image/jpeg">
      <input type="submit" value="Update Product" name="update_product" class="btn1">
      <a href="http://localhost/DataBase_Project/addproduct.php"><p class="btn2">Cancel</p></a>
   </form>
    <?php
            }; // Closing brace for the while loop
        };
         // Closing brace for the if condition
        echo "<script>document.querySelector('.edit_contform').style.display = 'flex';</script>";
        };
    ?>
</section>

</div>  
</body>
</html>