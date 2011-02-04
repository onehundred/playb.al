<style type="text/css">
h1 {
	font-family: 'LeagueGothicRegular';
}
h2 {
	font-family: 'SFCollegiateSolidRegular';
}
</style>
<div id="main_login">
    <h1>Login</h1>
    <?php
		echo form_open('main/login');
		echo form_input('username', 'Username');
		echo form_password('password', 'Password');
		echo form_submit('submit', 'Login');
		
		
	
		echo anchor('main/signup','Create account')
		
		 ?>
</div>
