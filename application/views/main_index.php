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
                <img src="<?php echo base_url();?>img/slider1.png" width="680" height="290" ondragstart="return false" />
                <section>test</section>
            </div>
            <!-- end slide 1 -->
            <div>
                <img src="<?php echo base_url();?>img/slider1.png" width="680" height="290" ondragstart="return false" />
               <section> <h1>jij beslist</h1><p>bla bla bla</p><input class="registreren" type="submit" name="submitsignup" value="manage jouw team"/></section>
            </div>
            <!-- end slide 2 -->
            <div>
            <img src="<?php echo base_url();?>img/slider1.png" width="680" height="290" ondragstart="return false" />
            <section></section>
            </div> <!-- end slide 3 -->
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
