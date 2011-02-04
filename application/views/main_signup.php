<div id="main_signup">
	<h1>Create an account</h1>
<fieldset>
<legend>Personal Information</legend>	
	<?php
		echo form_open('main/create_user');
		echo form_input('voornaam', set_value('voornaam', 'First Name'));
		echo form_input('achternaam', set_value('achternaam', 'Last Name'));
		echo form_input('email', set_value('email', 'E-Mail'));
		echo form_input('land', set_value('land', 'Country'));
		echo form_input('gemeente', set_value('gemeente', 'State'));
		echo form_input('adres', set_value('adres', 'address'));
		
			
		 ?>
		 
		 
</fieldset>	





<fieldset>
	<legend>Login Info</legend>
<?php	echo form_input('username', set_value('username', 'Username'));
		echo form_input('paswoord', set_value('paswoord', 'Password'));
			echo form_input('paswoord2', set_value('paswoord2', 'Password confirm'));
			
			echo form_submit('submit', 'Create account');


?>

<?php echo validation_errors('<p class="errors">');?>
</fieldset>	 
		
		
	
	
	


</div>