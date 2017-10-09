<?php
require ('../../global_declare.php');
$gd  = new global_declare();
$con = $gd->connect();

$query1 = " SELECT * FROM `zone` WHERE `country_id`=".$_POST['con_id'];
$get_zones = $gd->select($con, $query1); 
foreach($get_zones as $zone){
	echo "<option value ='".$zone['id']."'>".$zone['zone_name']."</option>";
} 
?>