<?php
require ('../../global_declare.php');
$gd  = new global_declare();
$con = $gd->connect();
$no_orders=0;
$no_prodcts=0;
$sub_total=0.0;
$total_amt=0.0;
$per_item_fee=0.0;
$ref_charges=0.0;
$interchange=0.0;
$sales_tax=0.0;
$balance=0.0;
if(isset($_POST['check_data']))
{
$ids=substr($_POST['check_data'],0,-1);

$count_orders=$gd->select($con,"SELECT count(distinct o.order_id) as order_count FROM `order_products` op inner join `orders` o on o.order_id=op.order_id where op.order_product_id IN (".$ids.")");
$no_orders=$count_orders[0]['order_count'];
$order_products=$gd->select($con,"SELECT * FROM `order_products` where order_product_id IN (".$ids.")");
foreach($order_products as $order_product)
{
$no_prodcts+=1;
$sub_total+=$order_product['sub_total'];
$total_amt+=$order_product['total'];
$per_item_fee+=$order_product['seller_fees'];
$ref_charges+=$order_product['referal_fees'];
$sales_tax+=$order_product['tax'];
}
$interchange=(($total_amt*2.5)/100);
$balance=($total_amt-($per_item_fee+$ref_charges+$interchange));
}
$response=array("orders_count"=>$no_orders,"products_count"=>$no_prodcts,"total_item_fees"=>number_format($per_item_fee,2),"total_ref_charges"=>number_format($ref_charges,2),"interchange"=>number_format($interchange,2),"sales_tax"=>number_format($sales_tax,2),"total_amt"=>number_format($sub_total,2),"grand_total"=>$total_amt,"total_balance"=>number_format($balance,2));
echo json_encode($response);
exit;
?>