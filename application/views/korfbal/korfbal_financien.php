<script>
$(document).ready(function()
{

	//ophalen sponsors voor team
	var teamid = $('#teamid').val();
	//alert(teamid);
	$.ajax({
    			type: "POST",
    			url: "http://playb.al/index.php/Json/korfbal_sponsors",
    			data:  { teamid: teamid,
            			
            			
        				},
    			dataType: "json",
        		success: function(data){
        			if(data === "niks"){
        				$('#sponsors').append('<div id="sponsor1"><a href="#">Kies sponsor</a></div>');
        				$('#sponsors').append('<div id="sponsor2"><a href="#">Kies sponsor</a></div>');
        				$('#sponsors').append('<div id="sponsor3"><a href="#">Kies sponsor</a></div>');
        			
        			}
        			var count=0;
        			for(var i in data){
        				count ++;
        			}
        			if(count === 1){
        				for(var i in data){
        					$('#sponsors').append('<div id="sponsor1"><h4>'+data[i].naam+'</h4><p>Bedrag: '+data[i].bedrag+'</p><p>Weken: '+data[i].weken+'</p></div>');
        				}
        				$('#sponsors').append('<div id="sponsor2"><a href="#">Kies sponsor</a></div>');
        				$('#sponsors').append('<div id="sponsor3"><a href="#">Kies sponsor</a></div>');
        			}
        			if(count === 2){
        				for(var i in data){
        					$('#sponsors').append('<div id="sponsor'+i+'"><h4>'+data[i].naam+'</h4><p>Bedrag: '+data[i].bedrag+'</p><p>Weken: '+data[i].weken+'</p></div>');
        				}
						$('#sponsors').append('<div id="sponsor3"><a href="#">Kies sponsor</a></div>');        			
        			}
        			if(count === 3){
        				for(var i in data){
        					$('#sponsors').append('<div id="sponsor'+i+'"><h4>'+data[i].naam+'</h4><p>Bedrag: '+data[i].bedrag+'</p><p>Weken: '+data[i].weken+'</p></div>');
        				}
        			
        			}
        		}
        		
        		});
        		
        		//klikken op kies sponsor3 geeft een paar bepaalde sponsors weer
        		$('#sponsor3').live('click', function(){
        		
        		
        			
        			 $('#myModal').reveal({
		        			
		        			 animation: 'fadeAndPop',                   //fade, fadeAndPop, none
	    					 animationspeed: 300,                       //how fast animtions are
	    					 closeonbackgroundclick: true,              //if you click background will modal close?
	    					 dismissmodalclass: 'close-reveal-modal'    //the class of a button or element that will close an open modal
	    					 });
        		
        		});

   });     		


</script>


<div class="players"><?php foreach($financien->result() as $row)
		{?>
		
		<p>Sponsors:<?php echo $row->sponsors;?></p>
		<p>Extra's: <?php echo $row->varia;?></p>
		<p>Wedstrijdinkomsten: <?php echo $row->wedstrijdinkomsten;?></p>
		<p>Totaal: <?php echo $row->totaal;?></p>
		
		
		
		<?php }?>
		</div>
		<div class="gameRight">
		<div id="sponsors">
			<h2>Sponsors</h2>
			
		</div>	
		</div>
		<input type="hidden" id="teamid" value="<?php echo $this->uri->segment('3');?>">
		 <div id="myModal" class="reveal-modal"> <a class="close-reveal-modal">&#215;</a> </div>
		