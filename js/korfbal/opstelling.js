$(function() {
	
		var teamid = $("#teamid").val();
		var spelerid = '';
		var wissel = '';
		var positie = ''
		
		
		getData();
		//data ophalen van de spelers die al in de opstelling staan
		function getData(){
		$(".droppable").remove();	
		$.ajax({
    			type: "POST",
    			url: "http://playb.al/index.php/Json/get_JsonOpstelling",
    			data: {
            			teamid: teamid
            		  },
        		dataType: "json",
        		success: function(data){
        			var spelers = data;
        			//kijken of er een speler op een bepaalde positie staat, zoniet aanvullen met een lege div
        					//rebound1
        					if(data === false){
        					
        						$('#vak1').append('<div class="droppable" id="rebound1">Drop speler hier</div>');
        						$('#vak1').append('<div class="droppable" id="playmaking1">Drop speler hier</div>');
        						$('#vak1').append('<div class="droppable" id="attack1">Drop speler hier</div>');
    		        			$('#vak1').append('<div class="droppable" id="attack2">Drop speler hier</div>');
    		        			$('#vak2').append('<div class="droppable" id="rebound2">Drop speler hier</div>');
    		        			$('#vak2').append('<div class="droppable" id="playmaking2">Drop speler hier</div>');
    		        			$('#vak2').append('<div class="droppable" id="attack3">Drop speler hier</div>');
    		        			$('#vak2').append('<div class="droppable" id="attack4">Drop speler hier</div>');
    		        			$('#general').append('<div class="droppable" id="captain">Drop speler hier</div>');
    		        			$('#general').append('<div class="droppable" id="septpieces">Drop speler hier</div>');
    		        			}
        					else{
		        			if(spelers[0].voornaam === 'null')
		        			{
		        				$('#vak1').append('<div class="droppable" id="rebound1">Drop speler hier</div>');
		        			
		        			}else
		        			{
		        				$('#vak1').append('<div class="droppable" id="rebound1">'+spelers[0].voornaam+'<input type="hidden" id="'+spelers[0].id+'"/></div>');
		        				
		        			}
		        			//playmaking1
		        			if(spelers[1].voornaam === 'null')
		        			{
		        				$('#vak1').append('<div class="droppable" id="playmaking1">Drop speler hier</div>');
		        			
		        			}else
		        			{
		        				$('#vak1').append('<div class="droppable" id="playmaking1">'+spelers[1].voornaam+'<input type="hidden" id="'+spelers[1].id+'"/></div>');
		        			}
		        			//attack1
		        			if(spelers[2].voornaam === 'null')
		        			{
		        				$('#vak1').append('<div class="droppable" id="attack1">Drop speler hier</div>');
		        			
		        			}else
		        			{
		        				$('#vak1').append('<div class="droppable" id="attack1">'+spelers[2].voornaam+'<input type="hidden" id="'+spelers[2].id+'"/></div>');
		        			}
		        			//attack2
		        			if(spelers[3].voornaam === 'null')
		        			{
		        				$('#vak1').append('<div class="droppable" id="attack2">Drop speler hier</div>');
		        			
		        			}else
		        			{
		        				$('#vak1').append('<div class="droppable" id="attack2">'+spelers[3].voornaam+'<input type="hidden" id="'+spelers[3].id+'"/></div>');
		        			}
		        			//reobund2
		        			if(spelers[4].voornaam === 'null')
		        			{
		        				$('#vak2').append('<div class="droppable" id="rebound2">Drop speler hier</div>');
		        			
		        			}else
		        			{
		        				$('#vak2').append('<div class="droppable" id="rebound2">'+spelers[4].voornaam+'<input type="hidden" id="'+spelers[4].id+'"/></div>');
		        			}
		        			//playmaking2
		        			if(spelers[5].voornaam === 'null')
		        			{
		        				$('#vak2').append('<div class="droppable" id="playmaking2">Drop speler hier</div>');
		        			
		        			}else
		        			{
		        				$('#vak2').append('<div class="droppable" id="playmaking2">'+spelers[5].voornaam+'<input type="hidden" id="'+spelers[5].id+'"/></div>');
		        			}
							//attack3
							if(spelers[6].voornaam === 'null')
		        			{
		        				$('#vak2').append('<div class="droppable" id="attack3">Drop speler hier</div>');
		        			
		        			}else
		        			{
		        				$('#vak2').append('<div class="droppable" id="attack3">'+spelers[6].voornaam+'<input type="hidden" id="'+spelers[6].id+'"/></div>');
		        			}
							//attack4
							if(spelers[7].voornaam === 'null')
		        			{
		        				$('#vak2').append('<div class="droppable" id="attack4">Drop speler hier</div>');
		        			
		        			}else
		        			{
		        				$('#vak2').append('<div class="droppable" id="attack4">'+spelers[7].voornaam+'<input type="hidden" id="'+spelers[7].id+'"/></div>');
		        			}
							//kapitein
							if(spelers[8].voornaam === 'null')
		        			{
		        				$('#general').append('<div class="droppable" id="captain">Drop speler hier</div>');
		        			
		        			}else
		        			{
		        				$('#general').append('<div class="droppable" id="captain">'+spelers[8].voornaam+'<input type="hidden" id="'+spelers[8].id+'"/></div>');
		        			}
		        			//vrijworpen
		        			if(spelers[9].voornaam === 'null')
		        			{
		        				$('#korfbalField').append('<div class="droppable" id="setpieces">Drop speler hier</div>');
		        			
		        			}else
		        			{
		        				$('#korfbalField').append('<div class="droppable" id="setpieces">'+spelers[9].voornaam+'<input type="hidden" id="'+spelers[9].id+'"/></div>');
		        			}
		        			}
		        			//de bovenstaande divs draggable maken zodat ze gewisseld kunnen worden
		        			$( ".droppable" ).draggable({ 
								cursor: 'move',
								helper: 'clone',
								revert: true,
								appendTo: "body"
												
							});	
							
							
							
							
							$(".droppable" ).draggable({
								start: function() {
								
									spelerid = $(this).find(':input').attr('id');
									wissel = "wissel";
									positie = $(this).attr('id');
									
									//alert(spelerid);
								},
								drag: function() {
												},
								stop: function() {
									
								}
							});	
							
							//hierboven aangemaakte divs droppable maken
		        			$( ".droppable").droppable({
								activeClass: "ui-state-default",
								hoverClass: "ui-state-hover",
								accept: ".trigger",
								drop: function( event, ui ) {
					
					
					
							positie = $(this).attr('id');
							//alert(spelerid);
							var geslachtstring = $('#dpop'+spelerid).find("#geslacht").text();
							var geslachtarray = geslachtstring.split(": ");
							var geslacht = geslachtarray[1];
							//alert(geslacht);
							//alert(wissel);
							
							$.ajax({
				    			type: "POST",
				    			url: "http://playb.al/index.php/Json/korfbal_reorder",
				    			data: { positie: positie,
				            			teamid: teamid,
				            			geslacht: geslacht, 
				            			spelerid : spelerid
				            			
				        				},
				        		dataType: "json",
				        		success: function(data){
				    			
				    			if(data.check === 'valid'){
									$().toastmessage('showSuccessToast', " Speler is toegewezen aan"+" "+positie+"");
								}
								if(data.check === 'invalid vrouwen'){
									$().toastmessage('showErrorToast', "Er kunnen maximum 2 vrouwen in een vak staan");
								
								}
								if(data.check ==='invalid mannen'){
									$().toastmessage('showErrorToast', "Er kunnen maximum 2 mannen in een vak staan");
								
								
								}
								if(data.check === 'invalid dezelfde'){
									$().toastmessage('showErrorToast', "Deze speler is al opgesteld");
								}
				    			if(data.check === 'invalid opgesteld'){
									$().toastmessage('showErrorToast', "De speler moet opgesteld! ");
								}
				    			getData();
						
		      
		                }
		  			});
					
				  }
			
			
			});	
						
        				}
								
				});					
			};
		
		//draggable maken van spelers met tooltip	
		$( ".trigger" ).draggable({ 
				cursor: 'move',
				helper: 'clone',
				revert: false,
				appendTo: "body"
								
			});	
			
		$(".trigger" ).draggable({
			start: function() {
				spelerid = $(this).attr('id');
				wissel = "drop";
			},
			drag: function() {
							},
			stop: function() {
				
			}
		});
		
		//players div droppable maken om spelers te verwijderen uit de opstelling
		$( "#players").droppable({
								activeClass: "ui-state-default",
								hoverClass: "ui-state-hover",
								accept: ".droppable",
								drop: function( event, ui ) {
								
								
								//alert(positie);
								$.ajax({
					    			type: "POST",
					    			url: "http://playb.al/index.php/Json/removePlayer_Opstelling",
					    			data: { 
					            			teamid: teamid, 
					            			spelerid : spelerid,
					            			positie: positie
					            			
					        				},
					        		dataType: "json",
					        		success: function(data){
					        		getData();
					        		
					        		}
					        		
					        		});

									
									
									
										}
								});	
		
		//jquery voor de tooltip met de gegevens van de speler in 
		 $('.bubbleInfo').each(function () {
            var distance = 10;
            var time = 250;
            var hideDelay = 50;

            var hideDelayTimer = null;

            var beingShown = false;
            var shown = false;
            var trigger = $('.trigger', this);
            var info = $('.popup', this).css('opacity', 0);


            $([trigger.get(0), info.get(0)]).mouseover(function () {
                if (hideDelayTimer) clearTimeout(hideDelayTimer);
                if (beingShown || shown) {
                    // don't trigger the animation again
                    return;
                } else {
                    // reset position of info box
                    beingShown = true;

                    info.css({
                        top: -90,
                        left: -33,
                        display: 'block'
                    }).animate({
                        top: '-=' + distance + 'px',
                        opacity: 1
                    }, time, 'swing', function() {
                        beingShown = false;
                        shown = true;
                    });
                }

                return false;
            }).mouseout(function () {
                if (hideDelayTimer) clearTimeout(hideDelayTimer);
                hideDelayTimer = setTimeout(function () {
                    hideDelayTimer = null;
                    info.animate({
                        top: '-=' + distance + 'px',
                        opacity: 0
                    }, time, 'swing', function () {
                        shown = false;
                        info.css('display', 'none');
                    });

                }, hideDelay);

                return false;
            });
        });
	
			

	});