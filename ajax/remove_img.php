<?php
require_once('../../global_declare.php');
$gd  = new global_declare();
$con = $gd->connect();
$pid = intval($_POST['pro_id']);
echo $query3 = "UPDATE `product` SET `image`='' WHERE id=".$pid;
$gd->update($con, $query3);
?>