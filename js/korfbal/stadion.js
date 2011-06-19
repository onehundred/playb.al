$(function(){
	getData();
	
	function getData(){
		var holder = document.getElementById("stadion");
		while(holder.hasChildNodes()){
			holder.removeChild(holder.lastChild);
		}
		
		var teamid = $('#teamid').val();
		
		$('.input').remove();

		
		$.ajax({
		type: "POST",
		url: "http://playb.al/index.php/Json/korfbal_jsonStadion",
		data: { teamid: teamid  },
		dataType: "json",
        success: function(data) {
        
        	var stadion = data;
        	//alert(stadion['g'].sectie);
        			if(stadion['g'].sectie === '1'){
				    	$('#stadion').append('<div id="rechts_boven"></div>');
				    	$('#sec_g').append('<div class="input">'+stadion['g'].plaatsen+'&nbsp;plaatsen.<p><input type="text" id="g" value="1"/><a id="plaatsen_g" class="kopen question">Koop plaatsen</a></p><div>	');	    	
        			}else{
        				$('#stadion').append('<div id="rechts_boven_kopen"></div>');
        				$('#sec_g').append('<p id="sectie_g" class="kopen question input">kopen</p>');

        			}
        			
        			if(stadion['b'].sectie === '1'){
				    	$('#stadion').append('<div id="midden_boven"></div>');
				    	$('#sec_b').append('<div class="input">'+stadion['b'].plaatsen+'&nbsp;plaatsen.<p><input type="text" id="b" value="1"/><a id="plaatsen_b" class="kopen">Koop plaatsen</a></p><div>	');	
				    	   	
        			}else{
        				$('#stadion').append('<div id="midden_boven_kopen"></div>');
        				$('#sec_b').append('<p id="sectie_b" class="kopen question input">kopen</p>');
        			}
					
					if(stadion['f'].sectie === '1'){
				    	$('#stadion').append('<div id="links_boven"></div>');	
				    	$('#sec_f').append('<div class="input">'+stadion['f'].plaatsen+'&nbsp;plaatsen.<p><input type="text" id="f" value="1"/><a id="plaatsen_f" class="kopen">Koop plaatsen</a></p><div>	');
        			}else{
        				$('#stadion').append('<div id="links_boven_kopen"></div>');
        				$('#sec_f').append('<p id="sectie_f" class="kopen question input">kopen</p>');
        			}
					
					if(stadion['c'].sectie === '1'){
				    	$('#stadion').append('<div id="rechts_midden"></div>');
				    	$('#sec_c').append('<div class="input">'+stadion['c'].plaatsen+'&nbsp;plaatsen.<p><input type="text" id="c" value="1"/><a id="plaatsen_c" class="kopen">Koop plaatsen</a></p><div>	');	
	    	
        			}else{
        				$('#stadion').append('<div id="rechts_midden_kopen"></div>');
        				$('#sec_c').append('<p id="sectie_c" class="kopen question input">kopen</p>');
        			}
        			
        			$('#stadion').append('<div id="midden_midden"></div>');	
        			
        			if(stadion['a'].sectie === '1'){
				    	$('#stadion').append('<div id="links_midden"></div>');	
				    	$('#sec_a').append('<div class="input">'+stadion['a'].plaatsen+'&nbsp;plaatsen.<p><input type="text" id="a" value="1"/><a id="plaatsen_a" class="kopen question">Koop plaatsen</a></p><div>	');	    	
        			}else{
        				$('#stadion').append('<div id="links_midden_kopen"></div>');
        				$('#sec_a').append('<p id="sectie_a" class="kopen question input">kopen</p>');
        			}
        			
        			if(stadion['h'].sectie === '1'){
				    	$('#stadion').append('<div id="rechts_onder"></div>');
				  		$('#sec_h').append('<div class="input">'+stadion['h'].plaatsen+'&nbsp;plaatsen.<p><input type="text" id="h" value="1"/><a id="plaatsen_h" class="kopen">Koop plaatsen</a></p><div>	'); 	    	
        			}else{
        				$('#stadion').append('<div id="rechts_onder_kopen"></div>');
        				$('#sec_h').append('<p id="sectie_h" class="kopen question input">kopen</p>');
        			}
					
					if(stadion['d'].sectie === '1'){
				    	$('#stadion').append('<div id="midden_onder"></div>');	
				    	$('#sec_d').append('<div class="input">'+stadion['d'].plaatsen+'&nbsp;plaatsen.<p><input type="text" id="d" value="1"/><a id="plaatsen_d" class="kopen">Koop plaatsen</a></p><div>	');	   	
        			}else{
        				$('#stadion').append('<div id="midden_onder_kopen"></div>');
        				$('#sec_d').append('<p id="sectie_d" class="kopen question input">kopen</p>');
        			}
					
					if(stadion['e'].sectie === '1'){
				    	$('#stadion').append('<div id="links_onder"></div>');
				    	$('#sec_e').append('<div class="input">'+stadion['e'].plaatsen+'&nbsp;plaatsen.<p><input type="text" id="e" value="1"/><a id="plaatsen_e" class="kopen">Koop plaatsen</a></p><div>	');		    	
        			}else{
        				$('#stadion').append('<div id="links_onder_kopen"></div>');
        				$('#sec_e').append('<p id="sectie_e" class="kopen question input">kopen</p>');
        			}
        			
        			
        		}
      	});
	
	
	}
	$( "#dialog-confirm" ).hide();
		
	$('.kopen').live('click', function(){
		$('.aankoop_overzicht').remove();
				
		var teamid = $('#teamid').val();
		//alert(teamid);
		var id = $(this).attr('id');
		//alert(id);
		
		if(id === 'sectie_b' || id === 'sectie_c' || id === 'sectie_d' || id === 'sectie_e' || id === 'sectie_f' || id === 'sectie_g' || id === 'sectie_h')
		{
			var url = "http://playb.al/index.php/Json/korfbal_buySection";
			$('#dialog-confirm').append('<p class="aankoop_overzicht">1 Sectie voor 500 000 &euro;</p>');
			
		}
		
		if(id === 'plaatsen_a' || id === 'plaatsen_b' || id === 'plaatsen_c' || id === 'plaatsen_d' || id === 'plaatsen_e' || id === 'plaatsen_f' || id === 'plaatsen_g' || id === 'plaatsen_h')
		{
			var url = "http://playb.al/index.php/Json/korfbal_buySeats";
			var input = id.split('plaatsen_');
			//alert(input[1]);
			var aantalplaatsen = $('#'+input[1]+'').val();
			var betalenplaatsen = aantalplaatsen * 100;
			//alert(aantalplaatsen);
			$('#dialog-confirm').append('<p class="aankoop_overzicht">'+aantalplaatsen+' plaats(en) voor '+betalenplaatsen+' &euro; </p>');
		}
		
		
		$( "#dialog:ui-dialog" ).dialog( "destroy" );
		
		
		$( "#dialog-confirm" ).dialog({
			resizable: false,
			height:280,
			modal: false,
			buttons: {
				"kopen": function() {
					$.ajax({

        type: "POST",

        url: url,

        data: { id: id,	
        		teamid: teamid,
        		aantalplaatsen: aantalplaatsen
            			
        				},
		dataType: "json",
        success: function(data) {
        
        if(data.section != undefined){
        	if(data.section === true)
			{
				$().toastmessage('showSuccessToast', 'Sectie is aangekocht!');
				$('#stadion').slideUp(500,function(){
						getData();
					});
					
					$('#stadion').slideDown(2000);
			
			}
			if(data.section === false){
			
				$().toastmessage('showErrorToast', 'U heeft te weinig geld om deze sectie te kopen!');
			}
		}
		
		if(data.seats != undefined){
			if(data.seats === true)
				{
					$().toastmessage('showSuccessToast', 'Plaatsen zijn aangekocht!');
					
						//$( "#sec_"+input[1]).effect( 'explode', 500, getData() );
						//getData();
					$("#sec_"+input[1]).flip({
					direction:'tb',
					color : '#FFF',
					onBefore: function(){
							console.log('before starting the animation');
					},
					onAnimation: function(){
							getData();
					},
					onEnd: function(){
							console.log('when the animation has already ended');
					}
				})
										
				}
				else{
					$().toastmessage('showErrorToast', 'U heeft te weinig geld om deze plaatsen te kopen of u uw totaal aantal plaatsen overstijgt de 5000!');
				}
	
	         }
         }
         	
			});

					$( this ).dialog( "close" );
				},
				sluiten: function() {
					$( this ).dialog( "close" );
				}
			}
		});

		
		
	
	});	
});
