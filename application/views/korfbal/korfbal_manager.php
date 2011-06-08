<div class="game">
    <div class="gameRight">
        <?php
//gegevens van users en teams kan hieruit gehaald worden
 foreach($manager->result() as $row)
		{ ?>
        <p>manager: <?php echo $row->gebruikersnaam;?> </p>
        <p>team: <?php echo $row->naam;?></p>
        <p> land: <?php echo $row->land; ?></p>
        <?php }?>
    </div>
    <aside>
        <div class="gameLeft">
            <div>
                <section>
                    <h2>bekers</h2>
                    <!-- if bekers = 0 -->
                    <p>je hebt nog geen bekers gewonnen</p>
                    <!-- else -->
                    <p>beker 1</p>
                    <p>beker 2</p>
                </section>
            </div>
            <div>
                <section>
                    <h2>banksaldo</h2>
                </section>
            </div>
            <div>
                <section>
                    <h2>achievements</h2>
                    <!-- if achievements = 0 -->
                    <p>je hebt nog geen achievements behaald</p>
                    <!-- else -->
                    
                    <section id="bottom"> </section>
                    <section id="belowbottom">
                        <div class="containerSmall">
                            <div class="folio_blockSmall">
                                <div class="main_viewSmall">
                                    <div class="galleryWrapperSmall">
                                        <div class="imgsSmall" ondragstart="return false">
                                            <img src="<?php echo base_url();?>img/achievement1.png" alt="achievement" title="playb.al achievement" />
                                            <img src="<?php echo base_url();?>img/achievement1.png" alt="achievement" title="playb.al achievement" />
                                            <img src="<?php echo base_url();?>img/achievement1.jpg" alt="achievement" title="playb.al achievement" />
                                            <img src="<?php echo base_url();?>img/achievement1.jpg" alt="achievement" title="playb.al achievement" />
                                        </div>
                                        <!-- end imgs --> 
                                    </div>
                                    <!-- end galleryWrapper -->
                                    <div class="pagingGallerySmall"> <a href="#" rel="1"></a> <a href="#" rel="2"></a> <a href="#" rel="3"></a> <a href="#" rel="4"></a> </div>
                                    <!-- end pagingGallery --> 
                                </div>
                                <!-- end main_view --> 
                                
                            </div>
                            <!-- end folio_block --> 
                            
                        </div>
                    </section>
                    <!-- end container --> 
                </section>
            </div>
            <?php foreach($achievements->result() as $row){ ?>
            <div style="float:left; margin:20px;">
                <p><?php echo $row->naam;?></p>
                <p>
                    <img style="width:50px; heigth: 50px;" src="<?php echo base_url()?>/img/achievements/<?php echo $row->afbeelding;?>"/>
                </p>
                <p><?php echo $row->punten;?> punten</p>
            </div>
            <?php } ?>
        </div>
    </aside>
</div>
