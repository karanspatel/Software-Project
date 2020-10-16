<!DOCTYPE html>

<html>
  
  <head>
    <title>Registration Page</title>
    <link rel="stylesheet" href="RegistrationStylesheet.css">
    <script src="scripts/RegistrationBackend.js"></script>
    <script src="scripts/Main.js"></script>
  </head>

  <body>
    
    <div align="center" style="padding-top: 100px;  font-size:30px;">
      <h1 class="display-1">Ghost<small class="text-muted">post</small></h1>
    </div>

  <div class="register-page">
    <div class="form">
      <form class="register-form">
        <input id="email_address" type="email" placeholder="University Email Address"/>
        <input id="password" type="password" placeholder="Password"/>
        <button type="button" onclick=registration_helper()>register account</button>
        <p class="message">Already registered? <a href="loginPage.php">Sign In</a></p>
      </form>
    </div>
  </div>
  <script>
    function registration_helper() {
      var response = register();
      if (response) {
        window.location.replace("loginPage.php");
      } else {
        window.alert("This email address has already been registered");
      }
    }
  </script>
  </body>

</html>