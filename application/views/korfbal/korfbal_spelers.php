<script src="<?php echo base_url();?>js/korfbal/spelers.js"></script>

<div class="gameRight">
    <div id="container">
        <?php 
    
foreach($spelers->result() as $row)
		{?>
        <?php 
            $geslacht = $row->geslacht; 
            if($geslacht== "female"){ 
            	echo '<div class="playerFemale">';
            }
            else {
            	echo '<div class="playerMale">';
            }
		?>
        <p class="number"><?php echo $row->rugnummer;?></p>
        <span class="name">
        <p class="firstname"><a href="../korfbal_player/<?php echo $team_id;?>/<?php echo $row->speler_id;?>"><?php echo $row->voornaam;?></a></p>
        <p class="lastname"><a href="../korfbal_player/<?php echo $team_id;?>/<?php echo $row->speler_id;?>"><?php echo $row->achternaam;?></a> </p>
        </span>
        <p class="gender">
            <img src="<?php echo base_url();?><?php $geslacht = $row->geslacht; if($geslacht== "female"){ ?>img/female.png<?php }else{?>img/male.png<?php } ?>" ondragstart="return false" />
        </p>
        <br />
        <p class="age"><?php echo $row->leeftijd; ?> jaar oud</p>
        <p class="price"><?php echo ($row->rebound * 6250) + ($row->stamina * 3125) + ($row->passing * 6250 ) + ($row->shotprecision * 400) + ($row->shotpower * 4000) + ($row->intercepting * 7500) + ($row->leadership * 1000) + ($row->playmaking * 6250);?> &euro;</p>
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
</div>
<div class="gameLeft">
    <h2>spelers rangschikken</h2>
    <p><a id="watchSkills" href="#">skills bekijken</a><a id="hideSkills" style="display: none;" href="#">skills verbergen</a></p>
    <p><a id="watchProgress" href="#">vordering bekijken</a></p>
    <ul id="sort" class="sort option-set">
        <ul class="sort asc option-set floated clearfix">
            <li><a href="#number" class="selected">
                <img src="<?php echo base_url();?>img/down.png" />
                </a></li>
        </ul>
        <li><a href="#number" class="" id="playerSort">
            <img src="<?php echo base_url();?>img/up.png" />
            rugnummer</a></li>
        <br />
        <ul class="sort asc option-set floated clearfix">
            <li><a href="#age" class="selected">
                <img src="<?php echo base_url();?>img/down.png" />
                </a></li>
        </ul>
        <li><a href="#age" class="">
            <img src="<?php echo base_url();?>img/up.png" />
            leeftijd</a></li>
        <br />
        <ul class="sort asc option-set floated clearfix">
            <li><a href="#price" class="selected">
                <img src="<?php echo base_url();?>img/down.png" />
                </a></li>
        </ul>
        <li><a href="#price" class="">
            <img src="<?php echo base_url();?>img/up.png" />
            prijs</a></li>
        <br />
        <hr />
        <div class="gameRight2">
            <ul class="sort asc option-set floated clearfix">
                <li><a href="#passing" class="selected">
                    <img src="<?php echo base_url();?>img/down.png" />
                    </a></li>
            </ul>
            <li><a href="#passing" class="">
                <img src="<?php echo base_url();?>img/up.png" />
                passing</a></li>
            <br />
            <ul class="sort asc option-set floated clearfix">
                <li><a href="#shotpower" class="selected">
                    <img src="<?php echo base_url();?>img/down.png" />
                    </a></li>
            </ul>
            <li><a href="#shotpower" class="">
                <img src="<?php echo base_url();?>img/up.png" />
                shotpower</a></li>
            <br />
            <ul class="sort asc option-set floated clearfix">
                <li><a href="#intercepting" class="selected">
                    <img src="<?php echo base_url();?>img/down.png" />
                    </a></li>
            </ul>
            <li><a href="#intercepting" class="">
                <img src="<?php echo base_url();?>img/up.png" />
                intercepting</a></li>
            <br />
            <ul class="sort asc option-set floated clearfix">
                <li><a href="#leadership" class="selected">
                    <img src="<?php echo base_url();?>img/down.png" />
                    </a></li>
            </ul>
            <li><a href="#leadership" class="">
                <img src="<?php echo base_url();?>img/up.png" />
                leadership</a></li>
            <br />
        </div>
        <!-- end gameRight2 -->
        <div class="gameRight3">
        <ul class="sort asc option-set floated clearfix">
            <li><a href="#rebound" class="">
                <img src="<?php echo base_url();?>img/down.png" />
                </a></li>
        </ul>
        <li><a href="#rebound" class="selected">
            <img src="<?php echo base_url();?>img/up.png" />
            rebound</a></li>
        <br />
        <ul class="sort asc option-set floated clearfix">
            <li><a href="#stamina" class="selected">
                <img src="<?php echo base_url();?>img/down.png" />
                </a></li>
        </ul>
        <li><a href="#stamina" class="">
            <img src="<?php echo base_url();?>img/up.png" />
            stamina</a></li>
        <br />
        <ul class="sort asc option-set floated clearfix">
            <li><a href="#shotprecision" class="selected">
                <img src="<?php echo base_url();?>img/down.png" />
                </a></li>
        </ul>
        <li><a href="#shotprecision" class="">
            <img src="<?php echo base_url();?>img/up.png" />
            shotprecsion</a></li>
        <br />
        <ul class="sort asc option-set floated clearfix">
            <li><a href="#playmaking" class="selected">
                <img src="<?php echo base_url();?>img/down.png" />
                </a></li>
        </ul>
        <li><a href="#playmaking" class="">
            <img src="<?php echo base_url();?>img/up.png" />
            playmaking</a></li>
    </ul>
    <!-- end ul id sort -->
    <ul id="filters">
        <li><a href="#" data-filter="*">mannen & vrouwen</a></li>
        <li><a href="#" data-filter=".playerMale">mannen</a></li>
        <li><a href="#" data-filter=".playerFemale">vrouwen</a></li>
    </ul>
    <ul id="toggle-sizes">
        <li><a href="#" data-filter="*">grootte</a></li>
 
    </ul>
    <!-- end gameLeft -->
    <input type="hidden" id="teamid" value="<?php echo $this->uri->segment(3);?>"/>
    <input type="hidden" id="teamid" value="<?php echo $this->uri->segment(3);?>"/>
</div>
<!-- end container --> 

<script>

$('#filters a').click(function(){
  var selector = $(this).attr('data-filter');
  $('#container').isotope({ filter: selector });
  return false;
});
    var $container = $('#container');
    
    
    
    
    
    $('#toggle-sizes a').click(function(){
        $container
          .toggleClass('variable-sizes')
          .isotope('reLayout');
        return false;
      });

    
    
    
    
    
    
    
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
        itemSelector : '.playerMale, .playerFemale',
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
          age : function( $elem ) {
            return parseInt( $elem.find('.age').text(), 10 );
          },
          price : function( $elem ) {
            return parseInt( $elem.find('.price').text(), 10 );
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