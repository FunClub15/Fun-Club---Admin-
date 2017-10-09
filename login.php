<?php
error_reporting(0);
require ('../global_declare.php');
session_start();
unset($_SESSION['seller_id'], $_SESSION['seller_cat_id'], $_SESSION['role']);
session_destroy();

$gd  = new global_declare();
$con = $gd->connect();
$error1="";
$error2="";
if(isset($_POST['login']))
{

	$email = $_POST['email'];

	$pwd = md5($_POST['pwd']);
	//echo $pwd;
	$query = "SELECT user_seller.*, user_seller.fullname, user_seller.id AS seller_id ";
	$query .= "FROM `user_seller` ";
	$query .= "WHERE user_seller.email = '".$email."'";

	$get_seller = $gd->select($con, $query);
	foreach($get_seller as $seller){

		if($seller['email'] == $email && $seller['password'] == $pwd){
			if($seller['status'] == 1){

				session_start();
				$_SESSION['seller_id']        	= $seller['seller_id'];
				
				$_SESSION['role']      		= $seller['role'];
				$_SESSION['seller_name']      	= $seller['fullname'];
				echo "<script>location.href='index';</script>";
			}
			else{
				$error2 = "Your email has blocked by Admin";
			}
		}
		else{
			$error1 = "Email and Password wrong";
		}
	}
}

elseif(isset($_GET['id']))
{
        $query = "SELECT user_seller . * , user_seller.id AS seller_id ";
	$query .= "FROM `user_seller` ";
	$query .= "WHERE user_seller.id = ".intval($_GET['id']);
	
	$get_seller = $gd->select($con, $query);
	foreach($get_seller as $seller){
		//echo $pwd;
		//echo "<br>";
		///echo $seller['password'];
		if($seller['seller_id'] == intval($_GET['id']))
		{
			session_start();
			$_SESSION['seller_id']        	= $seller['seller_id'];
			
			$_SESSION['role']      		= $seller['role'];
			
			if($_SESSION['role']==2)
			{
				$_SESSION['admin_login']      	= intval($_GET['admin']);
			}

                        else
                        {
                                $_SESSION['admin_login'] = 0;
                        }

				
			echo "<script>location.href='index.php';</script>";
		}
		else{
			$error1 = "Email and Password wrong";
		}
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Login | Fun Club</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The styles -->
    <link id="bs-css" href="css/bootstrap-cerulean.min.css" rel="stylesheet">
    <link href="css/charisma-app.css" rel="stylesheet">
    <link href='bower_components/fullcalendar/dist/fullcalendar.css' rel='stylesheet'>
    <link href='bower_components/fullcalendar/dist/fullcalendar.print.css' rel='stylesheet' media='print'>
    <link href='bower_components/chosen/chosen.min.css' rel='stylesheet'>
    <link href='bower_components/colorbox/example3/colorbox.css' rel='stylesheet'>
    <link href='bower_components/responsive-tables/responsive-tables.css' rel='stylesheet'>
    <link href='bower_components/bootstrap-tour/build/css/bootstrap-tour.min.css' rel='stylesheet'>
    <link href='css/jquery.noty.css' rel='stylesheet'>
    <link href='css/noty_theme_default.css' rel='stylesheet'>
    <link href='css/elfinder.min.css' rel='stylesheet'>
    <link href='css/elfinder.theme.css' rel='stylesheet'>
    <link href='css/jquery.iphone.toggle.css' rel='stylesheet'>
    <link href='css/uploadify.css' rel='stylesheet'>
    <link href='css/animate.min.css' rel='stylesheet'>
    <!-- jQuery -->
    <script src="bower_components/jquery/jquery.min.js"></script>
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <style>
      #fp:hover{
       color:#fff;
       text-decoration:none;
      }
    </style>
</head>
<body class="loginBG">
<div class="ch-container">
    <div class="row">
        
    <div class="row">
        <div class="col-md-12 center login-header">
            <h2>Welcome to Fun Club</h2>
        </div>
        <!--/span-->
    </div><!--/row-->

    <div class="row">
        <div class="well col-md-4 center login-box">
            <!--<div class="alert alert-info">
                Please login with your Email and Password.
            </div>-->
            <form class="form-horizontal" action="login.php" method="post">
                <fieldset>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-user red"></i></span>
                        <input type="email" class="form-control" name="email" placeholder="email" required>
                    </div>
                    <div class="clearfix"><p style="color: red; font-size:12px;"><?php echo $error2; ?></p></div><br>
                    <div class="input-group input-group-lg">
                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock red"></i></span>
                        <input type="password" class="form-control" name="pwd" placeholder="Password" required>
                    </div>
                    <div class="clearfix"><p style="color: red; font-size:12px;"><?php echo $error1; ?></p></div>
                    <div class="input-prepend">
                        <label class="remember" for="remember"><input type="checkbox" id="remember"> Remember me</label>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <label class="remember" for="remember"><a href="seller_forgot_pwd.php" id="fp">Forgot your password?</a></label>
                    </div>
                    <div class="clearfix"></div>
                    <p class="center col-md-5">
                        <input type="submit" name="login" class="btn btn-primary" value="Login">
                    </p>
                </fieldset>
            </form>
        </div>
        <!--/span-->
    </div><!--/row-->
</div><!--/fluid-row-->
</div><!--/.fluid-container-->
<!-- external javascript -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- library for cookie management -->
<script src="js/jquery.cookie.js"></script>
<!-- calender plugin -->
<script src='bower_components/moment/min/moment.min.js'></script>
<script src='bower_components/fullcalendar/dist/fullcalendar.min.js'></script>
<!-- data table plugin -->
<script src='js/jquery.dataTables.min.js'></script>
<!-- select or dropdown enhancer -->
<script src="bower_components/chosen/chosen.jquery.min.js"></script>
<!-- plugin for gallery image view -->
<script src="bower_components/colorbox/jquery.colorbox-min.js"></script>
<!-- notification plugin -->
<script src="js/jquery.noty.js"></script>
<!-- library for making tables responsive -->
<script src="bower_components/responsive-tables/responsive-tables.js"></script>
<!-- tour plugin -->
<script src="bower_components/bootstrap-tour/build/js/bootstrap-tour.min.js"></script>
<!-- star rating plugin -->
<script src="js/jquery.raty.min.js"></script>
<!-- for iOS style toggle switch -->
<script src="js/jquery.iphone.toggle.js"></script>
<!-- autogrowing textarea plugin -->
<script src="js/jquery.autogrow-textarea.js"></script>
<!-- multiple file upload plugin -->
<script src="js/jquery.uploadify-3.1.min.js"></script>
<!-- history.js for cross-browser state change on ajax -->
<script src="js/jquery.history.js"></script>
<!-- application script for Charisma demo -->
<script src="js/charisma.js"></script>
</body>
</html>