<script src="<?php echo base_url();?>js/korfbal/training.js"></script>

<div class="game">
    <div class="gameRight">
        <div id="container">
            <?php
foreach($training->result() as $row){

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
            <header class="playerHeader">
                <p class="number"><?php echo $row->rugnummer;?></p>
                <span class="name"><a href="../korfbal_player/<?php echo $team_id;?>/<?php echo $row->speler_id;?>">
                <p class="firstname"><?php echo $row->voornaam;?></p>
                <p class="lastname"><?php echo $row->achternaam;?></p>
                </a> </span>
                <p class="gender">
                    <img src="<?php echo base_url();?><?php $geslacht = $row->geslacht; if($geslacht== "female"){ ?>img/female.png<?php }else{?>img/male.png<?php } ?>" ondragstart= "return false" />
                </p>
                <br />
                <p class="age"><?php echo $row->leeftijd; ?> jaar oud</p>
                <p class="price"><?php echo ($row->rebound * 6250) + ($row->stamina * 3125) + ($row->passing * 6250 ) + ($row->shotprecision * 400) + ($row->shotpower * 4000) + ($row->intercepting * 7500) + ($row->leadership * 1000) + ($row->playmaking * 6250);?> &euro;</p>
            </header>
            <!-- end playerHeader -->
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
            <!-- end rightProgress -->
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

            <!-- end leftProgress --> 
            <!-- vordering van training --> 
            <!--             <p>vordering</p> --> 
            
        </div>
        <!-- end container -->
        <?php } ?>
    </div>
    <!-- end gameRight --> 
</div>

<aside>
    <div class="gameLeft">
        <?php foreach($energie->result() as $row)
{
	$energie = $row->energie;

} ?>
        <?php if(!isset($alien)){ ?>
        <div class="fillLeft">
            <section>
                <figure class="icon" id="gameTraining"></figure>
                <h2>training</h2>
                <input type="hidden" id="teamid" value="<?php echo $this->uri->segment('3');?>"/>
                <input type="hidden" id="energie" value="<?php echo $energie;?>"/>
                <p class="entry">trainen kost 30 energiepunten</p>
                <p class="entry"> je hebt momenteel <?php echo $energie; ?> energiepunten.</p>
                <p>
                    <select class="target" id="trainingSkill">
                        <option value="stamina" selected="selected">Stamina</option>
                        <option value="passing">Passing</option>
                        <option value="shotpower">Shotkracht</option>
                        <option value="shotprecision">Shotprecisie</option>
                        <option value="rebound">Rebound</option>
                        <option value="playmaking">Playmaking</option>
                        <option value="intercepting">Intercepting</option>
                    </select>
                </p>
                <p id="trainingButton"><a class="question" id="training">trainen</a></p>
            </section>
        </div>
        <?php } ?>
        <div id="sortPlayers" class="fillLeft">
            <section class="sortingFeatures">
                <figure class="icon" id="gamePlayers"></figure>
                <h2>spelers</h2>
                <figure class="icon" id="gameViewSmall"></figure>
                <p id="sortView"><a id="watchSkills" href="#">skills bekijken</a><a id="hideSkills" style="display: none;" href="#">skills verbergen</a></p>
                <figure class="icon" id="gameViewSmall"></figure>
                <p id="sortView"><a id="watchProgress" href="#">vordering bekijken</a><a id="hideProgress" style="display: none;" href="#">vordering verbergen</a></p>
                <ul id="filters">
                    <figure class="icon" id="gameViewSmall"></figure>
                    <p id="sortView"><a href="#" data-filter=".playerFemale">vrouwen</a></p>
                    <figure class="icon" id="gameViewSmall"></figure>
                    <p id="sortView"><a href="#" data-filter=".playerMale">mannen</a></p>
                    <figure class="icon" id="gameViewSmall"></figure>
                    <p id="sortView"> <a href="#" data-filter="*">mannen & vrouwen</a></p>
                </ul>
                <p id="breakline"></p>
                <ul id="sort" class="sort option-set">
                    <article class="sortSkill">
                        <li class="sort asc option-set floated clearfix"> <a href="#number" class="selected">
                            <figure class="icon" id="gameDown"></figure>
                            </a></li>
                        <a href="#number" id="playerSort">
                        <figure class="icon" id="gameUp"></figure>
                        rugnummer </a> </article>
                    <article class="sortSkill">
                        <li class="sort asc option-set floated clearfix"> <a href="#age" class="selected">
                            <figure class="icon" id="gameDown"></figure>
                            </a> </li>
                        <a href="#age">
                        <figure class="icon" id="gameUp"></figure>
                        leeftijd</a> </article>
                    <article class="sortSkill">
                        <li class="sort asc option-set floated clearfix"> <a href="#price" class="selected">
                            <figure class="icon" id="gameDown"></figure>
                            </a></li>
                        <a href="#price">
                        <figure class="icon" id="gameUp"></figure>
                        prijs</a> </article>
                    <p></p>
                    <ul class="sortTeamLeft">
                        <article class="sortSkill">
                            <li class="sort asc option-set floated clearfix"> <a href="#passing" class="selected">
                                <figure class="icon" id="gameDown"></figure>
                                </a> </li>
                            <a href="#passing">
                            <figure class="icon" id="gameUp"></figure>
                            passing</a> </article>
                        <article class="sortSkill">
                            <li class="sort asc option-set floated clearfix"> <a href="#shotpower" class="selected">
                                <figure class="icon" id="gameDown"></figure>
                                </a> </li>
                            <a href="#shotpower">
                            <figure class="icon" id="gameUp"></figure>
                            shotpower</a> </article>
                        <article class="sortSkill">
                            <li class="sort asc option-set floated clearfix"> <a href="#intercepting" class="selected">
                                <figure class="icon" id="gameDown"></figure>
                                </a> </li>
                            <a href="#intercepting">
                            <figure class="icon" id="gameUp"></figure>
                            intercepting</a> </article>
                        <article class="sortSkill">
                            <li class="sort asc option-set floated clearfix"> <a href="#leadership" class="selected">
                                <figure class="icon" id="gameDown"></figure>
                                </a> </li>
                            <a href="#leadership">
                            <figure class="icon" id="gameUp"></figure>
                            leadership</a> </article>
                    </ul>
                    <!-- end sortTeamLeft -->
                    <ul class="sortTeamRight">
                        <article class="sortSkill">
                            <li class="sort asc option-set floated clearfix"> <a href="#rebound">
                                <figure class="icon" id="gameDown"></figure>
                                </a> </li>
                            <a href="#rebound" class="selected">
                            <figure class="icon" id="gameUp"></figure>
                            rebound</a> </article>
                        <article class="sortSkill">
                            <li class="sort asc option-set floated clearfix"> <a href="#stamina" class="selected">
                                <figure class="icon" id="gameDown"></figure>
                                </a> </li>
                            <a href="#stamina">
                            <figure class="icon" id="gameUp"></figure>
                            stamina</a> </article>
                        <article class="sortSkill">
                            <li class="sort asc option-set floated clearfix"> <a href="#shotprecision" class="selected">
                                <figure class="icon" id="gameDown"></figure>
                                </a> </li>
                            <a href="#shotprecision">
                            <figure class="icon" id="gameUp"></figure>
                            shotprecsion</a> </article>
                        <article class="sortSkill">
                            <li class="sort asc option-set floated clearfix"> <a href="#playmaking" class="selected">
                                <figure class="icon" id="gameDown"></figure>
                                </a> </li>
                            <a href="#playmaking">
                            <figure class="icon" id="gameUp"></figure>
                            playmaking</a> </article>
                    </ul>
                    <!-- end sortTeamRight -->
                </ul>
                
                <!-- end ul id sort --> 
            </section>
        </div>
        <div class="chart_container fillLeft">
            <section>
                <figure class="icon" id="gameGraph"></figure>
                <h2>team skills</h2>
                <p>
                    <canvas id="chartTeamSkills" width="360" height="350">jammer, je browser ondersteunt geen canvas.</canvas>
                </p>
            </section>
        </div>
        
        <!--
/*
<?php if(!isset($alien)){ ?>
        <div>
            <section>
                <figure class="icon" id="gameCalendar"></figure>
                <h2>laatst getraind op</h2>
                <p>test</p>
                <p>datum</p>
                <p>test</p>
            </section>
        </div>
        <?php } ?>
*/
-->
        <input type="hidden" id="teamid" value="<?php echo $this->uri->segment(3);?>"/>
        
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
</aside>
<div id="myModal" class="reveal-modal"> <a class="close-reveal-modal">
    <img src="<?php echo base_url();?>img/close.png" />
    </a> </div>
</div>
<!-- end game --> 
