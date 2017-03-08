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
$D = array("CSE" => "cse" ,"EEE" => "eee", "ME" => "me" ,"IPE" => "ipe" );
$ddd = $D[$_SESSION['dept']];
$userid = $_SESSION['login_user'];
$cq = "select * from `eresult`.`$ddd` where id = '$yserid'";
$mq = mysql_query($cq);
$table = "course_".$ddd;
$cq = "select * from `eresult`.`$table` where id = '$userid'";
$result = mysql_query($cq);
$year = $result['year'];
$semester = $result['semester'];
$cnt = 0;
while($row = mysql_fetch_array($result)){
	if($row['status'] == 0) {
		header("location:student.php");
	}
	else if($row['gpa'] == 0){
		$tmp = $row['c_id'];
		$cq = "select * from `eresult`.`course` where id = '$tmp'";
		$res = mysql_query($cq);
		if($res['type'] == "Lab"){
			header("location:student.php");
		}
		else if($res['year'] == $year && $res['semester'] == $semester) $cnt++;
	}
}

if($cnt >= 3){
	header("location:student.php");
}
else if($result['carry'] >= '5'){
	header("location:student.php");
}
else{
	
	$semester++;
	if($semester>2){
		$year++;
		$semester = 1;
	}	
	$cq = "update `eresult`.`$dept` SET year = '$year',semester = '$semester' ";
	$mq = mysql_query($cq);
	$cq = "select * from `course` where year = '$year',semester = '$semester' ";
	$mq = mysql_query($cq);
	while($row = mysql_fetch_array($mq)){
			$tmp = $row['c_id'];
			$cq="insert into `eresult`.`$table` (`s_id`,`c_id`,`status`,`gpa`) values('$userid','$tmp','0','0')";
			$result = mysql_query($cq);
	}
	header("location:student.php");
}

?>