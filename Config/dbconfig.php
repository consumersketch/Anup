<?php
//defining db variables
$host='localhost';
$user_name='root';
$password='';
$db_name='test';

//connection to db
$conn=mysql_connect($host,$user_name,$password);
if(!$conn)die ('Could not connect to database !!');
mysql_select_db($db_name);

?>