<!-- todo de values hieronder dynamisch invullen -->
<!-- todo p id gender de afbeelding moet dynamisch opgehaald worden: if sex=male -> male.png  - else female.png -->
<script>
		$(function() {
		$( "#reboundProgress" ).progressbar({
			value: 5
		});
		$( "#passingProgress" ).progressbar({
			value: 10
		});
		$( "#staminaProgress" ).progressbar({
			value: 90
		});
		$( "#shotpowerProgress" ).progressbar({
			value: 60
		});
		$( "#shotprecisionProgress" ).progressbar({
			value: 40
		});
		$( "#playmakingProgress" ).progressbar({
			value: 15
		});
		$( "#interceptingProgress" ).progressbar({
			value: 30
		});
		$( "#leadershipProgress" ).progressbar({
			value: 5
		});
	});
	</script>

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
                <img src="<?php echo base_url();?>img/female.png" />
            </p>
            <!-- <p id="gender"><img src="<?php echo base_url();?>img/male.png" /></p> --> 
            <br />
            <p class="age"><?php echo $row->leeftijd; ?> jaar oud</p>
            <p class="price">$10 000</p>
            <br />
            <br />
            <div id="rightProgress">
                <p class="rebound">Rebound: <?php echo $row->rebound; ?>/20</p>
                <div id="reboundProgress"></div>
                <p>Stamina: <?php echo $row->stamina; ?>/20</p>
                <div id="staminaProgress"></div>
                <p>Shotprecision: <?php echo $row->shotprecision; ?>/20</p>
                <div id="shotprecisionProgress"></div>
                <p>Playmaking: <?php echo $row->playmaking; ?>/20</p>
                <div id="playmakingProgress"></div>
            </div>
            <div id="leftProgress">
                <p id="passing">Passing: <?php echo $row->passing; ?>/20</p>
                <div id="passingProgress"></div>
                <p>Shotpower: <?php echo $row->shotpower; ?>/20</p>
                <div id="shotpowerProgress"></div>
                <p>Intercepting: <?php echo $row->intercepting; ?>/20</p>
                <div id="interceptingProgress"></div>
                <p>Leadership: <?php echo $row->leadership; ?>/20</p>
                <div id="leadershipProgress"></div>
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
                    <li><a href="#symbol" class="">symbol (asc)</a></li>
                    <li><a href="#number" class="selected">number (asc)</a></li>
                    <li><a href="#weight" class="">weight (asc)</a></li>
                    <li><a href="#category">category (asc)</a></li>
                </ul>
            </li>
            <li>
                <ul class="sort desc option-set floated clearfix">
                    <li><a href="#original-order">original-order (desc)</a></li>
                    <li><a href="#firstname">first name (desc)</a></li>
                    <li><a href="#lastname">last name (desc)</a></li>
                    <li><a href="#symbol">symbol (desc)</a></li>
                    <li><a href="#number" class="">number (desc)</a></li>
                    <li><a href="#weight" class="">weight (desc)</a></li>
                    <li><a href="#category" class="">category (desc)</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
<!-- end container --> 

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
          number : function( $elem ) {
            return parseInt( $elem.find('.number').text(), 10 );
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