<?php
if($_POST['page'])
{
$name=$_POST['vn'];
$st_id=$_POST['st_id'];
$page = $_POST['page'];
$cur_page = $page;
$page -= 1;
$per_page = 3;
$previous_btn = true;
$next_btn = true;
$first_btn = true;
$last_btn = true;
$start = $page * $per_page;

include "../db.php";
$sub_query="";

if($st_id!=0)
{
$sub_query.=" and `voucher`.store_id=".$st_id;
}


$query_pag_data = "SELECT  `voucher`.`id`, `voucher`.`v_type`, `voucher`.`title`, `store`.`name`, `voucher`.`store_id`, `store`.`img_short` FROM `voucher` inner join `store` on `voucher`.`store_id`=`store`.`id` where title like '".$name."%' ".$sub_query." LIMIT $start, $per_page";
$result_pag_data = mysql_query($query_pag_data) or die('MySql Error' . mysql_error());
$msg = "";
while ($row = mysql_fetch_array($result_pag_data)) {
$status="";

    $msg .= "<tr><td><img src='".$row['img_short']."' width='50' height='50'/></td> <td><b>" . $row['title'] . "</b></td> <td>".$row['store_id']."</td><td>".$row['v_type']."</td><td><a class='btn btn-info' href='voucher_edit.php?eid=".$row['id']."'>
                                    <i class='glyphicon glyphicon-edit icon-white'></i>
                                    Edit
                                </a>&nbsp;
								
								<a href='search_voucher.php?did=".$row['id']."' class='btn btn-danger'>
                                    <i class='glyphicon glyphicon-trash icon-white'></i>
                                    Delete
                                </a>
								</td></tr>";
}
$msg = "<div class='data1'><table class=\"table table-striped table-bordered responsive\">
                        <thead>
                        <tr>
                            <th>Image</th>
                            <th>Voucher</th>
                            <th>Store Id</th>
							<th>Voucher Type</th>
                            <th>Actions</th>
							
                        </tr>
                        </thead>
                        <tbody>" . $msg . "</tbody></table></div>"; //Content for Data


/* --------------------------------------------- */
$query_pag_num = "SELECT COUNT(*) AS count FROM voucher where title like '".$name."%' ".$sub_query."";
$result_pag_num = mysql_query($query_pag_num);
$row = mysql_fetch_array($result_pag_num);
$count = $row['count'];
$no_of_paginations = ceil($count / $per_page);

/* ---------------Calculating the starting and endign values for the loop----------------------------------- */
if ($cur_page >= 7) {
    $start_loop = $cur_page - 3;
    if ($no_of_paginations > $cur_page + 3)
        $end_loop = $cur_page + 3;
    else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
        $start_loop = $no_of_paginations - 6;
        $end_loop = $no_of_paginations;
    } else {
        $end_loop = $no_of_paginations;
    }
} else {
    $start_loop = 1;
    if ($no_of_paginations > 7)
        $end_loop = 7;
    else
        $end_loop = $no_of_paginations;
}
/* ----------------------------------------------------------------------------------------------------------- */
$msg .= "<div class='pagination1'><ul>";

// FOR ENABLING THE FIRST BUTTON
if ($first_btn && $cur_page > 1) {
    $msg .= "<li p='1' class='active'>First</li>";
} else if ($first_btn) {
    $msg .= "<li p='1' class='inactive'>First</li>";
}

// FOR ENABLING THE PREVIOUS BUTTON
if ($previous_btn && $cur_page > 1) {
    $pre = $cur_page - 1;
    $msg .= "<li p='$pre' class='active'>Previous</li>";
} else if ($previous_btn) {
    $msg .= "<li class='inactive'>Previous</li>";
}
for ($i = $start_loop; $i <= $end_loop; $i++) {

    if ($cur_page == $i)
        $msg .= "<li p='$i' style='color:#fff;background-color:#006699;' class='active'>{$i}</li>";
    else
        $msg .= "<li p='$i' class='active'>{$i}</li>";
}

// TO ENABLE THE NEXT BUTTON
if ($next_btn && $cur_page < $no_of_paginations) {
    $nex = $cur_page + 1;
    $msg .= "<li p='$nex' class='active'>Next</li>";
} else if ($next_btn) {
    $msg .= "<li class='inactive'>Next</li>";
}

// TO ENABLE THE END BUTTON
if ($last_btn && $cur_page < $no_of_paginations) {
    $msg .= "<li p='$no_of_paginations' class='active'>Last</li>";
} else if ($last_btn) {
    $msg .= "<li p='$no_of_paginations' class='inactive'>Last</li>";
}
$goto = "<input type='text' class='goto' size='1' style='margin-top:-1px;margin-left:60px;'/><input type='button' id='go_btn' class='go_button' value='Go'/>";
$total_string = "<span class='total' a='$no_of_paginations'>Page <b>" . $cur_page . "</b> of <b>$no_of_paginations</b></span>";
$msg = $msg . "</ul>" . $goto . $total_string . "</div>";  // Content for pagination
echo $msg;
echo "<script>$('#container1 .pagination1 li.active').on('click',function(){
                    var page = $(this).attr('p');
                    search(page);
                    
                });           
                $('#go_btn').on('click',function(){
                    var page = parseInt($('.goto').val());
                    var no_of_pages = parseInt($('.total').attr('a'));
                    if(page != 0 && page <= no_of_pages){
                        search(page);
                    }else{
                        alert('Enter a PAGE between 1 and '+no_of_pages);
                        $('.goto').val('').focus();
                        return false;
                    }
                    
                });</script>";
}

