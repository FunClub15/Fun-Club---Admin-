<?php 

require('header.php');
require_once('../global_declare.php');

$gd  = new global_declare();
$con = $gd->connect();

$success ="";
$error= "";

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
				$from = (($result_arrays5[0]['email'])?($result_arrays5[0]['email']):'');
				
				$subject	=	"Seller Activation";

				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				// More headers
				$headers .= 'From: Support <' .strip_tags($from). '>';
  
				$msg	= 	'<html>';
				$msg	.= 	'<body>';
				$msg	.= 	'Your Account has been activated';
				$msg	.= 	'<br>';
				$msg	.= 	'To login as a Seller on Shopping Points';
				$msg	.= 	'<br>';
				$msg	.= 	'Kindly follow the  mentioned link below';
				$msg	.= 	'<br>';
				$msg	.= 	'http://dev.technology-minds.com/funclub/manage';
				$msg	.= 	'<br>';
				$msg	.= 	'<br>';
				$msg	.= 	'Regards';
				$msg	.= 	'<br>';
				$msg	.= 	'Shopping Points';
				$msg	.= 	'</body>';
				$msg	.= 	'</html>';
			}
			
			else if($status == 0)
			{
				$to   = $_POST['in_active_email'];
				$from = (($result_arrays5[0]['email'])?($result_arrays5[0]['email']):'');
				
				$subject	=	"Seller Deactivation";

				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				// More headers
				$headers .= 'From: Support <' .strip_tags($from). '>';
				
				$msg	= 	'<html>';
				$msg	.= 	'<body>';
				$msg	= 	'Your account has been deactivated by admin';
				$msg	.= 	'<br>';
				$msg	.= 	'Please contact the admin for further assistance';
				$msg	.= 	'<br>';
				$msg	.= 	'admin@funclubs.com';
				$msg	.= 	'<br>';
				$msg	.= 	'<br>';
				$msg	.= 	'Regards';
				$msg	.= 	'<br>';
				$msg	.= 	'Shopping Points';
				$msg	.= 	'</body>';
				$msg	.= 	'</html>';
			}
			
			mail($to, $subject, $msg, $headers);
			
            @$success = "
            <div class='alert alert-success'>
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                Seller has updated successfully!
            </div>";
        }
        else{
            @$error = "
            <div class='alert alert-danger'>
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                <strong>Error!</strong> Occured.
            </div>";
        }
       echo "<script>setTimeout(location.href='view_sellers', 3000);</script>";
        
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
                <a href="hotel_list" style="color: #666666 !important;">View Sellers</a>
            </li>
        </ul>
    </div>

    <div class="row">
    <div class="box col-md-12">
    
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
        <h2 style="color: #ffffff;"><i class="glyphicon glyphicon-zoom-in icon-white"></i>View Sellers</h2>

        <div class="box-icon">
            <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
        </div>
    </div>
    <div class="box-content">
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr>
    	<th>ID</th>
        <th>FIRST NAME</th>
        <th>LAST NAME</th>
        <th>EMAIL</th>
        <th>LEGAL NAME</th>
        <th>DISPLAY NAME</th>
        <th>VIEW SELLER</th>
        <th>STATUS</th>
        <th>CHANGE</th>
        <th>STATEMENT</th>
        <th>ACTION</th>
    </tr>
    </thead>
    <tbody>
    <?php
    	$query	=	"SELECT `user_seller`.id as seller_id, `user_seller`.role, `user_seller`.fname, `user_seller`.lname, `user_seller`.email, `user_seller`.status, `seller_des`.legal_name, `seller_des`.dis_name FROM `user_seller` INNER JOIN `seller_des` ON `user_seller`.id=`seller_des`.user_seller_id WHERE role <> 1";
    	
        $result_arrays	=	$gd->select($con, $query);
        if($result_arrays != "exists")
        {
        	foreach($result_arrays as $result_array)
        	{
        	
        	$status = "";
        	$btn = "";
        	if($result_array['status']==1){
        		$status="<span class='label-success label label-default'>Active</span>";
        		$btn = "<form action='view_sellers' method='post'>
				<input type='hidden' name='id' value='".$result_array['seller_id']."'>
				<input type='hidden' name='status' value='0'>
				<input type='hidden' name='in_active_email' value='".$result_array['email']."'>
				<button type='submit' class='btn btn-danger btn-sm' name='update-active' style='margin-bottom: 5px' data-toggle='tooltip' title='IN-ACTIVE'>IN-ACTIVE</button>
	                    	</form>";
        	}
        	else{
        		$status="<span class='label-default label'>Inactive</span>";
        		$btn = "<form action='view_sellers' method='post'>
				<input type='hidden' name='id' value='".$result_array['seller_id']."'>
				<input type='hidden' name='status' value='1'>
				<input type='hidden' name='active_email' value='".$result_array['email']."'>
				<button type='submit' class='btn btn-info btn-sm' name='update-inactive' style='margin-bottom: 5px' data-toggle='tooltip' title='ACTIVE'>ACTIVE</button>
	                    	</form>";
        	}
       ?>		
       		<tr>
        		<td class="center"><?php echo $result_array['seller_id']; ?></td>
        		<td class="center"><?php echo $result_array['fname']; ?></td>
        		<td class="center"><?php echo $result_array['lname']; ?></td>
        		<td class="center"><?php echo $result_array['email']; ?></td>
        		<td class="center"><?php echo $result_array['legal_name']; ?></td>
        		<td class="center"><?php echo $result_array['dis_name']; ?></td>
                        <td class="center"><a href="login?id=<?php echo $result_array['seller_id']; ?>">VIEW AS A SELLER</a></td>
        		<td class="center"><?php echo $status; ?></td>
        		<td class="center"><?php echo $btn; ?></td>
                        <td class="center"><a class="btn btn-info btn-sm" href="account_statement?token_id=<?php echo $result_array['seller_id']; ?>">Account Statement</a></td>
        		<td class="center" width="12%">
        			<a href="../account-settings?id=<?php echo $result_array['seller_id']; ?>&role=<?php echo $result_array['role']; ?>" class="btn btn-success btn-sm"  data-toggle="tooltip" title="VIEW"><i class="glyphicon glyphicon-zoom-in icon-white"></i></a>
        			<a href="../account-settings?id=<?php echo $result_array['seller_id']; ?>" class="btn btn-info btn-sm"  data-toggle="tooltip" title="EDIT"><i class="glyphicon glyphicon-edit icon-white"></i></a>
            			<a href="delete_user_seller?id=<?php echo $result_array['seller_id']; ?>" class="btn btn-danger btn-sm"  data-toggle="tooltip" title="DELETE" onClick="return confirm('Do You want to Delete this Category?')"><i class="glyphicon glyphicon-trash icon-white"></i></a>

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