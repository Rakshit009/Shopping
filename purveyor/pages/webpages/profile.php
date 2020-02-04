<?php
include("database.php");
session_start();
if(isset($_SESSION['email']))
{

}
else
{
  header("location:register.php");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Arimo|Crimson+Pro|Patua+One|Rubik&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Lobster&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Anton|Russo+One&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/dbe29486b0.js"></script>
  <link rel="stylesheet" type="text/css" href="main.css">
<style>
body
{

}
.decorate
{
font-family: 'Russo One', sans-serif;


}
.head
{
  font-size:40px;
  color:#011627;
}
.head:hover
{

  color:#011627;
}
.navbar .navbar-toggle .icon-bar {
   background-color:#011627;

}

.log
{
  font-family: 'Patua One', cursive;
  font-size:16px;
  color:black; 
}

@media (max-width: 640px) 
{
  body
  {
    background-size: 150%;
  }
  .spoke
  {
    margin-top: 20%;

  }
  .move
  {
    margin-left:0%; 
  }
}
.navbar
{
  border:1px solid lightgrey;
}
.navbar:hover
{
  background-color: white;
  transition: 1s;
}
.email
{

  color:#011627;
  font-family:  'Patua One';
  margin-top: 4%;

}
</style>
</head>
<body>

<nav class="navbar navv" >
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a style="font-family: 'Patua One', cursive;font-size:26px" class="navbar-brand head" href="index.php">purveyor</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown log"><a class="dropdown-toggle" style="color:#41B3A3" data-toggle="dropdown" href="#">profile
          <i class="fas fa-user"></i></a>
          <ul class="dropdown-menu">
            <li><a href="#">Account</a></li>
            <li><a href="#">Orders</a></li>
            <li class="divider"></li>
            <?php
              if(isset($_SESSION['email']))
              {   
                echo '<li><a style="color:#41B3A3" href="logout.php">logout</a></li>';
              }
              else
              {
                echo "<li><a style='color:black' href='login.php'>login</a></li>"; 
              }
            ?>    
          </ul>    
        </li>
        <li class="log"><a style="color:#41B3A3">cart <i class="fas fa-shopping-bag fa-lg"></i></a></li>        
      </ul>
      <form class="navbar-form navbar-right" action="/action_page.php">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search for products,brands and more">
          <div class="input-group-btn">
            <button class="btn btn-default" type="submit">
              <i class="glyphicon glyphicon-search"></i>
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</nav>

<div class="col-md-7">
  <img src="../../backgrounds/dancing.png" width="100%">
</div>

<div class="col-md-5">

  <?php
  include("database.php");
  if(isset($_SESSION['email']))
  {
    $email = $_SESSION['email'];
    $fetch = "SELECT * FROM `users` WHERE email =  '$email'";
    $run = mysqli_query($con,$fetch);

    $details = mysqli_fetch_array($run);

    if($fetch)
    {
      echo '<h4 class="email"> Email - '.$details['email'].'</h4>';

      echo '<h4 class="email">Name - '.$details['first'].' '.$details['last'].'</h4>';

      echo '<h4 class="email">Phone - '.$details['phone'].'</h4>';     
      
      echo '<h4 class="email">address - </h4>';
    }
  }

?>
  
</div>

  <center><button class="login_button">EDIT</button></center>

</body>
</html>