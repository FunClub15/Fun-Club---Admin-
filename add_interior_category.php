<?php
require('header.php');
require_once('../global_declare.php');

global $wpdb;
$gd  = new global_declare();
$con = $gd->connect();


$category="";

if(isset($_POST['category'])){

$category=$_POST['category'];

//$sql = "INSERT INTO `interior_design_category` (`name`,`image`,`category`) values ($name, $image, $category)";

$sql = "INSERT INTO `interior_design_category` (`category`) values (`$category`)";
mysqli_query($con, $sql);


}

?>