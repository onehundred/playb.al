<?php $username =$this->session->userdata('username');

if($username != ""){
?>
<p id="logged_in"> you are logged in as  <?php echo $this->session->userdata('username'); ?></p>
<?php }?>