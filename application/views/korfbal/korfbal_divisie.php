<script type="text/javascript">
        $(document).ready(function() {
            $ ('div.division_results #rij:even').addClass('even');
            $ ('div.division_results #rij:odd').addClass('odd');
        });
    </script>
<style>
.even {
	background-color: #FFFFFF;
	background-color: rgba(255,255,255,0.5);
	border-bottom: 1px solid #CCCCCC;
}
.odd {
	background-color: #E5E5E5;
		background-color: rgba(229,229,229,0.5);
	border-bottom: 1px solid #CCCCCC;
}
</style>
<?php

 foreach($divisie->result() as $row)
			{
				 $divisienaam = $row->divisie; 
				 $subdivisie = $row->sub_divisie;
	} ?>

<div class="gameRight">
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
<div class="gameLeft">
    <div>
        <section>
           <h2><img src="<?php echo base_url();?>img/icons/calendar.png" id="icon" ondragstart="return false" />kalender</h2>
                <p>huidige week: week <?php echo $calendar['week'];?></p>
                <p>huidige seizoen: seizoen <?php echo $calendar['seizoen'];?></p>
                <p>eerstvolgende wedstrijd: <?php echo $calendar['thuisteam']['teamnaam'];?> - <?php echo $calendar['uitteam']['teamnaam'];?></p>

        </section>
    </div>
    <div>
        <section>
            <h2>vorige matchen</h2>
            <?php if(isset($vorige_matchen[1]['thuis'])){?>
            <table>
                <tr>
                    <td><?php echo $vorige_matchen[1]['thuis']; ?></td>
                    <td>vs</td>
                    <td><?php echo $vorige_matchen[1]['uit']; ?></td>
                    <td><?php echo $vorige_matchen[1]['uitslag']; ?></td>
                </tr>
                <tr>
                    <td><?php echo $vorige_matchen[2]['thuis']; ?></td>
                    <td>vs</td>
                    <td><?php echo $vorige_matchen[2]['uit']; ?></td>
                    <td><?php echo $vorige_matchen[2]['uitslag']; ?></td>
                </tr>
                <tr>
                    <td><?php echo $vorige_matchen[3]['thuis']; ?></td>
                    <td>vs</td>
                    <td><?php echo $vorige_matchen[3]['uit']; ?></td>
                    <td><?php echo $vorige_matchen[3]['uitslag']; ?></td>
                </tr>
                <tr>
                    <td><?php echo $vorige_matchen[4]['thuis']; ?></td>
                    <td>vs</td>
                    <td><?php echo $vorige_matchen[4]['uit']; ?></td>
                    <td><?php echo $vorige_matchen[4]['uitslag']; ?></td>
                </tr>
            </table>
            <?php } ?>
        </section>
    </div>
    <div>
        <section>
            <h2>volgende matchen</h2>
             <table>
                <tr>
                    <td><?php echo $volgende_matchen[1]['thuis']; ?></td>
                    <td>vs</td>
                    <td><?php echo $volgende_matchen[1]['uit']; ?></td>
                </tr>
                <tr>
                    <td><?php echo $volgende_matchen[2]['thuis']; ?></td>
                    <td>vs</td>
                    <td><?php echo $volgende_matchen[2]['uit']; ?></td>

                </tr>
                <tr>
                    <td><?php echo $volgende_matchen[3]['thuis']; ?></td>
                    <td>vs</td>
                    <td><?php echo $volgende_matchen[3]['uit']; ?></td>

                </tr>
                <tr>
                    <td><?php echo $volgende_matchen[4]['thuis']; ?></td>
                    <td>vs</td>
                    <td><?php echo $volgende_matchen[4]['uit']; ?></td>
                </tr>
            </table>

        </section>
    </div>
</div>
