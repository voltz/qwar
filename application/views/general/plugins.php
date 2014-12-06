<script src="<?php echo base_url('assets/plugins/jquery-2.0.3.min.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/jquery.form.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/jquery-ui-1.9.2.custom.min.js');?>" type="text/javascript"></script>
<script src="<?php echo base_url('assets/plugins/select2-3.4.5/select2.min.js');?>" type="text/javascript"></script>
<?php
if(isset($plugins_js)){
	foreach($plugins_js as $js){
	?>
	<script src="<?php echo base_url('assets/plugins/'.$js);?>" type="text/javascript"></script> 
	<?php
	}
}
?>
<?php
if(isset($plugins_css)){
	foreach($plugins_css as $css){
	?>
	<link href="<?php echo base_url('assets/plugins/'.$css);?>" media="all" rel="stylesheet" type="text/css">
	<?php
	}
}
?>