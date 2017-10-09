<?php
include('../../global_declare.php');

//echo $_POST['cat_title'];

$gd=new global_declare();

$con = $gd->connect();

$sql= "SELECT title FROM `category` WHERE `title`='".$_POST['cat_title']."' ";
$result = $gd->select($con, $sql);

$exists="";

if($result != "exists")
{
     $exists="exists";
}

else{
     $exists="not_exists";
}

echo $exists;

?>