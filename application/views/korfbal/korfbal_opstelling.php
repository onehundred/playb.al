<style>


#vak2 {
	float:right;
}
#players {
	float:left;

	margin-right: 1em;
	
}
.tooltip {
	display:none;
	font-size:12px;
	height:70px;
	width:160px;
	padding:25px;
	color:#fff;
}

/* Bubble pop-up */
	   .bubbleInfo {
	   position: relative;

}
.popup {
	position: absolute;
	display: none;
	margin-left: 150px;
	z-index: 50;
	padding: 20px;
	margin-top:50px;

}

.trigger { 
	cursor:move;
	width: 100px;
	height: 50px;
	border: 1px solid #000;
	
	
}

.droppable {

	cursor: move;

}


}
</style>
<script src="<?php echo base_url();?>js/korfbal/opstelling.js"></script>

    <script src="<?php echo base_url();?>js/jqueryui.touch.js"></script>

<div class="game">


	<div id="korfbalField" style=" float:right;">
		<div id="vak2"><h2>Vak2</h2></div>
		<div id="vak1"><h2>Vak1</h2></div>
		<div id="general"><h2>General</h2></div>
    </div> <!-- end korfbalField -->
    <div id="players"> 
        <!-- <h1>Korfbal</h1> -->
        
<!--             <h3><a href="#">Players</a></h3> -->
            
                
                    <?php foreach($spelers->result() as $row){  ?>
                    <div class="bubbleInfo">
                   
                       <div id="<?php echo $row->speler_id;?>" class="trigger"><?php echo $row->voornaam.' '.$row->achternaam; ?></div>
                        
                        <div id="dpop<?php echo $row->speler_id;?>" class="popup">
                            
                            <p id="geslacht">Geslacht: <?php echo $row->geslacht;?></p>
                            <p id="rebound">Rebound:<?php echo $row->rebound; ?>/20</p>
                            <p id="stamina">Stamina:<?php echo $row->stamina; ?>/20</p>
                            <p id="passing">Passing:<?php echo $row->passing; ?>/20</p>
                            <p id="shotpower">Shotpower:<?php echo $row->shotpower; ?>/20</p>
                            <p id="shotprecision">Shotprecision:<?php echo $row->shotprecision; ?>/20</p>
                            <p id="playmaking">Playmaking:<?php echo $row->playmaking; ?>/20</p>
                            <p id="intercepting">Intercepting:<?php echo $row->intercepting; ?>/20</p>
                            <p id="leadership">Leadership:<?php echo $row->leadership; ?>/20</p>
                        </div>
                    </div>
                    <?php } ?>
             
        </div>
    </div>
    	
    <input type="hidden" id="teamid" value="<?php echo $this->uri->segment('3');?>" />
</div>
<!-- end game -->