<?php
  session_start();

  if(isset($_SESSION["email"])){
    header('Location: '.'indexFinal.php');
  }
?>

<!DOCTYPE html>

<html>
  <head>
    <title>Login Page</title>
    <link rel="stylesheet" href="LoginStylesheet.css">
    <script src="scripts/LoginBackend.js"></script>
    <script src="scripts/Main.js"></script>
  </head>

  <body>
    <div align="center" style="padding-top: 100px; font-size:30px;">
      <h1 class="display-1">Ghost<small class="text-muted">post</small></h1>
    </div>
    <p id="response"></p>
  
      <div class="login-page">
          <div class="form">
            <form class="login-form">
              <input id="email_address" type="email" placeholder="University Email Address"/>
              <input id="password" type="password" placeholder="Password"/>
              <button type="button" onclick=login_helper()>login</button>
              <p class="message">Not registered? <a href="RegistrationPage.php" style="color:black">Register account</a></p>
            </form>
          </div>
      </div>
      <script>
        function login_helper() {
          var response = login();
  
          if (response) {
            
            window.location.replace("IndexFinal.php");

          } else {
            window.alert("Please enter a correct email and password combination");
          }
        }
      </script>
    </body>

    
</html>
