<?php
require('header.php');
require_once("../global_declare.php");
$gd	=	new global_declare();
$con	=	$gd->connect();

$con = mysqli_connect("localhost","staffdb2","staffdb2123","shopping_points_revamp");
	 $cat =	"SELECT * FROM `groups` where id=".$_POST['id']; 
	 $get_datas_cat_single	=	$gd->select($con, $cat );
          $queryr = "SELECT menu_id FROM `group_permission` where group_id=".$_POST['id'];
          $groupper=	mysqli_query($con,$queryr); 
	$inarraypermwssion = array();
          while($row = mysqli_fetch_array($groupper,MYSQLI_NUM))
			{
			$inarraypermwssion[] = $row[0];
				$i+=1;
			}
       
$get_id	=	intval($_POST['id']);

if(isset($_POST['submit_btn']))
{
       $group_name =	mysqli_escape_string($con, $_POST['group_name']);

	$menu_permission=	 $_POST['menu_permission'];
        $sql1	=	"UPDATE `groups` SET `group_name`= '".$group_name ."' WHERE `id`=".$get_id;
	$update	=	$gd->update($con, $sql1);	

        $query ="DELETE FROM `group_permission` WHERE `group_id`=".$get_id;
        $del_information = $gd->del($con, $query);

        foreach($menu_permission as $permission){
             $sql2 = "Insert into group_permission values(NUll,'".$get_id."','".$permission."')";        
$insert_id2	=	$gd->insert($con, $sql2);	
         }  
	
	

	
	if(!empty($update))
	{
		$success_error	=	 "<div class='alert alert-success'>
	                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
	                    <strong>Menu Updated Successfully!</strong> .
	             </div>";
	             echo "<script>window.location='view_group.php';</script>";
	}
	else
	{
		$success_error	=	 "<div class='alert alert-danger'>
	                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
	                    <strong>Error!</strong> Please Try again
	             </div>";
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
	            <a href="#" style="color: #666666 !important;">Edit Group</a>
	        </li>
		
	    </ul>
	</div>
	
	<?php echo $success_error; ?>
	
	<form action="edit_group.php" method="POST" enctype="multipart/form-data">
	<input type="hidden" value="<?php echo $_POST['id']?>" name="id" />
		<div class="row" id="store">
			<div class="box col-md-12">
				<div class="box-inner">
					<div class="box-header well" data-original-title="">
						<h2 style="color: #ffffff;"><i class="glyphicon glyphicon-edit #ffffff"></i>Edit Group</h2>

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
								<input type="text" class="form-control" id="group_name" placeholder="" name="group_name" required value="<?php echo (($get_datas_cat_single[0]['group_name'])?($get_datas_cat_single[0]['group_name']):''); ?>">
								<p>(8 words or 65 Characters)</p>
							</div>
						
							<div class="col-md-6">
								<label for="sdesc">Permission:</label><br />
																<?php 
										$cat		=	"SELECT * FROM `menu` where parent_menu <= '0'";
										$cat_results	=	$gd->select($con, $cat);
										foreach($cat_results as $cat_result)
										{ ?>
                                                                                 
 <input type="checkbox" name="menu_permission[]" value="<?php echo $cat_result['id']; ?>" <?php if(in_array($cat_result['id'], $inarraypermwssion)){ ?> checked='checked' <?php } ?> />
<lable><?php echo $cat_result['menu_name']; ?></lable>
                                                                                 
	                                                                          <?php $cat2		=	"SELECT * FROM `menu` where parent_menu =".$cat_result['id'];
										$cat_results2	=	$gd->select($con, $cat2);
foreach($cat_results2 as $cat_result2)
										{ ?>
									<div style="margin-left:20px">

                                                                                  <input type="checkbox" name="menu_permission[]" value="<?php echo $cat_result2['id']; ?>"  <?php if(in_array($cat_result2['id'], $inarraypermwssion)){ ?> checked='checked' <?php } ?> />

<lable><?php echo $cat_result2['menu_name']; ?></lable>
</div>

<?php } ?>
										<?php } ?>

								
							</div>
							
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
