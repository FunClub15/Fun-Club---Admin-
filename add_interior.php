<?php
require('header.php');
require_once('../global_declare.php');

global $wpdb;
$gd  = new global_declare();
$con = $gd->connect();


$name="";
$image="";
$category="";

if(isset($_POST['name']) && isset($_POST['fileToUpload']) && isset($_POST['category'])){

$name=$_POST['name'];
$image=$_POST['fileToUpload'];
$category=$_POST['category'];

//$sql = "INSERT INTO `interior_design` (`name`,`image`,`category`) values ($name, $image, $category)";

$sql = "INSERT INTO `interior_design` (`name`,`image`,`category`) values ("$name, $image, $category)";
mysqli_query($con, $sql);


}

?>