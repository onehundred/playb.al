<?php $username =$this->session->userdata('username');

if($username != ""){
?>
<p id="logged_in">welcome, <?php echo $this->session->userdata('username'); ?></p>
<p><?php echo anchor('main/logout','Logout') ?></p>
<?php }?>