<?php 
require('header.php');
require('push_notify.php');
require_once('../global_declare.php');

global $wpdb;
$gd  = new global_declare();
$con = $gd->connect();


$success ="";
$error= "";

if(isset($_GET['id'])){
$id1=$_GET['id'];
$sql = "DELETE FROM `interior_design` WHERE id = $id1";
//$wpdb->query($sql);
if (mysqli_query($con, $sql)) {

    $success  = "Record deleted successfully";
$sendmsg = array
          (
		'body' 	=> '~ One sticker is removed by admin ~',
		'title'	=> 'Funclub',
             	'icon'	=> 'myicon',/*Default Icon*/
              	'sound' => 'mySound'/*Default sound*/
          );

       $fetchquery = "select * from device_ids";
              $result_device = mysqli_query($con,$fetchquery);
		if (mysqli_num_rows($result_device) > 0){
			while($row = $result_device->fetch_assoc()) {
				
                             $device_token = $row["device_id"];
                             sendGCM($sendmsg,$device_token);		

                         }
                     }
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
                <a href="interior_design" style="color: #666666 !important;">Interior Design</a>
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
        <h2 style="color: #ffffff;"><i class="glyphicon glyphicon-zoom-in icon-white"></i>Interior Design</h2>

        <div class="box-icon">
			<a href="add_interior_design" class="btn btn-round btn-default"><i class="glyphicon glyphicon-pencil"></i></a>
		
            <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
        </div>
    </div>
    <div class="box-content">
		
		<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
			<thead>
				<tr>
					<th>IMAGE</th>
					<th>NAME</th>
					
					<th>CATEGORY</th>
					<th class="text-center">ACTION</th>
				</tr>
			</thead>
			<tbody>
			<?php
				$query	=	"SELECT * FROM `interior_design`";
				
				$result_arrays	=	$gd->select($con, $query);
				if($result_arrays != "exists")
				{
					foreach($result_arrays as $result_array)
					{
						$id = $result_array['id'];
			   ?>		
					<tr>
						<td class="center"><img src="interior_design/<?php echo $result_array['image']; ?>" width="200"/></td>

						<td class="center"><?php echo $result_array['name']; ?></td>
						<td class="center"><?php echo $result_array['category']; ?></td>
						<td class="text-center">
							<a href="interior_design_edit.php?id=<?php echo $id; ?>" type="button" class="btn btn-info">Edit	</a>
							<a href="interior_design.php?id=<?php echo $id; ?>" type="button" class="btn btn-danger">Delete</a>
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