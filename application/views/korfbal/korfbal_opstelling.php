<style>
	#prullenbak{
		
	}
</style>
<script src="<?php echo base_url();?>js/korfbal/opstelling.js"></script>
<script src="<?php echo base_url();?>js/jqueryui.touch.js"></script>

<div class="game">


	<div id="korfbalField">
		<div id="vak2"><h2>Vak2</h2></div>
		<div id="vak1"><h2>Vak1</h2></div>
		<div id="general"><h2>General</h2></div>
		<div id="prullenbak"></div>
    </div> <!-- end korfbalField -->
   	<div id="players"> 
        <!-- <h1>Korfbal</h1> -->
        
<!--             <h3><a href="#">Players</a></h3> -->
            
                
                    <?php foreach($spelers->result() as $row){  ?>
                    <div class="bubbleInfo">
                   
                       <div id="<?php echo $row->speler_id;?>" class="trigger"><?php echo $row->voornaam.' '.$row->achternaam; ?></div>
                        
                        <div id="dpop<?php echo $row->speler_id;?>" class="popup">
                            
                            <p class="entry" id="geslacht">Geslacht: <?php echo $row->geslacht;?></p>
                            <p class="entry" id="rebound">Rebound:<?php echo $row->rebound; ?>/20</p>
                            <p class="entry" id="stamina">Stamina:<?php echo $row->stamina; ?>/20</p>
                            <p class="entry" id="passing">Passing:<?php echo $row->passing; ?>/20</p>
                            <p class="entry" id="shotpower">Shotpower:<?php echo $row->shotpower; ?>/20</p>
                            <p class="entry" id="shotprecision">Shotprecision:<?php echo $row->shotprecision; ?>/20</p>
                            <p class="entry" id="playmaking">Playmaking:<?php echo $row->playmaking; ?>/20</p>
                            <p class="entry" id="intercepting">Intercepting:<?php echo $row->intercepting; ?>/20</p>
                            <p class="entry" id="leadership">Leadership:<?php echo $row->leadership; ?>/20</p>
                        </div>
                    </div>
                    <?php } ?>
             
        </div>
    </div>
    	
    <input type="hidden" id="teamid" value="<?php echo $this->uri->segment('3');?>" />
</div>
<!-- end game -->