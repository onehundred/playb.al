<!-- todo de values hieronder dynamisch invullen -->
<!-- todo p id gender de afbeelding moet dynamisch opgehaald worden: if sex=male -> male.png  - else female.png //done -->
<script>
		$(function() {
		
				var teamid = $('#teamid').val();
				//alert(teamid);
				$.ajax({
    			type: "POST",
    			url: "http://playb.al/index.php/korfbal/korfbal_jsonPlayers",
    			data:  { teamid: teamid,
            			
            			
        				},
    			dataType: "json",
        		success: function(data){
        		var spelers = data;
        		//alert(spelers[1].rebound);
        		
        		for(var i=1;i<30;i++){
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
				}
        		
        		}
  				});
		
			});
	</script>








  

<!--
 <div id="container">
    
      
      
        
      
      
    <div class="element">
      <p class="number">48</p>
      <h3 class="symbol">Cd</h3>
      <h2 class="name">Cadmium</h2>
      <p class="weight">112.411</p>
    </div>
    
      
      
    <div class="element">
      <p class="number">20</p>
      <h3 class="symbol">Ca</h3>
      <h2 class="name">Calcium</h2>
      <p class="weight">40.078</p>
    </div>
    
      
      
    <div class="element">
      <p class="number">75</p>
      <h3 class="symbol">Re</h3>
      <h2 class="name">Rhenium</h2>
      <p class="weight">186.207</p>
    </div>
    
      
      
    <div class="element">
      <p class="number">81</p>
      <h3 class="symbol">Tl</h3>
      <h2 class="name">Thallium</h2>
      <p class="weight">204.3833</p>
    </div>
    
      
      
    <div class="element">
      <p class="number">51</p>
      <h3 class="symbol">Sb</h3>
      <h2 class="name">Antimony</h2>
      <p class="weight">121.76</p>
    </div>
    
      
      
    <div class="element">
      <p class="number">27</p>
      <h3 class="symbol">Co</h3>
      <h2 class="name">Cobalt</h2>
      <p class="weight">58.933195</p>
    </div>
    
      
      
    <div class="element">
      <p class="number">71</p>
      <h3 class="symbol">Lu</h3>
      <h2 class="name">Lutetium</h2>
      <p class="weight">174.9668</p>
    </div>
    
      
      
    <div class="element">
      <p class="number">18</p>
      <h3 class="symbol">Ar</h3>
      <h2 class="name">Argon</h2>
      <p class="weight">39.948</p>
    </div>
    
      
      
    <div class="element">
      <p class="number">37</p>
      <h3 class="symbol">Rb</h3>
      <h2 class="name">Rubidium</h2>
      <p class="weight">85.4678</p>
    </div>
    
      
      
    <div class="element">
      <p class="number">7</p>
      <h3 class="symbol">N</h3>
      <h2 class="name">Nitrogen</h2>
      <p class="weight">14.0067</p>
    </div>
    
      
      
    <div class="element" >
      <p class="number">93</p>
      <h3 class="symbol">Np</h3>
      <h2 class="name">Neptunium</h2>
      <p class="weight">(237)</p>
    </div>
    
      
      
    <div class="element">
      <p class="number">89</p>
      <h3 class="symbol">Ac</h3>
      <h2 class="name">Actinium</h2>
      <p class="weight">(227)</p>
    </div>
    
  </div>
--> <!-- #container -->
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
            <p class="rebound">Rebound: <?php echo $row->rebound; ?>/20</p>
            <div class="rebound<?php echo $row->speler_id;?>" id="reboundProgress"></div>
            <p>Stamina: <?php echo $row->stamina; ?>/20</p>
            <div class="stamina<?php echo $row->speler_id;?>" id="staminaProgress"></div>
            <p>Shotprecision: <?php echo $row->shotprecision; ?>/20</p>
            <div class="shotprecision<?php echo $row->speler_id;?>" id="shotprecisionProgress"></div>
            <p>Playmaking: <?php echo $row->playmaking; ?>/20</p>
            <div class="playmaking<?php echo $row->speler_id;?>" id="playmakingProgress"></div>
        </div>
        <div id="leftProgress">
            <p id="passing">Passing: <?php echo $row->passing; ?>/20</p>
            <div class="passing<?php echo $row->speler_id;?>" id="passingProgress"></div>
            <p>Shotpower: <?php echo $row->shotpower; ?>/20</p>
            <div class="shotpower<?php echo $row->speler_id;?>" id="shotpowerProgress"></div>
            <p>Intercepting: <?php echo $row->intercepting; ?>/20</p>
            <div class="intercepting<?php echo $row->speler_id;?>" id="interceptingProgress"></div>
            <p>Leadership: <?php echo $row->leadership; ?>/20</p>
            <div class="leadership<?php echo $row->speler_id;?>" id="leadershipProgress"></div>
        </div>
    </div>
    <!-- <hr/> -->
    <?php } ?>
</div><div class="playersOverview">
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
<input type="hidden" id="teamid" value="<?php echo $this->uri->segment(3);?>"/>
</div> <!-- end container -->

  


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