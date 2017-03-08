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
<div class="under-header">
<form action="" method="post">
<p><input type="text" name="teacherid" value="" placeholder="Enter Teacher ID" id="teaherid"></p>
<p><input type="text" name="courseid" value="" placeholder="Enter Course ID" id="courseid"></p>
<p><input type="radio" name="semester" value="Fall" />Fall<br/>
<input type="radio" name="semester" value="Spring" />Spring<br/>
<input type="text" name="year" value="" placeholder="Enter Year" id="year"></p>

<p class="submit"><input type="submit" name="Submit" value="Submit"></p>
</form>
</div>
</body>
</html>

<?php
session_start();
$cn=mysql_connect("localhost","root","");

if(!$cn) 
{
	die("could not connect".mysql_error());
}
mysql_select_db("eresult",$cn);
if( $_SESSION['login_user'] == NULL || strcmp($_SESSION['acc_type'],'admin')!=0 ){
	header("location:index.php");
}
$t1 = $_POST['teacherid'];
$t2 = $_POST['courseid'];
$t3 = $_POST['semester'];
$t4 = $_POST['year'];

if(isset($_POST['Submit'])){
	$sql1="INSERT INTO `eresult`.`course_teacher` ( `course_id`,`teacher_id`, `semester_type`, `year`)
VALUES('$t2','$t1','$t3','$t4')";
$mq = mysql_query($sql1);
	echo "1 record added";
	header("location:manage.php");
}

?>