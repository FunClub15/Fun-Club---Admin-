<!--Start Abdul Ahad Khan (23rd Sep, 2015)-->

<?php
require('header.php');
require_once('global_declare.php');
$gd 	=	new global_declare();
$con	=	$gd->connect();

$user_id	=	intval($_POST['user_id']);
$billing_id	=	intval($_POST['billing_id']);

if(isset($_POST['sign_up']))
{
	$dis_name	=	mysqli_escape_string($con, $_POST['dis_name']);
	$address_1	=	mysqli_escape_string($con, $_POST['address_1']);
	$address_2	=	mysqli_escape_string($con, $_POST['address_2']);
	$city_town	=	mysqli_escape_string($con, $_POST['city_town']);
	$state		=	mysqli_escape_string($con, $_POST['state']);
	$postal_code	=	mysqli_escape_string($con, $_POST['postal_code']);
	$country_name	=	mysqli_escape_string($con, $_POST['country_name']);
	$phone_number	=	mysqli_escape_string($con, $_POST['phone_number']);
	$main_product	=	mysqli_escape_string($con, $_POST['main_product']);
	$no_of_product	=	mysqli_escape_string($con, $_POST['no_of_product']);
	$any_brand	=	mysqli_escape_string($con, $_POST['any_brand']);
	
	if(!empty($dis_name) && !empty($address_1) && !empty($city_town) && !empty($state) && !empty($postal_code) && !empty($country_name) && !empty($phone_number)  && !empty($user_id))
	{
		$sql1	=	"Select dis_name from `seller_des` where dis_name ='".$dis_name."'";
		
		$return_arrays	=	$gd->select($con, $sql1);
		
		if($return_arrays == "exists")
		{
			$sql2	=	"UPDATE `seller_des` SET `dis_name`='".$dis_name."',`main_product_cat`=".$main_product.",`any_brand`='".$any_brand."',`no_product`=".$no_of_product." WHERE user_seller_id=".$user_id;
			
			$sql3	=	"UPDATE `seller_address` SET `address_1`='".$address_1."',`address_2`='".$address_2."',`status`=1,`city`='".$city_town."',`state`='".$state."',`postal_code`='".$postal_code."',`country`=".$country_name.",`phone_number`='".$phone_number."' WHERE `user_seller_id`=".$user_id." AND id=".$billing_id;
			
			$update_id2	=	$gd->update($con, $sql2);
			$update_id3	=	$gd->update($con, $sql3);
			
			echo "<script>window.location = 'http://dev.technology-minds.com/funclub/seller_signup_step_7?id=".$user_id."'</script>";
		}
		else
		{
			$user		=	$user_id;
			$billing	=	$billing_id;
		}
	}
	else
	{
		$user		=	$user_id;
		$billing	=	$billing_id;
		echo "<script>window.location = 'http://dev.technology-minds.com/funclub/seller_signup_step_3?id=$user_id';</script>";
	}
}

else if(isset($_POST['skip']))
{
	$user_id	=	intval($_POST['user_id']);
	echo "<script>window.location = 'http://dev.technology-minds.com/funclub/seller_signup_step_7?id=$user_id';</script>";
}

$sql4	=	"SELECT * FROM countries";
$return_arrays4	=	$gd->select($con, $sql4);

$sql5	=	"SELECT * FROM category";
$return_arrays5	=	$gd->select($con, $sql5);

$sql6	=	"SELECT UCASE(fname) as fname, UCASE(lname) as lname FROM `user_seller` where id=".intval($_GET['id']);
$return_arrays6	=	$gd->select($con, $sql6);

$sql7	=	"SELECT `seller_des`.*, category.title FROM seller_des INNER JOIN category ON category.id=seller_des.main_product_cat WHERE seller_des.user_seller_id=".intval($_GET['id']);
$result_arrays7	=	$gd->select($con, $sql7);


echo $sql8	=	"SELECT `seller_address`.*, `credit_card`.*, countries.name FROM credit_card INNER JOIN seller_address ON credit_card.billing_address_id=seller_address.id INNER JOIN countries ON countries.id=seller_address.country WHERE credit_card.user_seller_id=".intval($_GET['id'])." AND credit_card.billing_address_id=".intval($_GET['billing_id']);
$result_arrays8	=	$gd->select($con, $sql8);

?>

<style>
.green { color: green; }

.red { color: red; }
</style>
	      
	      
<script>
function dis_name()
{
	var a = $("#dis_name").val();
	$.ajax({
		type: 'POST',
		url: 'ajax/dis_name',
		data: {a1:a},
	}).done(function(data){
		$("#icon").html(data);
	});
}
</script>
<!--End Abdul Ahad Khan (23rd Sep, 2015)-->



<div class="container-fluid">
<div class="row">
<div class="col-sm-12">
<div class="jumbotron pad" id="jum_3">

<div class="row">
<div class="col-sm-12">
<label id="lab_heading_welcome">welcome <?php foreach($return_arrays6 as $return_array6){ echo $return_array6['fname']." ".$return_array6['lname']; }?></label>
</div>
</div>

<div class="row">
<div class="col-sm-12">
<label id="lab_heading_few_step">Complete a few more steps to finish setting up your selling accounts</label>
</div>
</div>

<div class="row">
<div class="col-sm-12">
<p id="subtitle">If you dont have the requested information available you can skip and return to it later.Your subscription will begin when you finish the step up process </p>
</div>
</div>


</div>
</div>
</div>
</div>


<div class="container-fluid" style="margin-top: 0 !important;">

<div class="row">
<div class="col-sm-12">
<div class="jumbotron pad" id="ss_3">

<div class="row">
<div class="col-sm-12">
<label id="lab_seller_info">Seller Information</label>
</div>
</div>



<div class="row">
<div class="col-sm-12" id="bottom-dotted">
</div>
</div>

<br>
<br>
<div class="row">
	<div class="col-sm-12">
		<div class="col-sm-9">
<form class="form-horizontal " role="form" id="" name="fm" method="POST" action="seller_signup_step_3_edit">
<div class="form-group col-sm-12">
<div class="form-group" >
	<input type="hidden" name="user_id" value="<?php echo (($_GET['id'])?($_GET['id']):($user));?>">
	<input type="hidden" name="billing_id" value="<?php echo (($_GET['billing_id'])?($_GET['billing_id']):($billing));?>">
      <label for="firstname" class="col-sm-6 control-label">* Display Name:</label>
      <div class="col-sm-4">
        <input type="text" class="form-control" id="dis_name" placeholder="Display Name" name="dis_name" value="<?php echo (($result_arrays7[0]['dis_name'])?($result_arrays7[0]['dis_name']):('')); ?>" required>
      </div><em id="check_aval"><a onClick="dis_name()">Check Availablity</a></em><span id="icon"></span>	      
   </div>
   
	<hr class="h_color">
   
   <div class="form-group" >
      <label for="firstname" class="col-sm-6 control-label">* Address:</label>
      <div class="col-sm-4">
         <input type="text" class="form-control" id="address_1" placeholder="" name="address_1" value="<?php echo (($result_arrays8[0]['address_1'])?($result_arrays8[0]['address_1']):('')); ?>" required>
      </div>
   </div>
   <hr class="h_color">
    <div class="form-group" >
      <label for="firstname" class="col-sm-6 control-label">Address line 2:</label>
      <div class="col-sm-4">
         <input type="text" class="form-control" id="address_2" placeholder="" name="address_2" value="<?php echo (($result_arrays8[0]['address_2'])?($result_arrays8[0]['address_2']):('')); ?>" required>
      </div>
   </div>
   <hr class="h_color">
   <div class="form-group" >
      <label for="firstname" class="col-sm-6 control-label">* City/Town:</label>
      <div class="col-sm-4">
         <input type="text" class="form-control" id="city_town" placeholder="" name="city_town" value="<?php echo (($result_arrays8[0]['city'])?($result_arrays8[0]['city']):''); ?>" required>
      </div>
   </div>
   <hr class="h_color">
   <div class="form-group" >
      <label for="firstname" class="col-sm-6 control-label">* State/Region:</label>
      <div class="col-sm-4">
         <input type="text" class="form-control" id="state" placeholder="" name="state" value="<?php echo (($result_arrays8[0]['state'])?($result_arrays8[0]['state']):''); ?>" required>
      </div>
   </div>
   <hr class="h_color">
   <div class="form-group" >
      <label for="firstname" class="col-sm-6 control-label">* Postal Code:</label>
      <div class="col-sm-3">
         <input type="text" class="form-control" id="postal_code" placeholder="" name="postal_code" value="<?php echo (($result_arrays8[0]['postal_code'])?($result_arrays8[0]['postal_code']):''); ?>" required>
      </div>
   </div>
   <hr class="h_color">
   <div class="form-group" >
      <label for="firstname" class="col-sm-6 control-label">* Country:</label>
      <div class="col-sm-3">
         <select class="form-control"  name="country_name" required>
          <option value="0">----Select----</option>
          <?php
          foreach($return_arrays4 as $country)
          {
          	if($country['id'] == $result_arrays8[0]['country'])
          	{
          ?>
          <option value="<?php echo $country['id'];?>" selected><?php echo $country['country_name'];?></option>
          <?php } else{ ?>
          <option value="<?php echo $country['id'];?>"><?php echo $country['country_name'];?></option>
          <?php } } ?>
         </select>
      </div><!--<em id="extenssion"><a>Add Extenssion</a></em>-->
   </div>
   <hr class="h_color">
   <div class="form-group" >
      <label for="firstname" class="col-sm-6 control-label">* Phone Number:</label>
      <div class="col-sm-3">
         <input type="text" class="form-control" id="phone_number" placeholder="" name="phone_number" value="<?php echo (($result_arrays8[0]['phone_number'])?($result_arrays8[0]['phone_number']):''); ?>" required>
      </div>
   </div>
   <hr class="h_color">
    <div class="form-group" >
	<label for="firstname" class="col-sm-6 control-label">Main product category:</label>
		<div class="col-sm-4">
			<select class="form-control" name="main_product">
				<option value="0">----This is Optional----</option>
				<?php
			        foreach($return_arrays5 as $category)
			        {
			        	if($category['id'] == $result_arrays7[0]['main_product_cat'])
			        	{
			        ?>
			        <option value="<?php echo $category['id'];?>" selected><?php echo $category['title'];?></option>
			        <?php } else{ ?>
			        <option value="<?php echo $category['id'];?>"><?php echo $category['title'];?></option>
			        <?php } } ?>
			</select>
		</div>
	</div>
	<hr class="h_color">
	<div class="form-group" >
		<label for="firstname" class="col-sm-6 control-label">Number of Product you plan to sell:</label>
		<div class="col-sm-3">
			<select class="form-control" name="no_of_product">
				<option value="0">-This is Optional-</option>
				<option value="1-5">1-5</option>
				<option value="6-10">6-10</option>
				<option value="11-15">11-15</option>
				<option value="16-20">16-20</option>
				<option value=">500">>500</option>
			</select>
		</div>
	</div>
	<hr class="h_color">
	<div class="form-group" >
		<label for="firstname" class="col-sm-6 control-label">Do you own any brand for the Product you are selling:</label>
		<div class="col-sm-3">
			<select class="form-control" name="any_brand">
				<option value="0">-This is Optional-</option>
				<option value="YES">YES</option>
				<option value="NO">NO</option>
			</select>
		</div>
	</div>
	<hr class="h_color">
   </div>
   <div class="row">
<div class="col-sm-12">
<div class="col-sm-6">
<em><a href="#">Goto setup summary</a></em>
</div>
<div class="col-sm-6 ">
<button type="submit" class="btn btn-default pull-right" id="btn_skip" name="skip">Skip Setup</button>
<button type="submit" class="btn btn-primary pull-right" id="btn_save_continue" name="sign_up">Save & continue</button>
</div>
</div>
</div>
</form>
</div><!-- end of left side---->


<div class="col-sm-3">

<div class="row">
<div class="col-sm-12">
<div id="small_box">
<br>
<div class="row">
<div class="col-sm-12">
<div class="progress">
  <span class="meter" ></span>
</div>
<p id="setup">Your account setup is 20% complete (1/5)</p>
</div>
</div>
</div>
</div>
</div>
<br>
<div class="row">
<div class="col-sm-12">

<div id="second_white_box">
<div id="head">
<label id="faq">FAQs</label>
</div>
<div class="row">
<div class="col-sm-11 col-sm-offset-1">
<br>
<em><a href="#" class="pad">What is display name?</a></em>
<br>
<br>
<em><a href="#" class="pad">Can i change my display name later?</a></em>
<br>
<br>
<em><a href="#" class="pad">Should i include my country code.If i provide an international (Non-USA) phone number?</a></em>
<br>
<br>
<em><a href="#" class="pad">Why do i need to need to provide my product cateroy?</a></em>
<br>
<br>
<em><a href="#" class="pad">Why do i need to need to provide my product cateroy?</a></em>
<br>
<br>
<em><a href="#" class="pad">Why do i need to need to provide the number of products i plan to list.</a></em>
<br>
<br>
</div>
</div>
</div>

</div>
</div>
<br>

<div class="row">

<div class="col-sm-12">
<div id="third_white_box">

<div id="head2">
<label id="faq">Services</label>
</div>
<br>
<div class="row">
<div class="col-sm-10 col-sm-offset-1">
<a><p id="selling_on" class="pad">Selling on funclubs-Professional</p></a>
<a href="" class="pad">Change</a>
<br>
<br>
</div>
</div>




</div>
</div>
</div>


</div><!-- end of right side---->


</div>
</div>




</div>
</div>
</div>

</div>
<!---- FOOTER---------->


<?php

require('footer.php');

?>