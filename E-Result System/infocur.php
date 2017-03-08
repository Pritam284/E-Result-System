<?php
$lab = null;
$theory=null;
?>

<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>eResult System</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">
	<link href="font-awesome/css/font-awesome.css" rel="stylesheet">
	
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
$var = $_SESSION['curno'];
echo '<center><table >';
echo '<tr>';
echo '<th>Course ID</th>';
echo '<th>Course Title</th>';
echo '<th>Credit Hour</th>';
echo '<th>Year</th>';
echo '<th>Semester</th>';
echo '<th>';
echo '</tr>';
for($i = 0;$i<$var;$i++){
echo '<tr>';
echo '<th><input type="text" name="id'.$i.'" ></th>';
echo '<th><input type="text" name="name'.$i.'" ></th>';
echo '<th><input type="text" name="credit'.$i.'" ></th>';
echo '<th><input type="text" name="year'.$i.'" ></th>';
echo '<th><input type="text" name="semester'.$i.'" ></th>';
print $lab;
echo '<th><Input type = "Radio" Name ="type'.$i.'" value= "Lab"';
?>
>Lab
<?php
print $theory;
echo '<Input type = "Radio" Name ="type'.$i.'" value= "Theory"</th>';?>
Theory
<?php
echo '</tr>';
}
echo '</table></center>';

?>
<center><input style = "margin: 20px" type="submit" name="Submit" value="Add Course(s)"></center>
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

$tt = $_SESSION['curno'];
$id = array();
$name = array();
$credit = array();
$year = array();
$semester = array();
$type = array();
if(isset($_POST['Submit'])){
for($i = 0;$i<$tt;$i++){
	$id[$i] =  $_POST['id'.$i];
	$name[$i] =  $_POST['name'.$i];
	$credit[$i] = $_POST['credit'.$i];
	$year[$i] = $_POST['year'.$i];
	$semester[$i] = $_POST['semester'.$i];
	$type[$i] = $_POST['type'.$i];
	echo $type[$i];
	}
}
if(isset($_POST['Submit'])){
	$flag = true;
	$dept = $_SESSION['login_user'];
	for($i = 0;$i<$tt;$i++){
		$cq="INSERT INTO `eresult`.`course` (`id`,`department`,`year`,`semester`, `title`,`cradit_hour`,`type`) VALUES ('$id[$i]','$dept','$year[$i]','$semester[$i]', '$name[$i]','$credit[$i]','$type[$i]');";
		$mq=mysql_query($cq,$cn);
		if(!$mq){
			$flag = false;
			echo "Could not insert result ".mysql_error();
			for(;$i>=0;$i--){
				$cq="delete from `eresult`.`course` where id='$id[$i]';";
				$mq=mysql_query($cq,$cn);
			}
			break;
		}
	}
	if($flag){
		header("location:admin.php");
	}
}

mysql_close($cn);
?>