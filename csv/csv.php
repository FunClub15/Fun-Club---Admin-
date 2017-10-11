<?php 
session_start();
// Muhammad Khurram - 18 Nov 2015 -->
// File used in Seller Panel -->
require_once('../../global_declare.php');
$gd  = new global_declare();
$con = $gd->connect();
$seller_id = $_SESSION['seller_id'];
$seller_name = $_SESSION['seller_name'];

header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=file.csv");
header("Pragma: no-cache");
header("Expires: 0");


$file = fopen("subcribe.csv","r");
$list = array();

$query = "SELECT * FROM `subcribe`";
$get_emails = $gd->select($con, $query);

foreach ( $get_emails as $data ) {
    // Add a header row if it hasn't been added yet
    if ( !$headerDisplayed ) {
        // Use the keys from $data as the titles
        $data = array_filter($data);
        outputCSV($fh, array_keys($data));
        $headerDisplayed = true;
    }
 
    // Put the data into the stream
    outputCSV($data);
}

function outputCSV($list) {
    $output = fopen("php://output", "w");

    foreach ($list as $row) {
        fputcsv($output, $row);
    }
    fclose($output);
}
?>