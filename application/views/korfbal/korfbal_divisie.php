<?php

 foreach($divisie->result() as $row)
			{
				 $divisienaam = $row->divisie; 
	} ?>

<h1><?php echo $divisienaam;?></h1>
	<table>
					<tr>
						<td>Team</td>
						<td>Gespeeld</td>
						<td>Gewonnen</td>
						<td>Verloren</td>
						<td>Gelijk</td>
						<td>Doelpunten voor</td>
						<td>Doelpunten tegen</td>
						<td>Doelpunten saldo</td>
						<td>Punten</td>
					</tr>

<?php foreach($divisie->result() as $row)
			{?>
				
				
			<tr>
				<td><?php echo $row->naam;?></td>
				<td><?php echo $row->gespeeld;?></td>
				<td><?php echo $row->gewonnen;?></td>
				<td><?php echo $row->verloren;?></td>
				<td><?php echo $row->gelijk;?></td>
				<td><?php $voor = $row->doelpunten_voor;
				echo $voor;?></td>
				<td><?php  $tegen = $row->doelpunten_tegen;
					echo $tegen;?></td>
				<td><?php $saldo = $voor - $tegen;
					echo $saldo;?> </td>
				<td><?php echo $row->divisiepunten;?></td>
			</tr>
				
				


		<?php	}
		 
		
?>
</table>
