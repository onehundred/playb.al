 <div class="game">
    <div class="gameRight">
    <?php if(isset($error)){
    	foreach($error as $erro){ ?>
    	<p id="error"><?php echo $erro;?></p>	
    	
    <?php 	}
    
    } 
    ?>
        <?php
        $edit = $this->uri->segment('4');
//gegevens van users en teams kan hieruit gehaald worden
 foreach($manager->result() as $row)
		{ ?>
		
		<?php if($edit != 'edit'){ ?>
		
		
        <p>Manager: <?php echo $row->gebruikersnaam;?> </p>
        <p>Team: <?php echo $row->naam;?></p>
        <p>Manager sinds: <?php echo $row->datum_creatie;?></p>
        <p>Land: <?php echo $row->land; ?></p>
        <p>
        <?php if($row->afbeelding == null){ ?>
        	<img src="<?php echo base_url();?>img/default_profile.png" alt="profielfoto" ondragstart="return false" />
        <?php }else{ ?>
        	<img src="<?php echo base_url();?>userpics/thumbs/<?php echo $row->afbeelding;?>"/>
        <?php } ?>	
        </p>
        <a href="<?php echo $this->uri->segment('3');?>/edit">Wijzig</a>
		<p>Totaal gespeelde matchen in carrière: <?php echo $row->gespeeld_matchen;?></p>
		<p>Totaal gewonnen matchen in carrière: <?php echo $row->gewonnen_matchen;?></p>
		<p>Totaal verloren matchen in carrière: <?php echo $row->verloren_matchen;?></p>
		<p>Totaal matchen gelijk gespeeld in carrière: <?php echo $row->gelijke_matchen;?></p>

        <?php }else{ ?>
        
      <?php echo form_open_multipart('korfbal/korfbal_manager_update/'.$this->uri->segment('3'));?>

		<p><label>Foto: </label><input type="file" name="userfile" size="20" /></p>
      
        
        <p><label>Land: </label><select name="country">
			<option value="Afghanistan">Afghanistan</option>
			<option value="Albania">Albania</option>
			<option value="Algeria">Algeria</option>
			<option value="American Samoa">American Samoa</option>
			<option value="Andorra">Andorra</option>
			<option value="Angola">Angola</option>
			<option value="Anguilla">Anguilla</option>
			<option value="Antarctica">Antarctica</option>
			<option value="Antigua And Barbuda">Antigua And Barbuda</option>
			<option value="Argentina">Argentina</option>
			<option value="Armenia">Armenia</option>
			<option value="Aruba">Aruba</option>
			<option value="Australia">Australia</option>
			<option value="Austria">Austria</option>
			<option value="Azerbaijan">Azerbaijan</option>
			<option value="Bahamas">Bahamas</option>
			<option value="Bahrain">Bahrain</option>
			<option value="Bangladesh">Bangladesh</option>
			<option value="Barbados">Barbados</option>
			<option value="Belarus">Belarus</option>
			<option value="Belgium" selected="selected">Belgium</option>
			<option value="Belize">Belize</option>
			<option value="Benin">Benin</option>
			<option value="Bermuda">Bermuda</option>
			<option value="Bhutan">Bhutan</option>
			<option value="Bolivia">Bolivia</option>
			<option value="Bosnia And Herzegovina">Bosnia And Herzegovina</option>
			<option value="Botswana">Botswana</option>
			<option value="Bouvet">Bouvet Island</option>
			<option value="Brazil">Brazil</option>
			<option value="Brunei Darussalam">Brunei Darussalam</option>
			<option value="Bulgaria">Bulgaria</option>
			<option value="Burkina Faso">Burkina Faso</option>
			<option value="Burundi">Burundi</option>
			<option value="Cambodia">Cambodia</option>
			<option value="Cameroon">Cameroon</option>
			<option value="Canada">Canada</option>
			<option value="Cape Verde">Cape Verde</option>
			<option value="Cayman Islands">Cayman Islands</option>
			<option value="Central African Republic">Central African Republic</option>
			<option value="Chad">Chad</option>
			<option value="Chile">Chile</option>
			<option value="China">China</option>
			<option value="Christmas Island">Christmas Island</option>
			<option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
			<option value="Colombia">Colombia</option>
			<option value="Comoros">Comoros</option>
			<option value="Congo">Congo</option>
			<option value="Congo, The Democratic Republic Of The">Congo, The Democratic Republic Of The</option>
			<option value="Cook Islands">Cook Islands</option>
			<option value="Costa Rica">Costa Rica</option>
			<option value="Cote D'Ivoire">Cote D'Ivoire</option>
			<option value="Croatia">Croatia</option>
			<option value="Cuba">Cuba</option>
			<option value="Cyprus">Cyprus</option>
			<option value="Czech Republic">Czech Republic</option>
			<option value="Denmark">Denmark</option>
			<option value="Djibouti">Djibouti</option>
			<option value="Dominica">Dominica</option>
			<option value="Dominican Republic">Dominican Republic</option>
			<option value="Ecuador">Ecuador</option>
			<option value="Egypt">Egypt</option>
			<option value="El Salvador">El Salvador</option>
			<option value="Equatorial Guinea">Equatorial Guinea</option>
			<option value="Eritrea">Eritrea</option>
			<option value="Estonia">Estonia</option>
			<option value="Ethiopia">Ethiopia</option>
			<option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
			<option value="Faroe Islands">Faroe Islands</option>
			<option value="Fiji">Fiji</option>
			<option value="Finland">Finland</option>
			<option value="France">France</option>
			<option value="French Guiana">French Guiana</option>
			<option value="French Polynesia">French Polynesia</option>
			<option value="French Southern Territories">French Southern Territories</option>
			<option value="Gabon">Gabon</option>
			<option value="Gambia">Gambia</option>
			<option value="Georgia">Georgia</option>
			<option value="Germany">Germany</option>
			<option value="Ghana">Ghana</option>
			<option value="Gibraltar">Gibraltar</option>
			<option value="Greece">Greece</option>
			<option value="Greenland">Greenland</option>
			<option value="GGrenadaD">Grenada</option>
			<option value="Guadeloupe">Guadeloupe</option>
			<option value="Guam">Guam</option>
			<option value="Guatemala">Guatemala</option>
			<option value="Guernsey">Guernsey</option>
			<option value="Guinea">Guinea</option>
			<option value="Guinea-Bissau">Guinea-Bissau</option>
			<option value="Guyana">Guyana</option>
			<option value="Haiti">Haiti</option>
			<option value="Heard Island And Mcdonald Islands">Heard Island And Mcdonald Islands</option>
			<option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
			<option value="Honduras">Honduras</option>
			<option value="Hong Kong">Hong Kong</option>
			<option value="Hungary">Hungary</option>
			<option value="Iceland">Iceland</option>
			<option value="India">India</option>
			<option value="Indonesia">Indonesia</option>
			<option value="Iran, Islamic Republic Of">Iran, Islamic Republic Of</option>
			<option value="Iraq">Iraq</option>
			<option value="Ireland">Ireland</option>
			<option value="Isle Of Man">Isle Of Man</option>
			<option value="Israel">Israel</option>
			<option value="Italy">Italy</option>
			<option value="Jamaica">Jamaica</option>
			<option value="Japan">Japan</option>
			<option value="Jersey">Jersey</option>
			<option value="Jordan">Jordan</option>
			<option value="Kazakhstan">Kazakhstan</option>
			<option value="Kenya">Kenya</option>
			<option value="Kiribati">Kiribati</option>
			<option value="Korea, Democratic People'S Republic Of">Korea, Democratic People'S Republic Of</option>
			<option value="Korea, Republic Of">Korea, Republic Of</option>
			<option value="Kuwait">Kuwait</option>
			<option value="Kyrgyzstan">Kyrgyzstan</option>
			<option value="Lao People'S Democratic Republic">Lao People'S Democratic Republic</option>
			<option value="Latvia">Latvia</option>
			<option value="Lebanon">Lebanon</option>
			<option value="Lesotho">Lesotho</option>
			<option value="Liberia">Liberia</option>
			<option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
			<option value="Liechtenstein">Liechtenstein</option>
			<option value="Lithuania">Lithuania</option>
			<option value="Luxembourg">Luxembourg</option>
			<option value="Macao">Macao</option>
			<option value="Macedoniaf">Macedoniaf</option>
			<option value="Madagascar">Madagascar</option>
			<option value="Malawi">Malawi</option>
			<option value="Malaysia">Malaysia</option>
			<option value="Maldives">Maldives</option>
			<option value="Mali">Mali</option>
			<option value="Malta">Malta</option>
			<option value="Marshall Islands">Marshall Islands</option>
			<option value="Martinique">Martinique</option>
			<option value="Mauritania">Mauritania</option>
			<option value="Mauritius">Mauritius</option>
			<option value="Mayotte">Mayotte</option>
			<option value="Mexico">Mexico</option>
			<option value="Moldova, Republic Of">Moldova, Republic Of</option>
			<option value="Monaco">Monaco</option>
			<option value="Mongolia">Mongolia</option>
			<option value="Montserrat">Montserrat</option>
			<option value="Morocco">Morocco</option>
			<option value="Mozambique">Mozambique</option>
			<option value="Myanmar">Myanmar</option>
			<option value="Namibia">Namibia</option>
			<option value="Nauru">Nauru</option>
			<option value="Nepal">Nepal</option>
			<option value="Netherlands">Netherlands</option>
			<option value="Netherlands Antilles">Netherlands Antilles</option>
			<option value="New Caledonia">New Caledonia</option>
			<option value="New Zealand">New Zealand</option>
			<option value="Nicaragua">Nicaragua</option>
			<option value="Niger">Niger</option>
			<option value="Nigeria">Nigeria</option>
			<option value="Niue">Niue</option>
			<option value="Norfolk Island">Norfolk Island</option>
			<option value="Northern Mariana Islands">Northern Mariana Islands</option>
			<option value="Norway">Norway</option>
			<option value="Oman">Oman</option>
			<option value="Pakistan">Pakistan</option>
			<option value="Palau">Palau</option>
			<option value="Panama">Panama</option>
			<option value="Papua New Guinea">Papua New Guinea</option>
			<option value="Paraguay">Paraguay</option>
			<option value="Peru">Peru</option>
			<option value="Philippines">Philippines</option>
			<option value="Pitcairn">Pitcairn</option>
			<option value="Poland">Poland</option>
			<option value="Portugal">Portugal</option>
			<option value="Puerto Rico">Puerto Rico</option>
			<option value="Qatar">Qatar</option>
			<option value="Reunion">Reunion</option>
			<option value="Romania">Romania</option>
			<option value="Russian Federation">Russian Federation</option>
			<option value="Rwanda">Rwanda</option>
			<option value="Saint Helena">Saint Helena</option>
			<option value="Saint Kitts And Nevis">Saint Kitts And Nevis</option>
			<option value="Saint Lucia">Saint Lucia</option>
			<option value="Saint Pierre And Miquelon">Saint Pierre And Miquelon</option>
			<option value="Samoa">Samoa</option>
			<option value="San Marino">San Marino</option>
			<option value="Sao Tome And Principe">Sao Tome And Principe</option>
			<option value="Saudi Arabia">Saudi Arabia</option>
			<option value="Senegal">Senegal</option>
			<option value="Serbia And Montenegro">Serbia And Montenegro</option>
			<option value="Seychelles">Seychelles</option>
			<option value="Sierra Leone">Sierra Leone</option>
			<option value="Singapore">Singapore</option>
			<option value="Slovakia">Slovakia</option>
			<option value="Slovenia">Slovenia</option>
			<option value="Solomon Islands">Solomon Islands</option>
			<option value="Somalia">Somalia</option>
			<option value="South Africa">South Africa</option>
			<option value="Spain">Spain</option>
			<option value="Sri Lanka">Sri Lanka</option>
			<option value="Sudan">Sudan</option>
			<option value="Suriname">Suriname</option>
			<option value="Svalbard And Jan Mayen">Svalbard And Jan Mayen</option>
			<option value="Swaziland">Swaziland</option>
			<option value="Sweden">Sweden</option>
			<option value="Switzerland">Switzerland</option>
			<option value="Syrian Arab Republic">Syrian Arab Republic</option>
			<option value="Taiwan">Taiwan</option>
			<option value="Tajikistan">Tajikistan</option>
			<option value="Tanzania, United Republic Of">Tanzania, United Republic Of</option>
			<option value="Thailand">Thailand</option>
			<option value="Timor-Leste">Timor-Leste</option>
			<option value="Togo">Togo</option>
			<option value="Tokelau">Tokelau</option>
			<option value="Tonga">Tonga</option>
			<option value="Trinidad And Tobago">Trinidad And Tobago</option>
			<option value="Tunisia">Tunisia</option>
			<option value="Turkey">Turkey</option>
			<option value="Turkmenistan">Turkmenistan</option>
			<option value="Turks And Caicos Islands">Turks And Caicos Islands</option>
			<option value="Tuvalu">Tuvalu</option>
			<option value="Uganda">Uganda</option>
			<option value="Ukraine">Ukraine</option>
			<option value="United Arab Emirates">United Arab Emirates</option>
			<option value="United Kingdom">United Kingdom</option>
			<option value="United States">United States</option>
			<option value="Uruguay">Uruguay</option>
			<option value="Uzbekistan">Uzbekistan</option>
			<option value="Vanuatu">Vanuatu</option>
			<option value="Venezuela">Venezuela</option>
			<option value="Viet Nam">Viet Nam</option>
			<option value="Virgin Islands, British">Virgin Islands, British</option>
			<option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
			<option value="Wallis And Futuna">Wallis And Futuna</option>
			<option value="Western Sahara">Western Sahara</option>
			<option value="Yemen">Yemen</option>
			<option value="Zambia">Zambia</option>
			<option value="Zimbabwe">Zimbabwe</option>            
	</select>
</p>
<p><input type="submit"></p>
</form>
<?php } ?>

        <?php }?>
    </div> <!-- end gameRight -->
    <aside>
        <div class="gameLeft">
            <div>
                <section>
                <figure class="icon" id="gameCup"></figure>
                    <h2>bekers</h2>
                    <!-- if bekers = 0 -->
                    <p>je hebt nog geen bekers gewonnen</p>
                    <!-- else -->
                    <p>beker 1</p>
                    <p>beker 2</p>
                </section>
            </div>
           
            <script>

$.fn.cycle.defaults.timeout = 6000;
$(function() {

    
    $('#s5').show().after('<div id="galleryNav" class="galleryNav">').cycle({
        fx:     'fade',
        speed:  500,
        timeout: 5000,
        next:   '#s5', 
        pager:  '#galleryNav'
    });
});
</script>
            <div>
                <section>
                <figure class="icon" id="gameMedaille"></figure>
                    <h2>achievements</h2>
                         <div id="s5" class="pics">
                 			
                  			  <!-- if achievements = 0 -->
			                    <?php if($achievements->result() == null){ ?>
			                   	 <p>je hebt nog geen achievements behaald</p>
			                    <!-- else -->
			                    <?php }else{ ?>
			                    <?php foreach($achievements->result() as $row){ ?>
                   						<img width="68px" height="50px" src="<?php echo base_url()?>/img/achievements/<?php echo $row->afbeelding;?>" ondragstart="return false"/>
								<?php
										}
			 						} ?>
          <!--  <img src="<?php echo base_url();?>img/slider1.png" width="68" height="32" ondragstart="return false" />
            <img src="http://cloud.github.com/downloads/malsup/cycle/beach2.jpg" width="68" height="32" ondragstart="return false" />
            <img src="http://cloud.github.com/downloads/malsup/cycle/beach3.jpg" width="68" height="32" ondragstart="return false" />
            <img src="http://cloud.github.com/downloads/malsup/cycle/beach4.jpg" width="68" height="32" ondragstart="return false" />
            <img src="http://cloud.github.com/downloads/malsup/cycle/beach5.jpg" width="68" height="32" ondragstart="return false" />
            <img src="http://cloud.github.com/downloads/malsup/cycle/beach6.jpg" width="68" height="32" ondragstart="return false" />
            <img src="http://cloud.github.com/downloads/malsup/cycle/beach7.jpg" width="68" height="32" ondragstart="return false" />
            <img src="http://cloud.github.com/downloads/malsup/cycle/beach8.jpg" width="68" height="32" ondragstart="return false" />-->
        </div>

     
                </section>
            </div>
        </div> <!-- end gameLeft -->
    </aside>
</div> <!-- end game -->
