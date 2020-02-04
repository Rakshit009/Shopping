<?php
include("database.php");
session_start();
if(isset($_SESSION['email']))
{

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
.decorate
{

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
      <a style="font-family: 'Patua One', cursive;font-size:26px" class="navbar-brand head" href="main.php">purveyor</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown log"><a class="dropdown-toggle" style="color:#41B3A3" data-toggle="dropdown" href="#">profile
          <i class="fas fa-user"></i></a>
          <ul class="dropdown-menu">
            <li><a href="profile.php">Account</a></li>
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
        <li class="log"><a href="cart.php" style="color:#41B3A3">cart <i class="fas fa-shopping-bag fa-lg"></i></a></li>        
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

<div class="container-fluid">
  <img id="optionalstuff" src="../../backgrounds/diwali.jpg" width="100%" > 
</div>

<h3 style="text-align: center;margin-bottom:5%">Celebrate this diwali with your loved one's with amazing discount!!!!</h3>

 <?php
    $fetch = "SELECT * FROM `books`";
    $run = mysqli_query($con,$fetch);

    if($run)
    {
      while($data = mysqli_fetch_assoc($run))
      {
        $image = $data['imagename'];

        ?>
        <div style="margin-bottom: 5%;" class="col-md-3" >
          <center style=""><?php echo '<img width="70%" src="../../backgrounds/'.$data['imagename'].'"/>'; ?></center>
          <a href=""><center style="margin-top:3%;color:#1AD9C1;font-weight: bold;"><?php echo $data['name']; ?></center></a>
          <center style="color:red;font-weight:bold"><?php echo $data['price']; ?> Rs</center>
        </div>

        <?php


      }
    }
    else
    {
      echo "something went wrong";
    }
 ?>

</body>
</html>