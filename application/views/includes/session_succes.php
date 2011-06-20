<?php $username =$this->session->userdata('username');

if($username != ""){
?>
<?php

if(isset($alien)){
	if(isset($profilepic_ori)){
	 if($profilepic_ori != null){ ?>
		<img id="profilePhoto" alt="profielfoto" src="<?php echo base_url();?>img/userpics/thumbs/<?php echo $profilepic_ori;?>" ondragstart="return false" />
	<?php }else{ ?>
		<img src="<?php echo base_url();?>img/default_profile.png" id="profilePhoto" alt="profielfoto" ondragstart="return false" />
	<?php } }else{?>
		<img src="<?php echo base_url();?>img/default_profile.png" id="profilePhoto" alt="profielfoto" ondragstart="return false" />
	<?php }

}else{

	if(isset($profilepic)){
	 if($profilepic != null){ ?>
		<img id="profilePhoto" alt="profielfoto" src="<?php echo base_url();?>img/userpics/thumbs/<?php echo $profilepic;?>" ondragstart="return false" />
	<?php }else{ ?>
		<img src="<?php echo base_url();?>img/default_profile.png" id="profilePhoto" alt="profielfoto" ondragstart="return false" />
	<?php } }else{?>
		<img src="<?php echo base_url();?>img/default_profile.png" id="profilePhoto" alt="profielfoto" ondragstart="return false" />
	<?php }

} ?>

<a href="#" id="closeProfile"><img src="<?php echo base_url();?>img/close.png" ondragstart="return false" /></a>

	<p><?php echo($username);?></p>
	<?php if(isset($alien)){ ?>
		<p><?php if(isset($teamnaam_ori)){ echo $teamnaam_ori; }?> </p>
	<?php }else{ ?>
		<p><?php if(isset($teamnaam)){ echo($teamnaam);}?></p>
	<?php } ?>	

	<?php echo anchor('main/logout','afmelden', 'id="logout"') ?>


	

<?php }?>
