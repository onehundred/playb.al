<script>

$.fn.cycle.defaults.timeout = 6000;
$(function() {

    
    $('#sliderHome').show().after('<div id="galleryNav" class="galleryNav">').cycle({
        fx:     'fade',
        speed:  500,
        timeout: 5000,
       
        pager:  '#galleryNav',
         pause:   1 
    });
});
</script>

<section class="register">
    <article>
        <div id="sliderHome" class="pics">
            <div>
                <section>
                    <h1 class="sliderTag">manage</h1>
                    <p>als manager beheer jij elk aspect van je team. </p>
                    <input class="registreren" id="sliderButton" type="submit" name="submitsignup" value="manage jouw team"/>
                </section>
            </div>
            <!-- end slide 1 -->
            <div>
                 <section>
                    <h1 class="sliderTag">train</h1>
                    <p>je spelers wachten op jou. houdt hun conditie hoog, zorg wel dat ze nog energie hebben voor competitie.</p>
                    <input class="registreren" id="sliderButton" type="submit" name="submitsignup" value="manage jouw team"/>
                </section>

            </div>
            <!-- end slide 2 -->
            <div>
                 <section>
                    <h1 class="sliderTag">coach</h1>
                    <p>jij bepaalt de strategie. stel je spelers op voor de wedstrijden. zonder jou tactisch inzicht loopt alles in de war.</p>
                    <input class="registreren" id="sliderButton" type="submit" name="submitsignup" value="manage jouw team"/>
                </section>

            </div>
            <!-- end slide 3 -->
            
            <div>
                 <section>
                    <h1 class="sliderTag">bouw</h1>
                    <p>bouw delen bij en plaats extra zitjes in je stadion.  meer publiek, meer inkomsten.</p>
                    <input class="registreren" id="sliderButton" type="submit" name="submitsignup" value="manage jouw team"/>
                </section>

            </div>
            <!-- end slide 4 -->
            
            <div>
               <section>
                    <h1 class="sliderTag">heers</h1>
                    <p>klim naar de top van de eerste divisie. sleep de titel in de wacht en maak alvast plaats in je kast voor een beker.</p>
                    <input class="registreren" id="sliderButton" type="submit" name="submitsignup" value="manage jouw team"/>
                </section>
            </div>
            <!-- end slide 5 -->
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
        </div>
        <!-- end slider --> 
        
    </article>
</section>
<!-- end register -->
<section class="sports">
    <article>
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
