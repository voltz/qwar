<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="robots" content="index, follow">
<?php $this->load->view("general/plugins.php"); ?>
<?php if(!isset($no_node) ){ ?>
<script src="<?php echo NODESERVERURL;?>/socket.io/socket.io.js"></script>
<script type="text/javascript">
var socket = io.connect("<?php echo NODESERVERURL;?>");
</script>
<?php } ?>
<?php $this->load->view("general/javascript.php"); ?>
<?php $this->load->view("general/css.php"); ?>
<title><?php echo (isset($web_title))?$web_title:"QWar by Thinker";?></title>
</head>
<body>
<div id="base_url" alt="<?php echo base_url(); ?>" data-node="<?php echo NODESERVERURL;?>"></div>