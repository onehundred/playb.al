<section id="layouts">
        <div class="makeAccount" style="display: none;">
        <div id="main_signup">
            <h2>account aanmaken</h2>
            <a href="#" id="makeAccountClose">sluiten</a>
            <a href="#" id="switchAccountToLogin">heb je al een account?</a>
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
    </div> <!-- end makeAccount -->

    <figure class="korfbal">
        <img id="korfbalbg" src="<?php echo base_url();?>img/korfbalbg.png"/>
        <div class="startgame">
            <h1>korfbal</h1>
            <a href="#" id="startKorfbal">start</a> </div>
        <div class="korfbalAnimation" style="display: none;">
            <img src="<?php echo base_url();?>img/korfbal.png" type="image/png" id="korfbal" ondragstart="return false"/>
        </div>
    </figure>
    <figure class="basketbal">
        <img id="basketbalbg" src="<?php echo base_url();?>img/basketbalbg.png" />
        <div class="startgame">
            <h1>basketbal</h1>
            <a href="#" id="startBasketbal">start</a> </div>
        <div class="basketbalAnimation" style="display: none;">
            <img src="<?php echo base_url();?>img/basketbal.png" id="basketbal" ondragstart="return false"/>
        </div>
    </figure>
    <figure class="volleybal">
        <img id="volleybalbg" src="<?php echo base_url();?>img/volleybalbg.png" />
        <div class="startgame">
            <h1>volleybal</h1>
            <a id="startVolleybal" href="#">start</a> </div>
        <div class="volleybalAnimation" style="display: none;">
            <img src="<?php echo base_url();?>img/volleybal.png" id="volleybal" ondragstart="return false" />
        </div>
    </figure>

       <div class="bottomButtons"> 
        <!--
        <div class="light"><a href="#">hoe werkt het</a></div>
        <div class="question"><a href="#">bekijk demo</a></div>
--> 
    </div>
</section>
<h1 id="tagline">manage jouw team.</h1>
<section id="bottom">


 </section>
<section id="belowbottom"> 

<div class="container">
	
    <div class="folio_block">
    	
        <div class="main_view">
            <div class="galleryWrapper">	
<img src="<?php echo base_url();?>img/gallery_right_hide.png" id="galleryRightHide" alt="" style="display: ;" />
<img src="<?php echo base_url();?>img/gallery_left_hide.png" id="galleryLeftHide" alt="" style="display: ;" />
                <div class="imgs" ondragstart="return false">
<img src="<?php echo base_url();?>img/gallery1.png" alt="speel playb.al op elke computer" />
<img src="<?php echo base_url();?>img/gallery2.png" alt="speel playb.al op elke smartphone" />
<img src="<?php echo base_url();?>img/3.jpg" alt="" />
<img src="<?php echo base_url();?>img/4.jpg" alt="" />
                </div>
            </div>
            <div class="pagingGallery">
                <a href="#" rel="1"></a>
                <a href="#" rel="2"></a>
                <a href="#" rel="3"></a>
                <a href="#" rel="4"></a>
            </div>
        </div>

    </div>	

</div>
</section>