<style>

#players {
	float:left;
	width: 250px;
	
	margin-right: 1em;
}
#catalog li {
	width: 200px;
	margin-top: 15px;
	background-color: gray;
	list-style: none;
}
#rebound1, #playmaking1, #attack1, #attack2 {
	width: 100px;
	height: 100px;
	float: left;
	margin-left: 10px;
}
/* style the list to maximize the droppable hitarea */
	#rebound1 ul, #attack1 ul, #attack2 ul, #playmaking1 ul {
	margin: 0;
	height: 40px;
	padding-left: 4px;
	list-style: none;
}
#rebound2, #playmaking2, #attack3, #attack4 {
	width: 100px;
	height: 100px;
	float: left;
	margin-left: 10px;
}
/* style the list to maximize the droppable hitarea */
	#rebound2 ul, #attack4 ul, #attack3 ul, #playmaking2 ul {
	margin: 0;
	height: 40px;
	padding-left: 4px;
	list-style: none;
}
#captain, #setpieces {
	width: 100px;
	height: 100px;
	float: left;
	margin-left: 10px;
}
/* style the list to maximize the droppable hitarea */
	#captain ul, #setpieces ul {
	margin: 0;
	height: 40px;
	padding-left: 4px;
	list-style: none;
}
#vak2 {
	width: 250px;
	float:left;
	margin-right: 30px;
	margin-top: 25px;
}
#vak1 {
	width: 250px;
	float:left;
	margin-right: 30px;
	margin-top: 25px;
}
#general {
	width: 200px;
	float:right;
	margin-right: 30px;
	margin-top: 25px;
	margin-bottom: 25px;
}
.tooltip {
	display:none;
	font-size:12px;
	height:70px;
	width:160px;
	padding:25px;
	color:#fff;
}
</style>
<style>
/* Bubble pop-up */
	   .bubbleInfo {
	position: relative;
}
.popup {
	position: absolute;
	display: none;
	margin-left: 150px;
	z-index: 50;
	margin-top:-50px;
	border: 1px solid;
}
</style>

<div style="height: 400px;">
    <div id="players"> 
        <!-- <h1>Korfbal</h1> -->
        <div id="catalog">
<!--             <h3><a href="#">Players</a></h3> -->
            <div>
                <ul>
                    <?php foreach($spelers->result() as $row){  ?>
                    <div class="bubbleInfo">
                        <div>
                            <li class="trigger"><?php echo $row->voornaam.' '.$row->achternaam; ?> id:<?php echo $row->speler_id;?></li>
                        </div>
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
                </ul>
            </div>
        </div>
    </div>
    <div id="korfbalField" style="background-color: yellow; height: 00px; float:right;">
    <div id="vak1">
        <h2>Vak1</h2>
        <div id="rebound1">
            <h3>Rebound</h3>
            <div class="ui-widget-content">
                <ul>
                    <li class="placeholder">
                        <?php if(isset($opstelling[0]['voornaam'])){
			echo $opstelling[0]['voornaam'];
			}else{ ?>
                        Add player
                        <?php } ?>
                    </li>
                </ul>
            </div>
        </div>
        <div id="playmaking1">
            <h3>Playmaking</h3>
            <div class="ui-widget-content">
                <ul>
                    <li class="placeholder">
                        <?php if(isset($opstelling[1]['voornaam'])){
			echo $opstelling[1]['voornaam'];
			}else{ ?>
                        Add player
                        <?php } ?>
                    </li>
                </ul>
            </div>
        </div>
        <div id="attack1">
            <h3>Attack 1</h3>
            <div class="ui-widget-content">
                <ul>
                    <li class="placeholder">
                        <?php if(isset($opstelling[2]['voornaam'])){
			echo $opstelling[2]['voornaam'];
			}else{ ?>
                        Add player
                        <?php } ?>
                    </li>
                </ul>
            </div>
        </div>
        <div id="attack2">
            <h3>Attack2</h3>
            <div class="ui-widget-content">
                <ul>
                    <li class="placeholder">
                        <?php if(isset($opstelling[3]['voornaam'])){
			echo $opstelling[3]['voornaam'];
			}else{ ?>
                        Add player
                        <?php } ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="vak2">
        <h2>Vak2</h2>
        <div id="rebound2">
            <h3>Rebound</h3>
            <div class="ui-widget-content">
                <ul>
                    <li class="placeholder">
                        <?php if(isset($opstelling[4]['voornaam'])){
			echo $opstelling[4]['voornaam'];
			}else{ ?>
                        Add player
                        <?php } ?>
                    </li>
                </ul>
            </div>
        </div>
        <div id="playmaking2">
            <h3>Playmaking</h3>
            <div class="ui-widget-content">
                <ul>
                    <li class="placeholder">
                        <?php if(isset($opstelling[5]['voornaam'])){
			echo $opstelling[5]['voornaam'];
			}else{ ?>
                        Add player
                        <?php } ?>
                    </li>
                </ul>
            </div>
        </div>
        <div id="attack3">
            <h3>Attack 1</h3>
            <div class="ui-widget-content">
                <ul>
                    <li class="placeholder">
                        <?php if(isset($opstelling[6]['voornaam'])){
			echo $opstelling[6]['voornaam'];
			}else{ ?>
                        Add player
                        <?php } ?>
                    </li>
                </ul>
            </div>
        </div>
        <div id="attack4">
            <h3>Attack2</h3>
            <div class="ui-widget-content">
                <ul>
                    <li class="placeholder">
                        <?php if(isset($opstelling[7]['voornaam'])){
			echo $opstelling[7]['voornaam'];
			}else{ ?>
                        Add player
                        <?php } ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="general">
        <h2>General</h2>
        <div id="captain">
            <h3>Captain</h3>
            <div class="ui-widget-content">
                <ul>
                    <li class="placeholder">
                        <?php if(isset($opstelling[8]['voornaam'])){
			echo $opstelling[8]['voornaam'];
			}else{ ?>
                        Add player
                        <?php } ?>
                    </li>
                </ul>
            </div>
        </div>
        <div id="setpieces">
            <h3>Set pieces</h3>
            <div class="ui-widget-content">
                <ul>
                    <li class="placeholder">
                        <?php if(isset($opstelling[9]['voornaam'])){
			echo $opstelling[9]['voornaam'];
			}else{ ?>
                        Add player
                        <?php } ?>
                    </li>
                </ul>
            </div>
        </div>
        </div> <!-- end korfbalField -->
    </div>
</div>
<input type="hidden" id="teamid" value="<?php echo $this->uri->segment('3');?>" />
</div>
<!-- End demo --> 
<script src="<?php echo base_url();?>/js/korfbal_opstelling.js"></script> 
<!-- <script src="<?php echo base_url();?>/js/toastmessage/jquery.toastmessage.js"></script> --> 

