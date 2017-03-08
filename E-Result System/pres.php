<?php
$cse_status = null;
$eee_status=null;
$r_status = null;
$c_status=null;
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
<div class="under-header">
<form action="" method="post">
<input type="text" name="subNo" value="" placeholder="Subject code" id="subNo"><br>
<p>Department ::
<Input type = 'Radio' Name ='department' value= 'CSE'
<?PHP print $cse_status; ?>
>CSE
<Input type = 'Radio' Name ='department' value= 'EEE' 
<?PHP print $eee_status; ?>
<span style = "color:BLACK" >EEE </span><br>
</p>
<p>Result Type ::
<Input type = 'Radio' Name ='resultType' value= 'Regular'
<?PHP print $r_status; ?>
>Regular
<Input type = 'Radio' Name ='resultType' value= 'Carry/Clearance' 
<?PHP print $c_status; ?>
>Carry/Clearance <br>
</p>

<p class="submit"><input type="submit" name="Submit" value="Submit"></p>
</form>
</div>
</body>
</html>

<?php
session_start();
if( $_SESSION['login_user'] == NULL || strcmp($_SESSION['acc_type'],'teacher')!=0 ){
	header("location:index.php");
}
$var1 = $_POST['subNo'];
$var2 = $_POST['deptNo'];
$DeptName = array("CSE","EEE", "ME","IPE");
$D = array("CSE" => "cse" ,"EEE" => "eee", "ME" => "me" ,"IPE" => "ipe" );
if(isset($_POST['Submit']) ){
	$dept_radio = $_POST['department'];
	$exam_radio = $_POST['resultType'];
	if ($dept_radio == 'CSE') {
		$cse_status = 'checked';
	}
	else if ($dept_radio == 'EEE') {
		$eee_status = 'checked';
	}
	$flag = false;
	foreach($DeptName as $tmp){
		if(strcmp($tmp,$dept_radio) == 0) {
			$flag = true;
			break;	
		}
	}
	if($flag){
		$_SESSION['subNo'] = $var1;
		$_SESSION['deptNo'] = $D[$dept_radio];
		if($exam_radio  == 'Regular'){
			header("location:uploadResultRegular.php");
		}
		else if($exam_radio  == 'Carry/Clearance'){
			header("location:uploadResult.php");
		}
	}
}

?>