

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
	<ul class="list-inline intro-social-buttons">
                <li><a href="showResult.php" class="btn btn-default btn-lg"><i class="fa fa-leaf fa-fw"></i> <span class="network-name">Show Result</span></a>
                </li>
				 <li><a href="refresh.php" class="btn btn-default btn-lg"><i class="fa fa-leaf fa-fw"></i> <span class="network-name">Refresh</span></a>
                </li>
                </ul>
	</div>			
</body>
</html>

<?php
session_start();
if( $_SESSION['login_user'] == NULL || strcmp($_SESSION['acc_type'],'student')!=0 ){
	header("location:index.php");
}
if($_SESSION['login_user'] == null){
	header("location:index.php");
}
$cn=mysql_connect("localhost","root","");

if(!$cn) 
{
	die("could not connect".mysql_error());
}
mysql_select_db("eresult",$cn);
$D = array("CSE" => "cse" ,"EEE" => "eee", "ME" => "me" ,"IPE" => "ipe" );
$ddd = $D[$_SESSION['dept']];
$userid = $_SESSION['login_user'];
$cq = "SELECT * FROM `eresult`.`$ddd`  WHERE id = '$userid'";
$result=mysql_query($cq);
$row = mysql_fetch_array($result);
echo 'First Name :: ' . $row['firstName'] . '<br>';
echo 'Last Name  :: ' . $row['lastName'] . '<br>';
echo 'ID         :: ' . $row['id'] .'<br>';
echo 'Year :: ' . $row['year'] . '<br>';
echo 'Semester :: ' . $row['semester'] . '<br>';
echo 'CGPA(only passed subject) :: ' . $row['cgpa'] . '<br>';
echo 'Carry      :: ' . $row['carry'] . '<br>';
echo 'Total Credit :: ' . $row['sumOfcredit'] . '<br>';

?>
