<script src="<?php echo base_url();?>/js/korfbal/korfbal_index.js"> </script>
<div class="gameWrap">
<div class="game">
    <aside>
        <div class="gameLeft" id="gameLeftOverview">
            <section class="column">
            <?php if(!isset($alien)){ ?>
                <div class="fillLeft" id="korfbal_berichten">
                    <section>
                        <figure class="icon" id="gameMessage"></figure>
                        <h2> berichten</h2>
                    </section>
                </div>
             <?php } ?>   
                <div class="fillLeft">
                    <section>
                        <figure class="icon" id="gameCalendar"></figure>
                        <h2> kalender</h2>
                        
                        <p class="entry">week <?php echo $calendar['week'];?> - seizoen <?php echo $calendar['seizoen'];?></p>
                        <p class="entry">volgende wedstrijd: <br /><?php echo $calendar['thuisteam']['teamnaam'];?> - <?php echo $calendar['uitteam']['teamnaam'];?></p>
                    </section>
                </div>
            </section>
            <!-- end column -->
            <section class="column">
                <div class="fillLeft">
                    <section>
                        <figure class="icon" id="gameTweets"></figure>
                        <h2> nieuws</h2>
                        <p class="tweet" id="twitter_nieuws"></p>
                        <!-- tweets van @playb_al zonder mentions --> 
                        
                    </section>
                </div>
                <div class="fillLeft">
                    <section>
                        <figure class="icon" id="gameTweets"></figure>
                        <h2> status</h2>
                        <p class="tweet" id="twitter_status"></p>
                        
                        <!-- tweets van @playb_al met #status --> 
                    </section>
                </div>
                <div class="fillLeft">
                    <section>
                        <figure class="icon" id="gameTweets"></figure>
                        <h2> updates</h2>
                        <p class="tweet" id="twitter_update"></p>
                        <!-- tweets van @playb_al met #update --> 
                        
                    </section>
                </div>
                <?php foreach($divisie->result() as $test){
                	$divisie_id = $test->divisie_id;
                
                }?>
                <?php if($divisie_id != 1){ ?>
                <div class="fillLeft">
                    <section>
                        <figure class="icon" id="gameRanking"></figure>
                        <h2> klassement eerste divisie</h2>
                        <?php 
                        $i =1;
                        foreach($divisie_eerste->result() as $row){ ?>
                           <div id="klassementEntry">  <p id="klassementTeamnaam"><?php echo $i.' '.$row->naam;?><span id="klassementPunten"><?php echo $row->divisiepunten;?></div>
                        <?php
                        	$i++;
                         } ?>
                    </section>
                </div>
                <?php } ?>
                <?php if(!isset($alien)){ ?>
                <div class="fillLeft">
                    <section>
                        <figure class="icon" id="gameRanking"></figure>
                        <h2>klassement jouw divisie</h2>
                        <?php
                         $i=1;
                         foreach($divisie->result() as $row){ ?>
                      <div id="klassementEntry">  <p id="klassementTeamnaam"><?php echo $i.' '.$row->naam;?><span id="klassementPunten"><?php echo $row->divisiepunten;?></div>
                        <?php
                        	$i++;
                         } ?>
                    </section>
                </div>
                <?php } ?>
            </section>
            <!-- end column -->
            <section class="column">
                <div class="fillLeft">
                    <section>
                        <figure class="icon" id="gameCup"></figure>
                        <h2> laatste award</h2>
                        <?php if(isset($stats['award'])){ ?>
                        	<img id="cup" ondragstart="return false" src="<?php echo base_url();?>img/awards/cup_gold.png" />
                        	<p><?php echo $stats['award'];?></p>
                        <?php }else{ ?>
                      	  <p class="entry">je hebt nog geen award behaald.</p>
                        <?php } ?>
                    </section>
                </div>
                <div class="fillLeft">
                    <section>
                        <figure class="icon" id="gameMedaille"></figure>
                        <h2> laatste achievement</h2>
                            <?php if(isset($stats['achievement']['naam'])){ ?>
                        		<p><?php echo $stats['achievement']['naam'];?></p>
                        		<img id="achievementBadge" ondragstart="return false" src="<?php echo base_url();?>img/achievements/<?php echo $stats['achievement']['afbeelding'];?>"/>
                        		<p><?php echo $stats['achievement']['punten'];?> punten</p>
                        <?php }else{ ?>
                      	  <p>je hebt nog geen achievement behaald.</p>
                        <?php } ?>
                    </section>
                </div>
                <div class="fillLeft">
                    <section>
                        <figure class="icon" id="gamePlayerBought"></figure>
                        <h2> laatste speler gekocht</h2>
                         <?php if(isset($stats['gekocht']['voornaam'])){ ?>
                        	<p><?php echo $stats['gekocht']['voornaam'].' '.$stats['gekocht']['achternaam'];?></p>
                        <?php }else{ ?>
                      	  <p class="entry">nog geen speler gekocht.</p>
                        <?php } ?>
                    </section>
                </div>
                <div class="fillLeft">
                    <section>
                        <figure class="icon" id="gamePlayerSold"></figure>
                        <h2> laatste speler verkocht</h2>
                        <?php if(isset($stats['verkocht']['voornaam'])){ ?>
                        	<p><?php echo $stats['verkocht']['voornaam'].' '.$stats['gekocht']['achternaam'];?></p>
                        <?php }else{ ?>
                      	  <p class="entry">nog geen speler verkocht.</p>
                        <?php } ?>
                    </section>
                </div>
            </section>
            <!-- end column --> 
        </div>
        <!-- end gameLeft --> 
    </aside>
</div> <!-- end game -->
</div> <!-- end gameWrap -->
<input type="hidden" id="team_id" value="<?php echo $this->uri->segment('3');?>"/>
