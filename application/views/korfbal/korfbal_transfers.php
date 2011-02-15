<div>

<?php foreach($transfers->result() as $row)
{ ?>
	<p><?php echo $row->voornaam;?>&nbsp;<?php echo $row->achternaam;?></p>
	<p>Deadline: <?php echo $row->deadline;?></p>
	<?php $huidig = $row->huidig_bod;
	if($huidig == null){
	
		echo "<p>er is nog geen bod geplaatst op deze speler</p>";
		echo anchor('korfbal/korfbal_player/'.$team_id.'/'.$row->speler_id,'Plaats een bod');
	} 
	else{
	
		 echo "<p>Huidig bod:".$row->huidig_bod." "."door"." ".$row->naam."</p>";
		 echo anchor('korfbal/korfbal_player/'.$team_id.'/'.$row->speler_id,'Plaats een bod');
	}
	
	
	?>
	<hr/>

<?php } 



 ?>



</div>