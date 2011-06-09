<script>
	function username_click(){
		var username = $('#sign_username').val();
		if(username == 'Username'){
			$('#sign_username').val('');
		}
		if(username == ''){
			$('#sign_username').val('Username');
		}
		if(username != '' && username != 'Username'){
		
			$('#sign_username').val(username);
		}
	}
	function voornaam_click(){
		var voornaam = $('#sign_voornaam').val();
		if(voornaam == 'Voornaam'){
			$('#sign_voornaam').val('');
		}
		if(voornaam == ''){
			$('#sign_voornaam').val('Voornaam');
		}
		if(voornaam != '' && voornaam != 'Voornaam'){
		
			$('#sign_voornaam').val(voornaam);
		}
	
	}
	function achternaam_click(){
		var achternaam = $('#sign_achternaam').val();
		if(achternaam == 'Achternaam'){
			$('#sign_achternaam').val('');
		}
		if(achternaam == ''){
			$('#sign_achternaam').val('Achternaam');
		}
		if(achternaam != '' && achternaam != 'Achternaam'){
		
			$('#sign_achternaam').val(achternaam);
		}
	
	}
	
	function email_click(){
		var email = $('#sign_email').val();
		if(email == 'Email'){
			$('#sign_email').val('');
		}
		if(email == ''){
			$('#sign_email').val('Email');
		}
		if(email != '' && email != 'Email'){
		
			$('#sign_email').val(email);
		}
	
	}
	
	function password_click(){
			var password = $('#sign_password').val();
		if(password == 'Paswoord'){
			$('#sign_password').val('');
		}
		if(password == ''){
			$('#sign_password').val('Paswoord');
		}
		if(password != '' && password != 'Paswoord'){
		
			$('#sign_password').val(password);
		}
	
	
	}
		function password2_click(){
			var password = $('#sign_password2').val();
		if(password == 'Password'){
			$('#sign_password2').val('');
		}
		if(password == ''){
			$('#sign_password2').val('Password');
		}
		if(password != '' && password != 'Password'){
		
			$('#sign_password2').val(password);
		}
	
	
	}
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
				     if(password2 == '' || password2 == 'Password'){
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
<script type="text/javascript">
$.fn.cycle.defaults.timeout = 6000;
$(function() {
    // run the code in the markup!
    $('table pre code').not('#skip,#skip2').each(function() {
        eval($(this).text());
    });
    
    $('#s4').after('<div id="nav" class="nav">').cycle({
        fx:     'fade',
        speed:  500,
        timeout: 0,
        next:   '#s4', 
        pager:  '#nav'
    });
});

function onBefore() {
    $('#output').html("Scrolling image:<br>" + this.src);
    //window.console.log(  $(this).parent().children().index(this) );
}
function onAfter() {
    $('#output').html("Scroll complete for:<br>" + this.src)
        .append('<h3>' + this.alt + '</h3>');
}
</script>
<section class="register">
<article>



<div id="s4" class="pics">
<iframe src="http://www.youtube.com/embed/zS_F4wE5kUs?rel=0" frameborder="0" allowfullscreen></iframe>
            <div><img src="http://cloud.github.com/downloads/malsup/cycle/beach1.jpg" width="680" height="423" /></div>
<div>            <img src="http://cloud.github.com/downloads/malsup/cycle/beach2.jpg" width="680" height="423" /></div>
            <img src="http://cloud.github.com/downloads/malsup/cycle/beach3.jpg" width="680" height="423" />
            <img src="http://cloud.github.com/downloads/malsup/cycle/beach4.jpg" width="680" height="423" />
            <img src="http://cloud.github.com/downloads/malsup/cycle/beach5.jpg" width="680" height="423" />
            <img src="http://cloud.github.com/downloads/malsup/cycle/beach6.jpg" width="680" height="423" />
            <img src="http://cloud.github.com/downloads/malsup/cycle/beach7.jpg" width="680" height="423" />
            <img src="http://cloud.github.com/downloads/malsup/cycle/beach8.jpg" width="680" height="423" />
 </div>

</article>

<section class="sports">
    <div class="makeAccount" style="display: none;">
        <div id="main_signup">
            <h2>account aanmaken</h2>
            <a href="#" id="makeAccountClose">sluiten</a> <a href="#" id="switchAccountToLogin">heb je al een account?</a>
            <section id="layouts">
<!--
                <figure class="stripe1"></figure>
                <figure class="stripe2"></figure>
                <figure class="stripe3"></figure>
-->
                <form action="#" method="post" id="signupform">
                <fieldset>
                    <legend>Personal Information</legend>
                    <input type="text" name="voornaam" id="sign_voornaam" onFocus="voornaam_click()" onblur="voornaam_click()" value="Voornaam"/>
                    <input type="text" name="achternaam" id="sign_achternaam" onFocus="achternaam_click()" onblur="achternaam_click()" value="Achternaam"/>
                    <input type="text" name="email" id="sign_email" onFocus="email_click()" onblur="email_click()" value="Email"/>
                    <p id="personal_error"></p>
                </fieldset>
                <fieldset>
                    <legend>Login Info</legend>
                    <input type="text" name="username" id="sign_username" onFocus="username_click()" onblur="username_click()" value="Username"/>
                    <p id="username_error"></p>
                    <input type="password" name="password" id="sign_password" onFocus="password_click()" onblur="password_click()" value="Paswoord"/>
                    <input type="password" name="password2" id="sign_password2" onFocus="password2_click()" onblur="password2_click()" value="Password"/>
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
<h1 id="tagline">manage jouw team.</h1>
</section>
