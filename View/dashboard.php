<html>
<head>
<title>Dashboard</title>
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<link type="text/css" href="<?php echo CSS_PATH;?>style.css" rel="stylesheet"  />
<script src="<?php echo  JS_PATH;?>main.js"  /></script>
</head>
<body>

<table align="center" border="1" class="Filter_Tbl">
<tbody>
<tr>
<td><select name="client_filter" id="client_filter"><?php echo $client_filter_list; ?> </select></td>
<td><select name="product_filter" id="product_filter"><?php echo $product_filter_list; ?> </select></td>
<td><select name="date_filter" id="date_filter"><?php echo $date_filter_list; ?> </select></td>
<td><input type="button" id="submit_filter" value="Submit Filter"/></td>
</tr>
</tbody>
</table>

<table align="center" border="1" class="Report_Tbl">
<thead><td>Invoice Number</td><td>Invoice Date</td><td>Product</td><td>Quantity</td><td>Price</td><td>Total</td></thead>
<tbody id="result_data">
<?php foreach($invoice_list as $key=>$value){ ?>
<tr>
<td><?php echo $value['invoice_num'];  ?></td>
<td><?php echo date('d/m/Y',strtotime($value['invoice_date']));  ?></td>
<td><?php echo $value['product_description'];  ?></td>
<td><?php echo $value['qty'];  ?></td>
<td><?php echo $value['price'];  ?></td>
<td><?php echo round(($value['price']*$value['qty']),2);  ?></td>
<tr>
<?php } ?>
</tbody>

</table>
</body>
</html>