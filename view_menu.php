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
                <a href="view_menu.php">View Menu</a>
            </li>
        </ul>
    </div>

    <div class="row">
    <div class="box col-md-12">
    <div class="box-inner">
    <div class="box-header well" data-original-title="">
        <h2>VIEW MENU</h2>

        <div class="box-icon">
            <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
        </div>
    </div>
    <div class="box-content">
    <table class="table table-striped table-bordered bootstrap-datatable datatable responsive">
    <thead>
    <tr>
        <th>Name</th>
        <th>Page URL</th>
        <th>Parent Menu</th>
<th>Sort Order</th>
<th>Action</th>
        <!--<th>Sort Order</th>-->
        
    </tr>
    </thead>
    <tbody>
    <?php
    	$status="";
        $query = "SELECT * FROM `menu`";
        $get_information = $gd->select($con, $query);
        foreach($get_information as $information){
                if($information['parent_menu'] > 0){
	       $cat =	"SELECT menu_name FROM `menu` where id=".$information['parent_menu'];
	       $cat_results	=	$gd->select($con, $cat);
							
             }else{
$cat_results = '';
            }
            echo "<tr>
                <td class='center'>".mysqli_real_escape_string($con,$information['menu_name'])."</td>
                <td class='center'>".mysqli_real_escape_string($con,$information['page_url'])."</td>
                <td class='center'>".$cat_results[0]['menu_name']."</td>
                <td class='center'>".$information['sort_order']."</td>
<td class='center'>
                    <ul class='list-inline'>
                    <li>
                    <form action='edit_menu.php' method='post'>
			<input type='hidden' name='id' value='".$information['id']."'>
			<button type='submit' class='btn btn-info' name='update-btn' style='margin-bottom: 5px' data-toggle='tooltip' title='EDIT'>
			<i class='glyphicon glyphicon-edit icon-white'></i></button>
                    </form>
                    </li>
                    <li>
                    <form action='delete_menu.php' method='post'>
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