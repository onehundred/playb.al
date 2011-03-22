<script type="text/javascript">
        $(document).ready(function() {
            $ ('div.division_results #rij:even').addClass('even');
            $ ('div.division_results #rij:odd').addClass('odd');
        });
    </script>
    <style>
.even {
	background: #FFF;
	border-bottom: 1px solid #CCC;
}
.odd {
	background: #E5E5E5;
	border-bottom: 1px solid #CCC;
}
</style>
    <?php

 foreach($divisie->result() as $row)
			{
				 $divisienaam = $row->divisie; 
				 $subdivisie = $row->sub_divisie;
	} ?>

<div class="players">
    <h1><?php echo $divisienaam;?>.<?php echo $subdivisie;?></h1>
    <div class="division">
        <div id="team"> <a class="tooltip" title="teamnaam" href="#">team </a></div>
        <div id="played"> <a class="tooltip" title="totaal aantal matchen gespeeld" href="#">MT </a></div>
        <div id="won"><a class="tooltip" title="totaal aantal matchen gewonnen" href="#"> M </a></div>
        <div id="lost"> <a class="tooltip" title="totaal aantal matchen verloren" href="#"> M </a></div>
        <div id="draw"><a class="tooltip" title="totaal aantal matchen gelijk gespeeld" href="#"> M </a> </div>
        <div id="goalsPos"><a class="tooltip" title="totaal aantal doelpunten gescoord" href="#"> D</a></div>
        <div id="goalsNeg"><a class="tooltip" title="totaal aantal doelpunten tegen" href="#"> D </a> </div>
        <div id="goalsSal"> <a class="tooltip" title="doelpunten saldo" href="#"> DS</a> </div>
        <div id="points"> <a class="tooltip" title="totaal aantal punten" href="#"> P </a> </div>
    </div>
    <br />
    <?php foreach($divisie->result() as $row)
    
			{?>
    <div class="division_results">
        <div id="rij">
            <div id="team"> <?php echo $row->naam;?> </div>
            <div id="played"> <!-- matches totaal --> 
                <?php echo $row->gespeeld;?> </div>
            <div id="won"> <!-- matches gewonnen --> 
                <?php echo $row->gewonnen;?> </div>
            <div id="lost"> <!-- matches verloren --> 
                <?php echo $row->verloren;?> </div>
            <div id="draw"> <!-- matches gelijkspel --> 
                <?php echo $row->gelijk;?> </div>
            <div id="goalsPos"> <!-- goals gemaakt -->
                <?php $voor = $row->doelpunten_voor; echo $voor;?>
            </div>
            <div id="goalsNeg"> <!-- goals tegen -->
                <?php  $tegen = $row->doelpunten_tegen; echo $tegen;?>
            </div>
            <div id="goalsSal"> <!-- goals saldo -->
                <?php $saldo = $voor - $tegen; echo $saldo;?>
            </div>
            <div id="points"> <!-- punten totaal --> 
                <?php echo $row->divisiepunten;?> </div>
        </div>
    </div>
    <?php	}
		 
		
?>
</div>
<div class="gameRight">
    <h2>vorige match</h2><p>Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Nullam id dolor id nibh ultricies vehicula ut id elit. Cras mattis consectetur purus sit amet fermentum. Cras mattis consectetur purus sit amet fermentum. Donec ullamcorper nulla non metus auctor fringilla.</p>
    <h2>volgende match</h2><p>Vestibulum id ligula porta felis euismod semper. Donec sed odio dui. Curabitur blandit tempus porttitor. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Cras mattis consectetur purus sit amet fermentum. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</p>
</div>
