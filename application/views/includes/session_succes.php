<?php $username =$this->session->userdata('username');

if($username != ""){
?>
<?php if($profilepic != null){ ?>
	<img id="profilePhoto" alt="profielfoto" src="<?php echo base_url();?>userpics/thumbs/<?php echo $profilepic;?>" ondragstart="return false" />
<?php }else{ ?>
	<img src="<?php echo base_url();?>img/default_profile.png" id="profilePhoto" alt="profielfoto" ondragstart="return false" />
<?php } ?>

<a href="#" id="closeProfile"><img src="<?php echo base_url();?>img/close.png" ondragstart="return false" /></a>

	<p><?php echo($username);?></p>
		<p><?php echo($teamnaam);?></p>
	<?php echo anchor('main/logout','afmelden', 'id="logout"') ?>

	

<?php }?>
