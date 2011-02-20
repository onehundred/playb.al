<?php $username =$this->session->userdata('username');

if($username != ""){
?>

<ul id="menu"><?php echo anchor('main/logout','Logout') ?></ul>
<?php }?>