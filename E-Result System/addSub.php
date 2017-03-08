<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>eResult System</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom Google Web Font -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,100italic,300italic,400italic,700italic,900italic' rel='stylesheet' type='text/css'>

    <!-- Add custom CSS here -->
    <link href="css/landing-page.css" rel="stylesheet">

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
                <a class="navbar-brand" href="student.php">eResult</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="student.php">Home</a>
                    </li>
                    <li><a href="index.php">Log out</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
	<div class="under-header">
<form action="" method="post">
<?php
session_start();
if( $_SESSION['login_user'] == NULL || strcmp($_SESSION['acc_type'],'student')!=0 ){
	header("location:index.php");
}
$var = $_SESSION['take'];
for($i = 0;$i<$var;$i++){
echo 'ID :<input type="text" name="id'.$i.'" ><br>';
}
?>
<input type="submit" name="Submit" value="Add Student(s)">
</form>
</div>

<?php
if($_SESSION['login_user'] == null){
	header("location:Main.php");
}
$cn=mysql_connect("localhost","root","");

if(!$cn) 
{
	die("could not connect".mysql_error());
}
mysql_select_db("eresult",$cn);

$tt = $_SESSION['take'];
$id = array();
if(isset($_POST['Submit'])){
for($i = 0;$i<$tt;$i++){
	$id[$i] =  $_POST['id'.$i];
}
}
$stdid = $_SESSION['login_user'];
if(isset($_POST['Submit'])){
	$flag = true;
	for($i = 0;$i<$tt;$i++){
		$cq="INSERT INTO `eresult`.`course_cse` (`s_id`, `c_id`, `status`, `gpa`) VALUES ('$stdid', '$id[$i]', '0', '0');";
		$mq=mysql_query($cq,$cn);
		if(!$mq){
			$flag = false;
			echo "some subject is not in the course table";
		}
	}
	if($flag)
	header("location:student.php");
}

mysql_close($cn);
?>

</body>
</html>


