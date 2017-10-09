<?php 
require('header.php');
require_once('../global_declare.php');

global $wpdb;
$gd  = new global_declare();
$con = $gd->connect();


$success ="";
$error= "";

if(isset($_GET['id'])){
$id1=$_GET['id'];
$sql = "DELETE FROM `interior_design_category` WHERE id = $id1";
//$wpdb->query($sql);
if (mysqli_query($con, $sql)) {
    $success  = "Record deleted successfully";
} else {
    $error = "Error deleting record: " . $conn->error;
}
}
?>
<style>
table{
overflow: auto !important;
position: relative;
}

.table>thead>tr>th, .table>tbody>tr>th, .table>tfoot>tr>th, .table>thead>tr>td, .table>tbody>tr>td, .table>tfoot>tr>td {
    vertical-align: middle !important;
}
</style>

    <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
                <div>
        <ul class="breadcrumb">
            <li>
                <a href="index" style="color: #666666 !important;">Home</a>
            </li>
            <li>
                <a href="interior_design_category" style="color: #666666 !important;">Interior Design Category</a>
            </li>
        </ul>
    </div>

    <div class="row">
    <div class="box col-md-12">
       <?php if($success){ ?>
		<div class="alert alert-success alert-dismissable">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<?php echo $success; ?>
		</div>
		
		<?php } ?>
		
		<?php if($error){ ?>
			<div class="alert alert-danger alert-dismissable">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<?php echo $error; ?>
			</div>
		<?php } ?>             	
    <div class="box-inner">
	
    <div class="box-header well" data-original-title="">
        <h2 style="color: #ffffff;"><i class="glyphicon glyphicon-zoom-in icon-white"></i>Interior Design Category</h2>

        <div class="box-icon">
			<a href="add_interior_design_category" class="btn btn-round btn-default"><i class="glyphicon glyphicon-pencil"></i></a>
		
            <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
        </div>
    </div>
    <div class="box-content">
		
		<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
			<thead>
				<tr>
					<th>ID</th>	
					<th>CATEGORY</th>
					<th class="text-center">ACTION</th>
				</tr>
			</thead>
			<tbody>
			<?php
				$query	=	"SELECT * FROM `interior_design_category`";
				
				$result_arrays	=	$gd->select($con, $query);
				if($result_arrays != "exists")
				{
					foreach($result_arrays as $result_array)
					{
						$id = $result_array['id'];
			   ?>		
					<tr>
						<td class="center"><?php echo $id; ?></td>
						<td class="center"><?php echo $result_array['name']; ?></td>
						<td class="text-center">
							<a href="interior_design_category_edit.php?id=<?php echo $id; ?>" type="button" class="btn btn-info">Edit	</a>
							<a href="interior_design_category.php?id=<?php echo $id; ?>" type="button" class="btn btn-danger">Delete</a>
						</td>
					 </tr>
			   <?php  } } ?>
			</tbody>
		</table>

    </div>
    </div>
    </div>
    <!--/span-->

    </div><!--/row-->

    <!-- content ends -->
    </div><!--/#content.col-md-0-->
</div><!--/fluid-row-->


<!--footer--> 
<?php
require('footer.php');
?>