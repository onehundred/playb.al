<!DOCTYPE HTML>

<!-- head homepage -->

<html manifest="<?php echo base_url();?>playbal.manifest?v=1" lang="en" class="no-js">
<head>
<meta charset="utf-8" />

<title>playb.al</title>

<meta name="description" content="">
<meta name="author" content="">
<meta name="HandheldFriendly" content="True">
<meta name="viewport" content="width=device-width; initial-scale=1"/>
<meta name="viewport" content="width=device-width; maximum-scale=1"/>
<!-- mobile ie font smoothing -->
<meta http-equiv="cleartype" content="on">
<!-- ios app look -->
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">
<link rel="apple-touch-startup-image" href="<?php echo base_url();?>img/l/splash.png">
<!-- iphone 4, retina display -->
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url();?>img/h/apple-touch-icon.png">
<!-- ipad 1 -->
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url();?>img/m/apple-touch-icon.png">
<!-- ios, no retina display. android > 2.1 -->
<link rel="apple-touch-icon-precomposed" href="<?php echo base_url();?>img/l/apple-touch-icon-precomposed.png">
<!-- nokia -->
<link rel="shortcut icon" href="<?php echo base_url();?>img/l/apple-touch-icon.png">
<link rel="shortcut icon" href="<?php echo base_url();?>img/favicon.ico">

<link rel="stylesheet/less" href="<?php echo base_url();?>css/style.less" />


<!-- no mediaqueries fallback -->
<!--[if lt IE 9]>
<link rel="stylesheet" href="<?php echo base_url();?>css/style_nomq.css" media="screen" />
<![endif]-->

<!-- no javascipt fallback -->
<noscript><link rel="stylesheet" href="<?php echo base_url();?>css/style_nojs.css" media="screen" /></noscript>

<!-- media queries / less -->
<link rel="stylesheet/less" href="<?php echo base_url();?>css/style1168.less" media="only screen and (min-width: 1212px)" />
<link rel="stylesheet/less" href="<?php echo base_url();?>css/style768.less"  media="only screen and (max-width: 991px) and (min-width: 768px)" />
<link rel="stylesheet/less" href="<?php echo base_url();?>css/style480.less"  media="only screen and (max-width: 767px) and (min-width: 480px)" />
<link rel="stylesheet/less" href="<?php echo base_url();?>css/style320.less"  media="only screen and (max-width: 479px)" />

<script src="<?php echo base_url();?>js/less-1.0.41.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.0/jquery.min.js"></script>
<!-- jquery lokaal wegens falen van google gedurende productie -->
<!-- <script src="<?php echo base_url();?>js/jquery-1.5.2.min.js"></script> -->
<script src="http://playbaleindwerk.appspot.com/js/jquery-ui-1.8.9.custom/js/jquery-ui-1.8.9.custom.min.js"></script>
<script src="http://playbaleindwerk.appspot.com/js/touchswipe.js"></script>
<script src="<?php echo base_url();?>js/base.js"></script>
<script src="http://playbaleindwerk.appspot.com/js/jquery.transform.js"></script>
<script src="http://playbaleindwerk.appspot.com/js/jquery.multiple-bgs.min.js"></script>
<script src="<?php echo base_url();?>/js/modernizr-1.7.min.js"></script>
<!--[if IE]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!--[if (gte IE 6)&(lte IE 8)]>
<script type="text/javascript" src="<?php echo base_url();?>js/selectivizr.js"></script>
<![endif]-->
</head>
<body>
<?php include_once ("analytics.php") ?>