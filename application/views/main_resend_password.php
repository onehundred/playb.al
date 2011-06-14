<style>
	#resend_password{
		margin-left: 20%;
	}
</style>
<div id="resend_password">
<?php if(isset($update)){ ?>
	<?php if($update == 'false'){ ?>
		<p>U bent niet in staat om deze pagina te bekijken.</p>
	
	<?php }
		if($update == 'true'){ ?>
		<?php echo validation_errors(); ?>
		<form method="post" action="http://playb.al/index.php/main/update_password/<?php echo $this->uri->segment('3');?>/<?php echo $this->uri->segment('4');?>">
			<label>Paswoord:</label><input type="password" name="password1"/>
			<label>Herhaal paswoord:</label><input type="password" name="password2"/>
			<input type="submit"/>
		</form>
	
	<?php } 
	if($update == 'success'){ ?>
	<p> uw paswoord is veranderd!</p>
	
	<?php } ?>
<?php }else{ ?>
	<?php if(isset($resend)){ ?>
		<?php if($resend == 'resend'){ ?>
		<p>Check uw inbox voor verdere instructies.</p>
		<?php }else{ ?>
			<p>Dit e-mail adres bestaat niet.</p>
		<?php } ?>
	<?php }else{ ?>


	<h3>Paswoord vergeten?</h3>
	<p>Geef hieronder uw e-mail adres in, dan sturen we u een mail met verdere instructies.</p>
	
	<form method="post" action="http://playb.al/index.php/main/resend_password">
		<input type="input" name="email"/>
		<input type="submit"/>
	
	
	</form>
	
	<?php } ?>
<?php } ?>
</div>