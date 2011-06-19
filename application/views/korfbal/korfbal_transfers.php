<script>	
$(document).ready(function(){

	function get_transfers(positie){
		
			$.ajax({
    			type: "POST",
    			url: "<?php echo base_url();?>index.php/json/korfbal_transfers",
    			data:  { positie: positie, 
    					 },
    			dataType: "json",
        		success: function(data){
        			//alert(data[1].huidig_bod);
        			var count=1;
        			for(var j in data){
        				count++;
        			}
        			//alert(count);
        			
        			
        			for(var i=1;i<count;i++){
        				if(data[i].huidig_bod == null){
        					var huidig = '<p>Er is nog geen bod geplaatst op deze speler.</p>'
        							+ '<a href="../../korfbal_other_team/korfbal_player/'+data[i].teamid+'/'+data[i].spelerid+'">Plaats een bod</a>'; 
        				}else{
        					var huidig = '<p>Huidig bod: '+data[i].huidig_bod+'$ door: '+data[i].hoogste_bieder +'</p>'
        								+ '<a href="../../korfbal_other_team/korfbal_player/'+data[i].teamid+'/'+data[i].spelerid+'">Plaats een bod</a>'; ;
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
<div class="game">
<div class="gameRight">
    <input type="hidden" id="teamid" value="<?php echo $this->uri->segment('3');?>"/>
    <div id="transfer_filter">
        <select id="positie">
            <option id="all" value="all">Alle Posities</option>
            <option id="aanvaller" value="aanvaller">Aanvaller</option>
            <option id="spelmaker" value="spelmaker">Spelmaker</option>
            <option id="rebounder" value="rebounder">Rebounder</option>
        </select>
        <a class="question" id="submit_search">zoeken</a>
    </div>
    <div id="transfers"> </div>
</div>
<aside>
    <div class="gameLeft">
         <div class="fillLeft">
                    <section>
                        <figure class="icon" id="gameCalendar"></figure>
                        <h2> kalender</h2>
                        
                        <p class="entry">week <?php echo $calendar['week'];?> - seizoen <?php echo $calendar['seizoen'];?></p>
                        <p class="entry">volgende wedstrijd: <br /><?php echo $calendar['thuisteam']['teamnaam'];?> - <?php echo $calendar['uitteam']['teamnaam'];?></p>
                    </section>
                </div>
                <div class="fillLeft">
                    <section>
                        <figure class="icon" id="gamePlayerBought"></figure>
                        <h2> laatste speler gekocht</h2>
                         <?php if(isset($stats['gekocht']['voornaam'])){ ?>
                        	<p><a href="<?php echo base_url();?>index.php/korfbal/korfbal_player/<?php echo $team_id;?>/<?php echo $stats['gekochtid'];?>"/><?php echo $stats['gekocht']['voornaam'].' '.$stats['gekocht']['achternaam'];?></a></p>
                        <?php }else{ ?>
                      	  <p class="entry">nog geen speler gekocht.</p>
                        <?php } ?>
                    </section>
                </div>
                <div class="fillLeft">
                    <section>
                        <figure class="icon" id="gamePlayerSold"></figure>
                        <h2> laatste speler verkocht</h2>
                        <?php if(isset($stats['verkocht']['voornaam'])){ ?>
                        	<p><a href="<?php echo base_url();?>index.php/korfbal_other_team/korfbal_player/<?php echo $stats['verkocht']['teamid'];?>/<?php echo $stats['verkochtid'];?>"/><?php echo $stats['verkocht']['voornaam'].' '.$stats['gekocht']['achternaam'];?></a></p>
                        <?php }else{ ?>
                      	  <p class="entry">nog geen speler verkocht.</p>
                        <?php } ?>
                    </section>
                </div>
    </div> <!-- end gameLeft -->
</aside>
</div> <!-- end game -->
