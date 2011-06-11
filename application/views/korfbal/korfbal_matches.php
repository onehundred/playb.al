<div class="game">
    <div class="gameRight">
        <?php if(!isset($alien)){ ?>
        &nbsp;<a href="../korfbal_teamorders/<?php echo $team_id;?>">Geef nu je opstelling door voor de volgende wedstrijd.</a>
        <?php }?>
        <?php for($i=1;$i<15;$i++){ ?>
        <p>
        <p id="matchTeamName"><?php echo $matches[$i]['thuis'];?></p>
        <p id="versus">VS</p>
        <p id="matchTeamName"><?php echo $matches[$i]['uit'];?></p>
        <?php $uitslag = $matches[$i]['uitslag'];
            if(isset($uitslag)){
                if(!isset($alien)){ 
                    echo "".$uitslag."&nbsp;";
                    echo anchor('korfbal/korfbal_review/'.$this->uri->segment('3').'/'.$matches[$i]['wedstrijdid'],'bekijk replay nu');
                    echo '<br />';
                }else{
                    echo "".$uitslag."&nbsp;";
                    echo anchor('korfbal_other_team/korfbal_review/'.$this->uri->segment('3').'/'.$matches[$i]['wedstrijdid'],'bekijk replay nu');
                    echo '<br />';

                }

             } } ?>
        </p>
    </div>
    <!-- end gameRight -->
    <aside>
        <div class="gameLeft">
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
            <div class="chart_container">
                <section>
                    <h2>huidig seizoen</h2>
                    <canvas id="chartCanvas1" width="150" height="150">Your web-browser does not support the HTML 5 canvas element.</canvas>
                </section>
            </div>
            <div class="chart_container">
                <section>
                    <h2>vorig seizoen</h2>
                    <canvas id="chartCanvas2" width="150" height="150">Your web-browser does not support the HTML 5 canvas element.</canvas>
                </section>
            </div>
        </div>
    </aside>
    <script type="text/javascript">
     var chart1 = new AwesomeChart('chartCanvas1');
            chart1.data = [51.62,31.3, 10];
            chart1.chartType = "pie";
            chart1.colors = ['#50B432', '#ED561B', '#058DC7', '#945D59', '#93BBF4', '#F493B8'];
            chart1.randomColors = false;
            chart1.draw();
            
              var chart2 = new AwesomeChart('chartCanvas2');
    /*             chart1.title = ""; */
            chart2.data = [39.62,51.3, 25];
            chart2.chartType = "pie";
    /*             chart1.labels = ['verloren','gewonnen']; */
            chart2.colors = ['green', 'red', 'blue', '#945D59', '#93BBF4', '#F493B8'];
            chart2.randomColors = false;
            chart2.draw();

    </script> 
</div>
<!-- end game -->
