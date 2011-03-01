<style>
#plaatsen{
	width: 400px;

}
#stadion{
	width: 600px;
	height: 706px;
	float: right;
	
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

	function getData(){
		var teamid = $('#teamid').val();
		
		$.ajax({
		type: "POST",
		url: "http://playb.al/index.php/korfbal/korfbal_jsonStadion",
		data: { teamid: teamid  },
		dataType: "json",
        success: function(data) {
        
        	var stadion = data;
        	//alert(stadion['g'].sectie);
        			if(stadion['g'].sectie === '1'){
				    	$('#stadion').append('<div id="rechts_boven"></div>');	    	
        			}else{
        				$('#stadion').append('<div id="rechts_boven_kopen">$</div>');
        			}
        			
        			if(stadion['b'].sectie === '1'){
				    	$('#stadion').append('<div id="midden_boven"></div>');
				    	$('#aantalplaatsen_b').text('Sectie B: '+ stadion['b'].plaatsen+' plaatsen');
				    	$('#aantalplaatsen_b').append('<p><input type="text" id="b" value="1"/><span id="plaatsen_b" class="kopen">Koop plaatsen</span></p>');   	
	    	
        			}else{
        				$('#stadion').append('<div id="midden_boven_kopen">$</div>');
        			}
					
					if(stadion['f'].sectie === '1'){
				    	$('#stadion').append('<div id="links_boven"></div>');	    	
        			}else{
        				$('#stadion').append('<div id="links_boven_kopen">$</div>');
        			}
					
					if(stadion['c'].sectie === '1'){
				    	$('#stadion').append('<div id="rechts_midden"></div>');	    	
        			}else{
        				$('#stadion').append('<div id="rechts_midden_kopen">$</div>');
        			}
        			
        			$('#stadion').append('<div id="midden_midden"></div>');	
        			
        			if(stadion['a'].sectie === '1'){
				    	$('#stadion').append('<div id="links_midden"></div>');	
				    	$('#aantalplaatsen_a').text('Sectie A: '+ stadion['a'].plaatsen+' plaatsen');
				    	$('#aantalplaatsen_a').append('<p><input type="text" id="a" value="1"/><span id="plaatsen_a" class="kopen">Koop plaatsen</span></p>');   	
        			}else{
        				$('#stadion').append('<div id="links_midden_kopen">$</div>');
        			}
        			
        			if(stadion['h'].sectie === '1'){
				    	$('#stadion').append('<div id="rechts_onder"></div>');	    	
        			}else{
        				$('#stadion').append('<div id="rechts_onder_kopen">$</div>');
        			}
					
					if(stadion['d'].sectie === '1'){
				    	$('#stadion').append('<div id="midden_onder"></div>');	    	
        			}else{
        				$('#stadion').append('<div id="midden_onder_kopen">$</div>');
        			}
					
					if(stadion['e'].sectie === '1'){
				    	$('#stadion').append('<div id="links_onder"></div>');	    	
        			}else{
        				$('#stadion').append('<div id="links_onder_kopen">$</div>');
        			}
        			
        			
        		}
      	});
	
	
	}
	
	getData();


	$('.kopen').click(function(){
		
		var teamid = $('#teamid').val();
		//alert(teamid);
		var id = $(this).attr('id');
		//alert(id);
		
		if(id === 'sectie_b' || id === 'sectie_c' || id === 'sectie_d' || id === 'sectie_e' || id === 'sectie_f' || id === 'sectie_g' || id === 'sectie_h')
		{
			var url = "http://playb.al/index.php/korfbal/korfbal_buySection";
			
		}
		
		if(id === 'plaatsen_a' || id === 'plaatsen_b' || id === 'plaatsen_c' || id === 'plaatsen_d' || id === 'plaatsen_e' || id === 'plaatsen_f' || id === 'plaatsen_g' || id === 'plaatsen_h')
		{
			var url = "http://playb.al/index.php/korfbal/korfbal_buySeats";
			var input = id.split('plaatsen_');
			//alert(input[1]);
			var aantalplaatsen = $('#'+input[1]+'').val();
			//alert(aantalplaatsen);
		
		}
		
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
				
			
			}
			else{
				$().toastmessage('showErrorToast', 'U heeft te weinig geld om deze sectie te kopen!');
			}
		}
		
		if(data.seats){
			if(data.seats === true)
				{
					$().toastmessage('showSuccessToast', 'Plaatsen zijn aangekocht!');
					$("#plaatsen").fadeOut();
					$("#plaatsen").fadeIn();
				
				}
				else{
					$().toastmessage('showErrorToast', 'U heeft te weinig geld om deze plaatsen te kopen!');
				}
	
	         }
         }
         	
			});

	
	});

});


</script>
<?php foreach($stadion->result() as $row)
		{?>
			<h2><?php echo $row->naam;?></h2>
			<?php 
			$sectie_a = $row->sectie_a;
			$sectie_b = $row->sectie_b;
			$sectie_c = $row->sectie_c;
			$sectie_d = $row->sectie_d;
			$sectie_e = $row->sectie_e;
			$sectie_f = $row->sectie_f;
			$sectie_g = $row->sectie_g;
			$sectie_h = $row->sectie_h;
			$plaatsen_a = $row->plaatsen_a;
			$plaatsen_b = $row->plaatsen_b;
			$plaatsen_c = $row->plaatsen_c;
			$plaatsen_d = $row->plaatsen_d;
			$plaatsen_e = $row->plaatsen_e;
			$plaatsen_f = $row->plaatsen_f;
			$plaatsen_g = $row->plaatsen_g;
			$plaatsen_h = $row->plaatsen_h;
			
			
			
			?>
		
		
		
	<?php	}
?>
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

<div id="plaatsen">
	<div id="aantalplaatsen_a"></div>
	<div id="aantalplaatsen_b"></div>
	<div>Sectie C: <?php if($sectie_c == 0){?>
			<p id="sectie_c" class="kopen">Sectie C nu kopen</p>
				<?php }else{?>
			<?php echo $plaatsen_c;?>&nbsp;plaatsen.<p><input type="text" id="c" value="1"/><span id="plaatsen_c" class="kopen">Koop plaatsen</span><?php }?></p>	
	</div>
	<div>Sectie D: <?php if($sectie_d == 0){?>
			<p id="sectie_d" class="kopen">Sectie D nu kopen</p>
				<?php }else{?>
			<?php echo $plaatsen_d;?>&nbsp;plaatsen.<p><input type="text" id="d" value="1"/><span id="plaatsen_d" class="kopen">Koop plaatsen</span><?php }?></p>	
	</div>
	<div>Sectie E: <?php if($sectie_e == 0){?>
			<p id="sectie_e" class="kopen">Sectie E nu kopen</p>
				<?php }else{?>
			<?php echo $plaatsen_e;?>&nbsp;plaatsen.<p><input type="text" id="e" value="1"/><span id="plaatsen_e" class="kopen">Koop plaatsen</span><?php }?></p>	
	</div>
	<div>Sectie F: <?php if($sectie_f == 0){?>
			<p id="sectie_f" class="kopen">Sectie F nu kopen</p>
				<?php }else{?>
			<?php echo $plaatsen_f;?>&nbsp;plaatsen.<p><input type="text" id="f" value="1"/><span id="plaatsen_f" class="kopen">Koop plaatsen</span><?php }?></p>	
	</div>
	<div>Sectie G: <?php if($sectie_g == 0){?>
			<p id="sectie_g" class="kopen">Sectie G nu kopen</p>
				<?php }else{?>
			<?php echo $plaatsen_g;?>&nbsp;plaatsen.<p><input type="text" id="g" value="1"/><span id="plaatsen_g" class="kopen">Koop plaatsen</span><?php }?></p>	
	</div>
	<div>Sectie H: <?php if($sectie_h == 0){?>
			<p id="sectie_h" class="kopen">Sectie H nu kopen</p>
				<?php }else{?>
			<?php echo $plaatsen_h;?>&nbsp;plaatsen.<p><input type="text" id="h" value="1"/><span id="plaatsen_h" class="kopen">Koop plaatsen</span><?php }?></p>	
	</div>
	
</div>
<input type="hidden" id="teamid" value="<?php echo $this->uri->segment('3')?>"/>
</div>