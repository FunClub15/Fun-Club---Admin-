<?php
session_start();
require_once ('../global_declare.php');
$gd  = new global_declare();
$con = $gd->connect();	

include('include/security.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Funclub</title>
	
	<!-- The styles -->
	<link id="bs-css" href="css/bootstrap-cerulean.min.css" rel="stylesheet">
	
	<link href="css/charisma-app.css" rel="stylesheet">
	
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
	<!--ckeditor-->
	<script src="//cdn.ckeditor.com/4.5.9/full/ckeditor.js"></script>
	<!--<script src="ckeditor/samples/js/sample.js"></script>
	<link rel="stylesheet" href="ckeditor/samples/css/samples.css">
	<link rel="stylesheet" href="ckeditor/samples/toolbarconfigurator/lib/codemirror/neo.css">-->

	<!--<link rel="stylesheet" href="ckeditor/sample.css">-->
	<!--ckeditor-->
	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<style>
		#wrapper { 
			width:595px;
			margin:0 auto;
		}
		legend {
			margin-top: 20px;
		}
		#attribution {
			font-size:12px;
			color:#999;
			padding:20px;
			margin:20px 0;
			border-top:1px solid #ccc;
		}
		#O_o { 
			text-align: center; 
			background: #33577b;
			color: #b4c9dd;
			border-bottom: 1px solid #294663;
		}
		#O_o a:link, #O_o a:visited {
			color: #b4c9dd;
			border-bottom: #b4c9dd;
			display: block;
			padding: 8px;
			text-decoration: none;
		}
		#O_o a:hover, #O_o a:active {
			color: #fff;
			border-bottom: #fff;
			text-decoration: none;
		}
		@media only screen and (max-width: 620px), only screen and (max-device-width: 620px) {
			#wrapper {
				width: 90%;
			}
				legend {
				font-size: 24px;
				font-weight: 500;
			}
		}

		.chosen-container-multi .chosen-choices li.search-field input[type="text"] {
			height: 30px !important;
		}

		.chosen-container-multi .chosen-choices li.search-choice {
			line-height: 20px;
		}

		.chosen-container-single .chosen-single {
			height: 36px !important;
			line-height: 35px !important;
		}

                .navbar-brand img {
                        height: auto !important;
    margin-top: 0px !important;
    width: 99px;
                }

                .navbar-inner {
                        padding-top: 0px !important;
                        height: 0px !important;
                }

                #msg_panel .panel-primary{
                        font-size: 14px !important;
                }
.navbar-default{
background-image:url('img/head.jpg');
}
	</style>

</head>

<body onload="change()" style="background: #f9f9f9;">
	<!-- topbar starts -->
	<div class="navbar navbar-default" role="navigation">
		<div class="navbar-inner">
			<button type="button" class="navbar-toggle pull-left animated flip">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			
<?php 

$site_query	=	"SELECT * FROM `site_setting`";
$site_data	=	$gd->select($con, $site_query);

?>
			<a class="navbar-brand" href="index">
				<img alt="funclubs" src="../<?php if($site_data != 'exists'){ echo $site_data[0]['logo_path']; } ?>" class="hidden-xs"/>
			</a>

			<!-- user dropdown starts -->
			<div class="btn-group pull-right">
				<button class="btn btn-default dropdown-toggle" data-toggle="dropdown">
					<i class="glyphicon glyphicon-user"></i>
					<span class="hidden-sm hidden-xs"> 
					
					<?php
					if(isset($_SESSION['seller_id'])){
						$query="SELECT `fullname` FROM `user_seller` WHERE `id` = ".$_SESSION['seller_id'];
						$get_seller = $gd->select($con, $query);
						echo $get_seller[0]['fullname'];
					}
					?>
					
					</span>
					<span class="caret"></span>
				</button>
				<ul class="dropdown-menu">
					<li><a href="include/logout.php">Logout</a></li>
				
				</ul>
			</div>

		</div>
	</div>

		
	<!-- topbar ends -->
	<div class="ch-container">
		<div class="row">
			<!-- left menu starts -->
			<div class="col-sm-2 col-lg-2">
				<div class="sidebar-nav">
					<div class="nav-canvas">
						<div class="nav-sm nav nav-stacked">

						</div>
						<ul class="nav nav-pills nav-stacked main-menu">
							<li class="nav-header">Main</li>
							<li><a href="index"><i class="glyphicon glyphicon-home"></i> Dashboard</a></li>
                                                        <li class="accordion"><a href="#" class="ajax-link">View Members</a>
      <ul class="nav nav-pills nav-stacked" style="display: block;">
         <li><a href="view_members.php?role=0">FC Members</a></li>
         <li><a href="view_members.php?role=3">Club Owners</a></li>
         <li><a href="view_members.php?role=4">Party Promoters</a></li>
         
</ul>
                                                        </li>
							<li><a href="interior_design.php">Interior Design</a></li>
                                                        <li><a href="interior_design_category.php">Interior Design Category</a></li>
	 <li class="accordion"><a href="view_menu.php" class="ajax-link">Menu</a>
      <ul class="nav nav-pills nav-stacked">
         <li><a href="view_menu.php">View Menu</a></li>
         <li><a href="add-menu.php">Add Menu</a></li>
         
</ul>
 </li>
<li class="accordion"><a href="view_group.php" class="ajax-link">Groups</a>
      <ul class="nav nav-pills nav-stacked">
         <li><a href="view_group.php">View Group</a></li>
         <li><a href="add-group.php">Add Group</a></li>
         
</ul>
 </li>
<li><a href="add-user.php">Add User</a> </li>
	
					<li><a >Content</a></li>								
						<li><a >Events</a></li>								
						<li><a >Souvenirs</a></li>								
						</ul>
						<!--<label id="for-is-ajax" for="is-ajax"><input id="is-ajax" type="checkbox"> Ajax on menu</label>-->
					</div>
				</div>
			</div>
			<!--/span-->