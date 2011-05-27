 <div class="game"><div class="gameRight"> 
        <h2>nieuws</h2>
        <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Vestibulum id ligula porta felis euismod semper. Cras mattis consectetur purus sit amet fermentum. Vestibulum id ligula porta felis euismod semper. Sed posuere consectetur est at lobortis.</p>
        <h2>playb.al updates</h2>
        <p>Nullam quis risus eget urna mollis ornare vel eu leo. Maecenas sed diam eget risus varius blandit sit amet non magna. Aenean lacinia bibendum nulla sed consectetur. Aenean lacinia bibendum nulla sed consectetur. Curabitur blandit tempus porttitor. Cras mattis consectetur purus sit amet fermentum. Integer posuere erat a ante venenatis dapibus posuere velit aliquet.</p>
    </div>
    <!-- end gameRight -->
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
            <h2><img src="<?php echo base_url();?>img/icons/podium.png" id="icon" ondragstart="return false" />klassement eerste divisie</h2>
                <?php foreach($divisie_eerste->result() as $team){ ?>
                	<p><?php echo $team->naam;?> <?php echo $team->divisiepunten;?> punten</p>
                
                
                <?php }?></p>
            </section>
        </div>
        <div>
            <section>
                <h2>klassement jouw divisie</h2>
                <?php foreach($divisie->result() as $team){ ?>
                	<p><?php echo $team->naam;?> <?php echo $team->divisiepunten;?> punten</p>
                
                
                <?php }?></p>
            </section>
        </div>
        <div>
            <section>
                <h2><img src="<?php echo base_url();?>img/icons/cup.png" id="icon" ondragstart="return false" />laatste award</h2>
                <p>Donec ullamcorper nulla non metus auctor fringilla. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</p>
            </section>
        </div>
        <div>
            <section>
                <h2><img src="<?php echo base_url();?>img/icons/medaille.png" id="icon" ondragstart="return false" />laatste achievement</h2>
                <p>Donec ullamcorper nulla non metus auctor fringilla. Praesent commodo cursus magna, vel scelerisque nisl consectetur et.</p>
            </section>
        </div>
        <div>
            <section>
                <h2><img src="<?php echo base_url();?>img/icons/player_bought.png" id="icon" ondragstart="return false" />laatste speler gekocht</h2>
                <p>Nullam id dolor id nibh ultricies vehicula ut id elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet.</p>
            </section>
        </div>
        <div>
            <section>
                <h2><img src="<?php echo base_url();?>img/icons/player_sold.png" id="icon" ondragstart="return false" />laatste speler verkocht</h2>
                <p>Curabitur blandit tempus porttitor. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
            </section>
        </div>
    </div>
    <!-- end gameLeft --> 
</div> <!-- end game -->