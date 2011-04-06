<script src="<?php echo base_url();?>js/korfbal/training.js"></script>
<div class="players">
    <?php foreach($energie->result() as $row)
{
	$energie = $row->energie;

} ?>
    <h2>Op wat wil je trainen?</h2>
    <input type="hidden" id="teamid" value="<?php echo $this->uri->segment('3');?>"/>
    <input type="hidden" id="energie" value="<?php echo $energie;?>"/>
    <select class="target">
        <option value="stamina" selected="selected">Stamina</option>
        <option value="passing">Passing</option>
        <option value="shotpower">Shotkracht</option>
        <option value="shotprecision">Shotprecisie</option>
        <option value="rebound">Rebound</option>
        <option value="playmaking">Playmaking</option>
        <option value="intercepting">Intercepting</option>
    </select>
    Een training kost 30 van je energiepunten, je hebt momenteel <?php echo $energie; ?> energiepunten.
    <div style="text-decoration:underline; color:blue; cursor: pointer;" id="training">Train nu.</div>
    <br/>
    <?php
foreach($training->result() as $row){

//echo $row->FK_team_id;
 ?>

        <div class="playerDetail">
          <p class="number"><?php echo $row->rugnummer;?></p>
            <p class="firstname"><?php echo $team_id;?>/<?php echo $row->speler_id;?><?php echo $row->voornaam;?></p>
            <p class="lastname"><?php echo $row->achternaam; ?></p>
            <p class="gender">
                <img src="<?php echo base_url();?><?php $geslacht = $row->geslacht; if($geslacht== "female"){ ?>img/female.png<?php }else{?>img/male.png<?php } ?>" />
            </p>
            <br />
            <p class="age"><?php echo $row->leeftijd; ?> jaar oud</p>
            <p class="price"><?php echo ($row->rebound * 6250) + ($row->stamina * 3125) + ($row->passing * 6250 ) + ($row->shotprecision * 400) + ($row->shotpower * 4000) + ($row->intercepting * 7500) + ($row->leadership * 1000) + ($row->playmaking * 6250);?> &euro;</p>
            <br />
            <br />
            <div id="rightProgress">
                <p id="skillTitle">rebound: </p>
                <p class="rebound"><?php echo $row->rebound; ?></p>
                <p class="rebound">/20</p>
                <div class="rebound<?php echo $row->speler_id;?>" id="reboundProgress"></div>
                <p id="skillTitle">rebound: </p>
                <p class="rebound"><?php echo $row->rebound_tr; ?></p>
                <p class="rebound">/1000</p>
                <div class="rebound_tr<?php echo $row->speler_id;?>" id="reboundProgress"></div>
                <p id="skillTitle">stamina: </p>
                <p class="stamina"><?php echo $row->stamina; ?></p>
                <p class="rebound">/20</p>
                <div class="stamina<?php echo $row->speler_id;?>" id="staminaProgress"></div>
                <p id="skillTitle">stamina: </p>
                <p class="stamina"><?php echo $row->stamina_tr; ?></p>
                <p class="rebound">/1000</p>
                <div class="stamina_tr<?php echo $row->speler_id;?>" id="staminaProgress"></div>
                <p id="skillTitle">shotprecision: </p>
                <p class="shotprecision"><?php echo $row->shotprecision; ?></p>
                <p class="rebound">/20</p>
                <div class="shotprecision<?php echo $row->speler_id;?>" id="shotprecisionProgress"></div>
                <p id="skillTitle">shotprecision: </p>
                <p class="shotprecision"><?php echo $row->shotprecision_tr; ?></p>
                <p class="rebound">/1000</p>
                <div class="shotprecision_tr<?php echo $row->speler_id;?>" id="shotprecisionProgress"></div>
                <p id="skillTitle">playmaking: </p>
                <p class="playmaking"><?php echo $row->playmaking; ?></p>
                <p class="rebound">/20</p>
                <div class="playmaking<?php echo $row->speler_id;?>" id="playmakingProgress"></div>
                <p id="skillTitle">playmaking: </p>
                <p class="playmaking"><?php echo $row->playmaking_tr; ?></p>
                <p class="rebound">/1000</p>
                <div class="playmaking_tr<?php echo $row->speler_id;?>" id="playmakingProgress"></div>
            </div>
            <div id="leftProgress">
                <p id="skillTitle">passing: </p>
                <p class="passing"><?php echo $row->passing; ?></p>
                <p class="rebound">/20</p>
                <div class="passing<?php echo $row->speler_id;?>" id="passingProgress"></div>
                 <p id="skillTitle">passing: </p>
                <p class="passing"><?php echo $row->passing_tr; ?></p>
                <p class="rebound">/1000</p>
                <div class="passing_tr<?php echo $row->speler_id;?>" id="passingProgress"></div>
                <p id="skillTitle">shotpower: </p>
                <p class="shotpower"><?php echo $row->shotpower; ?></p>
                <p class="rebound">/20</p>
                <div class="shotpower<?php echo $row->speler_id;?>" id="shotpowerProgress"></div>
                <p id="skillTitle">shotpower: </p>
                <p class="shotpower"><?php echo $row->shotpower_tr; ?></p>
                <p class="rebound">/1000</p>
                <div class="shotpower_tr<?php echo $row->speler_id;?>" id="shotpowerProgress"></div>
                <p id="skillTitle">intercepting: </p>
                <p class="intercepting"><?php echo $row->intercepting; ?></p>
                <p class="rebound">/20</p>
                <div class="intercepting<?php echo $row->speler_id;?>" id="interceptingProgress"></div>
                 <p id="skillTitle">intercepting: </p>
                <p class="intercepting"><?php echo $row->intercepting_tr; ?></p>
                <p class="rebound">/1000</p>
                <div class="intercepting_tr<?php echo $row->speler_id;?>" id="interceptingProgress"></div>
                <p id="skillTitle">leadership: </p>
                <p class="leadership"><?php echo $row->leadership; ?></p>
                <p class="rebound">/20</p>
                <div class="leadership<?php echo $row->speler_id;?>" id="leadershipProgress"></div>
                 <p id="skillTitle">leadership: </p>
                <p class="leadership"><?php echo $row->leadership_tr; ?></p>
                <p class="rebound">/1000</p>
                <div class="leadership_tr<?php echo $row->speler_id;?>" id="leadershipProgress"></div>
            </div>
            <!-- vordering van training -->
<!--             <p>vordering</p> -->
            <div id="rightProgress">
                
                
                
                
            </div>
            <div id="leftProgress">
               
                
               
               
            </div>
        </div>

    <?php }


 ?>
    <div id="myModal" class="reveal-modal"> <a class="close-reveal-modal">&#215;</a> </div>
</div>
<div class="gameRight">

    <div class="chart_container">    <h2>team skills</h2>
        <canvas id="chartCanvas1" width="350" height="350"> Your web-browser does not support the HTML 5 canvas element. </canvas>
    </div>
    <h2>laatst getraind op</h2>
    <p>test</p>
    <h2>datum</h2>
    <p>test</p>
</div>
