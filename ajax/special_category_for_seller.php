<?php
require_once('../../global_declare.php');
$gd  = new global_declare();
$con = $gd->connect();
/*
for($i=1; $i<=count($_POST['cat_id']); $i++)
{
	$cat_id.=	mysqli_escape_string($con, $_POST['cat_id'][$i]).",";	
}
	$sub_str_cat_id	=	substr($cat_id, 0, -2);
echo "<pre>";
echo $sub_str_cat_id;
echo "</pre>";
*/
$cat_id	=	intval(($_POST['cat_id'])?($_POST['cat_id']):(0));
$sql = "SELECT category_id	FROM `special_category` WHERE seller_id=".$_POST['seller_id']." AND category_id =".$cat_id;

$special_category_check	=	$gd->select($con, $sql);

if($special_category_check != "exists")
{
	$not_approve = "<p>This category requires Special Approval from Admin</p>
	<p>Click OK for further proceed</p>";
        
        $response	=	array(
	'not_approve'	=>	$not_approve,
        'special'       =>      "special"
	);
	echo json_encode($response);

} else if($cat_id){
	$approve = "<p>Please Select any category</p>";
        
        $response	=	array(
	'approve'	=>	$approve,
        'special'       =>      "not_special"
	);
	echo json_encode($response);
}
?>