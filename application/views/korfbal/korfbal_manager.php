<style>
#managerStatistics{
	padding: 10px;
	width: 400px;
}
#managerStatistics p{
	padding: 10px;
}
.manager_number{
	float: right;
	font-weight: bold;

}
#managerGegevens{
	padding: 10px;
	width: 400px;
}
#managerGegevens p{
	padding: 10px;
}

</style>
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
        <div id="managerGegevens">
        <p class="entry">Manager: <?php echo $row->gebruikersnaam;?> </p>
        <p class="entry">Team: <?php echo $row->naam;?></p>
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
        </div>
        <div id="managerStatistics" >
           
            <p class="entry">gewonnen matchen in carrière:<span class="manager_number"> <?php echo $row->gewonnen_matchen;?></span></p>
            <p class="entry">verloren matchen in carrière:<span class="manager_number"> <?php echo $row->verloren_matchen;?></span></p>
            <p class="entry">matchen gelijk gespeeld in carrière:<span class="manager_number"> <?php echo $row->gelijke_matchen;?></span></p>
            <hr/>
             <p class="entry">gespeelde matchen in carrière:<span class="manager_number"><?php echo $row->gespeeld_matchen;?></span></p>
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
        next: '#s6',
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