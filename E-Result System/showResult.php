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
	<section style = "margin: 80px">
	
<?php

session_start();
if( $_SESSION['login_user'] == NULL || strcmp($_SESSION['acc_type'],'student')!=0 ){
	header("location:index.php");
}
$cn=mysql_connect("localhost","root","");

if(!$cn) 
{
	die("could not connect".mysql_error());
}
mysql_select_db("eresult",$cn);

$stdid = $_SESSION['login_user'];
$D = array("CSE" => "cse" ,"EEE" => "eee", "ME" => "me" ,"IPE" => "ipe" );
$table = 'course_'.$D[$_SESSION['dept']];
$cq = "SELECT * FROM `eresult`.`$table`  WHERE s_id = '$stdid'";
echo '<center><table width="">';
echo '<tr>';
echo '<th>Course Name</th>';
echo '<th>GPA</th>';
echo '</tr>';

$result=mysql_query($cq);
while($row = mysql_fetch_array($result)){
	$tmp = $row['c_id'];
	$cq = "SELECT * FROM `eresult`.`course`  WHERE id = '$tmp'";
	$res = mysql_query($cq);
	$res1 = mysql_fetch_array($res);
	$tmp = $row['status'];
	echo '<tr><th>'.$res1['title'].'</th>';
	if(strcmp($tmp,"0") == 0){
		echo '<th>result not published</th></tr>';
	}
	else{
		echo '<th>'.$row['gpa'] . '</th></tr>';
	}
}
echo '</table></center>';
?>	
</body>
</html>

