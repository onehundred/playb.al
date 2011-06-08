<section class="sports">
    <figure class="korfbal">
        <h1>Korfbal</h1>
        <div id="">
            <p id="overview">team:</p>
            <p id="continue"> <a onclick="parent.location='http://google.be'">in app pagina</a>
                <?php if(isset($korfNaam)){
	echo anchor("korfbal/korfbal_start/$korfId", $korfNaam);

?>
            </p>
            <hr />
            <p id="overview">divisie:</p>
            <p id="overview2">2</p>
            <hr />
            <p id="overview">positie:</p>
            <p id="overview2">7</p>
            <img src="<?php echo base_url();?>img/korfbal.png" id="korfbal" ondragstart="return false" />
        </div>
        <?php
}else{

	echo anchor('sportchoice/korfbal_signup','Create korfball team');


} ?>
    </figure>
    <!-- end korfbal -->
    
    <figure class="basketbal">
        <h1>basketbal</h1>
        <div id="">
            <p id="overview">team:</p>
            <p id="continue"> <a onclick="parent.location='http://google.be'">in app pagina</a>
                <?php if(isset($basNaam)){
	echo anchor("basketbal/basketbal_start/$basId", $basNaam);
?>
            </p>
            <hr />
            <p id="overview">divisie:</p>
            <p id="overview2">2</p>
            <hr />
            <p id="overview">positie:</p>
            <p id="overview2">7</p>
            <img src="<?php echo base_url();?>img/basketbal.png" id="basketbal" ondragstart="return false" />
            <?php

}else{

	echo anchor('sportchoice/basketbal_signup','Create basketbal team');


} ?>
        </div>
    </figure>
    <!-- end korfbal -->
    
    <figure class="volleybal">
        <h1>volleybal</h1>
        <div id="">
            <p id="overview">team:</p>
            <p id="continue"> <a onclick="parent.location='http://google.be'">in app pagina</a>
                <?php if(isset($volNaam)){
	echo anchor("volleybal/volleybal_start/$volId", $volNaam);

?>
            </p>
            <hr />
            <p id="overview">divisie:</p>
            <p id="overview2">2</p>
            <hr />
            <p id="overview">positie:</p>
            <p id="overview2">7</p>
            <img src="<?php echo base_url();?>img/volleybal.png" id="volleybal" ondragstart="return false" />
            <?php
}else{

	echo anchor('sportchoice/volleybal_signup','Create volleybal team');


} ?>
        </div>
    </figure>
    <!-- end korfbal --> 
    
</section>
<!-- <h1 id="tagline">manage jouw team.</h1> -->