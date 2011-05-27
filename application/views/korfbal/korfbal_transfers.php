<div class="gameRight">
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
<div class="gameLeft">
    <div><section>
       <h2><img src="<?php echo base_url();?>img/icons/calendar.png" id="icon" ondragstart="return false" />kalender</h2>
                <p>huidige week: week <?php echo $calendar['week'];?></p>
                <p>huidige seizoen: seizoen <?php echo $calendar['seizoen'];?></p>
                <p>eerstvolgende wedstrijd: <?php echo $calendar['thuisteam']['teamnaam'];?> - <?php echo $calendar['uitteam']['teamnaam'];?></p>
</section>    </div>
</div>
