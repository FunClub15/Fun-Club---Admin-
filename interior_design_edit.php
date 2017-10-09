<?php 
require('header.php');
require_once('../global_declare.php');

$gd  = new global_declare(); 
$con = $gd->connect();

$success ="";
$error= "";

if(isset($_POST['submit']))
{
$id = $_GET['id'];	
      $query = "UPDATE interior_design set name = '".$_POST['name']."', category = '".$_POST['category']."' where id =".$id;
       mysqli_query($con,$query);

					
				$dbfilename = NULL;
				$htttp_url = NULL;
					
					$target_dir = "interior_design/";
                     if(!empty($_FILES["fileToUpload"]["name"])){

                            $htttp_url = 'http://dev.technology-minds.com/funclub/manage/webservices/interior_design/'; 
                            $dbfilename = 'interior_design_'.basename($_FILES["fileToUpload"]["name"]);
                    }
					$target_file = $target_dir . 'interior_design_'.basename($_FILES["fileToUpload"]["name"]);
					$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
$uploadOk = 1;
					// Allow certain file formats
					if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" ) {
						
						$uploadOk = 0;
					}
					// Check if $uploadOk is set to 0 by an error
					if ($uploadOk == 0) {
						
					// if everything is ok, try to upload file
					} else {

						if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                           $sql3 = "UPDATE interior_design SET image='".$dbfilename."' Where id  = ".$id;
                            mysqli_query($con,$sql3 );
       
	

						} else {
						}
					}
?>
<script>alert('Record add successfully');
  window.location = 'interior_design.php'
</script>
<?php
			
 }
 
    
?>
<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $fetchquery = "select * from interior_design where id = ".$id;
      $result1 = mysqli_query($con,$fetchquery);
		if (mysqli_num_rows($result1) == 1){
			while($row = $result1->fetch_assoc()) {
				$name= $row["name"];
				$id = $row["id"];
				$image= $row["image"];
				$category= $row["category"];
			}
          }

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
                <a href="add_interior_design" style="color: #666666 !important;">Update Interior Design</a>
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
        <h2 style="color: #ffffff;"><i class="glyphicon glyphicon-zoom-in icon-white"></i>View Interior</h2>

        <div class="box-icon">
            <a href="#" class="btn btn-minimize btn-round btn-default"><i class="glyphicon glyphicon-chevron-up"></i></a>
        </div>
    </div>
    <div class="box-content">

                <form name="addInteriorDesign" action="" method="POST" enctype="multipart/form-data">
			<div class="form-group">
				<label for="name">Name:</label>
				<input type="text" class="form-control" id="name" name="name" value="<?php echo $name ?>" required="required" >
			</div>
			<div class="form-group">
				<label for="fileToUpload">Image:<img src="interior_design/<?php echo $image ?>" width="200" /></label>
				<input type="file" class="form-control" name="fileToUpload" id="fileToUpload">
			</div>
			
			<div class="form-group">
				<label for="category">Category:</label>
				<select class="form-control" id="category" name="category" required="required">
					<option> --Select-- </option>

<?php
      $fetchquery = "select * from interior_design_category";
              $result1 = mysqli_query($con,$fetchquery);
		if (mysqli_num_rows($result1) > 0){
			while($row = $result1->fetch_assoc()) {
				$name= $row["name"];
?>
                                <?php if($category == "$name") { ?>
                                <option value="<?php echo $category; ?>" selected="selected"><?php echo $category ; ?></option>
<?php } else { ?>
                                <option value="<?php echo $name; ?>"><?php echo $name; ?></option>
<?php } } }?>
				</select>
			</div>
			<input type="submit" class="btn btn-default" name="submit" value="Submit">
		</form>
		
	
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