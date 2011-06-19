<div class="game">
    <div class="gameRight">
        <?php if(isset($error)){
    	foreach($error as $erro){ ?>
        <p id="error"><?php echo $erro;?></p>
        <?php 	}
    
    } 
    ?>
        <?php
        $edit = $this->uri->segment('4');
//gegevens van users en teams kan hieruit gehaald worden
 foreach($manager->result() as $row)
		{ ?>
        <?php if($edit != 'edit'){ ?>
        <p>Manager: <?php echo $row->gebruikersnaam;?> </p>
        <p>Team: <?php echo $row->naam;?></p>
        <!-- <p>Manager sinds: <?php echo $row->datum_creatie;?></p> -->
        <p id="managerPic">
            <?php if($row->afbeelding == null){ ?>
            <img src="<?php echo base_url();?>img/default_profile.png" alt="profielfoto" ondragstart="return false" />
            <?php }else{ ?>
            <img src="<?php echo base_url();?>img/userpics/thumbs/<?php echo $row->afbeelding;?>"/>
            <?php } ?>
        </p>
        <?php if(!isset($alien)){ ?>
        <p id="managerChangePic"><a class="question" href="<?php echo $this->uri->segment('3');?>/edit">foto uploaden</a></p>
        <?php } ?>
        <div id="managerStatistics">
            <p>Totaal gespeelde matchen in carrière: <?php echo $row->gespeeld_matchen;?></p>
            <p>Totaal gewonnen matchen in carrière: <?php echo $row->gewonnen_matchen;?></p>
            <p>Totaal verloren matchen in carrière: <?php echo $row->verloren_matchen;?></p>
            <p>Totaal matchen gelijk gespeeld in carrière: <?php echo $row->gelijke_matchen;?></p>
        </div>
        <?php }else{ ?>
        <?php echo form_open_multipart('korfbal/korfbal_manager_update/'.$this->uri->segment('3'));?>
        <p>
            <label>Foto: </label>
            <input type="file" name="userfile" size="20" />
        </p>
        <p>
            <input type="submit">
        </p>
        </form>
        <?php } ?>
        <?php }?>
    </div>
    <!-- end gameRight -->
    <aside>
        <div class="gameLeft"> 
            <script>
        $.fn.cycle.defaults.timeout = 4000;
        	$(function() {

    
    $('#s6').show().cycle({
        fx:     'fade',
        speed:  500,
        pause: 1,
    });
});
        </script>
            <div class="fillLeft">
                <section>
                    <figure class="icon" id="gameCup"></figure>
                    <h2>bekers</h2>
                    <?php if($awards->result() == null){ ?>
                    <p>je hebt nog geen bekers gewonnen</p>
                    <?php }else{ ?>
                    <div id="s6" class="pics">
                        <?php foreach($awards->result() as $row){ ?>
                        <div>
                            <img src="<?php echo base_url()?>/img/awards/cup_gold.png" ondragstart="return false" />
                            <p><?php echo $row->naam;?></p> </div>
                        
                        <?php 
                  }?>
                  </div>
                 <?php } ?>
                  
                </section>
                </div>
                <script>


$(function() {

    
    $('#s5').show().cycle({
        fx:     'fade',
        speed:  500,
        next: '#s5',
       pause: 1
    });
});
</script>
                <div class="fillLeft">
                    <section>
                        <figure class="icon" id="gameMedaille"></figure>
                        <h2>achievements</h2>
                        <?php if($achievements->result() == null){ ?>
                        <p>je hebt nog geen achievements behaald</p>
                        <?php }else{ ?>
                        <div id="s5" class="pics">
                            <?php foreach($achievements->result() as $row){ ?>
                            <div>
                                <img src="<?php echo base_url()?>/img/achievements/<?php echo $row->afbeelding;?>" ondragstart="return false" />
                               <p> <?php echo $row->naam;?></p> </div>
                               
                            <?php
										}?>
							</div>
			 					<?php } ?>
                     
                    </section>
                </div>
            </div>
        </div>
        <!-- end gameLeft --> 
    </aside>
</div>
<!-- end game --> 