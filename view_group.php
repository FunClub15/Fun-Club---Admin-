<?php
require('header.php');
require_once ('../global_declare.php');

$gd  = new global_declare();
$con = $gd->connect();

?>

    <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
                <div>
        <ul class="breadcrumb">
            <li>
                <a href="index.php">Home</a>
            </li>
            <li>
                <a href="view_group.php">View Group</a>
            </li>
        </ul>
    </div>

    <div class="row">
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2>VIEW GROUP</h2>

        <div class="box-icon">
            <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
        </div>
    </div>
    <div class="box-content">
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr>
        <th>Id</th>
        <th>Group Name</th>
        <th>Action</th>
        <!--<th>Sort Order</th>-->
        
    </tr>
    </thead>
    <tbody>
    <?php
    	$status="";
        $query = "SELECT * FROM `groups`";
        $get_information = $gd->select($con, $query);
        foreach($get_information as $information){
                
            echo "<tr>
                <td class='center'>".mysqli_real_escape_string($con,$information['id'])."</td>
                <td class='center'>".mysqli_real_escape_string($con,$information['group_name'])."</td>
                
                
<td class='center'>
                    <ul class='list-inline'>
                    <li>
                    <form action='edit_group.php' method='post'>
			<input type='hidden' name='id' value='".$information['id']."'>
			<button type='submit' class='btn btn-info' name='update-btn' style='margin-bottom: 5px' data-toggle='tooltip' title='EDIT'>
			<i class='glyphicon glyphicon-edit icon-white'></i></button>
                    </form>
                    </li>
                    <li>
                    <form action='delete_group.php' method='post'>
			<input type='hidden' name='id' value='".$information['id']."'>
			<button type='submit' onclick='return confirm (\"Are you sure you want to delete from the database?\")' class='btn btn-danger' name='delete' style='margin-bottom: 5px' data-toggle='tooltip' title='DELETE'>
			<i class='glyphicon glyphicon-trash icon-white'></i></button>
                    </form>
                    </li>
                    </ul>
                </td>
                
            </tr>";
        }
    ?>

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
<!--End Muhammad Khurram 07th Oct, 2015-->