<div id="columns">
	<div id="login" style="float:right;">
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
/* 		todo: create account lostrekken */	
		echo anchor('main/signup','Create account');
		} 
	?>
	</div>
	
</div>

