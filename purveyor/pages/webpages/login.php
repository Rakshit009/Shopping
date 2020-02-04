
<!DOCTYPE html>
<html>
   <head>
      <meta charset="UTF-8">
      <title></title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="google-signin-client_id" content="1094927913552-ohdd89eh174qloj2savunuacro2qkk97.apps.googleusercontent.com">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
      <link href="https://fonts.googleapis.com/css?family=Abel|Arimo|Crimson+Pro|Lobster|PT+Sans+Narrow|Pacifico|Patua+One|Roboto|Rubik&display=swap" rel="stylesheet">
      <link rel="stylesheet" type="text/css" href="main.css">
      <script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
      
      <style>
         .hint
         {
         font-size:20px;
         margin-top: 4%;
         font-family: 'Abel', sans-serif;
         }
      </style>
   </head>
   <body>
      <div class="col-md-7 helper">
         <img id="optionalstuff" src="../../backgrounds/garden.jpg" width="100%" >
      </div>
      <div class="col-md-5">
         <center>
            <h3  class="site_nam"><a style="color:#011627;font-family: 'Pacifico', cursive;font-size:35px;" href="main.php">purveyor</a></h3>
         </center>
         <center>
            <p style="color:#011627;margin-top:7%;font-family: 'Abel', sans-serif;font-size:25px;">login</p>
         </center>
         <form action="login.php" method="POST">
            <center>
               <p id="Email" class="hint" >Email</p>
            </center>
            <center><input class="box" type="text" name="email" /></center>
            <center>
               <p class="hint">Password</p>
            </center>
            <center><input class="box" type="password" name="password" /></center>
            <center> <a style="  font-family: 'Patua One', cursive;text-decoration: none;color:#41B3A3;" href="forgot.php">forgot password?</a></center>
            <center><input class="login_button" value="Sign in" type="submit" name="submit"></center>
         </form>
         <center>
            <p style="margin-top:4%;font-family: 'Patua One', cursive;, cursive;color:41B3A3">----------- or -----------</p>
         </center>
         <center>
            <div class="deco">
               <div class="g-signin2" data-onsuccess="onSignIn">
               </div>
            </div>
         </center>
         <script>
            function onSuccess(googleUser) {
              console.log('Logged in as: ' + googleUser.getBasicProfile().getName());
            }
            function onFailure(error) {
              console.log(error);
            }
            function renderButton() {
              gapi.signin2.render('g-signin2', {
                'scope': 'profile email',
                'width': 240,
                'height': 50,
                'longtitle': true,
                'theme': 'dark',
                'onsuccess': onSuccess,
                'onfailure': onFailure
              });
            }
         </script>
         <center>
            <p class="new_account">New to Purveyor? <a href="register.php" style="color:#41B3A3">Create Account</a></p>
         </center>
      </div>

   </body>
</html>

<?php
include("database.php");
if(isset($_POST['submit']))
{
  $email = $_POST['email'];
  $pass = $_POST['password'];

  if(!empty($email) && !empty($pass))
  {
    $query = "SELECT * FROM `userbase` WHERE email = '$email' AND password = '$pass'";
    $run = mysqli_query($con,$query);

    if(mysqli_num_rows($run)>0)
    {
      session_start();
      $_SESSION['email'] = $email;
      echo "<script type='text/javascript'>window.location.href = 'main.php';</script>";   
      exit();
    }
    else
    {
     echo "<script>swal.fire('The email or password is wrong')</script>"; 
    }
  } 
  else
  {
    echo "<script>swal.fire('Please fill all the fields')</script>"; 
  } 
}
?>