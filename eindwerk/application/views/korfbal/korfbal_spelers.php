<div>
<h1>Players</h1>

<?php 
foreach($spelers->result() as $row)
		{?>
		 <p>First name: <?php echo $row->voornaam;?></p>
		 <p>Last name: <?php echo $row->achternaam; ?></p>
		 <p>Age:<?php echo $row->leeftijd; ?></p>
		 <p>Sex: <?php echo $row->geslacht; ?></p>
		 <p>Experience: <?php echo $row->ervaring; ?></p>
		
		<hr/>
		<?php }
?>


</div>