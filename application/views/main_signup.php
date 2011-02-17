<div id="main_signup">
	<h2>Create an account</h2>
<fieldset>
<legend>Personal Information</legend>	
	<?php
		echo form_open('main/create_user');
		echo form_input('voornaam', set_value('voornaam', 'First Name'));
		echo form_input('achternaam', set_value('achternaam', 'Last Name'));
		echo form_email('email', set_value('email', 'E-Mail'));
		echo form_input('land', set_value('land', 'Country'));
	?>
</fieldset>	
<fieldset>
<legend>Login Info</legend>
	<?php	
		echo form_input('username', set_value('username', 'Username'));
		echo form_input('paswoord', set_value('paswoord', 'Password'));
		echo form_input('paswoord2', set_value('paswoord2', 'Password confirm'));
		echo form_submit('submitsignup', 'Create account');
		echo form_close();
	?>
<?php echo validation_errors('<p class="errors">');?>
</fieldset>	 
</div>