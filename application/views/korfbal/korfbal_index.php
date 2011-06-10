
<div class="game">
    <aside>
        <div class="gameLeft" id="gameLeftOverview">
        <section class="column">
            <div>
                <section>
                    <h2>
                        <img src="<?php echo base_url();?>img/icons/calendar.png" id="icon" ondragstart="return false" />
                        berichten</h2>
                    <p>huidige week: week <?php echo $calendar['week'];?></p>
                    <p>huidige seizoen: seizoen <?php echo $calendar['seizoen'];?></p>
                    <p>eerstvolgende wedstrijd: <?php echo $calendar['thuisteam']['teamnaam'];?> - <?php echo $calendar['uitteam']['teamnaam'];?></p>
                </section>
            </div>
            <div>
                <section>
                    <h2>
                        <img src="<?php echo base_url();?>img/icons/calendar.png" id="icon" ondragstart="return false" />
                        nieuws</h2>
                    <!-- tweets van @playb_al zonder mentions --> 
                </section>
            </div>
            <div>
                <section>
                    <h2>
                        <img src="<?php echo base_url();?>img/icons/calendar.png" id="icon" ondragstart="return false" />
                        status</h2>
                    <!-- tweets van @playb_al met #status --> 
                </section>
            </div>
            </section> <!-- end column -->
            <section class="column">
            <div>
                <section>
                    <h2>
                        <img src="<?php echo base_url();?>img/icons/calendar.png" id="icon" ondragstart="return false" />
                        updates</h2>
                    <!-- tweets van @playb_al met #update --> 
                </section>
            </div>
            <div>
                <section>
                    <h2>
                        <img src="<?php echo base_url();?>img/icons/calendar.png" id="icon" ondragstart="return false" />
                        kalender</h2>
                    <p>huidige week: week <?php echo $calendar['week'];?></p>
                    <p>huidige seizoen: seizoen <?php echo $calendar['seizoen'];?></p>
                    <p>eerstvolgende wedstrijd: <?php echo $calendar['thuisteam']['teamnaam'];?> - <?php echo $calendar['uitteam']['teamnaam'];?></p>
                </section>
            </div>
            <div>
                <section>
                    <h2>
                        <img src="<?php echo base_url();?>img/icons/podium.png" id="icon" ondragstart="return false" />
                        klassement eerste divisie</h2>
                    <?php foreach($divisie_eerste->result() as $row){ ?>
                    <p><?php echo $row->naam;?> - <?php echo $row->divisiepunten;?></p>
                    <?php } ?>
                </section>
            </div>
            
            <div>
                <section>
                    <h2>klassement jouw divisie</h2>
                    <?php foreach($divisie->result() as $row){ ?>
                    <p><?php echo $row->naam;?> - <?php echo $row->divisiepunten;?></p>
                    <?php } ?>
                </section>
            </div>
            </section> <!-- end column -->
            <section class="column">
            <div>
                <section>
                    <h2>
                        <img src="<?php echo base_url();?>img/icons/cup.png" id="icon" ondragstart="return false" />
                        laatste award</h2>
                    <p>Donec ullamcorper nulla non metus auctor fringilla. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</p>
                </section>
            </div>
            <div>
                <section>
                    <h2>
                        <img src="<?php echo base_url();?>img/icons/medaille.png" id="icon" ondragstart="return false" />
                        laatste achievement</h2>
                    <p>Donec ullamcorper nulla non metus auctor fringilla. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</p>
                </section>
            </div>
            <div>
                <section>
                    <h2>
                        <img src="<?php echo base_url();?>img/icons/player_bought.png" id="icon" ondragstart="return false" />
                        laatste speler gekocht</h2>
                    <p>Nullam id dolor id nibh ultricies vehicula ut id elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet.</p>
                </section>
            </div>
            <div>
                <section>
                    <h2>
                        <img src="<?php echo base_url();?>img/icons/player_sold.png" id="icon" ondragstart="return false" />
                        laatste speler verkocht</h2>
                    <p>Curabitur blandit tempus porttitor. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                </section>
            </div>
            </section> <!-- end column -->
        </div>
        <!-- end gameLeft --> 
    </aside>
</div>
<!-- end game -->