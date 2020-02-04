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
      <link rel="stylesheet" type="text/css" href="main.css">
      <script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>
      <link href="https://fonts.googleapis.com/css?family=Abel|Arimo|Crimson+Pro|Lobster|PT+Sans+Narrow|Pacifico|Patua+One|Roboto|Rubik&display=swap" rel="stylesheet">
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
          <img id="optionalstuff" src="../../backgrounds/person.jpg" width="100%" > 
      </div>
      <div class="col-md-5">
         <center>
            <h3 style="margin-top:8%;"><a style="color:#011627;font-family: 'Pacifico', cursive;font-size:35px;" href="main.php">purveyor</a></h3>
         </center>
         <center>
            <p style="margin-top:7%;color:#011627;font-family: 'Abel', sans-serif;font-size:25px;">Register</p>
         </center>
         <form action="register.php" method="POST">
             <center>
                <p  class="hint">Email</p>
             </center>
             <center><input class="box" type="text" name="email" maxlength = "40" /></center>
             <center>
                <p class="hint">Password</p>
             </center>
             <center><input class="box" name="password" type="password" id="password" maxlength = "40" /></center>

             <center><input class="login_button" name="verifier" value="Sign Up" type="submit" name=""></center>
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
            <p class="new_account">Already have an Account? <a href="login.php" style="color:#41B3A3">login</a></p>
         </center>
      </div>
   </body>
</html>


<?php
//php code for registeration

include("database.php");

if(isset($_POST['verifier']))
{
  $email = $_POST['email'];
  $pass = $_POST['password'];

  if(!empty($email) && !empty($pass))
  {
    if(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^",$email))
    { 
      echo "<script>swal.fire('Please Enter Valid Email');</script>";
    }
    else
    {
      if(strlen($pass) < 6)
      {
          echo "<script>swal.fire('Password must be greater than 6');</script>";  
      }
      else
      {
        if(!preg_match("/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*)[0-9A-Za-z@#\-_$%^&+=§!\?]{6,20}$/",$pass))
        {
          echo "<script>swal.fire('use specialcase, letters and numbers.');</script>";  
        }
        else
        {

          $checkMail = "SELECT * FROM `userbase` WHERE email = '$email'";

          $checkRun = mysqli_query($con,$checkMail);

          $checkRow = mysqli_fetch_array($checkRun);

          if($checkRow['email'] == $email)
          {
            echo "<script>swal.fire('The Username Already exists')</script>";              
          }
          else
          {
            $query = "INSERT INTO `userbase`(`email`, `password`) VALUES ('$email','$pass')";
            $run = mysqli_query($con,$query);

            if($run == TRUE)
            {
              $rand = rand(100000,999999);
              $another = "INSERT INTO `users`(`email`, `first`, `last`, `phone`,`otp`,`status`,`potp`,`pstatus`,`paotp`,`pastatus`) VALUES ('$email','0','0','0','$rand','0','0','0','0','0')";
              $fire = mysqli_query($con,$another);
              
                $to = $email;
                $subject = "OTP - ".$rand;
                $txt = "OTP - ".$rand;
                $headers = "From: puveyor.in";

                mail($to,$subject,$txt,$headers);         
 
                session_start();
                $_SESSION['email'] = $email;
                echo "<script type='text/javascript'>window.location.href = 'details.php';</script>";   
                exit();      
            }
            else
            {
              echo "<script>swal.fire('Something Went Wrong')</script>";
            }          
          }
        } 
      }
    }
  }
  else
  {
    echo "<script>swal.fire('Please fill all the fields')</script>";
  }    

}

?>