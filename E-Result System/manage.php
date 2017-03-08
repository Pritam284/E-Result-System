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
	
	<div class="intro-header">

        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="intro-message">
						<h1>Admin</h1>
                        <h2>Computer Science & Technology</h2>
                        <hr class="intro-divider">
                        <ul class="list-inline intro-social-buttons">
                            <li><a href="managesub.php" class="btn btn-default btn-lg"><i class="fa fa-star fa-fw"></i> <span class="network-name">Manage Subject</span></a>
                            </li>
                            <li><a href="managestu.php" class="btn btn-default btn-lg"><i class="fa fa-leaf fa-fw"></i> <span class="network-name">Manage Student</span></a>
                            </li>
					    </ul>
                    </div>
                </div>
            </div>

        </div>
</body>
</html>


<?php

session_start();
echo $_SESSION['login_user'];
if( $_SESSION['login_user'] == NULL || strcmp($_SESSION['acc_type'],'admin')!=0 ){
	header("location:index.php");
}
?>