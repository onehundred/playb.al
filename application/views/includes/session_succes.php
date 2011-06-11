<?php $username =$this->session->userdata('username');

if($username != ""){
?>
<a href="#" id="closeProfile"><img src="<?php echo base_url();?>img/close.png" ondragstart="return false" /></a>

<img src="<?php echo base_url();?>img/default_profile.png" id="profilePhoto" alt="profielfoto" ondragstart="return false" />

	<p><?php echo($username);?></p>
		<p><?php echo($teamnaam);?></p>
	<?php echo anchor('main/logout','afmelden', 'id="logout"') ?>

	

<?php }?>
