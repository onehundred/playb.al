<div id="login" style="">
    <ul id="menu">
        <li class="menu_right"><a href="#" class="drop">aanmelden</a><!-- Begin 3 columns Item -->
            
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
                        <!--
          <li><a href="#">ThemeForest</a></li>
                    <li><a href="#">GraphicRiver</a></li>
                    <li><a href="#">ActiveDen</a></li>
                    <li><a href="#">VideoHive</a></li>
                    <li><a href="#">3DOcean</a></li>
-->
                    </ul>
                </div>
                <div class="col_1">
                    <ul class="greybox">
                      <!--
  <li><a href="#">Illustration</a></li>
                        <li><a href="#">More...</a></li>
-->
                        <!-- todo div hieronder toewijzen aan login (gemodificeerd) -->
                        
                        <div id="alslogin">
                		<?php
                		$user_id = $this->session->userdata('user_id'); 
				     		if (isset($user_id)){
	     					$this->load->view('includes/session_succes');
    						} 
   
    					if(!$user_id){
    					?>
                        </div>
                        
                        <!--   <h1>login</h1> -->
                  
                        <?php
						echo form_open('main/login');
		    			echo("e-mail");
						echo form_input('username', 'Username');
		 				echo("password");
						echo form_password('password', 'Password');
		    			echo("<p ></p>");
						echo form_submit('submit', 'Login');

						echo form_close();
						} 
						?>
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
