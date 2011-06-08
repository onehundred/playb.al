<script>
	$(document).ready(function(){
	
	function checkemail(str){
	   var filter=/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/
	
	   if ( !filter.test(str)) {
	    //alert ("bad");
	    return false;
	   }
	   else {
	    //alert ("ok");
	    return true;
	  }
	}
	
	$('#signupform').submit(function() {
		var status = 0;
		$('#personal_error').text('');
		$('#username_error').text('');
		$('#paswoord_error').text('');
		
		
		var voornaam = $('#sign_voornaam').val();
		var achternaam = $('#sign_achternaam').val();
		var email = $('#sign_email').val();
  		var username = $('#sign_username').val();
  		var password = $('#sign_password').val();
  		var password2 = $('#sign_password2').val();
  		
		$.ajax({
    			type: "POST",
    			url: "../../index.php/main/check_username",
    			data:  { username: username,
    					 email: email,    
            			
        				},
    			dataType: "json",
        		success: function(check_data){ 

  					//alert(check_data.username);

					if(voornaam == '' || voornaam == 'Voornaam'){
						$('#sign_voornaam').css({    
												'border' : '1px solid red',
											});
					
					}else{
						status = status +1;
								$('#sign_voornaam').css({    
												'border' : '1px solid gray',
											});
					
					}
					if(achternaam == '' || achternaam == 'Achternaam'){
						$('#sign_achternaam').css({    
												'border' : '1px solid red',
											});
					
					}else{
						status = status +1;
							$('#sign_achternaam').css({    
												'border' : '1px solid gray',
											});
					
					}
					if(email == '' || email =='email' || checkemail(email) == false){
						$('#sign_email').css({    
												'border' : '1px solid red',
											});
					}else{
						status = status +1;
						$('#sign_email').css({    
												'border' : '1px solid gray',
											});
					
					}
					if(check_data.email == false){
						$('#personal_error').text('Dit e-mail adres bestaat al.');
					}else{
						status = status +1;
					
					}
					if(username == '' || username == 'Username'){
						$('#sign_username').css({    
												'border' : '1px solid red',
											});
					}else{
						status = status +1;
						$('#sign_username').css({    
												'border' : '1px solid gray',
											});
					
					}
					if( check_data.username == false){
				
						$('#username_error').text('Deze username bestaat al.');
						
					}else{
						status = status +1;
					
					}
					if(password == '' || password =='Paswoord'){
						$('#sign_password').css({    
												'border' : '1px solid red',
											});
					}else{
						status = status +1;
						$('#sign_password').css({    
												'border' : '1px solid gray',
											});

					
					}
				     if(password2 == '' || password2 == 'Herhaal paswoord'){
						$('#sign_password2').css({    
												'border' : '1px solid red',
											});
					}else{
						status = status +1;
						$('#sign_password2').css({    
												'border' : '1px solid gray',
											});
					
					}
					if(password != password2){
						$('#paswoord_error').text('De paswoorden zijn niet identiek.');
					
					}else{
						status = status +1;
					
					}
					
					if(status == 9){
			  			$.ajax({
			    			type: "POST",
			    			url: "../../index.php/main/create_user",
			    			data:  { username: username,
			            			 password: password, 
			            			 voornaam: voornaam,
			            			 achternaam: achternaam,
			            			 email: email,   
			            			
			        				},
			    			dataType: "json",
			        		success: function(data){
			        			window.location = "../../index.php/main/signup_success"
			    			  }
			  		
			  			});
			  		}
  			}
  	});		
  		
  		return false;
	});
});

</script>

<section id="layouts">
    <div class="makeAccount" style="display: none;">
        <div id="main_signup">
            <h2>account aanmaken</h2>
            <a href="#" id="makeAccountClose">sluiten</a> <a href="#" id="switchAccountToLogin">heb je al een account?</a>
            <section id="layouts">
                <figure class="stripe1"></figure>
                <figure class="stripe2"></figure>
                <figure class="stripe3"></figure>
                <form action="#" method="post" id="signupform">
                <fieldset>
                    <legend>Personal Information</legend>
                    <input type="text" name="voornaam" id="sign_voornaam" onClick="this.value=''" value="Voornaam"/>
                    <input type="text" name="achternaam" id="sign_achternaam" onClick="this.value=''" value="Achternaam"/>
                    <input type="text" name="email" id="sign_email" onClick="this.value=''" value="Email"/>
                    <p id="personal_error"></p>
                </fieldset>
                <fieldset>
                    <legend>Login Info</legend>
                    <input type="text" name="username" id="sign_username" onClick="this.value=''" value="Username"/>
                    <p id="username_error"></p>
                    <input type="password" name="password" id="sign_password" onClick="this.value=''" value="Paswoord"/>
                    <input type="password" name="password2" id="sign_password2" onClick="this.value=''" value="Herhaal paswoord"/>
                    <p id="paswoord_error"></p>
                    <input type="submit" name="submitsignup" value="Registreer"/>
           
                </fieldset>
                </form> 
            </section>
        </div>
    </div>
    <!-- end makeAccount -->
    <figure class="korfbal">
        <img id="korfbalbg" style="display:none"; src="<?php echo base_url();?>img/korfbalbg.png"/>
        <div class="startgame">
            <h1>korfbal</h1>
            <a href="#" id="startKorfbal">start</a> </div>
        <div class="korfbalAnimation" style="display: none;">
            <img src="<?php echo base_url();?>img/korfbal.png" type="image/png" id="korfbal" ondragstart="return false"/>
        </div>
    </figure>
    <!-- end korfbal -->
    <figure class="basketbal">
        <img id="basketbalbg" src="<?php echo base_url();?>img/basketbalbg.png" />
        <div class="startgame">
            <h1>basketbal</h1>
            <a href="#" id="startBasketbal">start</a> </div>
        <div class="basketbalAnimation" style="display: none;">
            <img src="<?php echo base_url();?>img/basketbal.png" id="basketbal" ondragstart="return false"/>
        </div>
    </figure>
    <!-- end basketbal -->
    <figure class="volleybal">
        <img id="volleybalbg" src="<?php echo base_url();?>img/volleybalbg.png" />
        <div class="startgame">
            <h1>volleybal</h1>
            <a id="startVolleybal" href="#">start</a> </div>
        <div class="volleybalAnimation" style="display: none;">
            <img src="<?php echo base_url();?>img/volleybal.png" id="volleybal" ondragstart="return false" />
        </div>
    </figure>
    <!-- end volleybal -->

</section>
<h1 id="tagline">manage jouw team.</h1>








<section id="bottom"> </section>

<!--
    <div class="bottomButtons"> 
                <div class="light"><a href="#">hoe werkt het</a></div>
        <div class="question"><a href="#">bekijk demo</a></div> 
    </div>
-->