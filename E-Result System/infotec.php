<html>
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
  <script type="text/javascript">

            function check()
            {
                if (document.getElementById('FileName').value==""
                 || document.getElementById('FileName').value==undefined)
                {
                    alert ("Please Enter a File Name");
                    return false;
                }
                return true;
            }

   </script>
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
                <a class="navbar-brand" href="index.php">eResult</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="Admin.php">Home</a>
                    </li>
                    <li><a href="index.php">Log out</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
<section style = "margin: 80px">
<form action="" method="post">
<?php
session_start();
if( $_SESSION['login_user'] == NULL || strcmp($_SESSION['acc_type'],'admin')!=0 ){
	header("location:index.php");
}
$var = $_SESSION['tecno'];
echo '<center><table width="">';
echo '<tr>';
echo '<th>ID</th>';
echo '<th>First Name</th>';
echo '<th>Second Name</th>';
echo '</tr>';
for($i = 0;$i<$var;$i++){
echo '<tr>';
echo '<th><input type="text" name="id'.$i.'" ></th>';
echo '<th><input type="text" name="fname'.$i.'" ></th>';
echo '<th><input type="text" name="lname'.$i.'" ></th>';
echo '</tr>';
}
echo '</table></center>';
?>
<center><input style = "margin: 20px"type="submit" name="Submit" value="Add Teacher(s)"></center>
</form>
</body>
</html>


<?php
$cn=mysql_connect("localhost","root","");

if(!$cn) 
{
	die("could not connect".mysql_error());
}
mysql_select_db("eresult",$cn);

$tt = $_SESSION['tecno'];
$id = array();
$fname = array();
$lname = array();
if(isset($_POST['Submit'])){
for($i = 0;$i<$tt;$i++){
	$id[$i] =  $_POST['id'.$i];
	$fname[$i] =  $_POST['fname'.$i];
	$lname[$i] =  $_POST['lname'.$i];
}
}
if(isset($_POST['Submit'])){
	$dept = $_SESSION['login_user'];
	for($i = 0;$i<$tt;$i++){	
	$cq="INSERT INTO `eresult`.`teacher` (`id`, `firstName`, `lastName`,`department`,`password`) VALUES ('$id[$i]', '$fname[$i]', '$lname[$i]',  '$dept', '$id[$i]');";
		$mq=mysql_query($cq,$cn);
		if(!$mq){
			echo "Could not insert result ".mysql_error();
		}
	}
	header("location:admin.php");
}

mysql_close($cn);
