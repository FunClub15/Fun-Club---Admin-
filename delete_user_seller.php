<?php

require_once("../global_declare.php");
$gd = new global_declare();
$con	=	$gd->connect();

$sql_data1		=	"DELETE FROM `user_seller` WHERE id=".intval($_GET['id']);
$result_arrays_data1	=	$gd->del($con, $sql_data1);


$sql_data2		=	"DELETE FROM `seller_des` WHERE user_seller_id=".intval($_GET['id']);
$result_arrays_data2	=	$gd->del($con, $sql_data2);


$sql_data3		=	"DELETE FROM `seller_address` WHERE user_seller_id=".intval($_GET['id']);
$result_arrays_data3	=	$gd->del($con, $sql_data3);

if(!empty($result_arrays_data1))
{
	echo "<script>window.location='view_sellers';</script>";
}

?>
