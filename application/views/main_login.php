<div id="login">
    <ul id="menu">
        <li class="menu_right"> <a href="#" class="drop">
            <img src="<?php echo base_url();?>img/home.png" />
            <?php $username = $this->session->userdata('username'); if(isset($username)){ echo $username;} ?>
            <?php if(!$username){?>
            aanmelden
            <?php } ?>
            </a> 
            
            <!-- Begin 3 columns Item -->
            
            <div class="dropdown_3columns align_right"><!-- Begin 3 columns container --> 
                
                <!--
<div class="col_1">
                    <ul class="greybox">
                        <li><a href="#">FreelanceSwitch</a></li>
                    </ul>
                </div>
--> 
                <!--
<div class="col_1">
                    <ul class="greybox">
                             <li><a href="#">FreelanceSwitch</a></li>
                    </ul>
                </div>
-->
                <div class="col_1">
                    <ul class="greybox">
                        <!--
  <li><a href="#">Illustration</a></li>
                        <li><a href="#">More...</a></li>
--> 
                        <!-- todo div hieronder toewijzen aan login (gemodificeerd) -->
                        
                        <div>
                            <?php
                		$user_id = $this->session->userdata('user_id'); 
				     		if (isset($user_id)){
	     					$this->load->view('includes/session_succes');
    						} 
   
    					if(!$user_id){
    					?>
                        </div>
                        
                        <!--   <h1>login</h1> -->
                        
                        <div>
                            <?php
                        
						echo form_open('main/login');
		    			echo("<p>gebruikersnaam of e-mail adres</p>");
						echo form_input('username', '');
		 				echo("<p>paswoord</p>");
						echo form_password('password', '');
		    			echo("<p ></p>");
/* 		    	todo paswoord vergeten functionaliteit */
		    			echo("<p >paswoord vergeten?</p>");
		    			
						echo form_submit('submit', 'login');
						
						echo form_close();
						} 
						?>
                        </div>
                    </ul>
                </div>
            </div>
            <!-- End 3 columns container --> 
            
        </li>
        
        
        
        
    
        
        
        
        
        
     <!--   <li><?php echo form_input('','zoekfunctie') ?></li> -->
        
        
        
        
        
        
        
        
        
        
        
        
        
        <!-- End 3 columns Item -->
    </ul>
    
</div>
