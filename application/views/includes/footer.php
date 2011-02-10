<!--todo microsoft cdn veranderen naar google cdn (url niet live op moment van productie)-->
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.5.min.js"></script>
<script src="<?php echo base_url();?>js/formToWizard.js"></script>
<script>
        $(document).ready(function(){
            $("#SignupForm").formToWizard({ submitButton: 'submit' })
        });    
</script>
<script>
$("#showLogin").hover(function() { 
			$('#showLogin').hide();
			$('#login').slideDown(200);
			
			});

</script>
</div> <!-- end main -->
</div> <!-- end wrap -->
<footer>
    
</footer>
</body>
</html>