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
