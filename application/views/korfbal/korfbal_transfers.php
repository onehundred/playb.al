<script>	
$(document).ready(function(){

	function get_transfers(positie){
		
			$.ajax({
    			type: "POST",
    			url: "/index.php/Json/korfbal_transfers",
    			data:  { positie: positie, 
    					 },
    			dataType: "json",
        		success: function(data){
        			//alert(data[1].spelernaam);
        		
        			for(var i in data){
        				if(data[i].huidig_bod == null){
        					var huidig = '<p>Er is nog geen bod geplaatst op deze speler.</p>'
        							+ '<a href="../../korfbal/korfbal_player/'+data[i].teamid+'/'+data[i].spelerid+'">Plaats een bod</a>'; 
        				}else{
        					var huidig = '<p>Huidig bod: '+data[i].huidig_bod+'$ door: '+data[i].hoogste_bieder +'</p>'
        								+ '<a href="../../korfbal/korfbal_player/'+data[i].teamid+'/'+data[i].spelerid+'">Plaats een bod</a>'; ;
        				}
        			
	        			   var content = '<div id="transfer" class="transfer">' 
	        					   + '<div id="deadline">'+data[i].deadline+'</div>'
	        					   + '<div id="gegevens">'
	        					   + '<p>'+data[i].spelernaam+'</p>'
	        					   + '<p>'+data[i].leeftijd+' '+data[i].geslacht+'    '+data[i].positie +'</p>'
	        					   + huidig
	        					   + '</div>'
	    						   + '<br/></div>';
        			$('#transfers').append(content);
        			}
        		}
        	});	
	}
	
	$('#submit_search').click(function() {
		
 		var positie = $("#positie option:selected").val();
 		cleanup();
 		get_transfers(positie);
	});
	
	
	function cleanup(){
		$('.transfer').remove();
	}

});
	
</script>

<div class="gameRight">
<input type="hidden" id="teamid" value="<?php echo $this->uri->segment('3');?>"/>
	<div id="transfer_filter">
		<select id="positie">
			<option id="all" value="all">Alle Posities</option>
			<option id="aanvaller" value="aanvaller">Aanvaller</option>
			<option id="spelmaker" value="spelmaker">Spelmaker</option>
			<option id="rebounder" value="rebounder">Rebounder</option>
		</select>
		<p id="submit_search">Zoek</p>
	
	</div>
	<div id="transfers">
		
	
	</div>
 
</div>
<div class="gameLeft">
    <div><section>
       <h2><img src="<?php echo base_url();?>img/icons/calendar.png" id="icon" ondragstart="return false" />kalender</h2>
                <p>huidige week: week <?php echo $calendar['week'];?></p>
                <p>huidige seizoen: seizoen <?php echo $calendar['seizoen'];?></p>
                <p>eerstvolgende wedstrijd: <?php echo $calendar['thuisteam']['teamnaam'];?> - <?php echo $calendar['uitteam']['teamnaam'];?></p>
</section>    </div>
</div>
