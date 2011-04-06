<div class="players"><?php
//gegevens van users en teams kan hieruit gehaald worden
 foreach($manager->result() as $row)
		{ ?>
			<p>Manager: <?php echo $row->gebruikersnaam;?> </p>
			<p>Team: <?php echo $row->naam;?></p>
			<p>	Country: <?php echo $row->land; ?></p>
		
		
   <?php }?>
   </div><div class="gameRight">
   <h2>achievements</h2>
   <?php foreach($achievements->result() as $row){ ?>
   		<?php echo $row->naam;?> &nbsp; Punten: <?php echo $row->punten;?><br/>
   
  <?php } ?>
      <h2>bekers</h2>
      <h2>banksaldo</h2>
   </div>