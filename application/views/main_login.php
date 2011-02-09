<style type="text/css">
h1 {
	font-family: 'LeagueGothicRegular';
}
h2 {
	font-family: 'SFCollegiateSolidRegular';
}
</style>
<div id="columns">
	<div id="main_login" style="float:right;">
   <!--  <h1>login</h1> -->
    <?php
    $user_id = $this->session->userdata('user_id'); 
     if (isset($user_id))
    { $this->load->view('includes/session_succes');
    } 
    
    
    if(!$user_id){
		echo form_open('main/login');
		echo form_input('username', 'Username');
		echo form_password('password', 'Password');
		echo form_submit('submit', 'Login');
		echo form_close();	
		echo anchor('main/signup','Create account');
		} 
	?>
	</div>
	
</div>

