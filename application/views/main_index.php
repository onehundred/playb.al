<script type="text/javascript">


$('#korfbal').click(function() {
$('.basketbal').animate({rotate: '+=45deg'});   
   
   });		



		</script>
		
<section id="layouts">
    <h1 id="tagline">manage jouw team</h1>
    <figure class="korfbal">
        <h1>korfbal</h1>
        <div id="create">
        
            <div class="startgame">
                <img src="<?php echo base_url();?>img/start.png" />
                <?php 
		echo anchor('main/signup','start');
		?>
            </div>
        </div>
<!--         <img src="<?php echo base_url();?>img/down.png" id="down" /> -->
        <img src="<?php echo base_url();?>img/korfbal.png" id="korfbal" />
    </figure>
    <figure class="basketbal">
        <h1>basketbal</h1>
        <div id="create">
            <div class="startgame">
                <img src="<?php echo base_url();?>img/start.png" />
                <?php
                

		echo anchor('main/signup','start');
		?>
            </div>
        </div>
<!--         <img src="<?php echo base_url();?>img/down.png" id="down" /> -->
        <img src="<?php echo base_url();?>img/basketbal.png" id="basketbal" />
    </figure>
    <figure class="volleybal">
        <h1>volleybal</h1>
        <div id="create">
            <div class="startgame">
                <img src="<?php echo base_url();?>img/start.png" />
                <?php
		echo anchor('main/signup','start');
		?>
            </div>
        </div>
<!--         <img src="<?php echo base_url();?>img/down.png" id="down" /> -->
        <img src="<?php echo base_url();?>img/volleybal.png" id="volleybal" />
    </figure>
</section>
<section id="bottom">
    <div class="bottomButtons">
        <div class="light"><a href="#">hoe werkt het</a></div>
        <div class="question"><a href="#">bekijk demo</a></div>
    </div>
</section>
