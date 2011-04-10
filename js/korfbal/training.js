$(function() {
	init();
	function init(){
				var teamid = $('#teamid').val();
				$('#chartTeamSkills').empty();
				//alert(teamid);
				$.ajax({
    			type: "POST",
    			url: "http://playb.al/index.php/Json/korfbal_jsonPlayers",
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
					
					
					//alert(spelers[i].rebound_tr);
					$( ".rebound_tr"+spelers[i].spelerid).progressbarTraining({
					 value: spelers[i].rebound_tr / 10
					});
					$( ".passing_tr"+spelers[i].spelerid ).progressbarTraining({
						value: spelers[i].passing_tr /10 
					});
					$( ".intercepting_tr"+spelers[i].spelerid ).progressbarTraining({
						value: spelers[i].intercepting_tr / 10
					});
					$( ".shotpower_tr"+spelers[i].spelerid).progressbarTraining({
						value: spelers[i].shotpower_tr  / 10
					});
					$( ".shotprecision_tr"+spelers[i].spelerid).progressbarTraining({
						value: spelers[i].shotprecision_tr / 10
					});
					$( ".leadership_tr"+spelers[i].spelerid ).progressbarTraining({
						value: spelers[i].leadership_tr / 10
					});
					$( ".playmaking_tr"+spelers[i].spelerid ).progressbarTraining({
						value: spelers[i].playmaking_tr / 10
					});
					$( ".stamina_tr"+spelers[i].spelerid ).progressbarTraining({
						value: spelers[i].stamina_tr / 10
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
/////////////////////////////////////////////////////////////////
// CHARTS TRAINING begin
/////////////////////////////////////////////////////////////////				
			 var chart1 = new AwesomeChart('chartTeamSkills');
			 /* chart1.title = "Worldwide browser market share: December 2010"; */
   			 chart1.chartType = "horizontal bars";
             chart1.data = [reboundtotaal,passingtotaal,interceptingtotaal,shotpowertotaal,shotprecisiontotaal, leadershiptotaal,playmakingtotaal, staminatotaal];
             chart1.labels = ['rebound','playmaking','shotpower','shotprecision','passing','stamina', 'intercepting', 'leidersvermogen'];
             chart1.colors = ['#666', '#336b80', '#df1f2e', '#945D59', '#93BBF4', '#F493B8'];
             chart1.randomColors = false;
             chart1.draw();   
/////////////////////////////////////////////////////////////////
// CHARTS TRAINING end
/////////////////////////////////////////////////////////////////							
        		
        		}
        		
  				});
		
				}


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
		   						    					 
	    					 
	    					 
	    					 }
	    					 
	    					 $('#myModal').reveal({
		        			
		        			 animation: 'fade',                   //fade, fadeAndPop, none
	    					 animationspeed: 300,                       //how fast animtions are
	    					 closeonbackgroundclick: true,              //if you click background will modal close?
	    					 dismissmodalclass: 'close-reveal-modal'    //the class of a button or element that will close an open modal
	    					 });

		        		}
	    			}
	    			}
	  				});
                

              });
	
	
	});
	
	
});
