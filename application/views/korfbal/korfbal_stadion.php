<style>
#plaatsen{
	width: 400px;

}
#stadion{
	width: 600px;
	height: 706px;
	float: left;
	
}
#links_boven{
	width: 100px;
	height: 100px;
	float: left;
	background-color: blue;
	-webkit-border-top-left-radius: 100px;
}

#links_boven_kopen{
	width: 100px;
	height: 100px;
	float: left;
		-webkit-border-top-left-radius: 100px;
}


#midden_boven{
	float:right;
	width: 400px;
	height: 100px;
	background-color: green;
}

#midden_boven_kopen{
	float:right;
	width: 400px;
	height: 100px;
	text-align: center;
}


#rechts_boven{
	width: 100px;
	height: 100px;
	float:right;
	background-color: blue;
	-webkit-border-top-right-radius: 100px;
}
#rechts_boven_kopen{
	width: 100px;
	height: 100px;
	float:right;
	-webkit-border-top-right-radius: 100px;
	text-align: center;
}

#rechts_midden{
	width: 100px;
	height: 500px;
	float: right;
	background-color: green;
}
#rechts_midden_kopen{
	width: 100px;
	height: 500px;
	float: right;
	text-align: center;
}


#midden_midden{
	width: 400px;
	height: 500px;
	float: right;
	background-color: #bc8f66;

}

#links_midden{
	width: 100px;
	height: 500px;
	float: left;
	background-color: green;
}

#rechts_onder{
	width: 100px;
	height: 100px;
	float: right;
	background-color: blue;
	-webkit-border-bottom-right-radius: 100px;
}
#rechts_onder_kopen{
	width: 100px;
	height: 100px;
	float: right;
	text-align: center;
	-webkit-border-bottom-right-radius: 100px;
}

#midden_onder{
	width: 400px;
	height: 100px;
	float: right;
	background-color: green;
}
#midden_onder_kopen{
	width: 400px;
	height: 100px;
	float: right;
	text-align: center;
}
#links_onder{
	width: 100px;
	height: 100px;
	float: left;
	background-color: blue;
	-webkit-border-bottom-left-radius: 100px;

}
#links_onder_kopen{
	width: 100px;
	height: 100px;
	float: left;
	text-align: center
	-webkit-border-bottom-left-radius: 100px;

}

.kopen{
	text-decoration: underline;
	cursor: pointer;
	color:blue;
	margin-left: 35px;
	font-size: 9pt;
}
</style>
 
<script>
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
				    	$('#sec_g').append('<div class="input">'+stadion['g'].plaatsen+'&nbsp;plaatsen.<p><input type="text" id="g" value="1"/><span id="plaatsen_g" class="kopen">Koop plaatsen</span></p><div>	');	    	
        			}else{
        				$('#stadion').append('<div id="rechts_boven_kopen">$</div>');
        				$('#sec_g').append('<p id="sectie_g" class="kopen input">Sectie G nu kopen</p>');

        			}
        			
        			if(stadion['b'].sectie === '1'){
				    	$('#stadion').append('<div id="midden_boven"></div>');
				    	$('#sec_b').append('<div class="input">'+stadion['b'].plaatsen+'&nbsp;plaatsen.<p><input type="text" id="b" value="1"/><span id="plaatsen_b" class="kopen">Koop plaatsen</span></p><div>	');	
				    	   	
        			}else{
        				$('#stadion').append('<div id="midden_boven_kopen">$</div>');
        				$('#sec_b').append('<p id="sectie_b" class="kopen input">Sectie B nu kopen</p>');
        			}
					
					if(stadion['f'].sectie === '1'){
				    	$('#stadion').append('<div id="links_boven"></div>');	
				    	$('#sec_f').append('<div class="input">'+stadion['f'].plaatsen+'&nbsp;plaatsen.<p><input type="text" id="f" value="1"/><span id="plaatsen_f" class="kopen">Koop plaatsen</span></p><div>	');
        			}else{
        				$('#stadion').append('<div id="links_boven_kopen">$</div>');
        				$('#sec_f').append('<p id="sectie_f" class="kopen input">Sectie F nu kopen</p>');
        			}
					
					if(stadion['c'].sectie === '1'){
				    	$('#stadion').append('<div id="rechts_midden"></div>');
				    	$('#sec_c').append('<div class="input">'+stadion['c'].plaatsen+'&nbsp;plaatsen.<p><input type="text" id="c" value="1"/><span id="plaatsen_c" class="kopen">Koop plaatsen</span></p><div>	');	
	    	
        			}else{
        				$('#stadion').append('<div id="rechts_midden_kopen">$</div>');
        				$('#sec_c').append('<p id="sectie_c" class="kopen input">Sectie C nu kopen</p>');
        			}
        			
        			$('#stadion').append('<div id="midden_midden"></div>');	
        			
        			if(stadion['a'].sectie === '1'){
				    	$('#stadion').append('<div id="links_midden"></div>');	
				    	$('#sec_a').append('<div class="input">'+stadion['a'].plaatsen+'&nbsp;plaatsen.<p><input type="text" id="a" value="1"/><span id="plaatsen_a" class="kopen">Koop plaatsen</span></p><div>	');	    	
        			}else{
        				$('#stadion').append('<div id="links_midden_kopen">$</div>');
        				$('#sec_a').append('<p id="sectie_a" class="kopen input">Sectie A nu kopen</p>');
        			}
        			
        			if(stadion['h'].sectie === '1'){
				    	$('#stadion').append('<div id="rechts_onder"></div>');
				  		$('#sec_h').append('<div class="input">'+stadion['h'].plaatsen+'&nbsp;plaatsen.<p><input type="text" id="h" value="1"/><span id="plaatsen_h" class="kopen">Koop plaatsen</span></p><div>	'); 	    	
        			}else{
        				$('#stadion').append('<div id="rechts_onder_kopen">$</div>');
        				$('#sec_h').append('<p id="sectie_h" class="kopen input">Sectie H nu kopen</p>');
        			}
					
					if(stadion['d'].sectie === '1'){
				    	$('#stadion').append('<div id="midden_onder"></div>');	
				    	$('#sec_d').append('<div class="input">'+stadion['d'].plaatsen+'&nbsp;plaatsen.<p><input type="text" id="d" value="1"/><span id="plaatsen_d" class="kopen">Koop plaatsen</span></p><div>	');	   	
        			}else{
        				$('#stadion').append('<div id="midden_onder_kopen">$</div>');
        				$('#sec_d').append('<p id="sectie_d" class="kopen input">Sectie D nu kopen</p>');
        			}
					
					if(stadion['e'].sectie === '1'){
				    	$('#stadion').append('<div id="links_onder"></div>');
				    	$('#sec_e').append('<div class="input">'+stadion['e'].plaatsen+'&nbsp;plaatsen.<p><input type="text" id="e" value="1"/><span id="plaatsen_e" class="kopen">Koop plaatsen</span></p><div>	');		    	
        			}else{
        				$('#stadion').append('<div id="links_onder_kopen">$</div>');
        				$('#sec_e').append('<p id="sectie_e" class="kopen input">Sectie E nu kopen</p>');
        			}
        			
        			
        		}
      	});
	
	
	}
	$( "#dialog-confirm" ).hide();
		
	$('.kopen').live('click', function(){
	
				
		var teamid = $('#teamid').val();
		//alert(teamid);
		var id = $(this).attr('id');
		//alert(id);
		
		if(id === 'sectie_b' || id === 'sectie_c' || id === 'sectie_d' || id === 'sectie_e' || id === 'sectie_f' || id === 'sectie_g' || id === 'sectie_h')
		{
			var url = "http://playb.al/index.php/Json/korfbal_buySection";
			
		}
		
		if(id === 'plaatsen_a' || id === 'plaatsen_b' || id === 'plaatsen_c' || id === 'plaatsen_d' || id === 'plaatsen_e' || id === 'plaatsen_f' || id === 'plaatsen_g' || id === 'plaatsen_h')
		{
			var url = "http://playb.al/index.php/Json/korfbal_buySeats";
			var input = id.split('plaatsen_');
			//alert(input[1]);
			var aantalplaatsen = $('#'+input[1]+'').val();
			//alert(aantalplaatsen);
		
		}
		
		
		$( "#dialog:ui-dialog" ).dialog( "destroy" );
		
		
		$( "#dialog-confirm" ).dialog({
			resizable: false,
			height:300,
			modal: false,
			buttons: {
				"Kopen": function() {
					$.ajax({

        type: "POST",

        url: url,

        data: { id: id,	
        		teamid: teamid,
        		aantalplaatsen: aantalplaatsen
            			
        				},
		dataType: "json",
        success: function(data) {
        
        if(data.section){
			if(data.section === true)
			{
				$().toastmessage('showSuccessToast', 'Sectie is aangekocht!');
				$('#stadion').slideUp(500,function(){
						getData();
					});
					
					$('#stadion').slideDown(2000);
			
			}
			else{
				$().toastmessage('showErrorToast', 'U heeft te weinig geld om deze sectie te kopen!');
			}
		}
		
		if(data.seats){
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
					$().toastmessage('showErrorToast', 'U heeft te weinig geld om deze plaatsen te kopen!');
				}
	
	         }
         }
         	
			});

					$( this ).dialog( "close" );
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			}
		});

		
		
	
	});	
});


</script>
<div class="gameRight">
<?php foreach($stadion->result() as $row)
		{?>
			<h2><?php echo $row->naam;?></h2>
						
	<?php	}
?>
<?php if(!isset($alien)){?>
<div id="plaatsen">
	<div id="sec_a">Sectie A: </div>
	<div id="sec_b">Sectie B:</div>
	<div id="sec_c">Sectie C: </div>
	<div id="sec_d">Sectie D: </div>
	<div id="sec_e">Sectie E: </div>
	<div id="sec_f">Sectie F: </div>
	<div id="sec_g">Sectie G: </div>
	<div id="sec_h">Sectie H: </div>
	
</div>
<?php } ?>
</div><div class="players">
<div id="stadion_container">
<div id="stadion">
<!-- sectie g rechts boven -->

<!-- sectie b midden boven -->

<!-- sectie f links boven -->

<!-- sectie c rechts midden -->

<!-- speelveld midden midden -->	
	
<!-- sectie a standaard -->
	
<!-- sectie h rechts onder -->

<!-- sectie d midden onder -->

<!-- sectie e links onder -->

</div>
</div>

<input type="hidden" id="teamid" value="<?php echo $this->uri->segment('3')?>"/>
</div>
<div id="dialog-confirm" title="Plaatsen kopen?">
	<p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Bent u zeker dat u deze plaatsen wilt aankopen?</p>
</div>
