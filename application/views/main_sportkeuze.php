<section id="layouts">
    <h1 id="tagline">manage jouw team</h1>
    <figure class="korfbal">
        <h1>Korfbal</h1>
        <div id=""><p id="overview">team:</p>
            <p id="continue">
                <?php if(isset($korfNaam)){
	echo anchor("korfbal/korfbal_start/$korfId", $korfNaam);
}else{

	echo anchor('sportchoice/korfbal_signup','Create korfball team');


} ?>
            </p><hr /><p id="overview">divisie:</p><p id="overview2">2</p><hr /><p id="overview">positie:</p><p id="overview2">7</p>
        </div>
        <img src="<?php echo base_url();?>img/korfbal.png" id="korfbal" />
    </figure>
    <figure class="basketbal">
        <h1>Basketbal</h1>
        <div id="create">
            <div class="startgame">
                <img src="<?php echo base_url();?>img/start.png" />

            <?php if(isset($basNaam)){

	echo $basNaam;
	echo $basId;

}else{
	echo anchor('sportchoice/basketbal_signup','Create basketball team');


} ?>
       </div></div>
       
       <p>Divisie:</p>
        <p>Positie:</p>
        <img src="<?php echo base_url();?>img/basketbal.png" id="basketbal" />
    </figure>
    <figure class="volleybal">
        <h1>Volleybal</h1>
        <div id="create">
            <div class="startgame">
                <img src="<?php echo base_url();?>img/start.png" />
            <?php if(isset($volNaam)){
	echo $volNaam;
	echo $volId;

}else{
	echo anchor('sportchoice/volleybal_signup','start');



} ?></div>
        </div>
        <img src="<?php echo base_url();?>img/volleybal.png" id="volleybal" />
    </figure>
</section>
