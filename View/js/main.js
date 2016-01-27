$(document).ready(function(){
	
$('#submit_filter').click(function(){

$.ajax({
	   url: "ajax_handler.php",
	   data: {action:'filter_result',date_type:$('#date_filter').val(),client_id:$('#client_filter').val(),product_id:$('#product_filter').val()}
	}).success(function(data) {
	   $('#result_data').html('');
	   $('#result_data').html(data);
	});
	
});

$('#client_filter').change(function(){
	
	$.ajax({
	   url: "ajax_handler.php",
	   data: {action:'product_list',id:$(this).val()}
	}).success(function(data) {
	   $('#product_filter').html('');
	   $('#product_filter').html(data);
	});
	
});


	
});