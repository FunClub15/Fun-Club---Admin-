<?php
session_start();
// File used in Seller Panel for sending messages to buyer -->
require_once('../../global_declare.php');
$gd  = new global_declare();
$con = $gd->connect();
$seller_id = $_SESSION['seller_id'];
$seller_name = $_SESSION['seller_name'];

$msg 			= mysqli_real_escape_string($con,$_POST['msg']);
$chat_id 		= mysqli_real_escape_string($con,$_POST['chat_id']);
$date			= date("Y-m-d");
$time			= date("h:i:sa");

if(!empty($msg) && !empty($chat_id)){
$query = "INSERT INTO `buyer_seller_chat_reply`(`chat_id`, `seller_id`, `reply_by`, `reply`, `date`, `time`) VALUES (".$chat_id.",".$seller_id.",'".$seller_name."','".$msg."','".$date."','".$time."')";
	
$new_msg = $gd->insert($con, $query);
if($new_msg){
       $query2 = "SELECT ub.email FROM `buyer_seller_chat` bsc inner join `user_buyer` ub on bsc.chat_buyer=ub.id where bsc.id=".$chat_id;
       $buyer = $gd->select($con, $query2);
       $subject = "funclubs.com Message Notification";
       $from = "seller@funclubs.com";
       $body="<html><head>
       <title>Notification</title>
</head><body>
Hey,<br>You have a reply from seller.<br> <a href='".$gd->base_url."buyer_login'>click here</a> to login to your account to see the message.<br>
Thanks<br>
Regards,<br>
Shopping Points Inc.
</body></html>";
        $gd->send_email($buyer['0']['email'],$from,$body,$subject,$path='../../');
	echo "
		<div class='alert alert-success'>
			 <button type='button' class='close' data-dismiss='alert'>&times;</button>
			 <strong>Message has been sent.</strong>
		</div>
	";
}
else{
	echo "
		<div class='alert alert-danger'>
			 <button type='button' class='close' data-dismiss='alert'>&times;</button>
			 <strong>Error!</strong> Please Try again
		</div>
	";
}
}
	
?>