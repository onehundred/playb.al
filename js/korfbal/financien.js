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
        				$('#sponsors').append('<p id="1" class="sponsor"><a href="#">Kies sponsor</a></p>');
        				$('#sponsors').append('<p id="2" class="sponsor"><a href="#">Kies sponsor</a></p>');
        				$('#sponsors').append('<p id="3" class="sponsor"><a href="#">Kies sponsor</a></p>');
        			
        			}
        			var count=0;
        			for(var i in data){
        				count ++;
        			}
        			if(count === 1){
        				for(var i in data){
        					$('#sponsors').append('<p id="sponsor1" class="sponsorinfo"><h4>'+data[i].naam+'</h4><p>Bedrag: '+data[i].bedrag+'</p><p>Weken: '+data[i].weken+'</p><br/></p>');
        				}
        				$('#sponsors').append('<p id="2" class="sponsor"><a href="#">Kies sponsor</a></p>');
        				$('#sponsors').append('<p id="3" class="sponsor"><a href="#">Kies sponsor</a></p>');
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
        						
        							var finances = [];
        							var weken = [];
        							
        							for(var i = 1 in data){
        								finances = data[i];
        								weken = "Week"+i;
        							
        							}
        							
        							
        							var week1 = data[1];
        							//alert(week1);
									if(!!document.createElement('canvas').getContext){ //check that the canvas
						                                                           // element is supported
						            var mychart = new AwesomeChart('canvas1');
						         	mychart.chartType = "horizontal bars";
						         	 mychart.data = finances;
						         	 mychart.labels = weken;
						           // mychart.data = [data[1], data[2], data[3], data[4], data[5], data[6], data[7], data[8], data[9], data[10], data[11], data[12], data[13], data[14]];
						            //mychart.labels = ["Week1", "Week2", "Week3", "week4", "week5", "week6", "week7", "week8", "week9", "week10", "week11", "week12", "week13", "week14"];
						            mychart.draw();
						        }
        
        
        }
        
        });

				
   });     		
