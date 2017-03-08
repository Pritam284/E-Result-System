<html lang="en">

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
                <a class="navbar-brand" href="admin.php">eResult</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="admin.php">Home</a>
                    </li>
                    <li><a href="index.php">Log Out</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
	<form action="" method="post">
	<div class="intro-header">
	
	<?php
session_start();
if( $_SESSION['login_user'] == NULL || strcmp($_SESSION['acc_type'],'admin')!=0 ){
	header("location:index.php");
}
$cn=mysql_connect("localhost","root","");

if(!$cn) 
{
	die("could not connect".mysql_error());
}
mysql_select_db("eresult",$cn);
if($_SESSION['des_radio'] == 'teacher'){
	$dept = $_SESSION['dept_radio'];
	$cn = "select * from `teacher` where department='$dept';";
	$mq = mysql_query($cn);
	echo '<center><table class = "table" width="">';
	echo '<tr>';
	echo '<th>ID</th>';
	echo '<th>First Name</th>';
	echo '<th>Last Name</th>';
	echo '</tr>';
	while($row = mysql_fetch_array($mq)){
		echo '<tr>';
		echo '<th>'.$row['id'].'</th>';
		echo '<th>'.$row['firstName'].'</th>';
		echo '<th>'.$row['lastName'].'</th>';
		echo '</tr>';
	}
	?>
	</table>
	</div>
	<center><div class="">
	<br><br><a>Search Teacher Course :: <input type="text" name = "teacherId" value="" >
	<input type="submit" name = "submit" value="submit"><span class="network-name"></span></a><br><br>
	</div>
	<?php
}
else if($_SESSION['des_radio'] == 'student'){
	$dept = $_SESSION['dept_radio'];
	$tmp = $_SESSION['semester'];
	
	$year ;$semester;
	if($tmp == '1.1'){
		$year = '1' ;$semester = '1';
	}
	else if($tmp == '1.2'){
		$year = '1' ;$semester = '2';
	}
	else if($tmp == '2.1'){
		$year = '2' ;$semester = '1';
	}
	else if($tmp == '2.2'){
		$year = '2' ;$semester = '2';
	}
	else if($tmp == '3.1'){
		$year = '3' ;$semester = '1';
	}
	else if($tmp == '3.2'){
		$year = '3' ;$semester = '2';
	}
	else if($tmp == '4.1'){
		$year = '4' ;$semester = '1';
	}
	else if($tmp == '4.2'){
		$year = '4' ;$semester = '2';
	}
	
	$cn = "select * from `$dept` where year='$year' and semester='$semester';";
	$mq = mysql_query($cn);
	echo '<center><table class = "table" width="">';
	echo '<tr>';
	echo '<th>ID</th>';
	echo '<th>First Name</th>';
	echo '<th>Last Name</th>';
	echo '</tr>';
	while($row = mysql_fetch_array($mq)){
		echo '<tr>';
		echo '<th>'.$row['id'].'</th>';
		echo '<th>'.$row['firstName'].'</th>';
		echo '<th>'.$row['lastName'].'</th>';
		echo '</tr>';
	}
	?>
	</table>
	</div>
	<center><div class="">
	<br><br><a>Search Student Course :: <input type="text" name = "stdId" value="" >
	<input type="submit" name = "submit" value="submit"><span class="network-name"></span></a><br><br>
	</div>
	<?php
}

?>
	
	
	</form>

</body>
</html>

<?php
	if($_SESSION['des_radio'] == 'teacher'){
		if(isset($_POST['submit'])){
			$_SESSION['teacherId'] = $_POST['teacherId'];
			header("location:sTeacher.php");
		}
	}
	else if($_SESSION['des_radio'] == 'student'){
		if(isset($_POST['submit'])){
			$_SESSION['studentId'] = $_POST['stdId'];
			header("location:sStudent.php");
		}
	}
?>