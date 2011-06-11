<script>

$.fn.cycle.defaults.timeout = 6000;
$(function() {

    
    $('#s4').show().after('<div id="galleryNav" class="galleryNav">').cycle({
        fx:     'fade',
        speed:  500,
        timeout: 5000,
        next:   '#s4', 
        pager:  '#galleryNav'
    });
});
</script>

<section class="register">
    <article>
        <div id="s4" class="pics">
            <img src="<?php echo base_url();?>img/slider1.png" width="680" height="323" ondragstart="return false" />
            <img src="http://cloud.github.com/downloads/malsup/cycle/beach2.jpg" width="680" height="323" ondragstart="return false" />
            <img src="http://cloud.github.com/downloads/malsup/cycle/beach3.jpg" width="680" height="323" ondragstart="return false" />
            <img src="http://cloud.github.com/downloads/malsup/cycle/beach4.jpg" width="680" height="323" ondragstart="return false" />
            <img src="http://cloud.github.com/downloads/malsup/cycle/beach5.jpg" width="680" height="323" ondragstart="return false" />
            <img src="http://cloud.github.com/downloads/malsup/cycle/beach6.jpg" width="680" height="323" ondragstart="return false" />
            <img src="http://cloud.github.com/downloads/malsup/cycle/beach7.jpg" width="680" height="323" ondragstart="return false" />
            <img src="http://cloud.github.com/downloads/malsup/cycle/beach8.jpg" width="680" height="323" ondragstart="return false" />
        </div>
        <div class="makeAccount">
            <div id="main_signup">
                        <h1 id="tagline">manage jouw team.</h1>
                <!--             <a href="#" id="makeAccountClose">sluiten</a> <a href="#" id="switchAccountToLogin">heb je al een account?</a> -->
                <div id="layouts"> 
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
                </div>
            </div>
        </div>
    </article>
</section>
<!-- end register -->
<section class="sports">
    <article> 
        <!-- end makeAccount -->
        <figure class="korfbal">
            <img id="korfbalbg" src="<?php echo base_url();?>img/korfbalbg.png"/>
            <div class="startgame">
                <h1>korfbal</h1>
                <a href="#" id="startKorfbal">start</a></div>
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
    </article>
</section>
