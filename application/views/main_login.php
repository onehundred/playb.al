<div id="login">
    <li class="menu_right"> <a href="#" id="profile" class="">
        <?php $username = $this->session->userdata('username'); if(isset($username)){ echo $username;} ?>
        </a>
        <?php if(!$username){?>
        <div id="profile">
        <a href="#">aanmelden</a>
                <img src="<?php echo base_url();?>img/home.png" />
        </div>
        <?php } ?>


    </li>
</div>
<div class="profile" style="display: none; opacity: 0;">
    <?php
                		$user_id = $this->session->userdata('user_id'); 
				     		if (isset($user_id)){
	     					$this->load->view('includes/session_succes');
    						} 
   
    					if(!$user_id){
    					?>
</div>
<div class="login" style="display: none; opacity: 0;"><a href="#" id="closeLogin">sluiten</a>
    <?php
                        
						echo form_open('main/login');
		    			echo("<p>gebruikersnaam of e-mail adres</p>");
						echo form_input('username', '');
		 				echo("<p>paswoord</p>");
						echo form_password('password', '');
		    			echo("<p ></p>");
						/* todo paswoord vergeten functionaliteit */
		    			echo("<p >paswoord vergeten?</p>");
		    			
						echo form_submit('submit', 'login');
						
						echo form_close();
						} 
						?>
</div>

<!-- end login --> 

<!-- End 3 columns container --> 

<!-- End 3 columns Item -->