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
$var = $_SESSION['stdno'];
echo '<center><table width="600">';
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

<center><input style = "margin: 20px"type="submit" name="Submit" value="Add Student(s)" onclick="return check()";></center>
</form>

<?php
$cn=mysql_connect("localhost","root","");

if(!$cn) 
{
	die("could not connect".mysql_error());
}
mysql_select_db("eresult",$cn);

$tt = $_SESSION['stdno'];
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
	$flag = true;
	$dept = $_SESSION['login_user'];
	for($i = 0;$i<$tt;$i++){
		$cq="INSERT INTO  `eresult`.`cse` (`id` ,`firstName` ,`lastName` ,`cgpa` ,`password` ,`carry` ,`sumOfcredit` ,`year` ,`semester`) VALUES ('$id[$i]', '$fname[$i]', '$lname[$i]', '0', '$id[$i]','0','0','1','1');";
		$mq=mysql_query($cq,$cn);	
		$cq="SELECT * FROM  `eresult`.`course` where department = '$dept' and year = '1' and semester = '1' ";
		$mq=mysql_query($cq,$cn);
		if(!$mq){
			$flag = false;
			echo "Could not insert result ".mysql_error();
			for(;$i>=0;$i--){
				$cq="delete from `eresult`.`cse` where id=$id[$i];";
				$mq=mysql_query($cq,$cn);
			}
			break;
		}
		while($row = mysql_fetch_array($mq)){
			$tmp = $row['id'];
			$cq="insert into `eresult`.`course_cse` (`s_id`,`c_id`,`status`,`gpa`) values('$id[$i]','$tmp','0','0')";
			$tmp = mysql_query($cq,$cn);
		}
		
	}
	
	if($flag){
		header("location:admin.php");
	}
}

mysql_close($cn);
?>
</section>
</body>
</html>


