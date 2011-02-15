<script>
$(function(){
	
	$('#spelertransfer').click(function(){
	
		$('#slide').slideDown();
	
	});
	

 
    
    
$("#transfer").submit(function(){ 

		var bedrag = document.getElementById('bedrag').value;
		var spelerid = document.getElementById('spelerid').value;

		//alert (spelerid); 
            $.ajax({
    			type: "POST",
    			url: "http://playb.al/index.php/korfbal/korfbal_addTransfer",
    			data: { bedrag: bedrag,
            			spelerid: spelerid
            			
        				},
    			success: function() {
    			alert("goed zo");
      
                }
  				});
       });  
   });  
  






</script>

<div>
<?php foreach($speler->result() as $row)
{?>
	
	<p><?php echo $row->voornaam;?>&nbsp;<?php echo $row->achternaam;?></p>
	<p>Age:<?php echo $row->leeftijd; ?></p><br/>
	<p>Sex: <?php echo $row->geslacht; ?></p><br/>
	
				 
		 <p>Rebound: <?php echo $row->rebound; ?>/20</p>
		 <p>Passing: <?php echo $row->passing; ?>/20</p>
		 <p>Stamina: <?php echo $row->stamina; ?>/20</p>
		 <p>Shotpower: <?php echo $row->shotpower; ?>/20</p>
		 <p>Shotprecision: <?php echo $row->shotprecision; ?>/20</p>
		 <p>Playmaking: <?php echo $row->playmaking; ?>/20</p>
		 <p>Intercepting: <?php echo $row->intercepting; ?>/20</p>
		 <p>Leadership: <?php echo $row->leadership; ?>/20</p><br/>
		 
		 <?php $transfer = $row->transfer;
			if($transfer == 0)
			{?>
			
			<!--p tag en geen a href omwille van verspringen van pagina-->
			<p id="spelertransfer" style="text-decoration:underline; cursor:pointer;">Plaats deze speler op de transfer markt</p>
			<div id="slide" style=" display:none;">
			<form id="transfer" onsubmit="return false;">
				<label>Vraagprijs:</label><input type="text" id="bedrag" name="bedrag"/>
				<input type="hidden" id="spelerid" value="<?php echo $row->speler_id;?>"/>
				<input type="submit" name="transfer"/>
			
			</form>
			</div>
			
				
			<?php }
 } 


?>


</div>