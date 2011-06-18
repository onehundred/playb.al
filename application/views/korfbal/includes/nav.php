<h1 id="teamname"><div id="backHome"><img src="<?php echo base_url(); ?>img/icons/home.png" /></div><?php echo $teamnaam;?></h1>

<section class="sportnavWrap">
<nav class="sportnav">
    <p id="overzichtMenu"><?php echo anchor('korfbal/korfbal_start/'.$team_id.'','Overzicht') ?></p>
    <p id="trainingMenu"><?php echo anchor('korfbal/korfbal_team/'.$team_id.'','team') ?></p>
    <!-- <p id="spelersMenu"><?php echo anchor('korfbal/korfbal_players/'.$team_id.'','Spelers') ?> </p> -->
    <p id="wedstrijdenMenu"><?php echo anchor('korfbal/korfbal_matches/'.$team_id.'','Wedstrijden') ?></p>
    <p id="divisieMenu"><?php echo anchor('korfbal/korfbal_division/'.$team_id.'','Divisie') ?></p>
    <p id="stadionMenu"><?php echo anchor('korfbal/korfbal_stadium/'.$team_id.'','Stadion') ?></p>
    <p id="managerMenu"><?php echo anchor('korfbal/korfbal_manager/'.$team_id.'','Manager') ?></p>
    <p id="financienMenu"><?php echo anchor('korfbal/korfbal_finances/'.$team_id.'','Financien') ?></p>
    <p id="transfersMenu"><?php echo anchor('korfbal/korfbal_transfers/'.$team_id.'','Transfers') ?></p>
</nav>
</section>

