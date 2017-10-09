<?php
require('header.php');
require_once("../global_declare.php");
$gd	=	new global_declare();
$con	=	$gd->connect();

if(isset($_POST['submit_btn']))
{

	$group_name =	mysqli_escape_string($con, $_POST['group_name']);

	$menu_permission=	 $_POST['menu_permission'];
$sql1 = "Insert into groups values(NUll,'".$group_name."')";
	$insert_id1	=	$gd->insert($con, $sql1);	
        foreach($menu_permission as $permission){
             $sql2 = "Insert into group_permission values(NUll,'".$insert_id1."','".$permission."')";        
$insert_id2	=	$gd->insert($con, $sql2);	
         }  
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
	                    <strong>Menu Added Successfully!</strong> .
	             </div>";
         }elseif(isset($_POST['submit_btn']) && empty($insert_id1)){
                 
                     echo $success_error	=	 "<div class='alert alert-danger'>
	                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
	                    <strong>All Fileds Required!</strong> .
	             </div>";
         }
 	?>
	
	<form action="add-group.php" method="POST" enctype="multipart/form-data">
				
		<div class="row" id="store">
			<div class="box col-md-12">
				<div class="box-inner">
					<div class="box-header well" data-original-title="">
						<h2 style="color: #ffffff;"><i class="glyphicon glyphicon-edit #ffffff"></i>Add Group</h2>

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
						<div class="form-group col-md-12">
							<div class="col-md-6">
								<label for="name">Group Name:</label>
								<input type="text" class="form-control" id="group_name" placeholder="" name="group_name" required>
								<p>(8 words or 65 Characters)</p>
							</div>
						   
							<div class="col-md-6">
                                                                 
								<label for="sdesc">Permission:</label>
                                                                <div style="height:150px; overflow:auto">
								<?php 
										$cat		=	"SELECT * FROM `menu` where parent_menu <= '0'";
										$cat_results	=	$gd->select($con, $cat);
										foreach($cat_results as $cat_result)
										{ ?>
                                                                                 
 <input type="checkbox" name="menu_permission[]" value="<?php echo $cat_result['id']; ?>" />
<lable><?php echo $cat_result['menu_name']; ?></lable>
                                                                                 
	                                                                          <?php  $cat2		=	"SELECT * FROM `menu` where parent_menu =".$cat_result['id'];
										$cat_results2	=	$gd->select($con, $cat2);
foreach($cat_results2 as $cat_result2)
										{ ?>
									<div style="margin-left:20px">

                                                                                  <input type="checkbox" name="menu_permission[]" value="<?php echo $cat_result2['id']; ?>" />

<lable><?php echo $cat_result2['menu_name']; ?></lable>
</div>

<?php } ?>
										<?php } ?>
									</select>
								
							</div>
			<div class="clearfix"></div>				
						</div>
<div class="clearfix"></div>
							 
						</div>
<div class="clearfix"></div>
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