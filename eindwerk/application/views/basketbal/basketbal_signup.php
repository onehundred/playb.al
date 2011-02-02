<div id="basketbal_signup">
<form id="SignupForm" action="sportkeuze/basketbal_signup">
<fieldset>
<legend>Team name</legend>

<?php
		echo form_input('teamnaam', set_value('teamnaam', 'Teamn Name'));
		
		
?></fieldset>
<fieldset>
<legend>Arena name</legend>
<?php		
		echo form_input('stadionnaam', set_value('stadionnaam', 'Name arena'));
		echo form_submit('submit', 'Create team');
		?>
</fieldset>
</form>
</div>