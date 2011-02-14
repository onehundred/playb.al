<!-- todo div hieronder toewijzen aan login (gemodificeerd) -->

<div id="alslogin"> <?php
    $user_id = $this->session->userdata('user_id'); 
     if (isset($user_id)){
     $this->load->view('includes/session_succes');
    } 
   
    if(!$user_id){?>
</div>

  <!--   <h1>login</h1> -->
        <div id="logins">
		<a href="#" id="showLogin">aanmelden</a>
		</div>
		<div id="login" style="display:none;">
	<?php
		echo form_open('main/login');
		    echo("username");
		echo form_input('username', 'Username');
		 echo("password");
		echo form_password('password', 'Password');
		    echo("<p ></p>");
		echo form_submit('submit', 'Login');

		echo form_close();
		} 
	?><p>test</p><p>test</p><p>test</p><p>test</p><p>test</p><p>test</p>
		</div>
	 

