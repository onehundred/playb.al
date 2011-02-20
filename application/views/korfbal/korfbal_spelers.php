<div>
<!-- <h1>Players</h1> -->

<?php 
foreach($spelers->result() as $row)
		{?>
		 <p>Name: <a href="../korfbal_player/<?php echo $team_id;?>/<?php echo $row->speler_id;?>"><?php echo $row->voornaam;?>&nbsp;<?php echo $row->achternaam; ?></a></p>
		 <p>Age:<?php echo $row->leeftijd; ?></p>
		 <p>Sex: <?php echo $row->geslacht; ?></p>
		 <p>Rebound: <?php echo $row->rebound; ?>/20</p>
		 <p>Passing: <?php echo $row->passing; ?>/20</p>
		 <p>Stamina: <?php echo $row->stamina; ?>/20</p>
		 <p>Shotpower: <?php echo $row->shotpower; ?>/20</p>
		 <p>Shotprecision: <?php echo $row->shotprecision; ?>/20</p>
		 <p>Playmaking: <?php echo $row->playmaking; ?>/20</p>
		 <p>Intercepting: <?php echo $row->intercepting; ?>/20</p>
		 <p>Leadership: <?php echo $row->leadership; ?>/20</p><br/>
		 		</div>
		<hr/>
		<?php }
?>


</div>

