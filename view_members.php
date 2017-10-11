<?php 
require('header.php');
require_once('../global_declare.php');

$gd  = new global_declare();
$con = $gd->connect();

$success ="";
$error= "";
$delmsg="";
$role = $_GET['role'];
if(isset($_GET['delid'])){
$delid=$_GET['delid'];
$query="DELETE FROM user_seller WHERE id = $delid";
if($gd->select($con, $query)){
$delmsg=1;
}else{
$delmsg=0;
}
}

if(isset($_POST['update-inactive']) || isset($_POST['update-active']))
{	
	$status = mysqli_real_escape_string($con,$_POST['status']);
	$query = "UPDATE `user_seller` ";
        $query .= "SET `status`='".$status."' ";
        $query .= "WHERE `id`=".$_POST['id'];

        $update_buyer = $gd->update($con, $query);
        if($update_buyer)
        {
			$sql5		=	"SELECT `email` from `site_setting`";
			$result_arrays5	=	$gd->select($con, $sql5);
	
			if($status == 1)
			{
				$to   = $_POST['active_email'];
				
				$subject	=	"Member Activation";

				$msg	= 	'<html>';
				$msg	.= 	'<body>';
				$msg	.= 	'User Name: '.$_POST['active_email'];
				$msg	.= 	'<br>';
				$msg	.= 	'Your Account has been activated.';
				$msg	.= 	'<br>';
				$msg	.= 	'To login as a member on Fun Club';
				$msg	.= 	'<br>';
				$msg	.= 	'Kindly follow the  mentioned link below';
				$msg	.= 	'<br>';
				$msg	.= 	$gd->base_url.'manage';
				$msg	.= 	'<br>';
				$msg	.= 	'<br>';
				$msg	.= 	'Regards';
				$msg	.= 	'<br>';
				$msg	.= 	'Fun Club.';
				$msg	.= 	'</body>';
				$msg	.= 	'</html>';
			}
			
			else if($status == 0)
			{
				$to   = $_POST['in_active_email'];
				
				
				$subject	=	"Member Deactivation";

				$msg	= 	'<html>';
				$msg	.= 	'<body>';
				$msg	= 	'Your account has been deactivated by admin';
				$msg	.= 	'<br>';
				$msg	.= 	'Please contact the admin for further assistance.';
				$msg	.= 	'<br>';
				$msg	.= 	'admin@funclubs.com';
				$msg	.= 	'<br>';
				$msg	.= 	'<br>';
				$msg	.= 	'Regards';
				$msg	.= 	'<br>';
				$msg	.= 	'Fun Club.';
				$msg	.= 	'</body>';
				$msg	.= 	'</html>';
			}
			$from = "support@funclubs.com";
		
			$gd->send_email($to,$from,$msg,$subject);
            @$success = "
            <div class='alert alert-success'>
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                Seller has updated successfully!
            </div>"; 
        }
        else{
           
        }
       echo "<script>setTimeout(location.href='view_members', 3000);</script>";
        
    }
    
?>
<style>
table{
overflow: auto !important;
position: relative;
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
                <a href="view_members" style="color: #666666 !important;">View Members</a>
            </li>
        </ul>
    </div>

    <div class="row">
    <div class="box col-md-12">
     <a class="btn btn-info " href="export_member.php?role=<?php echo $role ?>" target="__blank">Export Members CSV</a>
<br />
<br />
	<?php 
                if($success){
                    echo $success;
                }
                else if ($error) {
                    echo $error;
                }
    	?>
                    	
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2 style="color: #ffffff;"><i class="glyphicon glyphicon-zoom-in icon-white"></i>View Members</h2>

        <div class="box-icon">
            <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
        </div>
    </div>
    <div class="box-content">
<?php if($delmsg == 1) {?>
<div class="alert alert-success fade in alert-dismissable" style="margin-top:18px;">
    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
    <strong>Success!</strong> User Successfully Deleted.
</div>
<?php } else {?>

<?php } ?>

	<table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr>
    	<th>ID</th>
        <th>FULL NAME</th>
        <th>USER NAME</th>
        <th>EMAIL</th>
        <th>PHONE NUMBER</th>
        <th>REGISTRATION DATE</th>
<th>SIGNUP DEVICE</th>
         <th>STATUS</th>
        <th>CHANGE</th>
        <th>ACTION</th>
        
    </tr>
    </thead>
    <tbody>
    <?php
    	$query	=	"SELECT `user_seller`.id as seller_id, `user_seller`.role, `user_seller`.fullname, `user_seller`.device_registration,`user_seller`.cell_number, `user_seller`.username, `user_seller`.email, `user_seller`.created_at, `user_seller`.status FROM `user_seller` WHERE role = ".$role;
    	
        $result_arrays	=	$gd->select($con, $query);
        if($result_arrays != "exists")
        {
        	foreach($result_arrays as $result_array)
        	{
        	
        	$status = "";
        	$btn = "";
        	if($result_array['status']==1){
        		$status="<span class='label-success label label-default'>Active</span>";
        		$btn = "<form action='view_members' method='post'>
				<input type='hidden' name='id' value='".$result_array['seller_id']."'>
				<input type='hidden' name='status' value='0'>
				<input type='hidden' name='in_active_email' value='".$result_array['email']."'>
				<button type='submit' class='btn btn-danger btn-sm' name='update-active' style='margin-bottom: 5px' data-toggle='tooltip' title='IN-ACTIVE'>IN-ACTIVE</button>
	                    	</form>";
        	}
        	else{
        		$status="<span class='label-default label'>Inactive</span>";
        		$btn = "<form action='view_members' method='post'>
				<input type='hidden' name='id' value='".$result_array['seller_id']."'>
				<input type='hidden' name='status' value='1'>
				<input type='hidden' name='active_email' value='".$result_array['email']."'>
				<button type='submit' class='btn btn-info btn-sm' name='update-inactive' style='margin-bottom: 5px' data-toggle='tooltip' title='ACTIVE'>ACTIVE</button>
	                    	</form>";
        	}
       ?>		
       		<tr>
        		<td class="center"><?php echo $result_array['seller_id']; ?></td>
        		<td class="center"><?php echo $result_array['fullname']; ?></td>
<td class="center"><?php echo $result_array['username']; ?></td>
        		<td class="center"><?php echo $result_array['email']; ?></td>
<td class="center"><?php echo $result_array['cell_number']; ?></td>
        		<td class="center"><?php echo $result_array['created_at']; ?></td>
<td class="center"><?php echo $result_array['device_registration']; ?></td>
        		
              <td class="center"><?php echo $status; ?></td>
        		<td class="center"><?php echo $btn; ?></td>
        		<td class="center"><a href="view_members?delid=<?php echo $result_array['seller_id']; ?>" class="btn btn-danger" role="button">Delete</a></td>
                     
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