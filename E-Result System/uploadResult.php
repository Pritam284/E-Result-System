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
                <a class="navbar-brand" href="teacher.php">eResult</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-ex1-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="teacher.php">Home</a>
                    </li>
                    <li><a href="index.php">Log Out</a>
                    </li>
                    
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
	<div class="under-header"></div>
<form action="" method="post">
<?php
$cn=mysql_connect("localhost","root","");

if(!$cn) 
{
	die("could not connect".mysql_error());
}
mysql_select_db("eresult",$cn);
session_start();
if( $_SESSION['login_user'] == NULL || strcmp($_SESSION['acc_type'],'teacher')!=0 ){
	header("location:index.php");
}
$var1 = $_SESSION['subNo'];
$var2 = 'course_'.$_SESSION['deptNo'];
$cq = "select * from `eresult`.`$var2` where c_id = '$var1' and status = '1' order by s_id ";
$result = mysql_query($cq);
$i = 0;
while($row = mysql_fetch_array($result)){
	echo $row['s_id'].' :<input type="number" name="mark'.$i.'" min="0" max="100" ><br>';
	$_POST['s_id'.$i] = $row['s_id'];
	$i++;
}
$_SESSION['cnt'] = $i;
?>
<input type="submit" name="Submit" value="Upload Result">
</form>

</body>
</html>


<?php
$tt = $_SESSION['cnt'];
$mark = array();
$name = array();
$gpa = array();
if(isset($_POST['Submit'])){
for($i = 0;$i<$tt;$i++){
	$mark[$i] =  $_POST['mark'.$i];
	$name[$i] = $_POST['s_id'.$i];
	if($mark[$i] >= '45'){
		$gpa[$i] = 2.25;
	}else if($mark[$i] >= '40'){
		$gpa[$i] = 2;
	}else{
		$gpa[$i] = 0;
	}
	
}
}
$var1 = $_SESSION['subNo'];
$var2 = 'course_'.$_SESSION['deptNo'];
$dept = $_SESSION['deptNo'];
$cq="select cradit_hour from course where id = '$var1'";
$result = mysql_query($cq);
$hour = mysql_fetch_array($result);
if(isset($_POST['Submit'])){
	for($i = 0;$i<$tt;$i++){
		$cq="UPDATE $var2 SET status = '1' ,gpa='$gpa[$i]' WHERE c_id = '$var1' and s_id = '$name[$i]'";
		$result = mysql_query($cq);
	}
	for($i = 0;$i<$tt;$i++){
		$cq="select * from `$dept` where id = '$name[$i]'";
		$result = mysql_query($cq);
		$row = mysql_fetch_array($result);
		$tmp = ($gpa[$i]*$hour['cradit_hour']) + ($row['cgpa']*$row['sumOfcredit']);
		$sum = $row['sumOfcredit'];
		$tmp /= $sum;
		$cq="UPDATE $dept SET cgpa='$tmp',sumOfcredit='$sum' WHERE id = '$name[$i]'";
		$result = mysql_query($cq);
		if($gpa[$i] != 0){
			$tmp = $row['carry'] - 1;
			$cq="UPDATE $dept SET carry='$tmp',sumOfcredit='$sum' WHERE id = '$name[$i]'";
			$result = mysql_query($cq);
		}
	}
	header("location:teacher.php");
}

mysql_close($cn);
?>