<script>
$(document).ready(function()
{

	//ophalen sponsors voor team
	var teamid = $('#teamid').val();
	//alert(teamid);
	get_sponsors();
	function get_sponsors(){

	$('.sponsor').remove();
	$('.sponsorinfo').remove();
	
	$.ajax({
    			type: "POST",
    			url: "http://playb.al/index.php/Json/korfbal_sponsors",
    			data:  { teamid: teamid,
            			
            			
        				},
    			dataType: "json",
        		success: function(data){
        			if(data === "niks"){
        				$('#sponsors').append('<div id="1" class="sponsor"><a href="#">Kies sponsor</a></div>');
        				$('#sponsors').append('<div id="2" class="sponsor"><a href="#">Kies sponsor</a></div>');
        				$('#sponsors').append('<div id="3" class="sponsor"><a href="#">Kies sponsor</a></div>');
        			
        			}
        			var count=0;
        			for(var i in data){
        				count ++;
        			}
        			if(count === 1){
        				for(var i in data){
        					$('#sponsors').append('<div id="sponsor1" class="sponsorinfo"><h4>'+data[i].naam+'</h4><p>Bedrag: '+data[i].bedrag+'</p><p>Weken: '+data[i].weken+'</p><br/></div>');
        				}
        				$('#sponsors').append('<div id="2" class="sponsor"><a href="#">Kies sponsor</a></div>');
        				$('#sponsors').append('<div id="3" class="sponsor"><a href="#">Kies sponsor</a></div>');
        			}
        			if(count === 2){
        				for(var i in data){
        					$('#sponsors').append('<div id="sponsor'+i+'" class="sponsorinfo"><h4>'+data[i].naam+'</h4><p>Bedrag: '+data[i].bedrag+'</p><p>Weken: '+data[i].weken+'</p><br/></div>');
        				}
						$('#sponsors').append('<div id="3" class="sponsor"><a href="#">Kies sponsor</a></div>');        			
        			}
        			if(count === 3){
        				for(var i in data){
        					$('#sponsors').append('<div id="sponsor'+i+'" class="sponsorinfo"><h4>'+data[i].naam+'</h4><p>Bedrag: '+data[i].bedrag+'</p><p>Weken: '+data[i].weken+'</p><br/></div>');
        				}
        			
        			}
        		}
        		
        		});
        		};
        		//klikken op kies sponsor3 geeft een paar bepaalde sponsors weer
        		$('.sponsor').live('click', function(){
        				var cat = $(this).attr('id');
        				
        				$('#sponsormodal').empty();
        				
        				$('#loading').ajaxSuccess(function() {
  							$(this).hide();
  						});
	
						$('#loading').ajaxStart(function() {
					 	    $(this).show();
						});

        					$.ajax({
    							type: "POST",
    							url: "http://playb.al/index.php/Json/korfbal_get_sponsors",
    							data:  { cat: cat,
            			
            			
        					},
    							dataType: "json",
        						success: function(data){
        							
        							for(var i in data){
        								$('#sponsormodal').append('<h4>'+data[i].naam+'</h4><p> Aantal weken:'+data[i].aantal_weken+'</p><p> Bedrag: '+data[i].bedrag+'</p><a href="#" class="contract" id="'+data[i].id+'">Contracteren</a><br/>');
        							
        							}
        							
        						}
        						
        						});

        				
        			 $('#sponsormodal').reveal({
		        			
		        			 animation: 'fadeAndPop',                   //fade, fadeAndPop, none
	    					 animationspeed: 300,                       //how fast animtions are
	    					 closeonbackgroundclick: true,              //if you click background will modal close?
	    					 dismissmodalclass: 'close-reveal-modal'    //the class of a button or element that will close an open modal
	    			 });
        		
        		});
				
				//klikken op contracteren om deze sponsor aan te nemen
				$('.contract').live('click', function(){
					var sponsorid = $(this).attr('id');
					
					
					$.ajax({
    							type: "POST",
    							url: "http://playb.al/index.php/Json/korfbal_contract_sponsor",
    							data:  { sponsorid: sponsorid,
    									 teamid : teamid
            			
            			
        					},
    							dataType: "json",
        						success: function(data){
        							
        							$('#sponsormodal').empty();
        							$('#sponsormodal').append('<h2>Sponsor is gecontracteerd</h2>');
        							get_sponsors();
        							        							
        							
        						}
        						
        						});

				
				});
				
				
   });     		


</script>
<?php foreach($financien->result() as $row)
		{	
			$totaal = $row->totaal;
			$sponsors = $row->sponsors;
			$wedstrijd = $row->wedstrijdinkomsten;
			$gek_spelers = $row->gekochte_spelers;
			$ver_spelers = $row->verkochte_spelers;
			$spelersloon = $row->spelersloon;
			$stadion = $row->stadion;
		
	 }?>

<div class="players">
	<p>Kapitaal: <?php echo $totaal;?></p>
	<!-- uitgaven -->
	<div id="uitgaven" style="float:right; margin-right:100px; width:200px;">
	<h3>Uitgaven</h3>

		
		<p>Spelersloon: <?php echo $spelersloon;?></p>
		<p>Stadionwerken: <?php echo $stadion;?></p>
		<p>Gekochte spelers: <?php echo $gek_spelers;?></p>
		<hr/>
		<p>Totale uitgaven: <?php  $uitgaven = $spelersloon + $stadion + $gek_spelers; echo $uitgaven;?></p>
	</div>
	<!--inkomsten -->
	<div id="inkomsten" style="width:200px;">
	<h3>Inkomsten</h3>

		
		<p>Sponsors: <?php echo $sponsors;?></p>
		<p>Wedstrijdinkomsten: <?php echo $wedstrijd;?></p>
		<p>Verkochte spelers: <?php echo $ver_spelers;?></p>
		<hr/>
		<p>Totale inkomsten: <?php $inkomsten = $sponsors + $wedstrijd + $ver_spelers; echo $inkomsten;?></p>
	</div>
	<br/>
	<p>Winst/Verlies: <?php echo $inkomsten - $uitgaven;?></p>
		</div>
		<div class="gameRight">
		<div id="sponsors">
		<h2>Sponsors</h2>	
			
		</div>	
		</div>
		<input type="hidden" id="teamid" value="<?php echo $this->uri->segment('3');?>">
		<div id="sponsormodal" class="reveal-modal"><div id="loading"><img src="<?php echo base_url()?>/img/loading.gif"/></div> <a class="close-reveal-modal">&#215;</a> </div>
		