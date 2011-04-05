<!-- head voor homepage -->

<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1"/>
<meta name="viewport" content="width=device-width; maximum-scale=1"/>
<title>playb.al</title>
<link rel="stylesheet" media="all" href=""/>
<link href="<?php echo base_url();?>css/style.less" rel="stylesheet/less" />

<!-- Fallback if browser does not support media queries + javascript (Read: Internet Explorer < 9) -->
<!--[if lt IE 9]>
	<link rel="stylesheet" href="8col.css" media="screen" />
	<![endif]-->

<!-- Media Queries / Less -->
<link href="<?php echo base_url();?>css/style1168.less" rel="stylesheet/less" media="only screen and (min-width: 1212px)" />
<link href="<?php echo base_url();?>css/style768.less"  rel="stylesheet/less" media="only screen and (max-width: 991px) and (min-width: 768px)" />
<link href="<?php echo base_url();?>css/style480.less"  rel="stylesheet/less" media="only screen and (max-width: 767px) and (min-width: 480px)" />
<link href="<?php echo base_url();?>css/style320.less"  rel="stylesheet/less" media="only screen and (max-width: 479px)" />

<script src="<?php echo base_url();?>js/less-1.0.41.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
<!-- jquery lokaal wegens falen van google gedurende productie -->
<script src="<?php echo base_url();?>js/jquery-1.5.2.min.js"></script>
<script src="<?php echo base_url();?>js/jquery-ui-1.8.9.custom/js/jquery-ui-1.8.9.custom.min.js"></script>
<script src="<?php echo base_url();?>js/jquery.mediaqueries.js"></script>
<script src="<?php echo base_url();?>js/touchswipe.js"></script>
<script src="<?php echo base_url();?>js/playbal.js"></script>
<script src="<?php echo base_url();?>js/jquery.transform.js"></script>
<script src="<?php echo base_url();?>/js/jquery.flip.js"></script>
<script src="<?php echo base_url();?>/js/jquery.multiple-bgs.min.js"></script>
<!--<script src="<?php echo base_url();?>js/jquery.circulate.js"></script>-->
<!--<script src="<?php echo base_url();?>js/jquery.easing.js"></script>-->
<script src="<?php echo base_url();?>js/jquery.loading.1.6.4.js"></script>
<!--<script src="<?php echo base_url();?>js/hoverable.js"></script>-->
<!--<script src="<?php echo base_url();?>js/touchable.js"></script>-->
<script src="<?php echo base_url();?>js/modernizr-1.6.min.js"></script>

<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body>
<script>
$(document).ready(function() {
$('#wrap').loading({ text: 'loading', pulse: false, mask: true, max: 100 });
});

</script>
