<?php
require ('../../global_declare.php');
$gd  = new global_declare();
$con = $gd->connect();
$col="";
if($_POST['get_this']=='sub')
{
$col="subject";
}
elseif($_POST['get_this']=='com'){
$col="comment";
}
if($col!=""){
$query = "SELECT ".$col." FROM `feedback` WHERE status = 1 and feedback_id = ".$_POST['id'];
$get_feedback = $gd->select($con, $query);
if($get_feedback!="exists"){
foreach($get_feedback as $feedback){
	echo $feedback[$col];
} 
}
}
?>