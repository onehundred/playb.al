<script>
$(document).ready(function(){
	$('#loginform').submit(function() {
  		var username = $('#login_username').val();
  		var password = $('#login_password').val();
  		
  		if(username == '' || password == ''){
  			$('.login').effect('shake', { times:3 }, 80);
  		}else{
  		
  			$.ajax({
    			type: "POST",
    			url: "../../index.php/main/login",
    			data:  { username: username,
            			 password: password,    
            			
        				},
    			dataType: "json",
        		success: function(data){
        			if(data == 'false'){
        				$('.login').effect('shake', { times:3 }, 80);
        			
        			}else{
        				window.location = '../../index.php/sportchoice/sport';
        			
        			}
  				}
  		
  			});
  		}
  		return false;
	});
});
</script>
<div id="login">
    <li class="menu_right"> <a href="#" id="profile" class=""> 
        <?php $username = $this->session->userdata('username'); if(isset($username)){ echo $username;} ?>
        </a>
        <?php if(!$username){?>
        <a href="#" id="profile">aanmelden</a>
        <?php } ?>&nbsp;<img src="<?php echo base_url();?>img/home.png" />
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
    
<!--       <h1>login</h1> -->
    
    <div class="login" style="display: none; opacity: 0;"><a href="#" id="closeLogin">sluiten</a>
        <?php
                        $attributes = array('id'=>'loginform');
						echo form_open('#', $attributes);
		    			echo("<p>gebruikersnaam of e-mail adres</p>");
		    			$userdata = array(
			              'name'        => 'username',
			              'id'          => 'login_username',
			              'value'       => '',
			          	);

						echo form_input($userdata);
		 				echo("<p>paswoord</p>");
		 				$passdata = array(
			              'name'        => 'password',
			              'id'          => 'login_password',
			              'value'       => '',
			          	);
						echo form_password($passdata);
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

<!--        <li><?php echo form_input('','zoeken') ?></li>  -->

<!-- End 3 columns Item -->