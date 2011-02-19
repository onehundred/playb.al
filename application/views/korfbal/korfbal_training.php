<script>

$(function() {
	

	$('#training').click(function(){
	
	var teamid = $('#teamid').val();
	$('#myModal p').remove();
	$('#myModal div').remove();
	//alert(teamid);
	
	
	$(".target option:selected").each(function () {
                var option = $(this).val();
                //alert(option);
                
                //stamina
                if(option === 'stamina'){
                //alert('stamina');
                 $.ajax({
	    			type: "POST",
	    			url: "http://playb.al/index.php/training/train_stamina",
	    			data: { teamid: teamid
	            			},
	        		dataType: "json",
	        		success: function(data){
	        		
	        		if(data.energiecheck === false){
	        			$().toastmessage('showErrorToast', "U heeft te weinig energiepunten.");
	        		//alert('U hebt te weinig energiepunten');
	        		}
	        		
	        		
	        		
	        		
	        		}
	        		
	        		
	        		});
                }
                //passing
                if(option === 'passing'){
	                $.ajax({
	    			type: "POST",
	    			url: "http://playb.al/index.php/training/train_passing",
	    			data: { teamid: teamid
	            			},
	        		dataType: "json",
	        		success: function(data){
	        		
	        		var spelers = data;
	        		if(data.energiecheck === false){
	        		$().toastmessage('showErrorToast', "U heeft te weinig energiepunten.");
	        		//alert('U hebt te weinig energiepunten');
	        		}
	        		else{
	        		
		        		for(i =1;i<20;i++){
		        			
		    				var progress = spelers[i].totaal / 10;
		    				//alert(progress);
		    				
		    				
		    				if(spelers[i].niveau){
		    					$('#myModal').append('<p>'+spelers[i].naam +' is gestegen naar niveau '+spelers[i].niveau+'</p>');
		        			$('#myModal').append('<div style=height:10px; id=progressbar'+i+'></div>');
		        			
		        			$( "#progressbar"+i ).progressbar({
								value: progress
							});

		    				
		    				}else{
		    				
		    				
		        			
		        			$('#myModal').append('<p>'+spelers[i].naam +' is '+spelers[i].gestegen+' punten gestegen. En heeft een totaal van '+ spelers[i].totaal+'</p>');
		        			$('#myModal').append('<div style=height:10px; id=progressbar'+i+'></div>');
		        			
		        			$( "#progressbar"+i ).progressbar({
								value: progress
							});
		        			
		        			//alert(spelers[i].naam + spelers[i].skill);
		   					$('#myModal').reveal({
		        			
		        			 animation: 'fade',                   //fade, fadeAndPop, none
	    					 animationspeed: 300,                       //how fast animtions are
	    					 closeonbackgroundclick: true,              //if you click background will modal close?
	    					 dismissmodalclass: 'close-reveal-modal'    //the class of a button or element that will close an open modal
	    					 });
	    					 }
		        		}
	    			}
	    			}
	  				});
                
                }
                //shotpower
                if(option === 'shotpower'){
                alert('shotpower');
                
                }
                //shotprecision
                if(option === 'shotprecision'){
                alert('shotprecision');
                
                }
                //intercepting
                if(option === 'intercepting'){
                alert('intercepting');
                
                }
                //rebound
                if(option === 'rebound'){
                alert('rebound');
                
                }
                //playmaking
                if(option === 'playmaking'){
                alert('playmaking');
                
                }
              });
	
		
	
	
	
	
	});
	
	
});	
</script>

<?php foreach($energie->result() as $row)
{
	$energie = $row->energie;

} ?>

<h2>Op wat wil je trainen?</h2>
<input type="hidden" id="teamid" value="<?php echo $this->uri->segment('3');?>"/>
<input type="hidden" id="energie" value="<?php echo $energie;?>"/>
<select class="target">
    <option value="stamina" selected="selected">Stamina</option>
    <option value="passing">Passing</option>
    <option value="shotpower">Shotkracht</option>
    <option value="shotprecision">Shotprecisie</option>
    <option value="rebound">Rebound</option>
    <option value="playmaking">Playmaking</option>
    <option value="intercepting">Intercepting</option>
  </select>Een training kost 30 van je energiepunten, je hebt momenteel <?php echo $energie; ?> energiepunten. <div style="text-decoration:underline; color:blue; cursor: pointer;" id="training">Train nu.</div><br/>
<?php
foreach($training->result() as $row){

//echo $row->FK_team_id;
 ?>
 
 
 <p><?php echo $row->voornaam. " ".$row->achternaam;?></p>
 <div>
 	<p>rebound:<?php echo $row->rebound;?>/20
 	vordering:<?php echo $row->rebound_tr;?>/1000</p>
 	<p>playmaking:<?php echo $row->playmaking;?>/20
 	vordering:<?php echo $row->playmaking_tr;?>/1000</p>
 	<p>shotpower:<?php echo $row->shotpower;?>/20
 	vordering:<?php echo $row->shotpower_tr;?>/1000</p>
 	<p>shotprecision:<?php echo $row->shotprecision;?>/20
 	vordering:<?php echo $row->shotprecision_tr;?>/1000</p>
 	<p>passing:<?php echo $row->passing;?>/20
 	vordering:<?php echo $row->passing_tr;?>/1000</p>
 	<p>stamina:<?php echo $row->stamina;?>/20
 	vordering:<?php echo $row->stamina_tr;?>/1000</p>
 	<p>intercepting:<?php echo $row->intercepting;?>/20
 	vordering:<?php echo $row->intercepting_tr;?>/1000</p>
 	<p>leidersvermogen:<?php echo $row->leadership;?>/20
 	vordering:<?php echo $row->leadership_tr;?>/1000</p>
 	
 
 </div>
 
 
 
 
<hr/>

<?php }


 ?>
 
 <div id="myModal" class="reveal-modal">
			
			<a class="close-reveal-modal">&#215;</a>
		</div>