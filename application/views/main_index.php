<section class="register">
<article>
    <div class="makeAccount" style="display: ;">
        <div id="main_signup">
<!--             <h2>account aanmaken</h2> -->
            <!-- <a href="#" id="makeAccountClose">sluiten</a> <a href="#" id="switchAccountToLogin">heb je al een account?</a> -->
            <section id="">
               <!--
 <figure class="stripe1"></figure>
                <figure class="stripe2"></figure>
                <figure class="stripe3"></figure>
-->
                <fieldset>
                    <legend>Personal Information</legend>
                    <?php
		$js= "onClick=this.value=''";
		echo form_open('main/create_user');
		echo form_input('voornaam', set_value('voornaam', 'First Name'), $js);
		echo form_input('achternaam', set_value('achternaam', 'Last Name'), $js);
		echo form_email('email', set_value('email', 'E-Mail'),$js);
		#echo form_input('land', set_value('land', 'Country'),$js);
	?>
                </fieldset>
                <fieldset>
                   <!--  <legend>Login Info</legend> -->
                    <?php	
		echo form_input('username', set_value('username', 'Username'),$js);
		echo form_input('paswoord', set_value('paswoord', 'Password'),$js);
		echo form_input('paswoord2', set_value('paswoord2', 'Password confirm'),$js);
		echo form_submit('submitsignup', 'Create account');
		echo form_close();
	?>
                    <?php echo validation_errors('<p class="errors">');?>
                </fieldset>
          
        </div>
    </div>
    <!-- end makeAccount -->
    <h1 id="tagline">manage jouw team</h1>
    <h3>de leukste manier om eigen baas te spelen. </h3><h3>stel je club samen en klim naar de top van de eerste divisie.</h3>
lorem ipsum dolor sit amet</h3>
</article>
      </section>
    <section class="sports">
    <figure class="korfbal">
        <img id="korfbalbg" src="<?php echo base_url();?>img/korfbalbg.png"/>
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








    <section class="gallery">
    <article>
    <div id="goleft"></div>
    <div class="slider"></div>
    <div id="goright"></div>
</article>
</section>
