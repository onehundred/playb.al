<script src="<?php echo base_url();?>js/korfbal/financien.js"></script>
<?php foreach($financien->result() as $row)
		{	
			$totaal = $row->totaal;
			$sponsors = $row->sponsors;
			$wedstrijd = $row->wedstrijdinkomsten;
			$gek_spelers = $row->gekochte_spelers;
			$ver_spelers = $row->verkochte_spelers;
			$spelersloon = $row->spelersloon;
			$stadion = $row->stadion;
			
						
			$inkomsten = $sponsors + $wedstrijd + $ver_spelers;
			$uitgaven = $spelersloon + $stadion + $gek_spelers;
			$uitkomst = $inkomsten - $uitgaven;
	 }?>
<?php foreach($financien_vorige->result() as $rij)
{
			$totaal_vorige = $rij->totaal;
			$sponsors_vorige = $rij->sponsors;
			$wedstrijd_vorige = $rij->wedstrijdinkomsten;
			$gek_spelers_vorige = $rij->gekochte_spelers;
			$ver_spelers_vorige = $rij->verkochte_spelers;
			$spelersloon_vorige = $rij->spelersloon;
			$stadion_vorige = $rij->stadion;

}?>

<div class="game">
    <div class="gameRight">
        <p>Kapitaal: <?php echo $totaal;?> &euro; (<?php echo $totaal + $uitkomst;?>)&euro;</p>
        <br/>
        <!-- uitgaven -->
        <h2>Deze week</h2>
        <div id="uitgaven" style="float:right; margin-right:100px; width:200px;">
            <h3>Uitgaven</h3>
            <p>Spelersloon: <?php echo $spelersloon;?></p>
            <p>Stadionwerken: <?php echo $stadion;?></p>
            <p>Gekochte spelers: <?php echo $gek_spelers;?></p>
            <hr/>
            <p>Totale uitgaven: <?php echo $uitgaven;?></p>
        </div>
        <!--inkomsten -->
        <div id="inkomsten" style="width:200px;">
            <h3>Inkomsten</h3>
            <p>Sponsors: <?php echo $sponsors;?></p>
            <p>Wedstrijdinkomsten: <?php echo $wedstrijd;?></p>
            <p>Verkochte spelers: <?php echo $ver_spelers;?></p>
            <hr/>
            <p>Totale inkomsten:
                <?php  echo $inkomsten;?>
            </p>
        </div>
        <br/>
        <p>Winst/Verlies: <?php echo $uitkomst;?></p>
        <br/>
        <br/>
        <?php if(isset($sponsors_vorige)){?>
        <h2>Vorige week</h2>
        <div id="uitgaven" style="float:right; margin-right:100px; width:200px;">
            <h3>Uitgaven</h3>
            <p>Spelersloon: <?php echo $spelersloon_vorige;?></p>
            <p>Stadionwerken: <?php echo $stadion_vorige;?></p>
            <p>Gekochte spelers: <?php echo $gek_spelers_vorige;?></p>
            <hr/>
            <p>Totale uitgaven:
                <?php  $uitgaven_vorige = $spelersloon_vorige + $stadion_vorige + $gek_spelers_vorige; echo $uitgaven_vorige;?>
            </p>
        </div>
        <!--inkomsten -->
        <div id="inkomsten" style="width:200px;">
            <h3>Inkomsten</h3>
            <p>Sponsors: <?php echo $sponsors_vorige;?></p>
            <p>Wedstrijdinkomsten: <?php echo $wedstrijd_vorige;?></p>
            <p>Verkochte spelers: <?php echo $ver_spelers_vorige;?></p>
            <hr/>
            <p>Totale inkomsten:
                <?php $inkomsten_vorige = $sponsors_vorige + $wedstrijd_vorige + $ver_spelers_vorige; echo $inkomsten_vorige;?>
            </p>
        </div>
        <br/>
        <p>Winst/Verlies: <?php echo $inkomsten_vorige - $uitgaven_vorige;?></p>
        <?php } ?>
    </div>
    <!-- end gameRight -->
    <aside>
        <div class="gameLeft">
        
    
        
            <div id="sponsors" class="fillLeft">	
            <section>
            <figure class="icon" id="gameSponsors"></figure>

                <h2>Sponsors</h2>
                </section>		
            </div>
           <!--
 <div id="grafiek"> 
            <section>
             <figure class="icon" id="gameBank"></figure>
                <h2>Overzicht financien</h2>

                <canvas id="canvas1" width="350" height="350"> uw browser ondersteunt geen canvas. </canvas>

                </section>
            </div> <!-- end grafiek -->
            
        </div>
        <input type="hidden" id="teamid" value="<?php echo $this->uri->segment('3');?>">
        <div id="sponsormodal" class="reveal-modal">
            <div id="loading">
                <img src="<?php echo base_url()?>/img/loading.gif"/>
            </div> <!-- end loading -->
            <a class="close-reveal-modal">&#215;</a> </div>
        <!-- end gameLeft --> 
    </aside>
</div>
<!-- end game -->
