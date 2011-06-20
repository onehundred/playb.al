<div class="game">
<div class="gameRight">
    <?php if(isset($matches[1]['thuis'])){ ?>
    <?php if(!isset($alien)){ ?>
    <a class="question" id="opstellingButton" href="../korfbal_teamorders/<?php echo $team_id;?>">opstelling</a>
    <?php }?>
    <?php for($i=1;$i<15;$i++){ ?>
    <div class="wedstrijdEntry">
        <p id="matchTeamNameHome"><?php echo $matches[$i]['thuis'];?></p>
        <!-- <p id="versus">VS</p> -->
        <p id="matchTeamNameOut"><?php echo $matches[$i]['uit'];?></p>
        <p id="matchUitslag">
        <?php $uitslag = $matches[$i]['uitslag'];
            if(isset($uitslag)){
                if(!isset($alien)){ 
                    echo '<p id="matchUitslagScore">'.$uitslag.'</p>';
                    echo anchor('korfbal/korfbal_review/'.$this->uri->segment('3').'/'.$matches[$i]['wedstrijdid'],'bekijk replay','class="light lower"');
                    echo '<br />';
                }else{
                    echo "".$uitslag."&nbsp;";
                    echo anchor('korfbal_other_team/korfbal_review/'.$this->uri->segment('3').'/'.$matches[$i]['wedstrijdid'],'bekijk replay','class="light lower"');
                    echo '<br />';

                } echo '</p>';

             } echo        '</div>';} 
             }else{ ?>
        <p>De wedstrijden voor dit seizoen zijn nog niet klaar, nog even geduld!</p>
        <?php } ?>
        </p>
    </div>
    <!-- end gameRight -->
    <aside>
        <div class="gameLeft">
            <div class="fillLeft">
                <section>
                    <figure class="icon" id="gameCalendar"></figure>
                    <h2> kalender</h2>
                    <p class="entry">week <?php echo $calendar['week'];?> seizoen <?php echo $calendar['seizoen'];?></p>
                    <p class="entry">volgende wedstrijd:<br />
                        <?php echo $calendar['thuisteam']['teamnaam'];?> - <?php echo $calendar['uitteam']['teamnaam'];?></p>
                </section>
            </div>
            <div class="chart_container fillLeft">
                <section>
                    <figure class="icon" id="gameGraph"></figure>
                    <h2>huidig seizoen</h2>
                    <div class="entry">
                        <div id="chartsWonLegend">
                            <span id="wonspan">leg</span>
                            <p>gewonnen</p>
                        </div>
                        <div id="chartsLostLegend">
                            <span id="lostspan">leg</span>
                            <p>verloren</p>
                        </div>
                        <div id="chartsDrawLegend">
                            <span id="drawspan">leg</span>
                            <p>gelijk</p>
                        </div>
                    </div>
                    <canvas id="chartCanvas1" width="150" height="150">Your web-browser does not support the HTML 5 canvas element.</canvas>
                </section>
            </div>
            <div class="chart_container fillLeft">
                <section>
                    <figure class="icon" id="gameGraph"></figure>
                    <h2>carriere</h2>
                    <div class="entry">
                        <div id="chartsWonLegend">
                            <span id="wonspan">leg</span>
                            <p>gewonnen</p>
                        </div>
                        <div id="chartsLostLegend">
                            <span id="lostspan">leg</span>
                            <p>verloren</p>
                        </div>
                        <div id="chartsDrawLegend">
                            <span id="drawspan">leg</span>
                            <p>gelijk</p>
                        </div>
                    </div>
                    <canvas id="chartCanvas2" width="150" height="150">Your web-browser does not support the HTML 5 canvas element.</canvas>
                </section>
            </div>
        </div>
        <input type="hidden" id="teamid" value="<?php echo $this->uri->segment('3');?>"/>
    </aside>
    <script type="text/javascript">
$(document).ready(function(){
    var teamid = $('#teamid').val();
    
    $.ajax({
    			type: "POST",
    			url: "<?php echo base_url();?>index.php/json/get_aantal_wedstrijden",
    			data: { teamid: teamid,
            			},
        		dataType: "json",
        		success: function(data){
    				
    					var gewonnen = data['seizoen']['gewonnen'];
    					var verloren = data['seizoen']['verloren'];
    					var gelijk =  data['seizoen']['gelijke'];
    					
			     		var chart1 = new AwesomeChart('chartCanvas1');
			            chart1.data = [gewonnen/100, verloren/100, gelijk/100];
			            chart1.chartType = "pie";
			            chart1.colors = ['#808080', '#333333', '#CCCCCC'];
			            chart1.randomColors = false;
			            chart1.draw();
			            
			            var gewonnen_al = data['overzicht']['gewonnen'];
    					var verloren_al = data['overzicht']['verloren'];
    					var gelijk_al =  data['overzicht']['gelijke'];
			            
			              var chart2 = new AwesomeChart('chartCanvas2');
			    /*             chart1.title = ""; */
			            chart2.data = [gewonnen_al/100, verloren_al/100, gelijk_al/100];
			            chart2.chartType = "pie";
			    /*      chart2.labels = ['verloren','gewonnen']; */
			            chart2.colors = ['#808080', '#333333', 'CCCCCC'];
			            chart2.randomColors = false;
			            chart2.draw();
			            
			     }
            });
});
    </script> 
</div>
<!-- end game -->