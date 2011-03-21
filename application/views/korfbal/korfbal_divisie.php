<?php

 foreach($divisie->result() as $row)
			{
				 $divisienaam = $row->divisie; 
				 $subdivisie = $row->sub_divisie;
	} ?>
<div class="players">
<h1><?php echo $divisienaam;?>.<?php echo $subdivisie;?></h1>
<div class="division">
<div id="team">
team
</div>
<div id="played">
MT

</div>
<div id="won">
M
</div>
<div id="lost">
M
</div>
<div id="draw">
M
</div>
<div id="goalsPos">
D
</div>
<div id="goalsNeg">
D
</div>
<div id="goalsSal">
DS
</div>
<div id="points">
P
</div>
</div>
<br />

<?php foreach($divisie->result() as $row)
			{?>
<div class="division">
<div id="team">
<?php echo $row->naam;?>
</div>
<div id="played"> <!-- matches totaal -->
<?php echo $row->gespeeld;?>
</div>
<div id="won"> <!-- matches gewonnen -->
<?php echo $row->gewonnen;?>
</div>
<div id="lost"> <!-- matches verloren -->
<?php echo $row->verloren;?>
</div>
<div id="draw"> <!-- matches gelijkspel -->
<?php echo $row->gelijk;?>
</div>
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
<?php echo $row->divisiepunten;?>
</div></div>
		<?php	}
		 
		
?>
</div>

<div class="gameRight">test</div>