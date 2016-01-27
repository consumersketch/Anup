<?php
require('Config/common.php');
require(MODEL_PATH.'Report.php');
$report = new Report();

if(!isset($_GET['action'])) exit();

$action=$_GET['action'];
$html='';

if($action=='product_list')
{
	$client_id=$_GET['id'];
	$product_list=$report->getProductFilter($client_id);
    echo $product_list;
	exit();
}



if($action=='filter_result')
{
    $date_type=$_GET['date_type'];
    $client_id=$_GET['client_id'];
    $product_id=$_GET['product_id'];
	$condition='';
	
	if($date_type!='')	
	{
		if($date_type=='last_month_date')
		{
			$str = date('Y-m-d', strtotime('-1 month '.date('Y-m-d')));
			list($y,$m,$d)=explode('-',$str);
			$start_date="$y-$m-01";
			$end_date=date('Y-m-d');
			$condition.=" and inv.invoice_date>='$start_date' and inv.invoice_date<='$end_date'";
		}
		elseif($date_type=='this_month')
		{
			$str = date('Y-m-d');
			list($y,$m,$d)=explode('-',$str);
			$start_date="$y-$m-01";
			$end_date=date('Y-m-d');
			$condition.=" and inv.invoice_date>='$start_date' and inv.invoice_date<='$end_date'";
		}
		elseif($date_type=='this_year')
		{
			$str = date('Y-m-d');
			list($y,$m,$d)=explode('-',$str);
			$start_date="$y-01-01";
			$end_date=date('Y-m-d');
			$condition.=" and inv.invoice_date>='$start_date' and inv.invoice_date<='$end_date'";
		}
		elseif($date_type=='last_year')
		{
			$str = date('Y-m-d', strtotime('-1 year '.date('Y-m-d')));
			list($y,$m,$d)=explode('-',$str);
			$start_date="$y-01-01";
			$end_date="$y-12-31";
			$condition.=" and inv.invoice_date>='$start_date' and inv.invoice_date<='$end_date'";
		}
	}

     if($client_id!='')	
	 {
		 $condition.=" and c.client_id='$client_id'";
	 }

     if($product_id!='')	
	 {
		 $condition.=" and p.product_id='$product_id'";
	 } 	 

}


$invoice_list=$report->getReport($condition);

if(!$invoice_list)
{
    $html.='<tr><td colspan="6" align="center">No data found for selected filter </td><tr>';
}
else
{
	foreach($invoice_list as $key=>$value)
	{ 
		$html.='
		<tr>
		<td>'.$value['invoice_num'].'</td>
		<td>'.date('d/m/Y',strtotime($value['invoice_date'])).'</td>
		<td>'. $value['product_description'].'</td>
		<td>'.$value['qty'].'</td>
		<td>'.$value['price'].'</td>
		<td>'.round(($value['price']*$value['qty']),2).'</td>
		<tr>';
	}
}

echo $html;
exit;

?>