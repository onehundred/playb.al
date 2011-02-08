<?php

 foreach($divisie->result() as $row)
			{
				 $divisienaam = $row->divisie; 
	} ?>

<h1><?php echo $divisienaam;?></h1>

<?php foreach($divisie->result() as $row)
			{?>
				
				<p><?php echo $row->naam;?></p>
				


		<?php	}
		 
		
?>
