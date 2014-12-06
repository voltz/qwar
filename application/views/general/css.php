<link href="<?php echo base_url("assets/css/style.css");?>" media="all" rel="stylesheet" type="text/css">

<?php
if(isset($css)){
	foreach($css as $c){
	?>
	<link href="<?php echo base_url('assets/css/'.$c);?>" media="all" rel="stylesheet" type="text/css">
	<?php
	}
}
?>