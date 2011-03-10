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
                	var url = "http://playb.al/index.php/training/train_stamina";
                	//alert('stamina');
                }
                //passing
                if(option === 'passing'){
                	var url = "http://playb.al/index.php/training/train_passing";
                }
                //shotpower
                if(option === 'shotpower'){
                	var url = "http://playb.al/index.php/training/train_shotpower";
                }
                //shotprecision
                if(option === 'shotprecision'){
                	var url = "http://playb.al/index.php/training/train_shotprecision";
                //alert('shotprecision');
                
                }
                //intercepting
                if(option === 'intercepting'){
                	var url = "http://playb.al/index.php/training/train_intercepting";
                //alert('intercepting');
                
                }
                //rebound
                if(option === 'rebound'){
                var url = "http://playb.al/index.php/training/train_rebound";
                //alert('rebound');
                
                }
                //playmaking
                if(option === 'playmaking'){
                var url = "http://playb.al/index.php/training/train_playmaking";
                //alert('playmaking');
                
                }
                
                
                 $.ajax({
	    			type: "POST",
	    			url: url,
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
	        		
		        		for(var i in spelers){
		        			
		    				var progress = spelers[i].totaal / 10;
		    				//alert(progress);
		    				
		    				
		    				if(spelers[i].niveau){
		    					$('#myModal').append('<p>'+spelers[i].naam +' is gestegen naar niveau '+spelers[i].niveau+'</p>');
		        			$('#myModal').append('<div background-color=red; style=height:10px; id=progressbar'+i+'></div>');
		        			
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
                

              });
	
		
	
	
	
	
	});
	
	
});	
</script>
<script>
		$(function() {
		
				var teamid = $('#teamid').val();
			
				//alert(teamid);
				$.ajax({
    			type: "POST",
    			url: "http://playb.al/index.php/korfbal_other_team/korfbal_jsonPlayers",
    			data:  { teamid: teamid,
            			
            			
        				},
    			dataType: "json",
        		success: function(data){
        		var spelers = data;
        		
        		var reboundtotaal = 0;
        		var passingtotaal = 0;
        		var interceptingtotaal = 0;
        		var shotpowertotaal = 0;
        		var shotprecisiontotaal = 0;
        		var leadershiptotaal = 0;
        		var playmakingtotaal = 0;
        		var staminatotaal = 0;
        		
        		
        		for(var i in spelers){
	        		$( ".rebound"+spelers[i].spelerid).progressbar({
					value: spelers[i].rebound * 5
					});
					$( ".passing"+spelers[i].spelerid ).progressbar({
						value: spelers[i].passing * 5
					});
					$( ".intercepting"+spelers[i].spelerid ).progressbar({
						value: spelers[i].intercepting * 5
					});
					$( ".shotpower"+spelers[i].spelerid).progressbar({
						value: spelers[i].shotpower * 5
					});
					$( ".shotprecision"+spelers[i].spelerid).progressbar({
						value: spelers[i].shotprecision * 5
					});
					$( ".leadership"+spelers[i].spelerid ).progressbar({
						value: spelers[i].leadership * 5
					});
					$( ".playmaking"+spelers[i].spelerid ).progressbar({
						value: spelers[i].playmaking * 5
					});
					$( ".stamina"+spelers[i].spelerid ).progressbar({
						value: spelers[i].stamina * 5
					});
					
					reboundtotaal =+ spelers[i].rebound + reboundtotaal;	
					passingtotaal =+ spelers[i].passing + passingtotaal;
					interceptingtotaal =+ spelers[i].intercepting + interceptingtotaal;
					shotpowertotaal =+ spelers[i].shotpower + shotpowertotaal;
					shotprecisiontotaal =+ spelers[i].shotprecision + shotprecisiontotaal;
					leadershiptotaal =+ spelers[i].leadership + leadershiptotaal;
					playmakingtotaal =+ spelers[i].playmaking + playmakingtotaal;
					staminatotaal =+ spelers[i].stamina + staminatotaal;				//alert(spelersskills);
				}
				
			 var chart1 = new AwesomeChart('chartCanvas1');
/*             chart1.title = "Worldwide browser market share: December 2010"; */
   			 chart1.chartType = "horizontal bars";
             chart1.data = [reboundtotaal,passingtotaal,interceptingtotaal,shotpowertotaal,shotprecisiontotaal, leadershiptotaal,playmakingtotaal, staminatotaal];
             chart1.labels = ['rebound','playmaking','shotpower','shotprecision','passing','stamina', 'intercepting', 'leidersvermogen'];
             chart1.colors = ['#006CFF', '#FF6600', '#34A038', '#945D59', '#93BBF4', '#F493B8'];
             chart1.randomColors = false;
             chart1.draw();   
			
        		
        		}
        		
  				});
		
				
							
			});
	</script>

<div class="players">
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
    </select>
    Een training kost 30 van je energiepunten, je hebt momenteel <?php echo $energie; ?> energiepunten.
    <div style="text-decoration:underline; color:blue; cursor: pointer;" id="training">Train nu.</div>
    <br/>
    <?php
foreach($training->result() as $row){

//echo $row->FK_team_id;
 ?>
    <div class="players">
        <div class="playerDetail">
            <p><?php echo $row->voornaam. " ".$row->achternaam;?></p>
            <div id="rightProgress">
                <p id="skillTitle">rebound: </p>
                <p class="rebound"><?php echo $row->rebound; ?></p>
                <p class="rebound">/20</p>
                <div class="rebound<?php echo $row->speler_id;?>" id="reboundProgress"></div>
                <p id="skillTitle">stamina: </p>
                <p class="stamina"><?php echo $row->stamina; ?></p>
                <p class="rebound">/20</p>
                <div class="stamina<?php echo $row->speler_id;?>" id="staminaProgress"></div>
                <p id="skillTitle">shotprecision: </p>
                <p class="shotprecision"><?php echo $row->shotprecision; ?></p>
                <p class="rebound">/20</p>
                <div class="shotprecision<?php echo $row->speler_id;?>" id="shotprecisionProgress"></div>
                <p id="skillTitle">playmaking: </p>
                <p class="playmaking"><?php echo $row->playmaking; ?></p>
                <p class="rebound">/20</p>
                <div class="playmaking<?php echo $row->speler_id;?>" id="playmakingProgress"></div>
            </div>
            <div id="leftProgress">
                <p id="skillTitle">passing: </p>
                <p class="passing"><?php echo $row->passing; ?></p>
                <p class="rebound">/20</p>
                <div class="passing<?php echo $row->speler_id;?>" id="passingProgress"></div>
                <p id="skillTitle">shotpower: </p>
                <p class="shotpower"><?php echo $row->shotpower; ?></p>
                <p class="rebound">/20</p>
                <div class="shotpower<?php echo $row->speler_id;?>" id="shotpowerProgress"></div>
                <p id="skillTitle">intercepting: </p>
                <p class="intercepting"><?php echo $row->intercepting; ?></p>
                <p class="rebound">/20</p>
                <div class="intercepting<?php echo $row->speler_id;?>" id="interceptingProgress"></div>
                <p id="skillTitle">leadership: </p>
                <p class="leadership"><?php echo $row->leadership; ?></p>
                <p class="rebound">/20</p>
                <div class="leadership<?php echo $row->speler_id;?>" id="leadershipProgress"></div>
            </div>
            
            <!-- <p>rebound:<?php echo $row->rebound;?>/20 --> 
            vordering:<?php echo $row->rebound_tr;?>/1000
            </p>
            <!-- <p>playmaking:<?php echo $row->playmaking;?>/20 --> 
            vordering:<?php echo $row->playmaking_tr;?>/1000
            </p>
            <!-- <p>shotpower:<?php echo $row->shotpower;?>/20 --> 
            vordering:<?php echo $row->shotpower_tr;?>/1000
            </p>
            <!-- <p>shotprecision:<?php echo $row->shotprecision;?>/20 --> 
            vordering:<?php echo $row->shotprecision_tr;?>/1000
            </p>
            <!-- <p>passing:<?php echo $row->passing;?>/20 --> 
            vordering:<?php echo $row->passing_tr;?>/1000
            </p>
            <!-- <p>stamina:<?php echo $row->stamina;?>/20 --> 
            vordering:<?php echo $row->stamina_tr;?>/1000
            </p>
            <!-- <p>intercepting:<?php echo $row->intercepting;?>/20 --> 
            vordering:<?php echo $row->intercepting_tr;?>/1000
            </p>
            <!-- <p>leidersvermogen:<?php echo $row->leadership;?>/20 --> 
            vordering:<?php echo $row->leadership_tr;?>/1000
            </p>
        </div>
    </div>
    <?php }


 ?>
    <div id="myModal" class="reveal-modal"> <a class="close-reveal-modal">&#215;</a> </div>
</div>
<div class="gameRight">
    <h2>team skills</h2>
    <div class="chart_container">
        <canvas id="chartCanvas1" width="350" height="350"> Your web-browser does not support the HTML 5 canvas element. </canvas>
    </div>
    <h2>laatst getraind op</h2>
    <p>test</p>
    <h2>datum</h2>
    <p>test</p>
</div>
