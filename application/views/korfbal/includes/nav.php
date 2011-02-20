<nav class="sportnav">
<h1 id="teamname"><?php echo $teamnaam;?></h1>

<p id="test"><?php echo anchor('korfbal/korfbal_start/'.$team_id.'','Overzicht') ?></p>
<p><?php echo anchor('korfbal/korfbal_players/'.$team_id.'','Spelers') ?>	</p>
<p><?php echo anchor('korfbal/korfbal_matches/'.$team_id.'','Wedstrijden') ?>	</p>
<p><?php echo anchor('korfbal/korfbal_stadium/'.$team_id.'','Stadion') ?>	</p>	
<p><?php echo anchor('korfbal/korfbal_finances/'.$team_id.'','Financien') ?>	</p>
<p><?php echo anchor('korfbal/korfbal_manager/'.$team_id.'','Manager') ?>	</p>
<p><?php echo anchor('korfbal/korfbal_division/'.$team_id.'','Divisie') ?>	</p>
<p><?php echo anchor('korfbal/korfbal_training/'.$team_id.'','Training') ?>	</p>
<p><?php echo anchor('korfbal/korfbal_transfers/'.$team_id.'','Transfers') ?>	</p>

</nav>