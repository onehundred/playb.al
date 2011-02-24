
<style>
.isotope,
.isotope .isotope-item {
  -webkit-transition-duration: 0.8s;
     -moz-transition-duration: 0.8s;
/*     -o-transition-duration: 0.8s;*/
          transition-duration: 0.8s;

}

.isotope {
  -webkit-transition-property: height, width;
     -moz-transition-property: height, width;
/*     -o-transition-property: height, width;*/
          transition-property: height, width;
}

/* disable CSS transitions for containers with infinite scrolling*/
.isotope.infinite-scrolling {
  -webkit-transition: none;
     -moz-transition: none;
       -o-transition: none;
          transition: none;
}

.isotope .isotope-item {
  -webkit-transition-property: -webkit-transform, opacity;
     -moz-transition-property:    -moz-transform, opacity;
/*     -o-transition-property:      -o-transform, opacity;*/
          transition-property:         transform, opacity;
}

.isotope.no-transition,
.isotope.no-transition .isotope-item {
  -webkit-transition-duration: 0s;
     -moz-transition-duration: 0s;
/*     -o-transition-duration: 0s;*/
          transition-duration: 0s;
}
</style>
<script type="text/javascript" src="<?php echo base_url();?>/js/highcharts/highcharts.js"></script>


<script>
		$(function() {
		
				var teamid = $('#teamid').val();
				var spelersskills = 0;
				//alert(teamid);
				$.ajax({
    			type: "POST",
    			url: "http://playb.al/index.php/korfbal/korfbal_jsonPlayers",
    			data:  { teamid: teamid,
            			
            			
        				},
    			dataType: "json",
        		success: function(data){
        		var spelers = data;
        		
        		
        		for(var i in spelers){
	        		$( ".rebound"+spelers[i].spelerid).progressbar({
					value: spelers[i].rebound * 5
					});
					$( ".passing"+spelers[i].spelerid ).progressbar({
						value: spelers[i].passing * 5
					});
					$( ".intercepting"+spelers[i].spelerid ).progressbar({
						value: spelers[i].intercepting * 5
					});
					$( ".shotpower"+spelers[i].spelerid).progressbar({
						value: spelers[i].shotpower * 5
					});
					$( ".shotprecision"+spelers[i].spelerid).progressbar({
						value: spelers[i].shotprecision * 5
					});
					$( ".leadership"+spelers[i].spelerid ).progressbar({
						value: spelers[i].leadership * 5
					});
					$( ".playmaking"+spelers[i].spelerid ).progressbar({
						value: spelers[i].playmaking * 5
					});
					$( ".stamina"+spelers[i].spelerid ).progressbar({
						value: spelers[i].stamina * 5
					});
					
					spelersskills =+ spelersskills + spelers[i].rebound ;
					//alert(spelersskills);
				}   
				var chart;
			
				chart = new Highcharts.Chart({
					chart: {
						renderTo: 'piechart',
						plotBackgroundColor: null,
						plotBorderWidth: null,
						plotShadow: false
					},
					title: {
						text: 'Gemiddelde spelersvaardigheden'
					},
					tooltip: {
						formatter: function() {
							return '<b>'+ this.point.name +'</b>: '+ this.y +' %';
						}
					},
					plotOptions: {
						pie: {
							allowPointSelect: true,
							cursor: 'pointer',
							dataLabels: {
								enabled: true,
								color: '#000000',
								connectorColor: '#000000',
								formatter: function() {
									return '<b>'+ this.point.name +'</b>: '+ this.y +' %';
								}
							}
						}
					},
				    series: [{
						type: 'pie',
						name: 'Gemiddelde skills',
						data: [
							['Rebound',   45.0],
							['Stamina',       26.8],
							{
								name: 'Intercepting',    
								y: 12.8,
								sliced: true,
								selected: true
							},
							['Playmaking',    8.5],
							['Shotpower',     6.2],
							['Shotprecision',   0.7],
							['Passing',     20.2]
							
						]
					}]
				});

				
        		
        		}
        		
  				});
		
				
							
			});
	</script>
<!--
 <div id="container">
      
    <div class="element">
      <p class="number">89</p>
      <h3 class="symbol">Ac</h3>
      <h2 class="name">Actinium</h2>
      <p class="weight">(227)</p>
    </div>
    
  </div>
--><!-- #container -->

<div id="container"> 
    <!-- <div class="players">  -->
    <div class="players"> 
        <!-- <h1>Players</h1> -->
        
        <?php 
    
foreach($spelers->result() as $row)
		{?>
        <div class="player">
            <p class="number">57</p>
            <p class="firstname"><a href="../korfbal_player/<?php echo $team_id;?>/<?php echo $row->speler_id;?>"><?php echo $row->voornaam;?></p>
            <p class="lastname"><?php echo $row->achternaam; ?></a></p>
            <!-- <p class="gender">s<?php echo $row->geslacht; ?></p> -->
            <p class="gender">
                <img src="<?php echo base_url();?><?php $geslacht = $row->geslacht; if($geslacht== "female"){ ?>img/female.png<?php }else{?>img/male.png<?php } ?>" />
            </p>
            <!-- <p id="gender"><img src="<?php echo base_url();?>img/male.png" /></p> --> 
            <br />
            <p class="age"><?php echo $row->leeftijd; ?> jaar oud</p>
            <p class="price">$10 000</p>
            <br />
            <br />
            <div id="rightProgress">
                <p id="skillTitle">rebound: </p>
                <p class="rebound"><?php echo $row->rebound; ?></p>
                <p class="rebound">/20</p>
                <div class="rebound<?php echo $row->speler_id;?>" id="reboundProgress"></div>
                <p id="skillTitle">stamina: </p>
                <p class="stamina"><?php echo $row->stamina; ?></p>
                <p class="rebound">/20</p>
                <div class="stamina<?php echo $row->speler_id;?>" id="staminaProgress"></div>
                <p id="skillTitle">shotprecision: </p>
                <p class="shotprecision"><?php echo $row->shotprecision; ?></p>
                <p class="rebound">/20</p>
                <div class="shotprecision<?php echo $row->speler_id;?>" id="shotprecisionProgress"></div>
                <p id="skillTitle">playmaking: </p>
                <p class="playmaking"><?php echo $row->playmaking; ?></p>
                <p class="rebound">/20</p>
                <div class="playmaking<?php echo $row->speler_id;?>" id="playmakingProgress"></div>
            </div>
            <div id="leftProgress">
                <p id="skillTitle">passing: </p>
                <p class="passing"><?php echo $row->passing; ?></p>
                <p class="rebound">/20</p>
                <div class="passing<?php echo $row->speler_id;?>" id="passingProgress"></div>
                <p id="skillTitle">shotpower: </p>
                <p class="shotpower"><?php echo $row->shotpower; ?></p>
                <p class="rebound">/20</p>
                <div class="shotpower<?php echo $row->speler_id;?>" id="shotpowerProgress"></div>
                <p id="skillTitle">intercepting: </p>
                <p class="intercepting"><?php echo $row->intercepting; ?></p>
                <p class="rebound">/20</p>
                <div class="intercepting<?php echo $row->speler_id;?>" id="interceptingProgress"></div>
                <p id="skillTitle">leadership: </p>
                <p class="leadership"><?php echo $row->leadership; ?></p>
                <p class="rebound">/20</p>
                <div class="leadership<?php echo $row->speler_id;?>" id="leadershipProgress"></div>
            </div>
        </div>
        <!-- <hr/> -->
        <?php } ?>
    </div>
    <div class="playersOverview">
        <h2>spelersoverzicht</h2>
        <ul id="sort" class="sort option-set">
            <li>
                <ul class="sort asc option-set floated clearfix">
                    <li><a href="#original-order" class="">original-order (asc)</a></li>
                    <li><a href="#firstname" class="">first name (asc)</a></li>
                    <li><a href="#lastname" class="">last name (asc)</a></li>
                    <li><a href="#rebound" class="selected">rebound (asc)</a></li>
                    <li><a href="#stamina" class="selected">stamina (asc)</a></li>
                    <li><a href="#shotprecision" class="selected">shotprecsion (asc)</a></li>
                    <li><a href="#playmaking" class="selected">playmaking (asc)</a></li>
                    <li><a href="#passing" class="selected">passing (asc)</a></li>
                    <li><a href="#shotpower" class="selected">shotpower (asc)</a></li>
                    <li><a href="#intercepting" class="selected">intercepting (asc)</a></li>
                    <li><a href="#leadership" class="selected">leadership (asc)</a></li>
                </ul>
            </li>
            <li>
            <li><a href="#original-order">original-order (desc)</a></li>
            <li><a href="#firstname">first name (desc)</a></li>
            <li><a href="#lastname">last name (desc)</a></li>
            <li><a href="#rebound" class="">rebound (desc)</a></li>
            <li><a href="#stamina" class="">stamina (desc)</a></li>
            <li><a href="#shotprecision" class="">shotprecision (desc)</a></li>
            <li><a href="#playmaking" class="">playmaking (desc)</a></li>
            <li><a href="#passing" class="">passing (desc)</a></li>
            <li><a href="#shotpower" class="">shotpower (desc)</a></li>
            <li><a href="#intercepting" class="">intercepting (desc)</a></li>
            <li><a href="#leadership" class="">leadership (desc)</a></li>
            </li>
        </ul>
    </div>
    <input type="hidden" id="teamid" value="<?php echo $this->uri->segment(3);?>"/>
</div>
<input type="hidden" id="teamid" value="<?php echo $this->uri->segment(3);?>"/>
</div> <!-- end container -->

<div id="piechart" style="width: 400px; height: 200px; margin: 0 auto"></div>

  


  <script>


    var $container = $('#container');
    
    
      // sorting
      $('#sort a').click(function(){
        // get href attribute, minus the #
        var $this = $(this),
            sortName = $this.attr('href').slice(1),
            asc = $this.parents('.sort').hasClass('asc');
        $container.isotope({ 
          sortBy : sortName,
          sortAscending : asc
        });
        return false;
      });
    
    
      // switches selected class on buttons
      $('#options').find('.option-set a').click(function(){
        var $this = $(this);

        // don't proceed if already selected
        if ( !$this.hasClass('selected') ) {
          $this.parents('.option-set').find('.selected').removeClass('selected');
          $this.addClass('selected');
        }

      });

  
    $(function(){
      
      $container.isotope({
        itemSelector : '.player',
        getSortData : {
          symbol : function( $elem ) {
            return $elem.attr('data-symbol');
          },
          category : function( $elem ) {
            return $elem.attr('data-category');
          },
          rebound : function( $elem ) {
            return parseInt( $elem.find('.rebound').text(), 10 );
          },
          stamina : function( $elem ) {
            return parseInt( $elem.find('.stamina').text(), 10 );
          },
           shotprecision : function( $elem ) {
            return parseInt( $elem.find('.shotprecision').text(), 10 );
          },
          playmaking : function( $elem ) {
            return parseInt( $elem.find('.playmaking').text(), 10 );
          },
           passing : function( $elem ) {
            return parseInt( $elem.find('.passing').text(), 10 );
          },
          shotpower : function( $elem ) {
            return parseInt( $elem.find('.shotpower').text(), 10 );
          },
          intercepting : function( $elem ) {
            return parseInt( $elem.find('.intercepting').text(), 10 );
          },
          leadership : function( $elem ) {
            return parseInt( $elem.find('.leadership').text(), 10 );
          },
          weight : function( $elem ) {
            return parseFloat( $elem.find('.weight').text().replace( /[\(\)]/g, '') );
          },
          firstname : function ( $elem ) {
            return $elem.find('.firstname').text();
          },
          lastname : function ( $elem ) {
            return $elem.find('.lastname').text();
          }
          
        
          
        }
      });
      
    });
  </script>