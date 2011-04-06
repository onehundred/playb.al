<div class="players"><?php
//gegevens van users en teams kan hieruit gehaald worden
 foreach($manager->result() as $row)
		{ ?>
			<p>Manager: <?php echo $row->gebruikersnaam;?> </p>
			<p>Team: <?php echo $row->naam;?></p>
			<p>	Country: <?php echo $row->land; ?></p>
		
		
   <?php }?>
   </div><div class="gameRight">
    
	  
      <h2>bekers</h2>
      <h2>banksaldo</h2>
       <h2>achievements</h2>
   <?php foreach($achievements->result() as $row){ ?>
   
   	<div style="float:left; margin:20px;">
   		<p><?php echo $row->naam;?></p> 
   		<p><img style="width:50px; heigth: 50px;" src="<?php echo base_url()?>/img/achievements/<?php echo $row->afbeelding;?>"/></p>
   		<p><?php echo $row->punten;?> punten</p>
   	</div>
   	
  <?php } ?>

   </div>