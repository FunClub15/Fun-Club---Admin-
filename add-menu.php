<?php
require('header.php');
require_once("../global_declare.php");
$gd	=	new global_declare();
$con	=	$gd->connect();

if(isset($_POST['submit_btn']))
{

	$menu_name      =	mysqli_escape_string($con, $_POST['menu_name']);
	$parent_menu    =	mysqli_escape_string($con, $_POST['parent_menu']);
	$page_url=	mysqli_escape_string($con, $_POST['page_url']);
	$sort_order =	mysqli_escape_string($con, $_POST['sort_order']);
	$sql1 = "Insert into menu values(NUll,'".$menu_name."','".$page_url."','".$parent_menu."',".$sort_order.")";
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
	                    <strong>Menu Added Successfully!</strong> .
	             </div>";
         }elseif(isset($_POST['submit_btn']) && empty($insert_id1)){
                 
                     echo $success_error	=	 "<div class='alert alert-danger'>
	                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
	                    <strong>All Fileds Required!</strong> .
	             </div>";
         }
 	?>
	
	<form action="add-menu.php" method="POST" enctype="multipart/form-data">
				
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
						<div class="form-group col-md-12">
							<div class="col-md-6">
								<label for="name">Menu Name:</label>
								<input type="text" class="form-control" id="menu_name" placeholder="" name="menu_name" required>
								<p>(8 words or 65 Characters)</p>
							</div>
						
							<div class="col-md-5">
								<label for="urlkey">Page URL:</label>
								<input type="text" class="form-control" id="page_url" Placeholder="" name="page_url" required>
								<p>(25 words or Less)</p>
							</div>
						   
							<div class="col-md-6">
								<label for="sdesc">Parent Menu:</label>
									<select id="selectError1" multiple class="form-control" data-rel="chosen" name="parent_menu">
										
										<?php 
										$cat		=	"SELECT id, menu_name FROM `menu`";
										$cat_results	=	$gd->select($con, $cat);
										foreach($cat_results as $cat_result)
										{
										?>
											<option value="<?php echo $cat_result['id']; ?>"><?php echo $cat_result['menu_name']; ?></option>
										
										<?php } ?>
									</select>
								<p>(7-8 Keywords max)</p>
							</div>
<div class="col-md-5">
								<label for="urlkey">Sort Order:</label>
								<input type="text" class="form-control" id="page_url" Placeholder="" name="sort_order">
								<p>(2 words or Less)</p>
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

<script>

function reward_as_price()
{
	$("#reward_points").val($("#our_price").val());
}

</script>