<script>
        $(document).ready(function(){
            $("#SignupForm").formToWizard({ submitButton: 'submit' })
            $('#SignupForm').submit(function() {
            	
            	$('#errors p').remove();
            	var teamnaam = $('#teamnaam_sign').val();
            	var stadionnaam = $('#stadionnaam_sign').val();
            	
            	$.ajax({
    					type: "POST",
    					url: "<?php echo base_url();?>index.php/sportchoice/check_teamnaam",
    					data:  { teamnaam: teamnaam,
             
            			
        						},
    					dataType: "json",
        				success: function(data){
            	
			            	if(teamnaam.length > 16 || teamnaam == '' || stadionnaam == '' || data == false){
			            		if(teamnaam.length > 16){
			            			$('#errors').append('<p>Team naam mag maximaal 16 letters bevatten</p>');
			            		}
			            		if(teamnaam == '' || teamnaam == 'Naam van je team!'){
			            			$('#errors').append('<p>geef je team een naam</p>');
			            		}
			            		if(stadionnaam == '' || stadionnaam == 'Naam van je stadion!'){
			            			$('#errors').append('<p>geef je stadion een naam</p>');
			            		}
			            		if(data == false){
			            			$('#errors').append('<p>Deze teamnaam bestaat al</p>');
			            		}
			            	}else{
			            		$.ajax({
			    					type: "POST",
			    					url: "<?php echo base_url();?>index.php/sportchoice/create_korfbalteam",
			    					data:  { teamnaam: teamnaam,
			            					 stadionnaam: stadionnaam,    
			            			
			        						},
			    					dataType: "json",
			        				success: function(data){
			        					if(data == true){
			        						window.location = "<?php echo base_url();?>index.php/sportchoice/korfbalsignup_success";
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
<legend>team naam</legend>

<?php
		$teamdata = array(
			              'name'        => 'teamnaam',
			              'id'          => 'teamnaam_sign',
			              'value'       => '',
			          	);
		echo form_input($teamdata);
		
		
?></fieldset>
<fieldset>
<legend>stadion naam</legend>
<?php		
		$stadiondata = array(
			              'name'        => 'stadionnaam',
			              'id'          => 'stadionnaam_sign',
			              'value'       => '',
			          	);
		echo form_input($stadiondata);
		echo form_submit('submit', 'team maken');
		?>
		<p id="errors"></p>
</fieldset>
</form>
</div>