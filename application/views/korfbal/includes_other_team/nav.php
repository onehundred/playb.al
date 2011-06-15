<h1 id="teamname"><?php echo $teamnaam;?></h1>

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

