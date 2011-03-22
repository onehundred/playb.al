<html>
<head>
    <title></title>
</head>

<body>
    <div class="players">
        <?php for($i=1;$i<15;$i++){ ?>

        <p id="matchTeamName"><?php echo $matches[$i]['thuis'];?></p>

        <p id="versus">VS</p>

        <p id="matchTeamName"><?php echo $matches[$i]['uit'];?></p><?php $uitslag = $matches[$i]['uitslag'];
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

            }else{

                if(!isset($alien)){ ?>
                	&nbsp;<a href="../korfbal_teamorders/<?php echo $team_id;?>">Geef nu je opstelling door.</a><br>
        <?php }else{ ?>
        			<br>
        <?php }


            } } ?>
    </div>

    <div class="gameRight">
        <h2>huidig seizoen</h2>

        <div class="chart_container">
            <canvas id="chartCanvas1" width="150" height="150">Your web-browser does not support the HTML 5 canvas element.</canvas>
        </div>
        <h2>vorig seizoen</h2>

        <div class="chart_container">
            <canvas id="chartCanvas2" width="150" height="150">Your web-browser does not support the HTML 5 canvas element.</canvas>
        </div>
    </div>
    <script type="text/javascript">
     var chart1 = new AwesomeChart('chartCanvas1');
    /*             chart1.title = "Worldwide browser market share: December 2010"; */
            chart1.data = [51.62,31.3, 10];
            chart1.chartType = "pie";
    /*             chart1.labels = ['verloren','gewonnen']; */
            chart1.colors = ['green', 'red', 'blue', '#945D59', '#93BBF4', '#F493B8'];
            chart1.randomColors = false;
            chart1.draw();
            
              var chart2 = new AwesomeChart('chartCanvas2');
    /*             chart1.title = "Worldwide browser market share: December 2010"; */
            chart2.data = [39.62,51.3, 25];
            chart2.chartType = "pie";
    /*             chart1.labels = ['verloren','gewonnen']; */
            chart2.colors = ['green', 'red', 'blue', '#945D59', '#93BBF4', '#F493B8'];
            chart2.randomColors = false;
            chart2.draw();

    </script>
    
</body>
</html>
