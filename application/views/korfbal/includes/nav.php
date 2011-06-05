<h1 id="teamname"><?php echo $teamnaam;?></h1>
 <style type="text/css">
    .keynav_box {
      height: 30px;
      width: 30px;
      position: absolute;
      background-color: green;
      border: 1px solid black;
    }
    .keynav_focusbox {
      height: 30px;
      width: 30px;
      position: absolute;
      background-color: red;
      border: 1px solid black;
    }
</style>
    <div id="demo1" style="position: relative; height: 50px; width: 100%;">
        <div class='keynav_box' style='top: 0px;left: 0px'><a href="http://google.be">google</a></div>
        <div class='keynav_box' style='top: 0px;left: 50px'><a href="http://scarlenn.be">scarlenn</a></div>
        <div class='keynav_box' style='top: 0px;left: 100px'>0:2</div>
        <div class='keynav_box' style='top: 0px;left: 150px'>0:3</div>
        <div class='keynav_box' style='top: 0px;left: 200px'>0:4</div>
        <div class='keynav_box' style='top: 0px;left: 250px'>0:5</div>
        <div class='keynav_box' style='top: 0px;left: 300px'>0:6</div>
        <div class='keynav_box' style='top: 0px;left: 350px'>0:7</div>
        <div class='keynav_box' style='top: 0px;left: 400px'>0:8</div>
    </div>

    <script type="text/javascript">
  $(document).ready(function() {
    // Initialize jQuery keyboard navigation
    $('#demo1 div').keynav('keynav_focusbox','keynav_box');

    // Set the first div as the one with focus, this is optional
    $('#demo1 div:first').removeClass().addClass('keynav_focusbox');

  });
</script> 

<section class="sportnavWrap">
<nav class="sportnav">
    <p id="overzichtMenu"><?php echo anchor('korfbal/korfbal_start/'.$team_id.'','Overzicht') ?></p>
    <p id="trainingMenu"><?php echo anchor('korfbal/korfbal_training/'.$team_id.'','team') ?></p>
    <!-- <p id="spelersMenu"><?php echo anchor('korfbal/korfbal_players/'.$team_id.'','Spelers') ?> </p> -->
    <p id="wedstrijdenMenu"><?php echo anchor('korfbal/korfbal_matches/'.$team_id.'','Wedstrijden') ?></p>
    <p id="divisieMenu"><?php echo anchor('korfbal/korfbal_division/'.$team_id.'','Divisie') ?></p>
    <p id="stadionMenu"><?php echo anchor('korfbal/korfbal_stadium/'.$team_id.'','Stadion') ?></p>
    <p id="managerMenu"><?php echo anchor('korfbal/korfbal_manager/'.$team_id.'','Manager') ?></p>
    <p id="financienMenu"><?php echo anchor('korfbal/korfbal_finances/'.$team_id.'','Financien') ?></p>
    <p id="transfersMenu"><?php echo anchor('korfbal/korfbal_transfers/'.$team_id.'','Transfers') ?></p>
</nav>
</section>
</div> <!-- end headerWrap -->
