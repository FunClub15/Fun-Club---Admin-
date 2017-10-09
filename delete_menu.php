<?php
require ('../global_declare.php');

$gd  = new global_declare();
$con = $gd->connect();
$id=$_POST['id'];
if(isset($_POST['delete']))
{       
        //$id=$_POST['id'];
        $query ="DELETE FROM `menu` WHERE `id`=".$id;
        $del_information = $gd->del($con, $query);
	if($del_information)
	{
            echo "<script>Record Deleted</script>";
	}
	else{
            echo "<script>Record Not Deleted</script>";
	}
        echo "<script>location.href='view_menu.php';</script>";
}

?>
<!--End Muhammad Khurram 07th Oct, 2015-->