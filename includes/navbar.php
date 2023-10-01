<?php

  session_start();
?>
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo mr-auto"><a href="index.php"><span>Com</span>pany</a></h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.php" class="logo mr-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="index.php">Home</a></li>

          <li class="drop-down"><a href="">About</a>
            <ul>
              <li><a href="about.php">About Us</a></li>
              <li><a href="team.php">Team</a></li>
              <li><a href="testimonials.php">Testimonials</a></li>
            </ul>
          </li>

          <li><a href="services.php">Services</a></li>
          <li><a href="portfolio.php">Portfolio</a></li>
          <li><a href="pricing.php">Pricing</a></li>
          <li><a href="blog.php">Blog</a></li>
          <li><a href="contact.php">Contact</a></li>
          <?php
          
            if(isset($_SESSION['user_id'])):
          ?>
          <li><a href="handlers/logout.php">Logout</a></li>
          <?php
            else:
          ?>
          <li><a href="login.php">Login</a></li>
          <li><a href="register.php">Register</a></li>
          <?php
            endif;
          ?>

        </ul>
      </nav><!-- .nav-menu -->

      <div class="header-social-links">
        <a href="#" class="twitter"><i class="icofont-twitter"></i></a>
        <a href="#" class="facebook"><i class="icofont-facebook"></i></a>
        <a href="#" class="instagram"><i class="icofont-instagram"></i></a>
        <a href="#" class="linkedin"><i class="icofont-linkedin"></i></a>
      </div>

    </div>
  </header>