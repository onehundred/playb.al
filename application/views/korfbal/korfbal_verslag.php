<script src="<?php echo base_url();?>js/toastmessage/jquery.toastmessage.js"></script>
<script src="<?php echo base_url();?>js/jquery.blockUI.js"></script>
<style>
	#canvas{
		background-image:url(<?php echo base_url();?>img/field.png);
	}
</style>

<div class="game">
    <div class="gameRight">
        <div>
            <canvas id="canvas" width="802" height="401"> oops, jouw browser ondersteunt dit niet. </canvas>
        </div>
        <div id="loading">
            <img src="<?php echo base_url()?>/img/loading.gif"/>
        </div>
        <div id="prestaties">
            <div style="float:right; margin-right:200px;" id="uitteam">
                <h3 id="naam_uitteam"></h3><img src="<?php echo base_url();?>img/player_theirs.png"/>
                <div id="rebound1">
                    <h4>Rebound</h4>
                    <p id="speler"></p>
                    <p id="prestatie"></p>
                </div>
                <div id="playmaking1">
                    <h4>Spelmaken</h4>
                    <p id="speler"></p>
                    <p id="prestatie"></p>
                </div>
                <div id="attack1">
                    <h4>Aanval</h4>
                    <p id="speler"></p>
                    <p id="prestatie"></p>
                </div>
                <div id="attack2">
                    <h4>Aanval</h4>
                    <p id="speler"></p>
                    <p id="prestatie"></p>
                </div>
                <div id="rebound2">
                    <h4>Rebound</h4>
                    <p id="speler"></p>
                    <p id="prestatie"></p>
                </div>
                <div id="playmaking2">
                    <h4>Spelmaken</h4>
                    <p id="speler"></p>
                    <p id="prestatie"></p>
                </div>
                <div id="attack3">
                    <h4>Aanval</h4>
                    <p id="speler"></p>
                    <p id="prestatie"></p>
                </div>
                <div id="attack4">
                    <h4>Aanval</h4>
                    <p id="speler"></p>
                    <p id="prestatie"></p>
                </div>
            </div>
            <div id="thuisteam">
                <h3 id="naam_thuisteam"></h3><img src="<?php echo base_url();?>img/player_ours.png"/>
                <div id="rebound1">
                    <h4>Rebound</h4>
                    <p id="speler"></p>
                    <p id="prestatie"></p>
                </div>
                <div id="playmaking1">
                    <h4>Spelmaken</h4>
                    <p id="speler"></p>
                    <p id="prestatie"></p>
                </div>
                <div id="attack1">
                    <h4>Aanval</h4>
                    <p id="speler"></p>
                    <p id="prestatie"></p>
                </div>
                <div id="attack2">
                    <h4>Aanval</h4>
                    <p id="speler"></p>
                    <p id="prestatie"></p>
                </div>
                <div id="rebound2">
                    <h4>Rebound</h4>
                    <p id="speler"></p>
                    <p id="prestatie"></p>
                </div>
                <div id="playmaking2">
                    <h4>Spelmaken</h4>
                    <p id="speler"></p>
                    <p id="prestatie"></p>
                </div>
                <div id="attack3">
                    <h4>Aanval</h4>
                    <p id="speler"></p>
                    <p id="prestatie"></p>
                </div>
                <div id="attack4">
                    <h4>Aanval</h4>
                    <p id="speler"></p>
                    <p id="prestatie"></p>
                </div>
            </div>
        </div>
    </div>
    <aside>
        <div class="gameLeft">
        	<p id="replay"></p>
        	<p id="stop_replay" class="light">stop replay</p>
        	
            <p id="terminating"><img src="<?php echo base_url();?>img/loading.gif"/></p>
        	<div id="tussenstand"></div>
            <div id="links">
                <input type="hidden" id="wedstrijdid" value="<?php echo $this->uri->segment('4');?>">
                <input type="hidden" id="teamid" value="<?php echo $this->uri->segment('3');?>">
            </div>
        </div>
    </aside>
</div>
<script src="<?php echo base_url();?>js/korfbal/verslag.js"></script>