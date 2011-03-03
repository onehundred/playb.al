<div class="players"><?php
//gegevens van users en teams kan hieruit gehaald worden
 foreach($manager->result() as $row)
		{ ?>
			<p>Manager: <?php echo $row->gebruikersnaam;?> </p>
			<p>Team: <?php echo $row->naam;?></p>
			<p>	Country: <?php echo $row->land; ?></p>
		
		
   <?php }?>
   </div><div class="gameRight">test</div>