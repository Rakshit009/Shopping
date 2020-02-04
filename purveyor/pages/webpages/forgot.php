<?php
   include("database.php");
   error_reporting(0);
?>
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
      </style>
   </head>
   <body>
      <div class="col-md-7 helper">
         <img id="optionalstuff" src="../../backgrounds/2woman.png" width="100%" >
      </div>
      <div class="col-md-5">
         <center>
         <h3  class="site_name"><a style="color:#011627;font-family: 'Pacifico', cursive;font-size:35px;" href="index.php">purveyor</a></h3>
         </center>
         <?php
           session_start();
           
           $email = $_SESSION['mail'];

           $last_q = "SELECT * FROM `users` WHERE email = '$email'";
           $last_run = mysqli_query($con, $last_q);

           if($last_run)
           {
             $take = mysqli_fetch_array($last_run);
           }

           if(isset($_SESSION['mail']) && $take['pastatus'] == '0')
           {
                echo '<center>
                  <p style="margin-top:7%;color:red;font-family: "Abel", sans-serif;font-size:25px;">OTP Sended!</p>
               </center>
               <center>
                  <p style="font-size:20px;margin-top: 4%;font-family: "Abel", sans-serif;">Enter OTP </p>
               </center>
               <form action="forgot.php" method="POST">
                  <center><input class="box" type="text" name="vemail" /></center>
                  <center><input class="login_button" value="Verify" type="submit" name="check"></center>            
               </form>';
           }
           else if(!isset($_SESSION['mail']))
           {
             echo '<center>
               <p style="margin-top:7%;color:red;font-family: "Abel", sans-serif;font-size:25px;">OTP will be sended to registered email</p>
            </center>
            <center>
               <p style="font-size:20px;margin-top: 4%;font-family: "Abel", sans-serif;">Enter Registered Email</p>
            </center>
            <form action="forgot.php" method="POST">
               <center><input class="box" type="text" name="email" /></center>
               <center><input class="login_button" value="generate OTP" type="submit" name="forgot"></center>            
            </form>';
           }
           else if(isset($_SESSION['mail']) && $take['pastatus'] == '1')
           {
             echo  '<form action="forgot.php" method="POST">
             <center>
               <p style="margin-top:7%;color:green;font-family: "Abel", sans-serif;">PASSWORD SETUP</p>
            </center>
            <center>
               <p style="font-size:20px;margin-top: 4%;font-family: "Abel", sans-serif;"> New Password</p>
            </center>
               <center><input class="box" type="text" name="newpass" /></center>
            <center>
               <p style="font-size:20px;margin-top: 4%;font-family: "Abel", sans-serif;"> Confirm Password</p>
            </center>
               <center><input class="box" type="text" name="conpass" /></center>
               <center><input class="login_button" value="Set Password" type="submit" name="pass"></center>            
            </form>';            
           }

         ?>
         <center>
            <p class="new_account">Already have an Account? <a href="login.php" style="color:#41B3A3">login</a></p>
         </center>
      </div>
   </body>
</html>

<?php

   if(isset($_POST['forgot']))
   {
      if(!empty($_POST['email']))
      {
        $email = $_POST['email'];
        
         if(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^",$email))
         { 
           echo "<script>swal.fire('Please Enter Valid Email');</script>";
         }
         else
         {

            $query = "SELECT * FROM `users` WHERE email = '$email'";
            $run = mysqli_query($con, $query);

            if(mysqli_num_rows($run)>=1)
            {
               $rand = rand(111111,666666);
               $another_query = "UPDATE `users` SET `paotp` = '$rand',`pastatus` = '0' WHERE `email` = '$email'";
               $another_run = mysqli_query($con,$another_query);

               if($another_run)
               {
                     
                  $_SESSION['mail'] = $email;
                  header("location:forgot.php");
               }
               else
               {
                  echo "<script>swal.fire('something went wrong')</script>";
               }
            }
            else
            {
               echo "<script>swal.fire('email not exist');</script>";
            }
         }
      }
      else
      {
         echo "<script>swal.fire('Pleae Enter Email');</script>";         
      }
   }


   if(isset($_POST['check']))
   {
      if(!empty($_POST['vemail']))
      {
         $email = $_SESSION['mail'];
         $notp = $_POST['vemail'];
         $query = "SELECT * FROM `users` WHERE email = '$email' and paotp = '$notp'";
         $rquery = mysqli_query($con,$query);

         if(mysqli_num_rows($rquery)>=1)
         {
           $update_otp = "UPDATE `users` set `paotp` = '1',pastatus = '1' WHERE `email`='$email'";
           $update_run = mysqli_query($con,$update_otp);

           if($update_run)
           {
              header("location:forgot.php");
           }
           else
           {
            echo "<script>swal.fire('Error');</script>"; 
           }
         }
         else
         {
            echo "<script>swal.fire('Please Enter Valid OTP');</script>"; 
         }
      }
      else
      {
           echo "<script>swal.fire('Please Enter OTP');</script>"; 
      }
   }
   else
   {

   }

   if(isset($_POST['pass']))
   {
      if(!empty($_POST['newpass']) && !empty($_POST['conpass']))
      {
        $newpass = $_POST['newpass'];
        $conpass = $_POST['conpass'];
        if($newpass == $conpass)
        {
           if(!preg_match("/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*)[0-9A-Za-z@#\-_$%^&+=§!\?]{6,20}$/",$newpass))
           {
             echo "<script>swal.fire('use specialcase, letters and numbers.');</script>";  
           }
           else
           {
              $update_password = "UPDATE `userbase` set `password` = '$newpass' WHERE `email`='$email'";
              $update_run = mysqli_query($con,$update_password);

              if($update_run)
              {
               echo "<script>swal.fire('Password Updated Successfully');</script>";
               session_unset();
               session_destroy(); 
               header('location:forgot.php');
              }
              else
              {
               echo "<script>swal.fire('Error in updating password.');</script>"; 
              }
           }         
        }
        else
        {
           echo "<script>swal.fire('Password doesnt match');</script>"; 
        }
      }
      else
      {
           echo "<script>swal.fire('fill all the fields');</script>"; 
      }
   }
?>