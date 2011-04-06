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
        					$('#sponsors').append('<section id="sponsor1" class="sponsorinfo"><h4>'+data[i].naam+'</h4><p>Bedrag: '+data[i].bedrag+'</p><p>Weken: '+data[i].weken+'</p><br/></div>');
        				}
        				$('#sponsors').append('<section id="2" class="sponsor"><a href="#">Kies sponsor</a></div>');
        				$('#sponsors').append('<section id="3" class="sponsor"><a href="#">Kies sponsor</a></div>');
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
			
			//grafiek met overzicht van de financien van het huidige seizoen
			$.ajax({
    							type: "POST",
    							url: "http://playb.al/index.php/Json/korfbal_finances",
    							data:  { teamid : teamid
            			
            			
        					},
    							dataType: "json",
        						success: function(data){
        						
        							var week1 = data[1];
        							//alert(week1);
									if(!!document.createElement('canvas').getContext){ //check that the canvas
						                                                           // element is supported
						            var mychart = new AwesomeChart('canvas1');
						         
						            mychart.title = "Verloop financien";
						            mychart.data = [data[1], data[2], data[3], data[4], data[5], data[6], data[7], data[8], data[9], data[10], data[11], data[12], data[13],data[14]];
						            mychart.labels = ["Week1", "Week2", "Week3", "week4", "week5", "week6", "week7", "week8", "week9", "week10", "week11", "week12", "week13", "week14"];
						            mychart.draw();
						        }
        
        
        }
        
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
			
						
			$inkomsten = $sponsors + $wedstrijd + $ver_spelers;
			$uitgaven = $spelersloon + $stadion + $gek_spelers;
			$uitkomst = $inkomsten - $uitgaven;
	 }?>
<?php foreach($financien_vorige->result() as $rij)
{
			$totaal_vorige = $rij->totaal;
			$sponsors_vorige = $rij->sponsors;
			$wedstrijd_vorige = $rij->wedstrijdinkomsten;
			$gek_spelers_vorige = $rij->gekochte_spelers;
			$ver_spelers_vorige = $rij->verkochte_spelers;
			$spelersloon_vorige = $rij->spelersloon;
			$stadion_vorige = $rij->stadion;

}?>

<div class="players">
    <p>Kapitaal: <?php echo $totaal;?> (<?php echo $totaal + $uitkomst;?>)</p>
    <br/>
    <!-- uitgaven -->
    <h2>Deze week</h2>
    <div id="uitgaven" style="float:right; margin-right:100px; width:200px;">
        <h3>Uitgaven</h3>
        <p>Spelersloon: <?php echo $spelersloon;?></p>
        <p>Stadionwerken: <?php echo $stadion;?></p>
        <p>Gekochte spelers: <?php echo $gek_spelers;?></p>
        <hr/>
        <p>Totale uitgaven: <?php echo $uitgaven;?></p>
    </div>
    <!--inkomsten -->
    <div id="inkomsten" style="width:200px;">
        <h3>Inkomsten</h3>
        <p>Sponsors: <?php echo $sponsors;?></p>
        <p>Wedstrijdinkomsten: <?php echo $wedstrijd;?></p>
        <p>Verkochte spelers: <?php echo $ver_spelers;?></p>
        <hr/>
        <p>Totale inkomsten:
            <?php  echo $inkomsten;?>
        </p>
    </div>
    <br/>
    <p>Winst/Verlies: <?php echo $uitkomst;?></p>
    <br/>
    <br/>
    <?php if(isset($sponsors_vorige)){?>
    <h2>Vorige week</h2>
    <div id="uitgaven" style="float:right; margin-right:100px; width:200px;">
        <h3>Uitgaven</h3>
        <p>Spelersloon: <?php echo $spelersloon_vorige;?></p>
        <p>Stadionwerken: <?php echo $stadion_vorige;?></p>
        <p>Gekochte spelers: <?php echo $gek_spelers_vorige;?></p>
        <hr/>
        <p>Totale uitgaven:
            <?php  $uitgaven_vorige = $spelersloon_vorige + $stadion_vorige + $gek_spelers_vorige; echo $uitgaven_vorige;?>
        </p>
    </div>
    <!--inkomsten -->
    <div id="inkomsten" style="width:200px;">
        <h3>Inkomsten</h3>
        <p>Sponsors: <?php echo $sponsors_vorige;?></p>
        <p>Wedstrijdinkomsten: <?php echo $wedstrijd_vorige;?></p>
        <p>Verkochte spelers: <?php echo $ver_spelers_vorige;?></p>
        <hr/>
        <p>Totale inkomsten:
            <?php $inkomsten_vorige = $sponsors_vorige + $wedstrijd_vorige + $ver_spelers_vorige; echo $inkomsten_vorige;?>
        </p>
    </div>
    <br/>
    <p>Winst/Verlies: <?php echo $inkomsten_vorige - $uitgaven_vorige;?></p>
    <?php } ?>
</div>
<div class="gameRight">
    <div id="sponsors">
        <h2>Sponsors</h2>
    </div>
    <div id="grafiek">
        <h2>Overzicht financien</h2>
        <canvas id="canvas1" width="400" height="300"> Your web-browser does not support the HTML 5 canvas element. </canvas>
    </div>
</div>
<input type="hidden" id="teamid" value="<?php echo $this->uri->segment('3');?>">
<div id="sponsormodal" class="reveal-modal">
    <div id="loading">
        <img src="<?php echo base_url()?>/img/loading.gif"/>
    </div>
    <a class="close-reveal-modal">&#215;</a> </div>
