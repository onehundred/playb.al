<?php foreach($financien->result() as $row)
		{?>
		
		<p>Sponsors:<?php echo $row->sponsors;?></p>
		<p>Extra's: <?php echo $row->varia;?></p>
		<p>Match revenue: <?php echo $row->wedstrijdinkomsten;?></p>
		
		
		
		<?php }?>