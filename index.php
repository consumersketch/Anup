<?php
require('Config/common.php');
require(MODEL_PATH.'Report.php');

$report = new Report();

//getting filter list
$date_filter_list=$report->getDateFilter();
$client_filter_list=$report->getClientFilter();
$product_filter_list=$report->getProductFilter();

//getting invoice list
$invoice_list=$report->getReport();


include(VIEW_PATH.'dashboard.php');

?>