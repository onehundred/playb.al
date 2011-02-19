<?php $username =$this->session->userdata('username');

if($username != ""){
?>

<p><?php echo anchor('main/logout','Logout') ?></p>
<?php }?>