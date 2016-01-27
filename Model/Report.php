<?Php

class Report
{
	
	
	public function __construct()
	{
		$this->setGetVariables();
	}
	
	/*
	Function Name :setPostVariables
	Description :used to set post variables to class variables	
	*/
	
	public function setGetVariables()
	{
		foreach($_POST as $key=>$value)
		{
			$this->$key=$value;
		}
	}
	
	
	/*
	Function Name :getReport
	Description :used to get invoices list
	Description :$where is used to pass condition for query
	*/
	
	public function getReport($where='')
	{
		
		$sql="select inv.invoice_num,inv.invoice_date,p.product_description,invt.qty,invt.price
		   from invoices inv,invoicelineitems invt,products p,clients c
		   where inv.invoice_num=invt.invoice_num
		   and invt.product_id=p.product_id
		   and inv.client_id=c.client_id
		   $where order by invoice_date desc
		   ";
		$result=mysql_query($sql);
		$output=array();
		
		if(!$result)
			return 0;
		
		while($data=mysql_fetch_assoc($result))
		{
			$output[]=$data;
		}
		
		
		return $output;
		
	}
	
	
	/*
	Function Name :getDateFilter
	Description :used to get date filter options
	*/
	
	public function getDateFilter()
	{
		$html='';
		$html.='<option value="all">All Ivoices</option>';
		$html.='<option value="last_month_date">Last Month To Date</option>';
		$html.='<option value="this_month">This Month</option>';
		$html.='<option value="this_year">This Year</option>';
		$html.='<option value="last_year">Last Year</option>';
		return $html;
	}
	
	
	/*
	Function Name :getClientFilter
	Description :used to get client filter options
	*/
	
	public function getClientFilter()
	{
		$sql="select * from clients";
		$result=mysql_query($sql);
		$html='<option value=""> Select Client</option>';
		
		while($data=mysql_fetch_assoc($result))
		{
			$html.='<option value="'.$data['client_id'].'">'.$data['client_name'].'</option>';
		}
		
		$html.='';
		
		return $html;
		
	}
	
	/*
	Function Name :getProductFilter
	Description :used to get product filter options
	Params :$client_id is id of the client
	*/
	
	public function getProductFilter($client_id='')
	{
		$html='<option value=""> Select Product </option>';
		
		if($client_id=='') return $html;
		
		$sql="select p.* from products p where p.client_id='$client_id'";
		$result=mysql_query($sql);
		
		
		while($data=mysql_fetch_assoc($result))
		{
			$html.='<option value="'.$data['product_id'].'">'.$data['product_description'].'</option>';
		}
		
		$html.='';
		
		return $html;
	}
	
	
	
	
	
	

}


?>