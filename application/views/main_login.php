<style type="text/css">
h1 {
	font-family: 'LeagueGothicRegular';
}
h2 {
	font-family: 'SFCollegiateSolidRegular';
}
</style>
<div id="columns">
	<div id="main_login">
    <h1>login</h1>
    <?php
		echo form_open('main/login');
		echo form_input('username', 'Username');
		echo form_password('password', 'Password');
		echo form_submit('submit', 'Login');	
		echo anchor('main/signup','Create account')
		
	?>
	</div>
</div>
