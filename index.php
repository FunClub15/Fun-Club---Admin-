<?php
require('header.php');

if($_SESSION['role']==1)
{
$q="SELECT count(order_id) as orders_count FROM  `orders` where order_status=1";
$q2="SELECT count(order_id) as orders_count FROM  `orders` where order_status=3";
$q3="SELECT count(id) as pro_counts FROM  `product`";
}
else{
$q="SELECT sum(o.order_id) as orders_count FROM  `orders` o inner join `order_products` op where o.order_status=1 and op.product_seller_id=".$_SESSION['seller_id']." group by o.order_id";
$q2="SELECT sum(o.order_id) as orders_count FROM  `orders` o inner join `order_products` op where o.order_status=3 and op.product_seller_id=".$_SESSION['seller_id']." group by o.order_id";
$q3="SELECT count(id) as pro_counts FROM  `product` where user_seller_id=".$_SESSION['seller_id'];
}
$orders_count=$gd->select($con, $q);
$sale_count=$gd->select($con, $q2);
$pro_count=$gd->select($con, $q3);
?>
   
<noscript>
	<div class="alert alert-block col-md-12">
		<h4 class="alert-heading">Warning!</h4>

		<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a>
			enabled to use this site.</p>
	</div>
</noscript>
	
<div id="content" class="col-lg-10 col-sm-10">
	<!-- content starts -->
	<div>
		<ul class="breadcrumb">
			<li>
				<a href="#">Home</a>
			</li>
			<li>
				<a href="#">Dashboard</a>
			</li>
		</ul>
	</div>
	<div class=" row">
		<div class="col-md-3 col-sm-3 col-xs-6">
			<a data-toggle="tooltip"  class="well top-block" href="view_members" style="background-color: #ee7748; color: #f1f0f0;">
				<i class="glyphicon glyphicon-tint"></i>

				<div>Total FC Members</div>
			        <!--<div><?php if($pro_count!="exists"){ echo $pro_count[0]['pro_counts'];} else{ echo 0;} ?></div>
				<span class="notification"><?php if($pro_count!="exists"){ echo $pro_count[0]['pro_counts'];} else{ echo 0;} ?></span>-->
			</a>
		</div>

		<div class="col-md-3 col-sm-3 col-xs-6">
			<a class="well top-block" href="" style="background-color: #639442; color: #f1f0f0;">
				<i class="glyphicon glyphicon-star"></i>

				<div>Total Club Owners</div>
				<!--<div><?php if($orders_count!="exists"){ echo $orders_count[0]['orders_count'];}else{ echo 0; } ?></div>
				<span class="notification green"><?php if($orders_count!="exists"){ echo $orders_count[0]['orders_count'];}else{ echo 0; } ?></span>-->
			</a>
		</div>

		<div class="col-md-3 col-sm-3 col-xs-6">
			<a data-toggle="tooltip" title="$34 new sales." class="well top-block" href="" style="background-color: #f8f62f; color: #f1f0f0;">
				<i class="glyphicon glyphicon-shopping-cart"></i>

				<div>Total Events</div>
				<!--<div><?php if($sale_count!="exists"){ echo $sale_count[0]['orders_count'];} else{ echo 0;} ?></div>
				<span class="notification yellow"><?php if($sale_count!="exists"){ echo $sale_count[0]['orders_count'];} else{ echo 0;} ?></span>-->
			</a>
		</div>

		<div class="col-md-3 col-sm-3 col-xs-6">
			<a data-toggle="tooltip" title="12 new messages." class="well top-block" href="" style="background-color: #2eb4f1; color: #f1f0f0;">
				<i class="glyphicon glyphicon-envelope"></i>

				<div>Total Sale</div>
				<!--<div>25</div>
				<span class="notification red">12</span>-->
			</a>
		</div>
	</div>

	<div class="row">
		<div class="box col-md-6">
			<div class="box-inner">
				<div class="box-header well">
					<h2><i class="glyphicon glyphicon-info-sign"></i> Introduction</h2>

					<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round btn-default"><i
								class="glyphicon glyphicon-chevron-up"></i></a>
						
					</div>
				</div>
				<div class="box-content row">
					<div class="col-lg-12 col-md-12">
						<div>
							<h1 style="text-align: justify;">Fun Club LLC.<br></h1>
							<p style="text-align: justify; font-family: sans-serif;
    font-style: italic;
}"><b>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</b></p>
							</br>
						</div>
					
						

						
					</div>
				</div>
			</div>
		</div>

		
		<div class="box col-md-6">
			<div class="box-inner homepage-box">
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-list-alt"></i> Site Map</h2>

					<!--<div class="box-icon">
						<a href="#" class="btn btn-minimize btn-round btn-default"><i
								class="glyphicon glyphicon-chevron-up"></i></a>
						
					</div>-->
				</div>
				<div class="box-content">
					<div class="box col-md-4">
						
						<p style="text-align: justify !important;">
							<b>Orders</b></br>
							-<a href="">Manage Orders</a></br>
							-<a href="">Manage Returns</a>
						</p>
 <?php if($_SESSION['role']==1){ ?>
						<p style="text-align: justify !important;">
							<b>Reports</b></br>
							-<a href="">Payments</a>
						</p>
<?php } ?>
                                        <p style="text-align: justify !important;">
							<b>Products</b></br>
							-<a href="">View Products</a>
						</p>
					</div>
					<div class="box col-md-4">
						<p style="text-align: justify !important;">
							<b>Performance</b></br>
							
							-<a href="">Feedback</a></br>
							-<a href="">Rating</a>
						</p>
                                              <?php if($_SESSION['role']==1){ ?>
						<p style="text-align: justify !important;">
							<b>Settings</b></br>
							-<a href="">Site Settings</a></br>
							<a href="">Slider Settings</a>
						</p><?php } ?>
					</div>
					<div class="box col-md-4">
						<p style="text-align: justify !important;">
							<b>Users</b></br>
							
							-<a href="">FC Members</a></br>
							-<a href="">Club Owners</a>
<a href="">Party Promoters</a>
						</p>
                                             
						<p style="text-align: justify !important;">
							<b>Events</b></br>
							-<a href="">Upcoming Events</a></br>							-<a href="">Post Events</a></br>							
-<a href="">Popular Events</a>
						</p>
					</div>
					
				</div>
			</div>
		</div>
		<!--/span-->
	</div>
	
	<!--/span-->

	<div class="box col-md-4">
		<div class="box-inner">
			<div class="box-header well" data-original-title="">
				<h2><i class="glyphicon glyphicon-user"></i> Latest Order</h2>

				<div class="box-icon">
					<a href="#" class="btn btn-minimize btn-round btn-default"><i
							class="glyphicon glyphicon-chevron-up"></i></a>
				</div>
			</div>
			
			<div class="box-content" >
				<div class="box-content">
					<ul class="dashboard-list">
						<?php
						$status="";
						if($_SESSION['role']==1){
						$query = "SELECT DISTINCT orders.order_id, orders.billing_fname, orders.billing_lname, orders.order_status, orders.order_total, orders.order_date, orders.date_modified FROM `orders` inner join `order_products` on orders.order_id = order_products.order_id order by orders.order_id desc LIMIT 4";	
						}
						else{
						 $query = "SELECT DISTINCT orders.order_id, orders.billing_fname, orders.billing_lname, orders.order_status, orders.order_total, orders.order_date, orders.date_modified FROM `orders` inner join `order_products` on orders.order_id = order_products.order_id  WHERE order_products.product_seller_id = ".$_SESSION['seller_id']."  order by orders.order_id desc LIMIT 4";	
						}
						
						$get_orders = $gd->select($con, $query);
						if($get_orders!="exists"){
						foreach($get_orders as $order){
						
							$query1 = "SELECT * FROM `order_status` WHERE `id` =  ".$order['order_status'];
							$get_status = $gd->select($con, $query1);
							
							
						?>
						<li>
							<a href="detail_order?order=<?php echo $order['order_id']; ?>">
							<strong>Order ID:</strong> <?php echo $order['order_id']; ?>
							</a><br>
							<strong>Customer:</strong> <?php echo $order['billing_fname']." ".$order['billing_lname']; ?><br>
							<strong>Order Date:</strong> <?php echo date('m/d/Y', strtotime($order['order_date'])); ?><br>
							<strong>Status:</strong> <?php echo $get_status[0]['name']; ?>
						</li>
<li>
							<a href="detail_order?order=<?php echo $order['order_id']; ?>">
							<strong>Order ID:</strong> <?php echo $order['order_id']; ?>
							</a><br>
							<strong>Customer:</strong> <?php echo $order['billing_fname']." ".$order['billing_lname']; ?><br>
							<strong>Order Date:</strong> <?php echo date('m/d/Y', strtotime($order['order_date'])); ?><br>
							<strong>Status:</strong> <?php echo $get_status[0]['name']; ?>
						</li>
						<?php }
						}
							?>
					</ul>
				</div>
			</div>
			
		</div>
	</div>
	
	<!--Chart_1-->
	
	<?php
	$current_date = date("Y-m-d");
	$last_months_date =  date("Y-m-d", strtotime("-6 months"));
	if($_SESSION['role']==1){
	$query1 = "SELECT COUNT(*) AS count, MONTHNAME(order_date) AS month FROM `orders` WHERE order_date BETWEEN  '".$last_months_date."' AND '".$current_date."' GROUP BY MONTH(order_date)";
	}
	else{
	 $query1 = "SELECT COUNT(*) AS count, MONTHNAME(order_date) AS month FROM `orders` WHERE order_date BETWEEN  '".$last_months_date."' AND '".$current_date."' GROUP BY MONTH(order_date)";	
	}

	$order_count = $gd->select($con, $query1);
	
	$data = array();
    $label = array();
	if($order_count!="exists"){
	foreach($order_count as $count){
		$data[] = $count['count'];
        $label[] = $count['month'];
	}
	}
	
/*
    $data = array(); //values
    $label = array(); //months
    foreach ($order_counte as $values) :
        $data[] = $value['data']; 
    endforeach;
	
	foreach ($order_counte as $values) :
       $label[] = $value['label'];
    endforeach;
*/
	?>
	
	<script src="js/Chart.js"></script>
	<div class="box col-md-8">
		<div class="box-inner">
			<div class="box-header well">
				<h2><i class="glyphicon glyphicon-list-alt"></i> Events on google map</h2>

				<div class="box-icon">
					<a href="#" class="btn btn-minimize btn-round btn-default"><i
							class="glyphicon glyphicon-chevron-up"></i></a>
					
				</div>
			</div>
			<div class="box-content">
				<!--<div id="stackchart_2" class="center" style="height:300px;"></div>-->
<iframe height="400px" width="100%" frameborder="0" scrolling="no" src="https://developers.google.com/maps/documentation/javascript/examples/full/marker-simple" allowfullscreen="">
    </iframe>

			</div>
		</div>
	</div>

	<script>
	var randomScalingFactor = function(){ return Math.round(Math.random()*100)};

	var barChartData = {
		labels : <?php echo json_encode($label) ?>,
		datasets : [
			{
				fillColor : "rgba(151,187,205,0.5)",
				strokeColor : "rgba(151,187,205,0.8)",
				highlightFill : "rgba(151,187,205,0.75)",
				highlightStroke : "rgba(151,187,205,1)",
				data : <?php echo json_encode($data) ?>
			}
		]

	}
	window.onload = function(){
		var ctx = document.getElementById("canvas").getContext("2d");
		window.myBar = new Chart(ctx).Bar(barChartData, {
			responsive : true
		});
	}

	</script>
	
	
	<!--/span-->
	<!--/row-->

<!--<div class="row">
	<div class="box col-md-4">
		<div class="box-inner">
			<div class="box-header well" data-original-title="">
				<h2><i class="glyphicon glyphicon-list"></i> Buttons</h2>

				<div class="box-icon">
					<a href="#" class="btn btn-setting btn-round btn-default"><i
							class="glyphicon glyphicon-cog"></i></a>
					<a href="#" class="btn btn-minimize btn-round btn-default"><i
							class="glyphicon glyphicon-chevron-up"></i></a>
				
				</div>
			</div>
			<div class="box-content buttons">
				<p class="btn-group">
					<button class="btn btn-default">Left</button>
					<button class="btn btn-default">Middle</button>
					<button class="btn btn-default">Right</button>
				</p>
				<p>
					<button class="btn btn-default btn-sm"><i class="glyphicon glyphicon-star"></i> Icon button</button>
					<button class="btn btn-primary btn-sm">Small button</button>
					<button class="btn btn-danger btn-sm">Small button</button>
				</p>
				<p>
					<button class="btn btn-warning btn-sm">Small button</button>
					<button class="btn btn-success btn-sm">Small button</button>
					<button class="btn btn-info btn-sm">Small button</button>
				</p>
				<p>
					<button class="btn btn-inverse btn-default btn-sm">Small button</button>
					<button class="btn btn-primary btn-round btn-lg">Round button</button>
					<button class="btn btn-round btn-default btn-lg"><i class="glyphicon glyphicon-ok"></i></button>
					<button class="btn btn-primary"><i class="glyphicon glyphicon-edit glyphicon-white"></i></button>
				</p>
				<p>
					<button class="btn btn-default btn-xs">Mini button</button>
					<button class="btn btn-primary btn-xs">Mini button</button>
					<button class="btn btn-danger btn-xs">Mini button</button>
					<button class="btn btn-warning btn-xs">Mini button</button>
				</p>
				<p>
					<button class="btn btn-info btn-xs">Mini button</button>
					<button class="btn btn-success btn-xs">Mini button</button>
					<button class="btn btn-inverse btn-default btn-xs">Mini button</button>
				</p>
			</div>
		</div>
	</div>
	<!--/span

	<div class="box col-md-4">
		<div class="box-inner">
			<div class="box-header well" data-original-title="">
				<h2><i class="glyphicon glyphicon-list"></i> Buttons</h2>

				<div class="box-icon">
					<a href="#" class="btn btn-setting btn-round btn-default"><i
							class="glyphicon glyphicon-cog"></i></a>
					<a href="#" class="btn btn-minimize btn-round btn-default"><i
							class="glyphicon glyphicon-chevron-up"></i></a>
					
				</div>
			</div>
			<div class="box-content  buttons">
				<p>
					<button class="btn btn-default btn-lg">Large button</button>
					<button class="btn btn-primary btn-lg">Large button</button>
				</p>
				<p>
					<button class="btn btn-danger btn-lg">Large button</button>
					<button class="btn btn-warning btn-lg">Large button</button>
				</p>
				<p>
					<button class="btn btn-success btn-lg">Large button</button>
					<button class="btn btn-info btn-lg">Large button</button>
				</p>
				<p>
					<button class="btn btn-inverse btn-default btn-lg">Large button</button>
				</p>
				<div class="btn-group">
					<button class="btn btn-default btn-lg">Large Dropdown</button>
					<button class="btn dropdown-toggle btn-default btn-lg" data-toggle="dropdown"><span
							class="caret"></span></button>
					<ul class="dropdown-menu">
						<li><a href="#"><i class="glyphicon glyphicon-star"></i> Action</a></li>
						<li><a href="#"><i class="glyphicon glyphicon-tag"></i> Another action</a></li>
						<li><a href="#"><i class="glyphicon glyphicon-download-alt"></i> Something else here</a></li>
						<li class="divider"></li>
						<li><a href="#"><i class="glyphicon glyphicon-tint"></i> Separated link</a></li>
					</ul>
				</div>

			</div>
		</div>
	</div>
	<!--/span

	<div class="box col-md-4">
		<div class="box-inner">
			<div class="box-header well" data-original-title="">
				<h2><i class="glyphicon glyphicon-list"></i> Weekly Stat</h2>

				<div class="box-icon">
					<a href="#" class="btn btn-setting btn-round btn-default"><i
							class="glyphicon glyphicon-cog"></i></a>
					<a href="#" class="btn btn-minimize btn-round btn-default"><i
							class="glyphicon glyphicon-chevron-up"></i></a>
					<a href="#" class="btn btn-close btn-round btn-default"><i
							class="glyphicon glyphicon-remove"></i></a>
				</div>
			</div>
			<div class="box-content">
				<ul class="dashboard-list">
					<li>
						<a href="#">
							<i class="glyphicon glyphicon-arrow-up"></i>
							<span class="green">92</span>
							New Comments
						</a>
					</li>
					<li>
						<a href="#">
							<i class="glyphicon glyphicon-arrow-down"></i>
							<span class="red">15</span>
							New Registrations
						</a>
					</li>
					<li>
						<a href="#">
							<i class="glyphicon glyphicon-minus"></i>
							<span class="blue">36</span>
							New Articles
						</a>
					</li>
					<li>
						<a href="#">
							<i class="glyphicon glyphicon-comment"></i>
							<span class="yellow">45</span>
							User reviews
						</a>
					</li>
					<li>
						<a href="#">
							<i class="glyphicon glyphicon-arrow-up"></i>
							<span class="green">112</span>
							New Comments
						</a>
					</li>
					<li>
						<a href="#">
							<i class="glyphicon glyphicon-arrow-down"></i>
							<span class="red">31</span>
							New Registrations
						</a>
					</li>
					<li>
						<a href="#">
							<i class="glyphicon glyphicon-minus"></i>
							<span class="blue">93</span>
							New Articles
						</a>
					</li>
					<li>
						<a href="#">
							<i class="glyphicon glyphicon-comment"></i>
							<span class="yellow">254</span>
							User reviews
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<!--/span
</div>--><!--/row-->
	<!-- content ends -->
</div><!--/#content.col-md-0-->
<!--</div>--><!--/fluid-row-->


	<hr>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
	 aria-hidden="true">

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h3>Settings</h3>
			</div>
			<div class="modal-body">
				<p>Here settings can be configured...</p>
			</div>
			<div class="modal-footer">
				<a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
				<a href="#" class="btn btn-primary" data-dismiss="modal">Save changes</a>
			</div>
		</div>
	</div>
</div>

	<!--footer -->
<?php
require('footer.php');
?>