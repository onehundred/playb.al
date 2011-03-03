<div id="main_signup">
	<h1 id="tagline">manage jouw team</h1>
		<h2>account aanmaken</h2>
		<section id="layouts">
		<figure class="stripe1"></figure>
		<figure class="stripe2"></figure>
		<figure class="stripe3"></figure>
<fieldset>
<legend>Personal Information</legend>	
	<?php
		$js= "onClick=this.value=''";
		echo form_open('main/create_user');
		echo form_input('voornaam', set_value('voornaam', 'First Name'), $js);
		echo form_input('achternaam', set_value('achternaam', 'Last Name'), $js);
		echo form_email('email', set_value('email', 'E-Mail'),$js);
		echo form_input('land', set_value('land', 'Country'),$js);
	?>
</fieldset>	
<fieldset>
<legend>Login Info</legend>
	<?php	
		echo form_input('username', set_value('username', 'Username'),$js);
		echo form_input('paswoord', set_value('paswoord', 'Password'),$js);
		echo form_input('paswoord2', set_value('paswoord2', 'Password confirm'),$js);
		echo form_submit('submitsignup', 'Create account');
		echo form_close();
	?>
<?php echo validation_errors('<p class="errors">');?>
</fieldset>	 	
</section>
</div>
