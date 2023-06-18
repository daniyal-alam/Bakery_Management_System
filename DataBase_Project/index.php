<?php

include 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- Always include this line of code!!! -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="preconnect" href="https://fonts.gstatic.com" />
    <link
      href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;600;700&display=swap"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="general.css" />
    <link rel="shortcut icon" type="x-icon" href="./img/logos/cake_logo.png">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="queries.css" />
    <link rel="stylesheet" href="./assets/css/simple-line-icons.css">

    <script
      type="module"
      src="https://unpkg.com/ionicons@5.4.0/dist/ionicons/ionicons.esm.js"
    ></script>
    <script
      nomodule=""
      src="https://unpkg.com/ionicons@5.4.0/dist/ionicons/ionicons.js"
    ></script>
    <script defer src="script.js">
    </script>

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
          <li><a class="main-nav-link" href="#home">Home</a></li>
          <li><a class="main-nav-link" href="#dashboard">Dashboard</a></li>
          <li><a class="main-nav-link" href="#testimonials">Testimonials</a></li>
          <li><a class="main-nav-link" href="#About">About</a></li>
          <li><a class="main-nav-link nav-cta" href="shopping_cart.php" id="cart">Cart <span><?php echo $row_count; ?></span></a></li>
        </ul>
      </nav>

      <button class="btn-mobile-nav">
        <ion-icon class="icon-mobile-nav" name="menu-outline"></ion-icon>
        <ion-icon class="icon-mobile-nav" name="close-outline"></ion-icon>
      </button>
    </header>

    <main>
      <section class="section-hero">
        <div class="hero">
          <div class="hero-text-box">
            <h1 class="heading-primary">
              Having a balanced diet entails that you have a cake in both hands.
            </h1>
            <p class="hero-description">
              The smart 365-days-per-year bakery subscription that will make you
              eat healthy cakes again. Tailored to your personal tastes.
            </p>
            <a href="#cta" class="btn btn--full margin-right-sm"
              >Start baking well</a
            >
            <a href="#home" class="btn btn--outline">Learn more &darr;</a>
            <div class="delivered-meals">
              <div class="delivered-imgs">
                <img src="img/customers/customer-1.jpg" alt="Customer photo" />
                <img src="img/customers/customer-2.jpg" alt="Customer photo" />
                <img src="img/customers/customer-3.jpg" alt="Customer photo" />
                <img src="img/customers/customer-4.jpg" alt="Customer photo" />
                <img src="img/customers/customer-5.jpg" alt="Customer photo" />
                <img src="img/customers/customer-6.jpg" alt="Customer photo" />
              </div>
              <p class="delivered-text">
                <span>250,000+</span> cakes delivered!
              </p>
            </div>
          </div>
          <div class="hero-img-box">
            <img
              src="img/gallery/gallery-1.jpg"
              class="hero-img"
              alt="Woman enjoying food, cakes in storage container, and food bowls on a table"
            />
          </div>
        </div>
      </section>

      <section class="section-heros" id="dashboard">
        <h1 class="heading-featured-in">Dashboard</h1>

        <div class="rows" id="products">
          <div id="card-boxes">
            <div class="divs">
              <img src="./img/customers/user.jpg" alt="1" width="100px" height="100px">
              <h3 class="head">User</h3>
            </div>
          </div>
          

          <div id="card-boxes">
            <div>
              <img src="./img/customers/product.png" alt="1" width="120px" height="100px">
              
              <a href="http://localhost/DataBase_Project/products.php"><h3 class="head">Products</h3></a>
            </div>
          </div>
        </div>

        <div class="rows" id="products">
          <div id="card-boxes">
            <div>
              <img src="./img/customers/items.png" alt="1" width="100px" height="100px">
              <a href="http://localhost/DataBase_Project/addproduct.php"><h3 class="head-1">Items <br> IN & OUT</h3></a>
            </div>
          </div>

          <div id="card-boxes">
            <div>
              <img src="./img/customers/data.png" alt="1" width="130px" height="100px">
              <a href="http://localhost/DataBase_Project/record.php"><h3 class="head-1">Record</h3></a>
            </div>
          </div>
        </div>
    
        
      </section>

      <section class="section-featured">
        <div class="container">
          <h2 class="heading-featured-in">As featured in</h2>
          <div class="logos">
            <img src="img/logos/techcrunch.png" alt="Techcrunch logo" />
            <img
              src="img/logos/business-insider.png"
              alt="Business Insider logo"
            />
            <img
              src="img/logos/the-new-york-times.png"
              alt="The New York Times logo"
            />
            <img src="img/logos/forbes.png" alt="Forbes logo" />
            <img src="img/logos/usa-today.png" alt="USA Today logo" />
          </div>
        </div>
      </section>

      <section class="section-testimonials" id="testimonials">
        <div class="testimonials-container">
          <span class="subheading">Testimonials</span>
          <h2 class="heading-secondary">Once you try it, you can't go back</h2>

          <div class="testimonials">
            <figure class="testimonial">
              <img
                class="testimonial-img"
                alt="Photo of customer Dave Bryson"
                src="img/customers/dave.jpg"
              />
              <blockquote class="testimonial-text">
                Inexpensive, healthy and great-tasting cakes, without even
                having to order manually! It feels truly magical.
              </blockquote>
              <p class="testimonial-name">&mdash; Dave Bryson</p>
            </figure>

            <figure class="testimonial">
              <img
                class="testimonial-img"
                alt="Photo of customer Ben Hadley"
                src="img/customers/ben.jpg"
              />
              <blockquote class="testimonial-text">
                The AI algorithm is crazy good, it chooses the right cakes for
                me every time. It's amazing not to worry about food anymore!
              </blockquote>
              <p class="testimonial-name">&mdash; Ben Hadley</p>
            </figure>

            <figure class="testimonial">
              <img
                class="testimonial-img"
                alt="Photo of customer Steve Miller"
                src="img/customers/steve.jpg"
              />
              <blockquote class="testimonial-text">
                DLS Bakers is a life saver! I just started a company, so there's
                no time for baking. I couldn't live without my daily cakes now!
              </blockquote>
              <p class="testimonial-name">&mdash; Steve Miller</p>
            </figure>

            <figure class="testimonial">
              <img
                class="testimonial-img"
                alt="Photo of customer Hannah Smith"
                src="img/customers/hannah.jpg"
              />
              <blockquote class="testimonial-text">
                I got DLS cakes for the whole family, and it frees up so much
                time! Plus, everything is organic without plastic.
              </blockquote>
              <p class="testimonial-name">&mdash; Hannah Smith</p>
            </figure>
          </div>
        </div>

        <div class="gallery">
          <figure class="gallery-item">
            <img
              src="img/gallery/gallery-1.jpg"
              alt="Photo of beautifully
            arranged food"
            />
            <!-- <figcaption>Caption</figcaption> -->
          </figure>
          <figure class="gallery-item">
            <img style="height: 200px;"
              src="img/gallery/gallery-2.jpg"
              alt="Photo of beautifully
            arranged food"
            />
          </figure>
          <figure class="gallery-item">
            <img style="height: 200px;"
              src="img/gallery/gallery-3.jpg"
              alt="Photo of beautifully
            arranged food"
            />
          </figure>
          <figure class="gallery-item">
            <img
              src="img/gallery/gallery-4.jpg"
              alt="Photo of beautifully
            arranged food"
            />
          </figure>
          <figure class="gallery-item">
            <img style="height: 200px;"
              src="img/gallery/gallery-5.jpg"
              alt="Photo of beautifully
            arranged food"
            />
          </figure>
          <figure class="gallery-item">
            <img
              src="img/gallery/gallery-6.jpg"
              alt="Photo of beautifully
            arranged food"
            />
          </figure>
          <figure class="gallery-item">
            <img style="height: 200px;"
              src="img/gallery/gallery-7.jpg"
              alt="Photo of beautifully
            arranged food"
            />
          </figure>
          <figure class="gallery-item">
            <img style="height: 200px;"
              src="img/gallery/gallery-8.jpg"
              alt="Photo of beautifully
            arranged food"
            />
          </figure>
          <figure class="gallery-item">
            <img style="height: 200px;"
              src="img/gallery/gallery-9.jpg"
              alt="Photo of beautifully
            arranged food"
            />
          </figure>
          <figure class="gallery-item">
            <img style="height: 200px;"
              src="img/gallery/gallery-10.jpg"
              alt="Photo of beautifully
            arranged food"
            />
          </figure>
          <figure class="gallery-item">
            <img style="height: 200px;"
              src="img/gallery/gallery-11.jpg"
              alt="Photo of beautifully
            arranged food"
            />
          </figure>
          <figure class="gallery-item">
            <img style="height: 200px;"
              src="img/gallery/gallery-12.jpg"
              alt="Photo of beautifully
            arranged food"
            />
          </figure>
        </div>
      </section>

        <div class="container grid grid--4-cols">
          <div class="feature">
            <ion-icon class="feature-icon" name="infinite-outline"></ion-icon>
            <p class="feature-title">Never bake again!</p>
            <p class="feature-text">
              Our subscriptions cover 365 days per year, even including major
              holidays.
            </p>
          </div>
          <div class="feature">
            <ion-icon class="feature-icon" name="nutrition-outline"></ion-icon>
            <p class="feature-title">Local and organic</p>
            <p class="feature-text">
              Our bakers only use local, fresh, and organic products to prepare
              your cakes.
            </p>
          </div>
          <div class="feature">
            <ion-icon class="feature-icon" name="leaf-outline"></ion-icon>
            <p class="feature-title">No waste</p>
            <p class="feature-text">
              All our partners only use reusable containers to package all your
              cakes.
            </p>
          </div>
          <div class="feature">
            <ion-icon class="feature-icon" name="pause-outline"></ion-icon>
            <p class="feature-title">Pause anytime</p>
            <p class="feature-text">
              Going on vacation? Just pause your subscription, and we refund
              unused days.
            </p>
          </div>
        </div>
      </section>

    <footer class="footer" id="About">
      <div class="container grid grid--footer">
        <div class="logo-col">
          <a href="#" class="footer-logo">
            <img class="logo" alt="Omnifood logo" src="img/logos/cake_logo.png" />
          </a>

          <ul class="social-links">
            <li>
              <a class="footer-link" href="#"
                ><ion-icon class="social-icon" name="logo-instagram"></ion-icon
              ></a>
            </li>
            <li>
              <a class="footer-link" href="#"
                ><ion-icon class="social-icon" name="logo-facebook"></ion-icon
              ></a>
            </li>
            <li>
              <a class="footer-link" href="#"
                ><ion-icon class="social-icon" name="logo-twitter"></ion-icon
              ></a>
            </li>
          </ul>

          <p class="copyright">
            Copyright &copy; 2023 by DLS Bakers, Inc. All rights reserved.
          </p>
        </div>

        <div class="address-col">
          <p class="footer-heading">Contact us</p>
          <address class="contacts">
            <p class="address">
              9th St. Khayaban-e-Mujahid, DHA Phase V, Karachi
            </p>
            <p>
              <a class="footer-link" href="tel:415-201-6370">021-3254791</a
              ><br />
              <a class="footer-link" href="mailto:hello@omnifood.com"
                >hello@dlsbakers.com</a
              >
            </p>
          </address>
        </div>

        <nav class="nav-col">
          <p class="footer-heading">Account</p>
          <ul class="footer-nav">
            <li><a class="footer-link" href="#">Create account</a></li>
            <li><a class="footer-link" href="#">Sign in</a></li>
            <li><a class="footer-link" href="#">iOS app</a></li>
            <li><a class="footer-link" href="#">Android app</a></li>
          </ul>
        </nav>

        <nav class="nav-col">
          <p class="footer-heading">Company</p>
          <ul class="footer-nav">
            <li><a class="footer-link" href="#">About DLS Bakers</a></li>
            <li><a class="footer-link" href="#">For Business</a></li>
            <li><a class="footer-link" href="#">Baking partners</a></li>
            <li><a class="footer-link" href="#">Careers</a></li>
          </ul>
        </nav>

        <nav class="nav-col">
          <p class="footer-heading">Resources</p>
          <ul class="footer-nav">
            <li><a class="footer-link" href="#">Recipe directory </a></li>
            <li><a class="footer-link" href="#">Help center</a></li>
            <li><a class="footer-link" href="#">Privacy & terms</a></li>
          </ul>
        </nav>
      </div>
    </footer>
  </body>
</html>