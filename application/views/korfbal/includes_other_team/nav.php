<h1 id="teamname">
	<div id="backHome"><a href="<?php echo base_url();?>index.php/korfbal/korfbal_start/<?php echo $session_teamid;?>"><img src="<?php echo base_url();?>img/icons/home.png" /></a>
	</div>
<?php echo $teamnaam;?></h1>

<section class="sportnavWrap">
<nav class="sportnav">
    <p id="overzichtMenu"><?php echo anchor('korfbal_other_team/korfbal_overview/'.$team_id.'','Overzicht') ?></p>
    <p id="trainingMenu"><?php echo anchor('korfbal_other_team/korfbal_team/'.$team_id.'','team') ?></p>
    <!-- <p id="spelersMenu"><?php echo anchor('korfbal_other_team/korfbal_players/'.$team_id.'','Spelers') ?> </p> -->
    <p id="wedstrijdenMenu"><?php echo anchor('korfbal_other_team/korfbal_matches/'.$team_id.'','Wedstrijden') ?></p>
    <p id="divisieMenu"><?php echo anchor('korfbal_other_team/korfbal_division/'.$team_id.'','Divisie') ?></p>
    <p id="stadionMenu"><?php echo anchor('korfbal_other_team/korfbal_stadium/'.$team_id.'','Stadion') ?></p>
    <p id="managerMenu"><?php echo anchor('korfbal_other_team/korfbal_manager/'.$team_id.'','Manager') ?></p>

</nav>
</section>

