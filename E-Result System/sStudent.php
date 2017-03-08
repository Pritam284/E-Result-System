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
$sId = $_SESSION['studentId'];
$table = "course_".$_SESSION['login_user'];
$cq = "select * from `$table` where s_id = '$sId'";
$mq = mysql_query($cq);
echo '<center><table class = "table" width="">';
echo '<tr>';
echo '<th>Course ID</th>';
echo '<th>GPA</th>';
echo '</tr>';
$cnt = mysql_num_rows($mq);
if($cnt>0){
while($row = mysql_fetch_array($mq)){
	$t1 = $row['c_id'];
	$t2 ;
	echo '<tr>';
	echo '<th>'.$t1.'</th>';
	if($row['status'] == '0'){
		$t2 = "not published";
	}
	else if($row['gpa'] == 0) $t2 = "failed";
	else $t2 = $row['gpa'];
	echo '<th>'.$t2.'</th>';
	echo '</tr>';
}
}
else echo "empty";

?>	
</div>
</body>
</html>