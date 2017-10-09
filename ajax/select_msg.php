<?php
session_start();
// Muhammad Khurram - 18 Nov 2015 -->
// File used in Seller Panel -->
require_once('../../global_declare.php');
$gd  = new global_declare();
$con = $gd->connect();
$seller_id = $_SESSION['seller_id'];
$seller_name = $_SESSION['seller_name'];
$limit = mysqli_real_escape_string($con,$_POST['limit']);
$chat_id = mysqli_real_escape_string($con,$_POST['chat_id']);
if(!empty($limit)){
$query3 = "SELECT buyer_seller_chat.subject, buyer_seller_chat_reply.* FROM `buyer_seller_chat_reply` inner join `buyer_seller_chat` on buyer_seller_chat.id = buyer_seller_chat_reply.chat_id WHERE buyer_seller_chat_reply.chat_id = ".$chat_id." ORDER BY buyer_seller_chat_reply.id DESC LIMIT ".$limit;
$get_detail = $gd->select($con, $query3);
?>
<div class="panel panel-primary" style="margin-top: 5px;">
	<div class="panel-heading"><?php echo $get_detail[0]['subject']; ?></div>
	<div class="panel-body">
		<?php foreach($get_detail as $detail){
		if($detail['seller_id'] != 0){ ?>
		<div class="text-left">
		<span class="label label-success"><?php echo $detail['reply_by']; ?></span>
		<span><?php echo $detail['date']." ".$detail['time']; ?></span><br>
		<p><?php echo $detail['reply']; ?></p>
		</div>
		<?php }
		if($detail['seller_id'] == 0){
		?>
		<div class="text-right">
		<span class="label label-success"><?php echo $detail['reply_by']; ?></span>
		<span><?php echo $detail['date']." ".$detail['time']; ?></span><br>
		<p><?php echo $detail['reply']; ?></p>
		</div>
		<?php } } ?>
		<button type="button" class="btn btn-primary btn-sm btn-block" id="limit_no" name="save">LOAD MORE</button>
	</div>
</div>
<?php } ?>
