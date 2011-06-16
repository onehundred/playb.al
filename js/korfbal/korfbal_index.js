$(document).ready(function(){


	
	get_berichten(0);
	get_berichten(1);
	function get_berichten(status){
	
	
	$('#korfbal_berichten p').remove();
	
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
        			
        				var content = '<span>'
        						
        							content += '<p class="verwijder" id="'+data[i]['bericht_id']+'"></p>'
        							if(status == 0){	
        								content += '<p class="markeer" id="'+data[i]['bericht_id']+'"></p>'
        							}
        							content += '<p class="bericht_datum">'+data[i]['datum']+'</p>'
        							+ '<p class="'+klas+'">'+data[i].bericht+'</p>'
        				
        							+ '</span>';
        			
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