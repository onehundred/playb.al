<?php $username =$this->session->userdata('username');

if($username != ""){
?>
<a href="#" id="closeProfile">sluiten</a>
<img src="<?php echo base_url();?>img/default_profile.png" />

	<p>dfgs</p>
	<p>dfgs</p>
	<p>dfgs</p>
	<p>dfgs</p>	
	<p>dfgssdfs sdfsdfs sdfffff sdfsdf sdfsdf sdfsdf</p>
	<p>dfgs</p>
	<?php echo anchor('main/logout','afmelden') ?>

	

<?php }?>
