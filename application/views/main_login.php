<div id="login" style="">
    <ul id="menu">
        <li class="menu_right"><a href="#" class="drop"><?php $username = $this->session->userdata('username'); if(isset($username)){ echo $username;} ?> <?php if(!$username){?>aanmelden<?php } ?> </a><!-- Begin 3 columns Item -->
            
            <div class="dropdown_3columns align_right"><!-- Begin 3 columns container -->
                
                <div class="col_3"> 
                    <!-- <h2>Lists in Boxes</h2> --> 
                </div>
                <div class="col_1">
                    <ul class="greybox">
                      <!--   <li><a href="#">FreelanceSwitch</a></li> -->
                    </ul>
                </div>
                <div class="col_1">
                    <ul class="greybox">
                    </ul>
                </div>
                <div class="col_1">
                    <ul class="greybox">
                      <!--
  <li><a href="#">Illustration</a></li>
                        <li><a href="#">More...</a></li>
-->
                        <!-- todo div hieronder toewijzen aan login (gemodificeerd) -->
                        
                        <div id="main_signup">
                		<?php
                		$user_id = $this->session->userdata('user_id'); 
				     		if (isset($user_id)){
	     					$this->load->view('includes/session_succes');
    						} 
   
    					if(!$user_id){
    					?>
                        </div>
                        
                        <!--   <h1>login</h1> -->
                  
                        <div id="main_signup">

                        <?php
						echo form_open('main/login');
		    			echo("gebruikersnaam of e-mail adres");
						echo form_input('username', '');
		 				echo("paswoord");
						echo form_password('password', '');
		    			echo("<p ></p>");
						echo form_submit('submit', 'Login');

						echo form_close();
						} 
						?>
                        <div id="main_signup">

                    </ul>
                </div>
                <div class="col_3"> 
                </div>
                <div class="col_3"> </div>
            </div>
            <!-- End 3 columns container --> 
            
        </li>
        <!-- End 3 columns Item -->
        </ul>
</div>
