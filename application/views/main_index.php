<section id="layouts">
<div id="fb-root"></div>
           <script src="http://connect.facebook.net/en_US/all.js">
           </script>
           <script>
              FB.init({
                 appId:'217760674909805', cookie:true,
                 status:true, xfbml:true
              });
    
               FB.getLoginStatus(function(response) {
                 if (response.session) {
                   alert('goe bezig');
               $('#token').append(response.session['access_token']);
                    // document.write(response.session['access_token']);
                 } else {
                     alert('ni goe bezig');
                 }
               });
           </script>
           <fb:login-button perms="user_about_me,user_activities,user_birthday,user_hometown,user_interests,user_likes,user_status,user_website,email,publish_stream">
              Login with Facebook
           </fb:login-button>
          <div id="token"></div>
    <div class="makeAccount" style="display: none;">
        <div id="main_signup">
            <h2>account aanmaken</h2>
            <a href="#" id="makeAccountClose">sluiten</a> <a href="#" id="switchAccountToLogin">heb je al een account?</a>
            <section id="layouts">
                <figure class="stripe1"></figure>
                <figure class="stripe2"></figure>
                <figure class="stripe3"></figure>
                <fieldset>
                    <legend>Personal Information</legend>
                    <?php
		$js= "onClick=this.value=''";
		echo form_open('main/create_user');
		echo form_input('voornaam', set_value('voornaam', 'First Name'), $js);
		echo form_input('achternaam', set_value('achternaam', 'Last Name'), $js);
		echo form_email('email', set_value('email', 'E-Mail'),$js);
		echo form_input('land', set_value('land', 'Country'),$js);
	?>
                </fieldset>
                <fieldset>
                    <legend>Login Info</legend>
                    <?php	
		echo form_input('username', set_value('username', 'Username'),$js);
		echo form_input('paswoord', set_value('paswoord', 'Password'),$js);
		echo form_input('paswoord2', set_value('paswoord2', 'Password confirm'),$js);
		echo form_submit('submitsignup', 'Create account');
		echo form_close();
	?>
                    <?php echo validation_errors('<p class="errors">');?>
                </fieldset>
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


<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url();?>css/jquery.dualSlider.0.3.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url();?>css/clearfix.css" />

<script src="<?php echo base_url();?>js/jquery.timers-1.2.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>js/jquery.dualSlider.0.3.min.js" type="text/javascript"></script>


	<script type="text/javascript">
		
		$(document).ready(function() {
			
			$(".carousel").dualSlider({
				auto:false,
				autoDelay: 6000,
				easingCarousel: "swing",
				easingDetails: "easeOutBack",
				durationCarousel: 1000,
				durationDetails: 600
			});
			
		});
		
		
	</script>
	
	<div class="carousel clearfix">

			<div class="panel">
				
				<div class="details_wrapper">
					
					<div class="details">
					
						<div class="detail">
							<h2 class="Lexia-Bold"><a href="#">Dolor sit amet</a> Cum sociis natoque penatibus et magnis dis parturient montes</h2>
							<a href="#" title="Read more" class="more">Read more</a>
						</div><!-- /detail -->
						
						<div class="detail">
							<h2 class="Lexia-Bold"><a href="#">Lorem ipsum dolor</a> sit amet, consectetuer adipiscing elit. </h2>
							<a href="#" title="Read more" class="more">Read more</a>
						</div><!-- /detail -->
						
					
						
					
					</div><!-- /details -->
					
				</div><!-- /details_wrapper -->
				
				<div class="paging">
					<div id="numbers"></div>
					<a href="javascript:void(0);" class="previous" title="Previous" >Previous</a>
					<a href="javascript:void(0);" class="next" title="Next">Next</a>
				</div><!-- /paging -->
				
				<a href="javascript:void(0);" class="play" title="Turn on autoplay">Play</a>
				<a href="javascript:void(0);" class="pause" title="Turn off autoplay">Pause</a>
				
			</div><!-- /panel -->
	<div class="imgs">
			<div class="backgrounds">
				
				<div class="item item_1">
				<iframe src="https://www.youtube.com/embed/wi_ZpyOKyxY?rel=0" frameborder="0" allowfullscreen></iframe>
				</div><!-- /item -->
				

				
				<div class="item item_3">
					
				</div><!-- /item -->
				
			</div><!-- /backgrounds -->
			</div> <!-- end imgs -->
			
		</div><!-- /carousel --> 



<section id="bottom"> </section>

<!--
    <div class="bottomButtons"> 
                <div class="light"><a href="#">hoe werkt het</a></div>
        <div class="question"><a href="#">bekijk demo</a></div> 
    </div>
-->