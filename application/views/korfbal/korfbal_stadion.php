<style>
#plaatsen {
	width: 400px;
}
#stadion {
	width: 600px;
	height: 706px;
	float: left;
}
#links_boven {
	width: 100px;
	height: 100px;
	float: left;
	background-color: blue;
	-webkit-border-top-left-radius: 100px;
}
#links_boven_kopen {
	width: 100px;
	height: 100px;
	float: left;
	-webkit-border-top-left-radius: 100px;
}
#midden_boven {
	float:right;
	width: 400px;
	height: 100px;
	background-color: green;
}
#midden_boven_kopen {
	float:right;
	width: 400px;
	height: 100px;
	text-align: center;
}
#rechts_boven {
	width: 100px;
	height: 100px;
	float:right;
	background-color: blue;
	-webkit-border-top-right-radius: 100px;
}
#rechts_boven_kopen {
	width: 100px;
	height: 100px;
	float:right;
	-webkit-border-top-right-radius: 100px;
	text-align: center;
}
#rechts_midden {
	width: 100px;
	height: 500px;
	float: right;
	background-color: green;
}
#rechts_midden_kopen {
	width: 100px;
	height: 500px;
	float: right;
	text-align: center;
}
#midden_midden {
	width: 400px;
	height: 500px;
	float: right;
	background-color: #bc8f66;
}
#links_midden {
	width: 100px;
	height: 500px;
	float: left;
	background-color: green;
}
#rechts_onder {
	width: 100px;
	height: 100px;
	float: right;
	background-color: blue;
	-webkit-border-bottom-right-radius: 100px;
}
#rechts_onder_kopen {
	width: 100px;
	height: 100px;
	float: right;
	text-align: center;
	-webkit-border-bottom-right-radius: 100px;
}
#midden_onder {
	width: 400px;
	height: 100px;
	float: right;
	background-color: green;
}
#midden_onder_kopen {
	width: 400px;
	height: 100px;
	float: right;
	text-align: center;
}
#links_onder {
	width: 100px;
	height: 100px;
	float: left;
	background-color: blue;
	-webkit-border-bottom-left-radius: 100px;
}
#links_onder_kopen {
	width: 100px;
	height: 100px;
	float: left;
 text-align: center -webkit-border-bottom-left-radius: 100px;
}
.kopen {
	text-decoration: underline;
	cursor: pointer;
	color:blue;
	margin-left: 35px;
	font-size: 9pt;
}
</style>
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
            <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Bent u zeker over deze aankoop?</p>
        </div>
    </aside>
</div>
<!-- end game --> 
