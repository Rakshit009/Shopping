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
  <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="main.css">
<style>
body
{

}
.checked {
  color: #1AD9C1;
  font-size: 22px;
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

 <?php
    $fetch = "SELECT * FROM `books`";
    $run = mysqli_query($con,$fetch);
    $data = mysqli_fetch_assoc($run);
    if($data)
    {
        ?>
        <div style="margin-top:3%;margin-left:3%" class="col-md-3" >
          <center style=" "><?php echo '<img class="img-thumbnail" width="100%" src="../../backgrounds/'.$data['imagename'].'"/>'; ?></center>
        </div>
        <div style="font-family:margin-top:2%; 'Roboto Condensed', sans-serif;margin-top:6%;margin-left:3%" class="col-md-6" >
        <center style="margin-top:2%;font-family: 'Roboto Condensed', sans-serif;color:#1AD9C1;font-size:28px;font-weight:bold"><?php echo $data['name']; ?></center>
        <center style="margin-top:2%;font-family: 'Roboto Condensed', sans-serif;color:grey;font-size:18px;font-weight:bold">Author Name :<span style="font-family: 'Roboto Condensed', sans-serif;
color:black"> <?php echo $data['author']; ?></span></center>
        <center style="margin-top:2%;font-family: 'Roboto Condensed', sans-serif;color:grey;font-size:18px;font-weight:bold">Price : <span style="font-family: 'Roboto Condensed', sans-serif;
color:red;font-size:18px;font-weight:bold"><?php echo $data['price']; ?></span> Rs</center>
        <center style="margin-top:2%; font-family: 'Roboto Condensed', sans-serif;color:grey;font-size:18px;font-weight:bold">Info : <span style="font-family: 'Roboto Condensed', sans-serif;color:black;font-size:14px;"><?php echo $data['info']; ?></span></center>
        <center style="margin-top:3%;"><button type="button" class="btn btn-success">Order Now</button></center>
        <center style="margin-top:3%;"> <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span style="font-size:22px" class="fa fa-star"></span>
                <span style="font-size:22px" class="fa fa-star"></span>
        </center>

        </div>
        <?php
    }
    else
    {
      echo "something went wrong";
    }
 ?>

 <div class="col-md-12" style="margin-bottom:4%">
      <div class="col-md-4">
         <center>
            <p style="color:#011627;margin-top:7%;font-family: 'Abel', sans-serif;font-size:25px;">Your review is important to Us!!!</p>
         </center>
         <form action="login.php" method="POST">
            <center>
               <p id="Email" class="hint" >Enter Review</p>
            </center>
            <center><input class="box" type="text" name="email" /></center>
            <center><input class="login_button" value="Submit" type="submit" name="submit"></center>
         </form>
      </div>
      <div class="col-md-8" overflow="scroll">
            <p style="text-align:center;color:#011627;margin-top:7%;font-family: 'Abel', sans-serif;font-size:25px;">User Reviews</p>        
             <?php
                $fetch = "SELECT * FROM `details`";
                $run = mysqli_query($con,$fetch);

                if($run)
                {
                  while($data = mysqli_fetch_assoc($run))
                  {


                    ?>
                    <div style="margin-bottom: 5%;" >
                      <center style="background-color:white;font-weight: bold;color: #1AD9C1;"><?php echo $data['Body']; ?></center>
                    </div>

                    <?php


                  }
                }
                else
                {
                  echo "something went wrong";
                }
             ?>
      </div>
 </div>
</body>
</html>