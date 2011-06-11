$(document).ready(function(){

 $.jTwitter('playb_al',1,'geen', function(userdata){
	  //Callback functn with the user data as shown above
	  $('#twitter_nieuws').append(userdata.results[0].text);
	  
	});
  $.jTwitter('playb_al',1,'status', function(userdata){
	  //Callback functn with the user data as shown above
	  $('#twitter_status').append(userdata.results[0].text);
	  
	});
 $.jTwitter('playb_al',1,'update', function(userdata){
	  //Callback functn with the user data as shown above
	  $('#twitter_update').append(userdata.results[0].text);
	  
	});
	
	get_berichten(0);
	get_berichten(1);
	function get_berichten(status){
	
	
	$('#korfbal_berichten div').remove();
	
	if(status == 0){
		var klas = 'unread';
	
	}else{
		var klas = 'read';
	}
		var teamid = $('#team_id').val();
		$.ajax({
    			type: "POST",
    			url: "../../json/get_berichten",
    			data:  { teamid: teamid,
    					 status: status,
            			
            			
        				},
    			dataType: "json",
        		success: function(data){
        			
        			for(var i =0;i<data.length;i++){
        			
        				var content = '<p>'
        							if(status == 0){	
        								content += '<p class="markeer" id="'+data[i]['bericht_id']+'">Markeer als gelezen</p>'
        							}
        							content += '<p class="verwijder" id="'+data[i]['bericht_id']+'">Verwijder bericht</p>'
        							+ '<p class="bericht_datum">'+data[i]['datum']+' '+ data[i]['verzender']+'</p>'
        							+ '<p class="'+klas+'">'+data[i].bericht+'<p>'
        				
        							+ '</p>';
        			
        				$('#korfbal_berichten').append(content);
        			
        			}
        		
        		}
        		
        	});
	}
	
	$('.markeer').live('click', function() {
		var berichtid = $(this).attr('id');
		$.ajax({
    			type: "POST",
    			url: "../../json/update_berichten",
    			data:  { berichtid: berichtid,
            			
            			},
    			dataType: "json",
        		success: function(data){
        			if(data == true){
        			
        				get_berichten(0);
						get_berichten(1);
        			
        			}
        		}
        		
        	});	
        			
				
	});


	$('.verwijder').live('click', function() {
		var berichtid = $(this).attr('id');
		$.ajax({
    			type: "POST",
    			url: "../../json/verwijder_berichten",
    			data:  { berichtid: berichtid,
            			
            			},
    			dataType: "json",
        		success: function(data){
        			if(data == true){
        			
        				get_berichten(0);
						get_berichten(1);
        			
        			}
        		}
        		
        	});	
        			
				
	});
	
	
	
	
	

});