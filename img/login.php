<?php


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Escape The School</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Bebas+Neue&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Permanent+Marker&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
</head>
    <body>

        <section class= "ETS">
            <div class="main-width">
                <header>
                    <div class="logo">
                        <video class="video-bg" autoplay muted loop>
                        <source src="img/bg-live.mp4" type="video/mp4">
                        </video>
                        <h2><a href="index.php">Escape The School</a></h2>
                    </div>

                    <nav>
                        <ul>
                            <li class="/"><a href="index.php">Home</a></li>
                            <li class="/"><a href="shop.php">Shop</a></li>
                            <li class="/"><a href="about.php">About us</a></li>
                            <li class="active"><a href="login.php">Login</a></li>
                            <li class="btn"><a href="play.php">Play</a></li>
                        </ul>
                    </nav>
                </header>

                <div class="container" id="signup" style="display:none;">
                    <h1 class="form-title">Register</h1>
                    <form method="post" action="register.php">
                      <div class="input-group">
                         <i class="fas fa-user"></i>
                         <input type="text" name="fname" id="fname" placeholder="First Name" required>
                         <label for="fname">First Name</label>
                      </div>
                      <div class="input-group">
                          <i class="fas fa-user"></i>
                          <input type="text" name="lname" id="lname" placeholder="Last Name" required>
                          <label for="lname">Last Name</label>
                      </div>
                      <div class="input-group">
                          <i class="fas fa-envelope"></i>
                          <input type="email" name="email" id="email" placeholder="E-mail" required>
                          <label for="email">Email</label>
                      </div>
                      <div class="input-group">
                          <i class="fas fa-lock"></i>
                          <input type="password" name="password" id="password" placeholder="Password" required>
                          <label for="password">Password</label>
                      </div>
                     <input type="submit" class="btn-signup" value="Sign Up" name="signUp">
                    </form>
                    <div class="links">
                      <p>Already have an account ?</p>
                      <button id="LoginButton">Sign In</button>
                    </div>
                  </div>
              
                  <div class="container" id="Login">
                      <h1 class="form-title">Login</h1>
                      <form method="post" action="register.php">
                        <div class="input-group">
                            <i class="fas fa-envelope"></i>
                            <input type="email" name="email" id="email" placeholder="email" required>
                            <label for="email">Email</label>
                        </div>
                        <div class="input-group">
                            <i class="fas fa-lock"></i>
                            <input type="password" name="password" id="password" placeholder="Password" required>
                            <label for="password">Password</label>
                        </div>
                        <p class="recover">
                          <a href="#">Recover Password</a>
                        </p>
                       <input type="submit" class="btn-login" value="Sign In" name="Login">
                      </form>
                      <div class="links">
                        <p>Don't have an account?</p>
                        <button id="signUpButton">Sign Up</button>
                      </div>
                    </div>
                <script src="script.js"></script>

            </div>
        </section>
    </body>
</html>