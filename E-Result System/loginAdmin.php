<!DOCTYPE html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>eResult System</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
	
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="Main.php">eResult</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Home</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

  <section style = "  margin: 80px auto width: 640px">
    <div class="login">
      <h1>Log in!</h1>
      <form action = "" method="POST">
        <p><input type="text" name="myusername" value="" placeholder="Username" id="myusername"></p>
        <p><input type="password" name="mypassword" value="" placeholder="Password" id="mypassword"></p>
		<p class="submit"><input type="submit" name="submit" value="Login"></p>
      </form>
    </div>

    <div class="login-help">
      <p>Forgot your password?</p>
    </div>
  </section>

  <section class="about">
    <p class="about-author">
&copy; 2014 The Lost Developers</section>
</body>
</html>

<?php
$host="localhost"; 
$username="root"; 
$password=""; 
$db_name="eresult"; 
$tbl_name="admin"; 

mysql_connect("$host","$username","$password") or die("cannot connect");
mysql_select_db("$db_name") or die("cannot select DB");

$myusername=$_POST['myusername'];
$mypassword=$_POST['mypassword'];

$myusername=stripslashes($myusername);
$mypassword=stripslashes($mypassword);

$myusername=mysql_real_escape_string($myusername);
$mypassword=mysql_real_escape_string($mypassword);

$sql="SELECT * FROM $tbl_name WHERE userID='$myusername' and password='$mypassword'";
$result=mysql_query($sql);
$count=mysql_num_rows($result);
session_start();
if($count == 1){
	$_SESSION['login_user']=$myusername;
	$_SESSION['acc_type'] = 'admin';
	header("location:admin.php");
}
else{
		echo "Wrong Username or Password" . $myusername . $mypassword;
}
?>