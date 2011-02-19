<section id="layouts">
	<h1 id="tagline">manage jouw team</h1>
    <figure class="korfbal">
        <h1>Korfbal</h1>
        <p>
            <?php if(isset($korfNaam)){
	echo anchor("korfbal/korfbal_start/$korfId", $korfNaam);
}else{

	echo anchor('sportchoice/korfbal_signup','Create korfball team');


} ?>
        </p>
        		<img src="<?php echo base_url();?>img/korfbal.png" id="korfbal" />
    </figure>
    <figure class="basketbal">
     <h1>Basketbal</h1>
        <p>
            <?php if(isset($basNaam)){

	echo $basNaam;
	echo $basId;

}else{
	echo anchor('sportchoice/basketbal_signup','Create basketball team');


} ?>
        </p>
<img src="<?php echo base_url();?>img/basketbal.png" id="basketbal" />

            </figure>
    <figure class="volleybal">
    <h1>Volleybal</h1>
        <p>
            <?php if(isset($volNaam)){
	echo $volNaam;
	echo $volId;

}else{
	echo anchor('sportchoice/volleybal_signup','Create volleyball team');



} ?>
        </p>
		<img src="<?php echo base_url();?>img/volleybal.png" id="volleybal" />
           </figure>
</section>
