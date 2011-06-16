<script src="<?php echo base_url();?>js/korfbal/spelers.js"></script>
<script>
$(function(){
	
	$('#spelertransfer').click(function(){
	
		$('#slide').slideDown();
	
	});
	
	$("#bieden").submit(function(){

        var bedrag = document.getElementById('bod').value;
        var spelerid = document.getElementById('speleridbod').value;
		var teamid = document.getElementById('teamidbod').value;
		//alert(bedrag + spelerid + teamid)
		
		$.ajax({

        type: "POST",

        url: "http://playb.al/index.php/json/korfbal_updateTransfer",

        data: { bedrag: bedrag,
            	spelerid: spelerid,
            	teamid: teamid
            			
        				},
		dataType: "json",
        success: function(data) {
			if(data.check == 'invalid'){
				$().toastmessage('showErrorToast', "Je moet een bod hoger dan het huidige bod, en hoger dan het minimumbod uitbrengen.");
			
			}
			
			if(data.check == 'valid'){
				$().toastmessage('showSuccessToast', "Je bod op deze speler is geregistrerd.");
			}

         }

 

        });

 

        return false;           

 

    });

$("#transfer").submit(function(){ 

		var bedrag = document.getElementById('bedrag').value;
		if(bedrag == ''){
			$().toastmessage('showErrorToast', "U moet een minimumbedrag invullen.");

		}else{
		
		var spelerid = document.getElementById('spelerid').value;
		var teamid = document.getElementById('teamid').value;
		var positie = $("#positie option:selected").text();

            $.ajax({
    			type: "POST",
    			url: "http://playb.al/index.php/Json/korfbal_addTransfer",
    			data: { bedrag: bedrag,
            			spelerid: spelerid,
            			teamid : teamid,
            			positie : positie
            			
        				},
        		dataType: "json",
        		success: function(data) {
        		
        		if(data.check == 'invalid'){
					$().toastmessage('showErrorToast', "Je kan niet minder dan 8 spelers in je team hebben.");

			
			}
			
			if(data.check == 'valid'){
    				$('#slide').hide();
    				$('#spelertransfer').hide();
    				$('#succes').show();
    				
    				}
    			
      
                }
  				});
  				
  		}		
       });  
   });  
  






</script>
<div class="game">
<div class="gameRight">
	    
    <?php $teamid = $this->uri->segment('3');?>
    <?php foreach($speler->result() as $row)
{?>
    <p><?php echo $row->voornaam;?>&nbsp;<?php echo $row->achternaam;?></p>
    <p>leeftijd:<?php echo $row->leeftijd; ?></p>
    <br/>
    <p>geslacht: <?php echo $row->geslacht; ?></p>
    <br/>
    <p>Waarde: <?php echo ($row->rebound * 6250) + ($row->stamina * 3125) + ($row->passing * 6250 ) + ($row->shotprecision * 400) + ($row->shotpower * 4000) + ($row->intercepting * 7500) + ($row->leadership * 1000) + ($row->playmaking * 6250);?> &euro;</p>
    <p>Loon: <?php echo ($row->rebound * 50) + ($row->stamina * 25) + ($row->passing * 50 ) + ($row->shotprecision * 25) + ($row->shotpower * 25) + ($row->intercepting * 70) + ($row->playmaking * 50);?> &euro;/ week </p>
    <br/>
   <div id="container">
    <div id="rightProgress">
                <section>
                    <p id="skillTitle">rebound: </p>
                    <p class="rebound"><?php echo $row->rebound; ?></p>
                    <p class="rebound">/20</p>
                    <div class="rebound<?php echo $row->speler_id;?>" id="reboundProgress"></div>
                </section>
                <section>
                    <p id="skillTitle">rebound: </p>
                    <p class="rebound"><?php echo $row->rebound_tr; ?></p>
                    <p class="rebound">/1000</p>
                    <div class="rebound_tr<?php echo $row->speler_id;?>" id="reboundProgress"></div>
                </section>
                <section>
                    <p id="skillTitle">stamina: </p>
                    <p class="stamina"><?php echo $row->stamina; ?></p>
                    <p class="rebound">/20</p>
                    <div class="stamina<?php echo $row->speler_id;?>" id="staminaProgress"></div>
                </section>
                <section>
                    <p id="skillTitle">stamina: </p>
                    <p class="stamina"><?php echo $row->stamina_tr; ?></p>
                    <p class="rebound">/1000</p>
                    <div class="stamina_tr<?php echo $row->speler_id;?>" id="staminaProgress"></div>
                </section>
                <section>
                    <p id="skillTitle">shotprecision: </p>
                    <p class="shotprecision"><?php echo $row->shotprecision; ?></p>
                    <p class="rebound">/20</p>
                    <div class="shotprecision<?php echo $row->speler_id;?>" id="shotprecisionProgress"></div>
                </section>
                <section>
                    <p id="skillTitle">shotprecision: </p>
                    <p class="shotprecision"><?php echo $row->shotprecision_tr; ?></p>
                    <p class="rebound">/1000</p>
                    <div class="shotprecision_tr<?php echo $row->speler_id;?>" id="shotprecisionProgress"></div>
                </section>
                <section>
                    <p id="skillTitle">playmaking: </p>
                    <p class="playmaking"><?php echo $row->playmaking; ?></p>
                    <p class="rebound">/20</p>
                    <div class="playmaking<?php echo $row->speler_id;?>" id="playmakingProgress"></div>
                </section>
                <section>
                    <p id="skillTitle">playmaking: </p>
                    <p class="playmaking"><?php echo $row->playmaking_tr; ?></p>
                    <p class="rebound">/1000</p>
                    <div class="playmaking_tr<?php echo $row->speler_id;?>" id="playmakingProgress"></div>
                </section>
            </div>
            <!-- end rightProgress -->
            <div id="leftProgress">
                <section>
                    <p id="skillTitle">passing: </p>
                    <p class="passing"><?php echo $row->passing; ?></p>
                    <p class="rebound">/20</p>
                    <div class="passing<?php echo $row->speler_id;?>" id="passingProgress"></div>
                </section>
                <section>
                    <p id="skillTitle">passing: </p>
                    <p class="passing"><?php echo $row->passing_tr; ?></p>
                    <p class="rebound">/1000</p>
                    <div class="passing_tr<?php echo $row->speler_id;?>" id="passingProgress"></div>
                </section>
                <section>
                    <p id="skillTitle">shotpower: </p>
                    <p class="shotpower"><?php echo $row->shotpower; ?></p>
                    <p class="rebound">/20</p>
                    <div class="shotpower<?php echo $row->speler_id;?>" id="shotpowerProgress"></div>
                </section>
                <section>
                    <p id="skillTitle">shotpower: </p>
                    <p class="shotpower"><?php echo $row->shotpower_tr; ?></p>
                    <p class="rebound">/1000</p>
                    <div class="shotpower_tr<?php echo $row->speler_id;?>" id="shotpowerProgress"></div>
                </section>
                <section>
                    <p id="skillTitle">intercepting: </p>
                    <p class="intercepting"><?php echo $row->intercepting; ?></p>
                    <p class="rebound">/20</p>
                    <div class="intercepting<?php echo $row->speler_id;?>" id="interceptingProgress"></div>
                </section>
                <section>
                    <p id="skillTitle">intercepting: </p>
                    <p class="intercepting"><?php echo $row->intercepting_tr; ?></p>
                    <p class="rebound">/1000</p>
                    <div class="intercepting_tr<?php echo $row->speler_id;?>" id="interceptingProgress"></div>
                </section>
                <section>
                    <p id="skillTitle">leadership: </p>
                    <p class="leadership"><?php echo $row->leadership; ?></p>
                    <p class="rebound">/20</p>
                    <div class="leadership<?php echo $row->speler_id;?>" id="leadershipProgress"></div>
                </section>
                <section>
                    <p id="skillTitle">leadership: </p>
                    <p class="leadership"><?php echo $row->leadership_tr; ?></p>
                    <p class="rebound">/1000</p>
                    <div class="leadership_tr<?php echo $row->speler_id;?>" id="leadershipProgress"></div>
                </section>
            </div>
          </div>

    
    
    
    
    <br/>
    <?php $transfer = $row->transfer;
			if($transfer == 0)
			{
			if(!isset($alien)){?>
    
    <!--p tag en geen a href omwille van verspringen van pagina-->
    <p class="question" id="spelertransfer">speler verkopen</p>
    <div id="slide" style=" display:none;">
        <form id="transfer" onsubmit="return false;">
            <label>Vraagprijs:</label>
            <input type="text" id="bedrag" name="bedrag"/>
         	<select id="positie">
         		<option value="aanvaller">Aanvaller</option>
         		<option value="spelmaker">Spelmaker</option>
         		<option value="rebounder">Rebounder</option>
         	
         	</select>
            <input type="hidden" id="spelerid" value="<?php echo $row->speler_id;?>"/>
            <input type="hidden" id="teamid" value="<?php echo $teamid;?>"/>
            <input type="submit" name="transfer"/>
        </form>
    </div>
    <p id="succes" style="display:none;">Speler is op de transferlijst geplaatst.</p>
    <?php } }else
			{?>
    <div> Plaats een bod op deze speler :
        <form id="bieden" onsubmit="return false;">
            <label>Bedrag:</label>
            <input type="text" id="bod" name="bod"/>
            <input type="hidden" id="speleridbod" value="<?php echo $row->speler_id;?>"/>
            <input type="hidden" id="teamidbod" value="<?php echo $teamid;?>"/>
            <input type="submit" name="bod"/>
        </form>
    </div>
    <?php }
 } 


?>
</div>
<aside>
<div class="gameLeft">
	<div>
        <section>
            <h2>aantal matchen gespeeld</h2>
            <?php if(isset($spelerstats['aantal_matchen'])){ ?>
           	    <p><?php echo $spelerstats['aantal_matchen']?></p>
	            <p>in zijn volledige korfbalcarrière</p>
            <?php }else{ ?>
            	<p>Deze speler speelde nog geen wedstrijden</p>
            <?php } ?>
        </section>
    </div>
    <div>
        <section>
            <h2>aantal goals in carriere</h2>
           <?php if(isset($spelerstats['goals_carriere'])){ ?>
           	    <p><?php echo $spelerstats['goals_carriere']?></p>
	            <p>in zijn volledige korfbalcarrière</p>
            <?php }else{ ?>
            	<p>Deze speler maakte nog geen goals</p>
            <?php } ?>
        </section>
    </div>
    <div>
        <section>
            <h2>goals dit seizoen</h2>
   		    <?php if(isset($spelerstats['goals_seizoen'])){ ?>
           	    <p><?php echo $spelerstats['goals_seizoen']?></p>
	            <p>in het huidige seizoen</p>
            <?php }else{ ?>
            	<p>Deze speler maakte nog geen goals dit seizoen</p>
            <?php } ?>

        </section>
    </div>
    <div>
        <section>
            <h2>goals vorige wedstrijd</h2>
            <?php if(isset($spelerstats['goals_wedstrijd'])){ ?>
           	    <p><?php echo $spelerstats['goals_wedstrijd']?></p>
	            <p>goals maakte deze speler vorige wedstrijd</p>
            <?php }else{ ?>
            	<p>Deze speler maakte vorige wedstrijd geen goals</p>
            <?php } ?>

        </section>
    </div>
    <div>
        <section>
            <h2>beste prestatie</h2>
             <?php if(isset($spelerstats['beste_prestatie'])){ ?>
           	    <p><?php echo $spelerstats['beste_prestatie']?>/100</p>
	            <p>was deze speler zijn/haar beste prestatie tot nu toe</p>
            <?php }else{ ?>
            	<p>Deze speler speelde nog geen wedstrijd</p>
            <?php } ?>

        </section>
    </div>
    <div>
        <section>
            <h2>prestatie vorige wedstrijd</h2>
             <?php if(isset($spelerstats['laatste_prestatie'])){ ?>
           	    <p><?php echo $spelerstats['laatste_prestatie']?>/100</p>
	            <p>was deze speler zijn/haar prestatie voor vorige wedstrijd</p>
            <?php }else{ ?>
            	<p>Deze speler speelde nog geen wedstrijd</p>
            <?php } ?>
        </section>
    </div>
    <div>
        <section>
            <h2>positie laatste wedstrijd</h2>
             <?php if(isset($spelerstats['laatste_positie'])){ ?>
           	    <p><?php echo $spelerstats['laatste_positie']?></p>
	            <p>was deze speler zijn/haar laatste positie</p>
            <?php }else{ ?>
            	<p>Deze speler speelde nog geen wedstrijd</p>
            <?php } ?>
        </section>
    </div>
</div>
</aside>
</div>
<input type="hidden" id="teamid" value="<?php echo $this->uri->segment(3);?>"/>