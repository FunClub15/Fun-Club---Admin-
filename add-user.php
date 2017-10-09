<?php
require('header.php');
require_once("../global_declare.php");
$gd	=	new global_declare();
$con	=	$gd->connect();

if(isset($_POST['submit_btn']))
{

	
	$fname = mysqli_real_escape_string($con,$_POST['fname']);
	$email = mysqli_real_escape_string($con,$_POST['email']);
	$password = mysqli_real_escape_string($con,md5($_POST['password']));
	$tel = mysqli_real_escape_string($con,$_POST['cell_number']);
	$status = mysqli_real_escape_string($con,$_POST['status']);
        $group= mysqli_real_escape_string($con,$_POST['group']);
	
	$sql1 = "Insert into user_seller (id,fullname,email,password,cell_number,status,role) values(NUll,'".$fname."','".$email."','".$password."','".$tel."','".$status."','".$group."')";
	$insert_id1	=	$gd->insert($con, $sql1);	
}
?>


<!--End Abdul Ahad Khan 30th Sep, 2015
-->
<div id="content" class="col-lg-10 col-sm-10">
	<!-- content starts -->
	<div>
	    <ul class="breadcrumb">
	        <li>
	            <a href="index" style="color: #666666 !important;">Home</a>
	        </li>
	        <li>
	            <a href="#" style="color: #666666 !important;">Add Menu</a>
	        </li>
	    </ul>
	</div>
	
	<?php 
	if(!empty($insert_id1)){
		     
                     echo $success_error	=	 "<div class='alert alert-success'>
	                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
	                    <strong>User Added Successfully!</strong> .
	             </div>";
         }elseif(isset($_POST['submit_btn']) && empty($insert_id1)){
                 
                     echo $success_error	=	 "<div class='alert alert-danger'>
	                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
	                    <strong>All Fileds Required!</strong> .
	             </div>";
         }
 	?>
	
	<form action="add-user.php" method="POST" enctype="multipart/form-data">
				
		<div class="row" id="store">
			<div class="box col-md-12">
				<div class="box-inner">
					<div class="box-header well" data-original-title="">
						<h2 style="color: #ffffff;"><i class="glyphicon glyphicon-edit #ffffff"></i>Add Menu</h2>

						<div class="box-icon">
							<!--<a href="#" class="btn btn-setting btn-round btn-default"><i
									class="glyphicon glyphicon-cog"></i></a>-->
							<a href="#" class="btn btn-minimize btn-round btn-default"><i
									class="glyphicon glyphicon-chevron-up"></i></a>
							<!--<a href="#" class="btn btn-close btn-round btn-default"><i
									class="glyphicon glyphicon-remove"></i></a>-->
						</div>
					</div>
					<div class="box-content"  style="font-size: 11px; color: #666666;">
						<div class="form-group">
						<label for="">Full Name:</label>
						<input type="text" class="form-control" id="" name="fname" value="<?php if(!empty($get_buyer[0]['fullname'])) { echo $get_buyer[0]['fullname'];} ?>">
						
					</div>
					
					<div class="form-group">
						<label for="email">Email:</label>
						<input type="email" class="form-control" id="" name="email" value="<?php if(!empty($get_buyer[0]['email'])) { echo $get_buyer[0]['email'];} ?>">
					</div>
					<div class="form-group">
						<label for="email">Password:</label>
						<input type="text" class="form-control" id="" name="password" value="">
					</div>
					
<div class="form-group">
						<label for="email">Telephone:</label>
						<input type="text" class="form-control" id="" name="cell_number" value="<?php if(!empty($get_buyer[0]['cell_number'])) { echo $get_buyer[0]['cell_number'];} ?>">
					</div>
<div class="form-group">
						<label for="email">Group:</label>
                                               <select class="form-control" name="group">
<?php 
$cat		=	"SELECT * FROM `groups`";
										$cat_results	=	$gd->select($con, $cat);
										foreach($cat_results as $cat_result)
										{ ?>
                                                    <option value="<?php echo $cat_result['id'] ?>"><?php echo $cat_result['group_name'] ?></option>
    <?php } ?>
                                               </select>
						
					</div>
					
<div class="form-group">
						<label for="">Status:</label>
						<select class="form-control" id="" name="status">
							<?php
							if(!empty($get_buyer[0]['status'])==1) 
							{ 
								echo "<option selected value='".$get_buyer[0]['status']."'>Active</option>";
							}
							else{
								echo "<option selected value='".$get_buyer[0]['status']."'>Inactive</option>";
							}
							?>
							<option value="1">Active</option>
							<option value="0">Inactive</option>
						</select>
					</div>
					
					
<div class="clearfix"></div>
						</div>	 
						</div>
		</div>
						<div class="form-group col-md-12">
							<div class="col-md-12">
								<input type="submit" class="btn btn-danger pull-right" style="margin-left: 5px;" name="submit_btn" value="Submit" />
							</div>
						</div>
					</div>
				</div>
		</div>
			</div>
			<!--/span-->
		</div><!--/row-->
	</form>
</div><!--/#content.col-md-0-->

</div>

<?php
include("date_lib.php");
include_once("footer.php");
?>

<script>

function reward_as_price()
{
	$("#reward_points").val($("#our_price").val());
}

</script>