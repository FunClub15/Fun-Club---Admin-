<?php
require ('../../global_declare.php');
$gd  = new global_declare();
$con = $gd->connect();

$query1 = "SELECT product.title as title, product.id as id, product_to_category.product_id FROM `product` inner join `product_to_category` on product.id = product_to_category.product_id INNER JOIN `category` ON product_to_category.category_id=category.id WHERE product.status = 1 and product_to_category.category_id = ".$_POST['cat_id']." OR category.parent_id=".$_POST['cat_id'];
$get_products = $gd->select($con, $query1); 
foreach($get_products as $product){
	echo "<option value ='".$product['id']."'>".$product['title']."</option>";
} 
?>