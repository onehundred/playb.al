<footer>
</footer>
<!-- todo jquery CDN veranderen van microsoft naar google,  google url not live at time of implementation. -->
<script src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.5.min.js"></script>
<script src="<?php echo base_url();?>js/formToWizard.js"></script>
<script>
        $(document).ready(function(){
            $("#SignupForm").formToWizard({ submitButton: 'submit' })
        });
        
     </script>
</body>
</html>
