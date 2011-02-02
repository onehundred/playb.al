<div>
<?php
		echo form_open('sportkeuze/korfbal_signup');
		echo form_input('voornaam', set_value('voornaam', 'First Name'));
		echo form_input('achternaam', set_value('achternaam', 'Last Name'));
		echo form_input('email', set_value('email', 'E-Mail'));
		echo form_submit('submit', 'Create team');
?>

</div>