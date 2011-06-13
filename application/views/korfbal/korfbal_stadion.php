<script src="<?php echo base_url();?>js/korfbal/stadion.js"></script>
<div class="game">
    <div class="gameRight">
        <div id="stadion_container">
            <div id="stadion"> 
                <!-- sectie g rechts boven --> 
                
                <!-- sectie b midden boven --> 
                
                <!-- sectie f links boven --> 
                
                <!-- sectie c rechts midden --> 
                
                <!-- speelveld midden midden --> 
                
                <!-- sectie a standaard --> 
                
                <!-- sectie h rechts onder --> 
                
                <!-- sectie d midden onder --> 
                
                <!-- sectie e links onder --> 
                
            </div>
            <!-- end stadion --> 
        </div>
        <!-- end stadion_container -->
        <input type="hidden" id="teamid" value="<?php echo $this->uri->segment('3')?>"/>
    </div>
    <!-- end gameRight -->
    <aside>
        <div class="gameLeft">
            <div>
                <section>
                            <figure class="icon" id="gameStadium"></figure>
                    <?php foreach($stadion->result() as $row)
		{?>
                    <h2><?php echo $row->naam;?></h2>
                    <?php	}
?>
                    <?php if(!isset($alien)){?>
                    <div id="plaatsen">
                        <div id="sec_a">Sectie A: </div>
                        <div id="sec_b">Sectie B:</div>
                        <div id="sec_c">Sectie C: </div>
                        <div id="sec_d">Sectie D: </div>
                        <div id="sec_e">Sectie E: </div>
                        <div id="sec_f">Sectie F: </div>
                        <div id="sec_g">Sectie G: </div>
                        <div id="sec_h">Sectie H: </div>
                    </div>
                    <!-- end plaatsen -->
                    <?php } ?>
                </section>
            </div>
        </div>
        <!-- end gameLeft -->
        <div id="dialog-confirm" title="Kopen?">
            <p>Bent u zeker over deze aankoop?</p>
        </div>
    </aside>
</div>
<!-- end game --> 
