<script>
        $(document).ready(function(){
            $("#SignupForm").formToWizard({ submitButton: 'submit' })
            $('#SignupForm').submit(function() {
            	
            	$('#errors p').remove();
            	var teamnaam = $('#teamnaam_sign').val();
            	var stadionnaam = $('#stadionnaam_sign').val();
            	
            	$.ajax({
    					type: "POST",
    					url: "../../index.php/sportchoice/check_teamnaam",
    					data:  { teamnaam: teamnaam,
             
            			
        						},
    					dataType: "json",
        				success: function(data){
            	
			            	if(teamnaam.length > 16 || teamnaam == '' || stadionnaam == '' || data == false){
			            		if(teamnaam.length > 16){
			            			$('#errors').append('<p>Team naam mag maximaal 16 letters bevatten</p>');
			            		}
			            		if(teamnaam == '' || teamnaam == 'Naam van je team!'){
			            			$('#errors').append('<p>Vul aub een teamnaam in</p>');
			            		}
			            		if(stadionnaam == '' || stadionnaam == 'Naam van je stadion!'){
			            			$('#errors').append('<p>Vul aub een stadionnaam in</p>');
			            		}
			            		if(data == false){
			            			$('#errors').append('<p>Deze teamnaam bestaat al</p>');
			            		}
			            	}else{
			            		$.ajax({
			    					type: "POST",
			    					url: "../../index.php/sportchoice/create_korfbalteam",
			    					data:  { teamnaam: teamnaam,
			            					 stadionnaam: stadionnaam,    
			            			
			        						},
			    					dataType: "json",
			        				success: function(data){
			        					if(data == true){
			        						window.location = "../../index.php/sportchoice/korfbalsignup_success";
			        					}	
			        				}
			        				
			        			});	
			            	
			            	
			            	}
            	
            }
            });	
            	
            	return false;
            });
            
            
            
        });    
</script>
<div id="korfbal_signup">
<form id="SignupForm" method="post" action="#">
<fieldset>
<legend>Team name</legend>

<?php
		$teamdata = array(
			              'name'        => 'teamnaam',
			              'id'          => 'teamnaam_sign',
			              'value'       => 'Naam van je team!',
			          	);
		echo form_input($teamdata);
		
		
?></fieldset>
<fieldset>
<legend>Arena name</legend>
<?php		
		$stadiondata = array(
			              'name'        => 'stadionnaam',
			              'id'          => 'stadionnaam_sign',
			              'value'       => 'Naam van je stadion!',
			          	);
		echo form_input($stadiondata);
		echo form_submit('submit', 'Create team');
		?>
		<p id="errors"></p>
</fieldset>
</form>
</div>