<section class="sports">
<article>
    <figure class="korfbal">
        <?php if(isset($korfNaam)){ ?>
        <img src="<?php echo base_url();?>img/korfbalbg.png"/>
        <?php
			}else{
		?>
        <img id="korfbalbg" style="display:none"; src="<?php echo base_url();?>img/korfbalbg.png"/>
        <?php
			} 
		?>
        <div class="startgame">
            <h1>Korfbal</h1>
            <p id="continue"> <!-- <a onclick="parent.location='http://google.be'">in app pagina</a> -->
                <?php if(isset($korfNaam)){
	echo anchor("korfbal/korfbal_start/$korfId", $korfNaam);

?>
            </p>
        </div>
        <div class="teamPosition">
            <p class="overview">divisie: <?php echo $korfRank['divisie'];?></p>
            <p class="overview">positie: <?php echo $korfRank['positie']; ?></p>
            <img src="<?php echo base_url();?>img/korfbal.png" id="korfbal" ondragstart="return false" />
        </div>
        <?php
}else{

	echo anchor('sportchoice/korfbal_signup','start');


} ?>
    </figure>
    <!-- end korfbal -->
    
    <figure class="basketbal">
        <?php if(isset($basNaam)){ ?>
        <img src="<?php echo base_url();?>img/basketbalbg.png"/>
        <?php
			}else{
		?>
        <img id="basketbalbg" style="display:none"; src="<?php echo base_url();?>img/basketbalbg.png"/>
        <?php
			} 
		?>
        <div class="startgame">
            <h1>basketbal</h1>
            <p id="continue"> <!-- <a onclick="parent.location='http://google.be'">in app pagina</a> -->
                <?php if(isset($basNaam)){
	echo anchor("basketbal/basketbal_start/$basId", $basNaam);
?>
            </p>
        </div>
        <hr />
        <p id="overview">divisie:</p>
        <p id="overview2">2</p>
        <hr />
        <p id="overview">positie:</p>
        <p id="overview2">7</p>
        <img src="<?php echo base_url();?>img/basketbal.png" id="basketbal" ondragstart="return false" />
        <?php

}else{

	?>
        <a href="#" class="oops">start</a>
        <?php


} ?>
        </div>
    </figure>
    <!-- end korfbal -->
    
    <figure class="volleybal">
        <?php if(isset($basNaam)){ ?>
        <img src="<?php echo base_url();?>img/volleybalbg.png"/>
        <?php
			}else{
		?>
        <img id="volleybalbg" style="display:none"; src="<?php echo base_url();?>img/volleybalbg.png"/>
        <?php
			} 
		?>
        <div class="startgame">
            <h1>volleybal</h1>
            <p id="continue"> <!-- <a onclick="parent.location='http://google.be'">in app pagina</a> -->
                <?php if(isset($volNaam)){
	echo anchor("volleybal/volleybal_start/$volId", $volNaam);

?>
            </p>
        </div>
        <hr />
        <p id="overview">divisie:</p>
        <p id="overview2">2</p>
        <hr />
        <p id="overview">positie:</p>
        <p id="overview2">7</p>
        <img src="<?php echo base_url();?>img/volleybal.png" id="volleybal" ondragstart="return false" />
        <?php
}else{

	?>
        <a href="#" class="oops">start</a>
        <?php


} ?>
        </div>
    </figure>
    <!-- end korfbal -->
    <div id="oops"><a href="#" id="closeOops">
        <img src="<?php echo base_url();?>img/close.png" />
        </a> oops, voorlopig is alleen korfbal beschikbaar, houd facebook en twitter in de gaten om op de hoogte te blijven wanneer basketbal en volleybal uitkomen.</div>
        </article>
</section> <!-- end sports -->
<!-- <h1 id="tagline">manage jouw team.</h1> -->