$(function() {
	init();
	function init(){
				var teamid = $('#teamid').val();
				$('#chartTeamSkills').empty();
				//alert(teamid);
				$.ajax({
    			type: "POST",
    			url: "http://playb.al/index.php/json/korfbal_jsonPlayers",
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
	        		$( ".rebound"+spelers[i].spelerid).progressbarSkill({
					value: spelers[i].rebound * 5
					});
					$( ".passing"+spelers[i].spelerid ).progressbarSkill({
						value: spelers[i].passing * 5
					});
					$( ".intercepting"+spelers[i].spelerid ).progressbarSkill({
						value: spelers[i].intercepting * 5
					});
					$( ".shotpower"+spelers[i].spelerid).progressbarSkill({
						value: spelers[i].shotpower * 5
					});
					$( ".shotprecision"+spelers[i].spelerid).progressbarSkill({
						value: spelers[i].shotprecision * 5
					});
					$( ".leadership"+spelers[i].spelerid ).progressbarSkill({
						value: spelers[i].leadership * 5
					});
					$( ".playmaking"+spelers[i].spelerid ).progressbarSkill({
						value: spelers[i].playmaking * 5
					});
					$( ".stamina"+spelers[i].spelerid ).progressbarSkill({
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

				}
  
			
        		
        		}
        		
        	});	
  		}
		
});				
							
			
