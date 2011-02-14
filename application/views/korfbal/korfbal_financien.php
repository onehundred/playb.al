<?php foreach($financien->result() as $row)
		{?>
		
		<p>Sponsors:<?php echo $row->sponsors;?></p>
		<p>Extra's: <?php echo $row->varia;?></p>
		<p>Wedstrijdinkomsten: <?php echo $row->wedstrijdinkomsten;?></p>
		
		
		<p>Totaal: <?php echo $row->totaal;?></p>
		
		
		
		<?php }?>