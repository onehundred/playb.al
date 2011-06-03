<script src="<?php echo base_url();?>js/korfbal/training.js"></script>

<div class="gameRight">
    <div id="container">
        <?php
foreach($training->result() as $row){

//echo $row->FK_team_id;
 ?>
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
            <img src="<?php echo base_url();?><?php $geslacht = $row->geslacht; if($geslacht== "female"){ ?>img/female.png<?php }else{?>img/male.png<?php } ?>" ondragstart= "return false" />
        </p>
        <br />
        <p class="age"><?php echo $row->leeftijd; ?> jaar oud</p>
        <p class="price"><?php echo ($row->rebound * 6250) + ($row->stamina * 3125) + ($row->passing * 6250 ) + ($row->shotprecision * 400) + ($row->shotpower * 4000) + ($row->intercepting * 7500) + ($row->leadership * 1000) + ($row->playmaking * 6250);?> &euro;</p>
        <div id="rightProgress">
            <section>
                <p id="skillTitle">rebound: </p>
                <p class="rebound"><?php echo $row->rebound; ?></p>
                <p class="rebound">/20</p>
                <div class="rebound<?php echo $row->speler_id;?>" id="reboundProgress"></div>
            </section>
            <section>
                <p id="skillTitle">rebound: </p>
                <p class="rebound"><?php echo $row->rebound_tr; ?></p>
                <p class="rebound">/1000</p>
                <div class="rebound_tr<?php echo $row->speler_id;?>" id="reboundProgress"></div>
            </section>
            <section>
                <p id="skillTitle">stamina: </p>
                <p class="stamina"><?php echo $row->stamina; ?></p>
                <p class="rebound">/20</p>
                <div class="stamina<?php echo $row->speler_id;?>" id="staminaProgress"></div>
            </section>
            <section>
                <p id="skillTitle">stamina: </p>
                <p class="stamina"><?php echo $row->stamina_tr; ?></p>
                <p class="rebound">/1000</p>
                <div class="stamina_tr<?php echo $row->speler_id;?>" id="staminaProgress"></div>
            </section>
            <section>
                <p id="skillTitle">shotprecision: </p>
                <p class="shotprecision"><?php echo $row->shotprecision; ?></p>
                <p class="rebound">/20</p>
                <div class="shotprecision<?php echo $row->speler_id;?>" id="shotprecisionProgress"></div>
            </section>
            <section>
                <p id="skillTitle">shotprecision: </p>
                <p class="shotprecision"><?php echo $row->shotprecision_tr; ?></p>
                <p class="rebound">/1000</p>
                <div class="shotprecision_tr<?php echo $row->speler_id;?>" id="shotprecisionProgress"></div>
            </section>
            <section>
                <p id="skillTitle">playmaking: </p>
                <p class="playmaking"><?php echo $row->playmaking; ?></p>
                <p class="rebound">/20</p>
                <div class="playmaking<?php echo $row->speler_id;?>" id="playmakingProgress"></div>
            </section>
            <section>
                <p id="skillTitle">playmaking: </p>
                <p class="playmaking"><?php echo $row->playmaking_tr; ?></p>
                <p class="rebound">/1000</p>
                <div class="playmaking_tr<?php echo $row->speler_id;?>" id="playmakingProgress"></div>
            </section>
        </div>
        <div id="leftProgress">
            <section>
                <p id="skillTitle">passing: </p>
                <p class="passing"><?php echo $row->passing; ?></p>
                <p class="rebound">/20</p>
                <div class="passing<?php echo $row->speler_id;?>" id="passingProgress"></div>
            </section>
            <section>
                <p id="skillTitle">passing: </p>
                <p class="passing"><?php echo $row->passing_tr; ?></p>
                <p class="rebound">/1000</p>
                <div class="passing_tr<?php echo $row->speler_id;?>" id="passingProgress"></div>
            </section>
            <section>
                <p id="skillTitle">shotpower: </p>
                <p class="shotpower"><?php echo $row->shotpower; ?></p>
                <p class="rebound">/20</p>
                <div class="shotpower<?php echo $row->speler_id;?>" id="shotpowerProgress"></div>
            </section>
            <section>
                <p id="skillTitle">shotpower: </p>
                <p class="shotpower"><?php echo $row->shotpower_tr; ?></p>
                <p class="rebound">/1000</p>
                <div class="shotpower_tr<?php echo $row->speler_id;?>" id="shotpowerProgress"></div>
            </section>
            <section>
                <p id="skillTitle">intercepting: </p>
                <p class="intercepting"><?php echo $row->intercepting; ?></p>
                <p class="rebound">/20</p>
                <div class="intercepting<?php echo $row->speler_id;?>" id="interceptingProgress"></div>
            </section>
            <section>
                <p id="skillTitle">intercepting: </p>
                <p class="intercepting"><?php echo $row->intercepting_tr; ?></p>
                <p class="rebound">/1000</p>
                <div class="intercepting_tr<?php echo $row->speler_id;?>" id="interceptingProgress"></div>
            </section>
            <section>
                <p id="skillTitle">leadership: </p>
                <p class="leadership"><?php echo $row->leadership; ?></p>
                <p class="rebound">/20</p>
                <div class="leadership<?php echo $row->speler_id;?>" id="leadershipProgress"></div>
            </section>
            <section>
                <p id="skillTitle">leadership: </p>
                <p class="leadership"><?php echo $row->leadership_tr; ?></p>
                <p class="rebound">/1000</p>
                <div class="leadership_tr<?php echo $row->speler_id;?>" id="leadershipProgress"></div>
            </section>
        </div>
        <!-- vordering van training --> 
        <!--             <p>vordering</p> --> 
        
    </div>
    <?php }


 ?>
    <div id="myModal" class="reveal-modal"> <a class="close-reveal-modal">&#215;</a> </div>
</div>
</div>
<div class="gameLeft">
    <?php foreach($energie->result() as $row)
{
	$energie = $row->energie;

} ?>
    <h2>Op wat wil je trainen?</h2>
    <input type="hidden" id="teamid" value="<?php echo $this->uri->segment('3');?>"/>
    <input type="hidden" id="energie" value="<?php echo $energie;?>"/>
    <select class="target">
        <option value="stamina" selected="selected">Stamina</option>
        <option value="passing">Passing</option>
        <option value="shotpower">Shotkracht</option>
        <option value="shotprecision">Shotprecisie</option>
        <option value="rebound">Rebound</option>
        <option value="playmaking">Playmaking</option>
        <option value="intercepting">Intercepting</option>
    </select>
    Een training kost 30 van je energiepunten, je hebt momenteel <?php echo $energie; ?> energiepunten.
    <div style="text-decoration:underline; color:blue; cursor: pointer;" id="training">Train nu.</div>
    <h2>spelers rangschikken</h2>
    <p><a id="watchSkills" href="#">skills bekijken</a><a id="hideSkills" style="display: none;" href="#">skills verbergen</a></p>
    <p><a id="watchProgress" href="#">vordering bekijken</a><a id="hideProgress" style="display: none;" href="#">vordering verbergen</a></p>
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
    <div class="chart_container">
        <section>
        <h2>team skills</h2>
        <canvas id="chartTeamSkills" width="350" height="350"> Your web-browser does not support the HTML 5 canvas element. </canvas>
    </div>
    <div>
        <section>
            <h2>laatst getraind op</h2>
            <p>test</p>
            <h2>datum</h2>
            <p>test</p>
        </section>
    </div>
    
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
</div>
<!-- end gameLeft --> 
