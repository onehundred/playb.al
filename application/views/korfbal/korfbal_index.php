<script src="<?php echo base_url();?>/js/korfbal/korfbal_index.js"> </script>

<div class="game">
    <aside>
        <div class="gameLeft" id="gameLeftOverview">
            <section class="column">
                <div id="korfbal_berichten">
                    <section>
                        <figure class="icon" id="gameMessage"></figure>
                        <h2> berichten</h2>
                    </section>
                </div>
                <div>
                    <section>
                        <figure class="icon" id="gameCalendar"></figure>
                        <h2> kalender</h2>
                        <p>huidige week: week <?php echo $calendar['week'];?></p>
                        <p>huidige seizoen: seizoen <?php echo $calendar['seizoen'];?></p>
                        <p>eerstvolgende wedstrijd: <?php echo $calendar['thuisteam']['teamnaam'];?> - <?php echo $calendar['uitteam']['teamnaam'];?></p>
                    </section>
                </div>
            </section>
            <!-- end column -->
            <section class="column">
                <div>
                    <section>
                        <figure class="icon" id="gameTweets"></figure>
                        <h2> nieuws</h2>
                        <p id="twitter_nieuws"></p>
                        <!-- tweets van @playb_al zonder mentions --> 
                        
                    </section>
                </div>
                <div>
                    <section>
                        <figure class="icon" id="gameTweets"></figure>
                        <h2> status</h2>
                        <p id="twitter_status"></p>
                        
                        <!-- tweets van @playb_al met #status --> 
                    </section>
                </div>
                <div>
                    <section>
                        <figure class="icon" id="gameTweets"></figure>
                        <h2> updates</h2>
                        <p id="twitter_update"></p>
                        <!-- tweets van @playb_al met #update --> 
                        
                    </section>
                </div>
                <?php foreach($divisie->result() as $test){
                	$divisie_id = $test->divisie_id;
                
                }?>
                <?php if($divisie_id != 1){ ?>
                <div>
                    <section>
                        <figure class="icon" id="gameRanking"></figure>
                        <h2> klassement eerste divisie</h2>
                        <?php 
                        $i =1;
                        foreach($divisie_eerste->result() as $row){ ?>
                        <p><?php echo $i.' '. $row->naam;?> - <?php echo $row->divisiepunten;?></p>
                        <?php
                        	$i++;
                         } ?>
                    </section>
                </div>
                <?php } ?>
                <div>
                    <section>
                        <figure class="icon" id="gameRanking"></figure>
                        <h2>klassement jouw divisie</h2>
                        <?php
                         $i=1;
                         foreach($divisie->result() as $row){ ?>
                        <p><?php echo $i.' '.$row->naam;?> - <?php echo $row->divisiepunten;?></p>
                        <?php
                        	$i++;
                         } ?>
                    </section>
                </div>
            </section>
            <!-- end column -->
            <section class="column">
                <div>
                    <section>
                        <figure class="icon" id="gameCup"></figure>
                        <h2> laatste award</h2>
                        <p>Donec ullamcorper nulla non metus auctor fringilla. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</p>
                    </section>
                </div>
                <div>
                    <section>
                        <figure class="icon" id="gameMedaille"></figure>
                        <h2> laatste achievement</h2>
                        <p>Donec ullamcorper nulla non metus auctor fringilla. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</p>
                    </section>
                </div>
                <div>
                    <section>
                        <figure class="icon" id="gamePlayerBought"></figure>
                        <h2> laatste speler gekocht</h2>
                        <p>Nullam id dolor id nibh ultricies vehicula ut id elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet.</p>
                    </section>
                </div>
                <div>
                    <section>
                        <figure class="icon" id="gamePlayerSold"></figure>
                        <h2> laatste speler verkocht</h2>
                        <p>Curabitur blandit tempus porttitor. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    </section>
                </div>
            </section>
            <!-- end column --> 
        </div>
        <!-- end gameLeft --> 
    </aside>
</div>
<input type="hidden" id="team_id" value="<?php echo $this->uri->segment('3');?>"/>
<!-- end game -->