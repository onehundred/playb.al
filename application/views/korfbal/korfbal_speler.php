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

        url: "http://playb.al/index.php/Json/korfbal_updateTransfer",

        data: { bedrag: bedrag,
            	spelerid: spelerid,
            	teamid: teamid
            			
        				},
		dataType: "json",
        success: function(data) {
			if(data.check == 'invalid'){
				alert('Je moet een bod hoger dan het huidige bod, en hoger dan het minimumbod uitbrengen');
			
			}
			
			if(data.check == 'valid'){
				alert('Je bod op deze speler is geregistreerd.');
			}

         }

 

        });

 

        return false;           

 

    });

$("#transfer").submit(function(){ 

		var bedrag = document.getElementById('bedrag').value;
		var spelerid = document.getElementById('spelerid').value;
		var teamid = document.getElementById('teamid').value;

		//alert (spelerid); 
            $.ajax({
    			type: "POST",
    			url: "http://playb.al/index.php/Json/korfbal_addTransfer",
    			data: { bedrag: bedrag,
            			spelerid: spelerid,
            			teamid : teamid
            			
        				},
        		dataType: "json",
        		success: function(data) {
        		
        		if(data.check == 'invalid'){
				alert('Je kan niet minder dan 8 spelers in je team hebben.');
			
			}
			
			if(data.check == 'valid'){
    				$('#slide').hide();
    				$('#spelertransfer').hide();
    				$('#succes').show();
    				
    				}
    			
      
                }
  				});
       });  
   });  
  






</script>

<div class="gameRight">
    <?php $teamid = $this->uri->segment('3');?>
    <?php foreach($speler->result() as $row)
{?>
    <p><?php echo $row->voornaam;?>&nbsp;<?php echo $row->achternaam;?></p>
    <p>Age:<?php echo $row->leeftijd; ?></p>
    <br/>
    <p>Sex: <?php echo $row->geslacht; ?></p>
    <br/>
    <p>Waarde: <?php echo ($row->rebound * 6250) + ($row->stamina * 3125) + ($row->passing * 6250 ) + ($row->shotprecision * 400) + ($row->shotpower * 4000) + ($row->intercepting * 7500) + ($row->leadership * 1000) + ($row->playmaking * 6250);?> $</p>
    <p>Loon: <?php echo ($row->rebound * 50) + ($row->stamina * 25) + ($row->passing * 50 ) + ($row->shotprecision * 25) + ($row->shotpower * 25) + ($row->intercepting * 70) + ($row->playmaking * 50);?> $/ week </p>
    <br/>
    <p>Rebound: <?php echo $row->rebound; ?>/20</p>
    <p>Passing: <?php echo $row->passing; ?>/20</p>
    <p>Stamina: <?php echo $row->stamina; ?>/20</p>
    <p>Shotpower: <?php echo $row->shotpower; ?>/20</p>
    <p>Shotprecision: <?php echo $row->shotprecision; ?>/20</p>
    <p>Playmaking: <?php echo $row->playmaking; ?>/20</p>
    <p>Intercepting: <?php echo $row->intercepting; ?>/20</p>
    <p>Leadership: <?php echo $row->leadership; ?>/20</p>
    <br/>
    <?php $transfer = $row->transfer;
			if($transfer == 0)
			{
			if(!isset($alien)){?>
    
    <!--p tag en geen a href omwille van verspringen van pagina-->
    <p id="spelertransfer" style="text-decoration:underline; cursor:pointer;">Plaats deze speler op de transfer markt</p>
    <div id="slide" style=" display:none;">
        <form id="transfer" onsubmit="return false;">
            <label>Vraagprijs:</label>
            <input type="text" id="bedrag" name="bedrag"/>
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
<div class="gameLeft">
    <div>
        <section>
            <h2>overzicht</h2>
            <p>een regel content minstens</p>
            <p>bij voorkeur twee</p>
        </section>
    </div>
    <div>
        <section>
            <h2>aantal matchen gespeeld</h2>
            <p>een regel content minstens</p>
            <p>bij voorkeur twee</p>
        </section>
    </div>
    <div>
        <section>
            <h2>aantal goals in carriere</h2>
            <p>een regel content minstens</p>
            <p>bij voorkeur twee</p>
        </section>
    </div>
    <div>
        <section>
            <h2>goals dit seizoen</h2>
            <p>een regel content minstens</p>
            <p>bij voorkeur twee</p>
        </section>
    </div>
    <div>
        <section>
            <h2>goals vorige wedstrijd</h2>
            <p>een regel content minstens</p>
            <p>bij voorkeur twee</p>
        </section>
    </div>
    <div>
        <section>
            <h2>beste prestatie</h2>
            <p>een regel content minstens</p>
            <p>bij voorkeur twee</p>
        </section>
    </div>
    <div>
        <section>
            <h2>prestatie vorige wedstrijd</h2>
            <p>een regel content minstens</p>
            <p>bij voorkeur twee</p>
        </section>
    </div>
</div>
