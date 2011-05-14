<?php  if($main_content == 'main_sportkeuze'){ ?>
	<?php $this->load->view('korfbal/includes/head');?>
<?php }else{?>
	<?php $this->load->view('includes/head');?>
<?php }?>
<?php $this->load->view('includes/header');?>


<?php $this->load->view($main_content);?>

<?php $this->load->view('includes/footer');?>

