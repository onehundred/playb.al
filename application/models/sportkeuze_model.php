<?php class Sportkeuze_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
       
    }
    
    function get_teamid()
    {
    
    
    }
    //functie die kijkt of er al een korfbalteam bestaat
    function check_korfbal($id)
    {
    	
    	
    	$this->db->where('FK_user_id',$id );
    	
    	$query = $this->db->get('korf_teams');
    	
    	
    	if($query->num_rows==1)
    	{
    			return true;
    	}

    }
    
    function get_rankschikking($userid)
    {
    	$data = array();
    	
    	$this->db->select('*');
    	$this->db->from('users');
    	$this->db->join('korf_teams','FK_user_id = user_id');
    	$this->db->join('korf_divisies', 'FK_division_id = divisie_id');
    	$this->db->where('user_id',$userid);
    	$query = $this->db->get();
    	
    	foreach($query->result() as $row){
    		$divid = $row->divisie_id;
    		$teamnaam = $row->naam;
    		$data['divisie'] = $row->divisie .'.'.$row->sub_divisie; 
    	}
    	
    	if(isset($divid)){
    	
    	$this->db->select('*');
    	$this->db->from('korf_teams');
    	$this->db->where('FK_division_id', $divid);
    	$this->db->order_by('divisiepunten', 'DESC');
    	$query2 = $this->db->get();
    	
    	
    	$i = 1;
    	foreach($query2->result() as $crow)
    	{
    		if($crow->naam == $teamnaam){
    			break;
    		
    		}else{	
    			$i++;
    		}	
    	}
    	
    	$data['positie'] = $i;
    	
    	return $data;
    	}
    
    }
    
    //functie die kijkt of er al een volleybalteam bestaat
    function check_volleybal($id)
    {
    
    	$this->db->where('FK_user_id',$id );
    	
    	$query = $this->db->get('vol_teams');
    	
    	
    	if($query->num_rows==1)
    	{
    			return true;
    	}

    }
    
    //functie die kijkt of er al een basketbalteam bestaat
    function check_basketbal($id)
    {
    	$this->db->where('FK_user_id',$id );
    	
    	$query = $this->db->get('bas_teams');
    	
    	
    	if($query->num_rows==1)
    	{
    			return true;
    	}

    
    }
    
    
    function check_teamnaam($teamnaam)
    {
    	$this->db->where('naam', $teamnaam);
		$query = $this->db->get('korf_teams');
		
		if($query->num_rows() != 0){
			return false;
		
		}else{
			return true;
		}
    
    }
    //maakt het korfbalteam aan
    function create_korfbalteam($teamnaam)
    {
    
    	$user_id = $this->session->userdata('user_id');    	
    	$mdate =  date('Y-m-d h:i:s');
    	
    	$this->db->select('team_id');
    	$this->db->where('bot', '0');
    	$this->db->order_by('team_id','desc');
    	$query = $this->db->get('korf_teams');
    	
    	
    	 foreach($query->result() as $row)
    	 {
    	 	$teamid = $row->team_id;
    	 
    	 }   	
    	    	
    	    	
    	$new_team_update_data = array(
    		'naam' => $teamnaam,
    		'FK_user_id' => $user_id,
    		'startdatum' => $mdate, 
    		'bot' => '1'
    	
    	);
    	
    	
    	$this->db->where('team_id', $teamid);
    	$update = $this->db->update('korf_teams', $new_team_update_data);
    	return $update;			
    }
    
    //maakt het korfbalstadion aan
    function create_korfbalstadion($stadionnaam)
    {
    
    $user_id = $this->session->userdata('user_id');
    	
    	$this->db->where('FK_user_id', $user_id);
    	$this->db->select('team_id');
    	$teamidquery = $this->db->get('korf_teams');
    	
    	
    	foreach($teamidquery->result() as $row)
    	{
    		$team_id = $row->team_id;
    	
    	}
    	
    	$new_stadion_insert_data = array(
    		'naam' => $stadionnaam,
    		'plaatsen_a' => rand(500,2000), 
    		'FK_team_id' => $team_id
    		
    	
    	);
    	
    	$this->db->where('FK_team_id', $team_id);
    	$insert = $this->db->insert('korf_stadion', $new_stadion_insert_data);
    	
    }
    
    
    function create_korfbalfinancien()
    {
    	$cron = $this->db->get('korf_cron');
		foreach($cron->result() as $row)
		{
			$week = $row->week;
			$seizoen = $row->seizoen;
		}
    $user_id = $this->session->userdata('user_id');
    	
    	$this->db->where('FK_user_id', $user_id);
    	$this->db->select('team_id');
    	$teamidquery = $this->db->get('korf_teams');
    	
    	
    	foreach($teamidquery->result() as $row)
    	{
    		$team_id = $row->team_id;
    	
    	}
		
		
    	$new_financien_insert_data = array(
    		'totaal' => 500000,
    		'FK_team_id' => $team_id,
    		'week' => $week,
    		'seizoen' => $seizoen
    		
    	
    	);
    	
    	$this->db->where('FK_team_id', $team_id);
    	$insert = $this->db->insert('korf_financien', $new_financien_insert_data);
    
    
    }
    
    //functie om een speler(man) aan te maken
    function create_korfbalplayer_man(){
    	$user_id = $this->session->userdata('user_id');
    	
    	$this->db->where('FK_user_id', $user_id);
    	$this->db->select('team_id');
    	$teamidquery = $this->db->get('korf_teams');
    	
    	
    	foreach($teamidquery->result() as $row)
    	{
    		$team_id = $row->team_id;
    	
    	}
    	
    	
    	    	$voornamen = array(
    					
    					'JAMES',               
						'JOHN',          
						'ROBERT',        
						'MICHAEL',       
						'WILLIAM',      
						'DAVID',         
						'RICHARD',              
						'CHARLES',              
						'JOSEPH',               
						'THOMAS',              
						'CHRISTOPHER',         
						'DANIEL',              
						'PAUL',                
						'MARK',                
						'DONALD',              
						'GEORGE',              
						'KENNETH',             
						'STEVEN',              
						'EDWARD',              
						'BRIAN',               
						'RONALD',              
						'ANTHONY',             
						'KEVIN',               
						'JASON',               
						'MATTHEW',             
						'GARY',                
						'TIMOTHY',             
						'JOSE',                
						'LARRY',               
						'JEFFREY',             
						'FRANK',               
						'SCOTT',               
						'ERIC',                
						'STEPHEN',             
						'ANDREW',              
						'RAYMOND',             
						'GREGORY',             
						'JOSHUA',              
						'JERRY',               
						'DENNIS',              
						'WALTER',              
						'PATRICK',             
						'PETER',               
						'HAROLD',              
						'DOUGLAS',             
						'HENRY',               
						'CARL',                
						'ARTHUR',              
						'RYAN',                
						'ROGER',               
						'JOE',                 
						'JUAN',                
						'JACK',                
						'ALBERT',              
						'JONATHAN',            
						'JUSTIN',              
						'TERRY',               
						'GERALD',              
						'KEITH',               
						'SAMUEL',              
						'WILLIE',              
						'RALPH',               
						'LAWRENCE',            
						'NICHOLAS',            
						'ROY',                 
						'BENJAMIN',            
						'BRUCE',               
						'BRANDON',             
						'ADAM',                
						'HARRY',               
						'FRED',                
						'WAYNE',               
						'BILLY',               
						'STEVE',               
						'LOUIS',               
						'JEREMY',              
						'AARON',               
						'RANDY',               
						'HOWARD',              
						'EUGENE',              
						'CARLOS',              
						'RUSSELL',             
						'BOBBY',               
						'VICTOR',              
						'MARTIN',              
						'ERNEST',              
						'PHILLIP',             
						'TODD',                
						'JESSE',               
						'CRAIG',               
						'ALAN',                
						'SHAWN',               
						'CLARENCE',            
						'SEAN',                
						'PHILIP',              
						'CHRIS',               
						'JOHNNY',              
						'EARL',                
						'JIMMY',               
						'ANTONIO',            
						'DANNY',              
						'BRYAN',              
						'TONY',               
						'LUIS',               
						'MIKE',               
						'STANLEY',            
						'LEONARD',            
						'NATHAN',             
						'DALE',               
						'MANUEL',             
						'RODNEY',             
						'CURTIS',             
						'NORMAN',             
						'ALLEN',              
						'MARVIN',             
						'VINCENT',            
						'GLENN',              
						'JEFFERY',            
						'TRAVIS',             
						'JEFF',               
						'CHAD',               
						'JACOB',              
						'LEE',                
						'MELVIN',             
						'ALFRED',             
						'KYLE',               
						'FRANCIS',            
						'BRADLEY',            
						'JESUS',              
						'HERBERT',            
						'FREDERICK',          
						'RAY',                
						'JOEL',               
						'EDWIN',              
						'DON',                
						'EDDIE',              
						'RICKY',              
						'TROY',               
						'RANDALL',            
						'BARRY',              
						'ALEXANDER',          
						'BERNARD',            
						'MARIO',              
						'LEROY',              
						'FRANCISCO',          
						'MARCUS',             
						'MICHEAL',            
						'THEODORE',           
						'CLIFFORD',           
						'MIGUEL',             
						'OSCAR',              
						'JAY',                
						'JIM',                
						'TOM',                
						'CALVIN',             
						'ALEX',               
						'JON',                
						'RONNIE',             
						'BILL',               
						'LLOYD',              
						'TOMMY',              
						'LEON',               
						'DEREK',              
						'WARREN',             
						'DARRELL',            
						'JEROME',             
						'FLOYD',              
						'LEO',                
						'ALVIN',              
						'TIM',                
						'WESLEY',             
						'GORDON',             
						'DEAN',               
						'GREG',               
						'JORGE',              
						'DUSTIN',             
						'PEDRO',              
						'DERRICK',            
						'DAN',                
						'LEWIS',              
						'ZACHARY',            
						'COREY',              
						'HERMAN',             
						'MAURICE',            
						'VERNON',             
						'ROBERTO',            
						'CLYDE',              
						'GLEN',               
						'HECTOR',             
						'SHANE',              
						'RICARDO',            
						'SAM',                
						'RICK',               
						'LESTER',             
						'BRENT',              
						'RAMON',              
						'CHARLIE',            
						'TYLER',              
						'GILBERT',            
						'GENE',               
						'MARC',               
						'REGINALD',           
						'RUBEN',              
						'BRETT',              
						'ANGEL',              
						'NATHANIEL',          
						'RAFAEL',             
						'LESLIE',             
						'EDGAR',              
						'MILTON',             
						'RAUL',               
						'BEN',                
						'CHESTER',            
						'CECIL',              
						'DUANE',              
						'FRANKLIN',           
						'ANDRE',              
						'ELMER',              
						'BRAD',               
						'GABRIEL',            
						'RON',                
						'MITCHELL',           
						'ROLAND',             
						'ARNOLD',             
						'HARVEY',             
						'JARED',              
						'ADRIAN',             
						'KARL',               
						'CORY',               
						'CLAUDE',             
						'ERIK',               
						'DARRYL',             
						'JAMIE',              
						'NEIL',               
						'JESSIE',             
						'CHRISTIAN',          
						'JAVIER',             
						'FERNANDO',           
						'CLINTON',            
						'TED',                
						'MATHEW',             
						'TYRONE',             
						'DARREN',             
						'LONNIE',             
						'LANCE',              
						'CODY',               
						'JULIO',              
						'KELLY',              
						'KURT',               
						'ALLAN',              
						'NELSON',             
						'GUY',                
						'CLAYTON',            
						'HUGH',               
						'MAX',                
						'DWAYNE',             
						'DWIGHT',             
						'ARMANDO',            
						'FELIX',              
						'JIMMIE',             
						'EVERETT',            
						'JORDAN',             
						'IAN',                
						'WALLACE',            
						'KEN',                
						'BOB',                
						'JAIME',              
						'CASEY',              
						'ALFREDO',            
						'ALBERTO',            
						'DAVE',               
						'IVAN',               
						'JOHNNIE',            
						'SIDNEY',             
						'BYRON',              
						'JULIAN',             
						'ISAAC',              
						'MORRIS',             
						'CLIFTON',            
						'WILLARD',            
						'DARYL',              
						'ROSS',               
						'VIRGIL',             
						'ANDY',               
						'MARSHALL',           
						'SALVADOR',           
						'PERRY',              
						'KIRK',               
						'SERGIO',             
						'MARION',             
						'TRACY',              
						'SETH',               
						'KENT',               
						'TERRANCE',           
						'RENE',               
						'EDUARDO',            
						'TERRENCE',           
						'ENRIQUE',            
						'FREDDIE',            
						'WADE',               
						'AUSTIN',             
						'STUART',             
						'FREDRICK',           
						'ARTURO',             
						'ALEJANDRO',          
						'JACKIE',             
						'JOEY',               
						'NICK',               
						'LUTHER',             
						'WENDELL',            
						'JEREMIAH',           
						'EVAN',               
						'JULIUS',             
						'DANA',               
						'DONNIE',             
						'OTIS',               
						'SHANNON',            
						'TREVOR',             
						'OLIVER',             
						'LUKE',               
						'HOMER',              
						'GERARD',             
						'DOUG',               
						'KENNY',              
						'HUBERT',             
						'ANGELO',             
						'SHAUN',              
						'LYLE',               
						'MATT',               
						'LYNN',               
						'ALFONSO',            
						'ORLANDO',            
						'REX',                
						'CARLTON',            
						'ERNESTO',            
						'CAMERON',            
						'NEAL',               
						'PABLO',              
						'LORENZO',            
						'OMAR',               
						'WILBUR',             
						'BLAKE',              
						'GRANT',              
						'HORACE',             
						'RODERICK',           
						'KERRY',              
						'ABRAHAM',            
						'WILLIS',             
						'RICKEY',             
						'JEAN',               
						'IRA',                
						'ANDRES',             
						'CESAR',              
						'JOHNATHAN',          
						'MALCOLM',            
						'RUDOLPH',            
						'DAMON',              
						'KELVIN',             
						'RUDY',               
						'PRESTON',            
						'ALTON',              
						'ARCHIE',             
						'MARCO',              
						'WM',                 
						'PETE',               
						'RANDOLPH',           
						'GARRY',              
						'GEOFFREY',           
						'JONATHON',           
						'FELIPE',             
						'BENNIE',             
						'GERARDO',            
						'ED',                 
						'DOMINIC',            
						'ROBIN',              
						'LOREN',              
						'DELBERT',            
						'COLIN',              
						'GUILLERMO',          
						'EARNEST',            
						'LUCAS',              
						'BENNY',              
						'NOEL',               
						'SPENCER',            
						'RODOLFO',            
						'MYRON',              
						'EDMUND',             
						'GARRETT',            
						'SALVATORE',          
						'CEDRIC',             
						'LOWELL',             
						'GREGG',              
						'SHERMAN',            
						'WILSON',             
						'DEVIN',              
						'SYLVESTER',          
						'KIM',                
						'ROOSEVELT',          
						'ISRAEL',             
						'JERMAINE',           
						'FORREST',            
						'WILBERT',            
						'LELAND',             
						'SIMON',              
						'GUADALUPE',          
						'CLARK',              
						'IRVING',             
						'CARROLL',            
						'BRYANT',             
						'OWEN',               
						'RUFUS',              
						'WOODROW',            
						'SAMMY',              
						'KRISTOPHER',         
						'MACK',               
						'LEVI',               
						'MARCOS',             
						'GUSTAVO',            
						'JAKE',               
						'LIONEL',             
						'MARTY',              
						'TAYLOR',             
						'ELLIS',              
						'DALLAS',             
						'GILBERTO',           
						'CLINT',              
						'NICOLAS',            
						'LAURENCE',           
						'ISMAEL',             
						'ORVILLE',            
						'DREW',               
						'JODY',               
						'ERVIN',              
						'DEWEY',              
						'AL',                 
						'WILFRED',            
						'JOSH',               
						'HUGO',               
						'IGNACIO',            
						'CALEB',              
						'TOMAS',              
						'SHELDON',            
						'ERICK',              
						'FRANKIE',            
						'STEWART',            
						'DOYLE',              
						'DARREL',             
						'ROGELIO',            
						'TERENCE',            
						'SANTIAGO',           
						'ALONZO',             
						'ELIAS',              
						'BERT',               
						'ELBERT',             
						'RAMIRO',             
						'CONRAD',             
						'PAT',                
						'NOAH',               
						'GRADY',              
						'PHIL',               
						'CORNELIUS',          
						'LAMAR',              
						'ROLANDO',            
						'CLAY',               
						'PERCY',              
						'DEXTER',             
						'BRADFORD',           
						'MERLE',              
						'DARIN',              
						'AMOS',               
						'TERRELL',            
						'MOSES',              
						'IRVIN',              
						'SAUL',               
						'ROMAN',              
						'DARNELL',            
						'RANDAL',             
						'TOMMIE',             
						'TIMMY',              
						'DARRIN',             
						'WINSTON',            
						'BRENDAN',            
						'TOBY',               
						'VAN',                
						'ABEL',               
						'DOMINICK',           
						'BOYD',               
						'COURTNEY',           
						'JAN',                
						'EMILIO',             
						'ELIJAH',             
						'CARY',               
						'DOMINGO',            
						'SANTOS',             
						'AUBREY',             
						'EMMETT',             
						'MARLON',             
						'EMANUEL',            
						'JERALD',             
						'EDMOND',             
						'EMIL',               
						'DEWAYNE',            
						'WILL',               
						'OTTO',               
						'TEDDY',              
						'REYNALDO',           
						'BRET',               
						'MORGAN',             
						'JESS',               
						'TRENT',              
						'HUMBERTO',           
						'EMMANUEL',           
						'STEPHAN',            
						'LOUIE',              
						'VICENTE',            
						'LAMONT',             
						'STACY',              
						'GARLAND',            
						'MILES',              
						'MICAH',              
						'EFRAIN',             
						'BILLIE',             
						'LOGAN',              
						'HEATH',              
						'RODGER',             
						'HARLEY',             
						'DEMETRIUS',          
						'ETHAN',              
						'ELDON',              
						'ROCKY',              
						'PIERRE',             
						'JUNIOR',             
						'FREDDY',             
						'ELI',                
						'BRYCE',              
						'ANTOINE',            
						'ROBBIE',             
						'KENDALL',            
						'ROYCE',              
						'STERLING',           
						'MICKEY',             
						'CHASE',              
						'GROVER',             
						'ELTON',              
						'CLEVELAND',          
						'DYLAN',              
						'CHUCK',              
						'DAMIAN',             
						'REUBEN',             
						'STAN',               
						'AUGUST',             
						'LEONARDO',           
						'JASPER',             
						'RUSSEL',             
						'ERWIN',              
						'BENITO',             
						'HANS',               
						'MONTE',              
						'BLAINE',             
						'ERNIE',              
						'CURT',               
						'QUENTIN',            
						'AGUSTIN',            
						'MURRAY',             
						'JAMAL',              
						'DEVON',              
						'ADOLFO',             
						'HARRISON',           
						'TYSON',              
						'BURTON',             
						'BRADY',              
						'ELLIOTT',            
						'WILFREDO',           
						'BART',               
						'JARROD',             
						'VANCE',              
						'DENIS',              
						'DAMIEN',             
						'JOAQUIN',            
						'HARLAN',             
						'DESMOND',            
						'ELLIOT',             
						'DARWIN',             
						'ASHLEY',             
						'GREGORIO',           
						'BUDDY',              
						'XAVIER',             
						'KERMIT',             
						'ROSCOE',             
						'ESTEBAN',            
						'ANTON',              
						'SOLOMON',            
						'SCOTTY',             
						'NORBERT',            
						'ELVIN',              
						'WILLIAMS',           
						'NOLAN',              
						'CAREY',              
						'ROD',                
						'QUINTON',            
						'HAL',                
						'BRAIN',              
						'ROB',                
						'ELWOOD',             
						'KENDRICK',           
						'DARIUS',             
						'MOISES',             
						'SON',                
						'MARLIN',             
						'FIDEL',              
						'THADDEUS',           
						'CLIFF',              
						'MARCEL',             
						'ALI',                
						'JACKSON',            
						'RAPHAEL',            
						'BRYON',              
						'ARMAND',             
						'ALVARO',             
						'JEFFRY',             
						'DANE',               
						'JOESPH',             
						'THURMAN',            
						'NED',                
						'SAMMIE',             
						'RUSTY',              
						'MICHEL',             
						'MONTY',              
						'RORY',               
						'FABIAN',             
						'REGGIE',             
						'MASON',              
						'GRAHAM',             
						'KRIS',               
						'ISAIAH',             
						'VAUGHN',             
						'GUS',                
						'AVERY',              
						'LOYD',               
						'DIEGO',              
						'ALEXIS',             
						'ADOLPH',             
						'NORRIS',             
						'MILLARD',            
						'ROCCO',              
						'GONZALO',            
						'DERICK',             
						'RODRIGO',            
						'GERRY',              
						'STACEY',             
						'CARMEN',             
						'WILEY',              
						'RIGOBERTO',          
						'ALPHONSO',           
						'TY',                 
						'SHELBY',             
						'RICKIE',             
						'NOE',                
						'VERN',               
						'BOBBIE',             
						'REED',               
						'JEFFERSON',          
						'ELVIS',              
						'BERNARDO',           
						'MAURICIO',           
						'HIRAM',              
						'DONOVAN',            
						'BASIL',              
						'RILEY',              
						'OLLIE',              
						'NICKOLAS',           
						'MAYNARD',            
						'SCOT',               
						'VINCE',              
						'QUINCY',             
						'EDDY',               
						'SEBASTIAN',          
						'FEDERICO',           
						'ULYSSES',            
						'HERIBERTO',          
						'DONNELL',            
						'COLE',               
						'DENNY',              
						'DAVIS',              
						'GAVIN',              
						'EMERY',              
						'WARD',               
						'ROMEO',              
						'JAYSON',             
						'DION',               
						'DANTE',              
						'CLEMENT',            
						'COY',                
						'ODELL',              
						'MAXWELL',            
						'JARVIS',             
						'BRUNO',              
						'ISSAC',              
						'MARY',               
						'DUDLEY',             
						'BROCK',              
						'SANFORD',            
						'COLBY',              
						'CARMELO',            
						'BARNEY',             
						'NESTOR',             
						'HOLLIS',             
						'STEFAN',             
						'DONNY',              
						'ART',                
						'LINWOOD',            
						'BEAU',               
						'WELDON',             
						'GALEN',              
						'ISIDRO',             
						'TRUMAN',             
						'DELMAR',             
						'JOHNATHON',          
						'SILAS',              
						'FREDERIC',           
						'DICK',               
						'KIRBY',              
						'IRWIN',              
						'CRUZ',               
						'MERLIN',             
						'MERRILL',            
						'CHARLEY',            
						'MARCELINO',          
						'LANE',               
						'HARRIS',             
						'CLEO',               
						'CARLO',              
						'TRENTON',            
						'KURTIS',             
						'HUNTER',             
						'AURELIO',            
						'WINFRED',            
						'VITO',               
						'COLLIN',             
						'DENVER',             
						'CARTER',             
						'LEONEL',             
						'EMORY',              
						'PASQUALE',           
						'MOHAMMAD',           
						'MARIANO',            
						'DANIAL',             
						'BLAIR',              
						'LANDON',             
						'DIRK',               
						'BRANDEN',            
						'ADAN',               
						'NUMBERS',            
						'CLAIR',              
						'BUFORD',             
						'GERMAN',             
						'BERNIE',             
						'WILMER',             
						'JOAN',               
						'EMERSON',            
						'ZACHERY',            
						'FLETCHER',           
						'JACQUES',            
						'ERROL',              
						'DALTON',             
						'MONROE',             
						'JOSUE',              
						'DOMINIQUE',          
						'EDWARDO',            
						'BOOKER',             
						'WILFORD',            
						'SONNY',              
						'SHELTON',            
						'CARSON',             
						'THERON',             
						'RAYMUNDO',           
						'DAREN',              
						'TRISTAN',            
						'HOUSTON',            
						'ROBBY',              
						'LINCOLN',            
						'JAME',               
						'GENARO',             
						'GALE',               
						'BENNETT',            
						'OCTAVIO',            
						'CORNELL',            
						'LAVERNE',            
						'HUNG',               
						'ARRON',              
						'ANTONY',             
						'HERSCHEL',           
						'ALVA',               
						'GIOVANNI',           
						'GARTH',              
						'CYRUS',              
						'CYRIL',              
						'RONNY',              
						'STEVIE',             
						'LON',                
						'FREEMAN',            
						'ERIN',               
						'DUNCAN',             
						'KENNITH',            
						'CARMINE',            
						'AUGUSTINE',          
						'YOUNG',              
						'ERICH',              
						'CHADWICK',           
						'WILBURN',            
						'RUSS',               
						'REID',               
						'MYLES',              
						'ANDERSON',           
						'MORTON',             
						'JONAS',              
						'FOREST',             
						'MITCHEL',            
						'MERVIN',             
						'ZANE',               
						'RICH',               
						'JAMEL',              
						'LAZARO',             
						'ALPHONSE',           
						'RANDELL',            
						'MAJOR',              
						'JOHNIE',             
						'JARRETT',            
						'BROOKS',             
						'ARIEL',              
						'ABDUL',              
						'DUSTY',              
						'LUCIANO',            
						'LINDSEY',            
						'TRACEY',             
						'SEYMOUR',            
						'SCOTTIE',            
						'EUGENIO',            
						'MOHAMMED',           
						'SANDY',              
						'VALENTIN',           
						'CHANCE',             
						'ARNULFO',            
						'LUCIEN',             
						'FERDINAND',          
						'THAD',               
						'EZRA',               
						'SYDNEY',             
						'ALDO',               
						'RUBIN',              
						'ROYAL',              
						'MITCH',              
						'EARLE',              
						'ABE',                
						'WYATT',              
						'MARQUIS',            
						'LANNY',              
						'KAREEM',             
						'JAMAR',              
						'BORIS',              
						'ISIAH',              
						'EMILE',              
						'ELMO',               
						'ARON',               
						'LEOPOLDO',           
						'EVERETTE',           
						'JOSEF',              
						'GAIL',               
						'ELOY',               
						'DORIAN',             
						'RODRICK',            
						'REINALDO',           
						'LUCIO',              
						'JERROD',             
						'WESTON',             
						'HERSHEL',            
						'BARTON',             
						'PARKER',             
						'LEMUEL',             
						'LAVERN',             
						'BURT',               
						'JULES',              
						'GIL',                
						'ELISEO',             
						'AHMAD',              
						'NIGEL',              
						'EFREN',              
						'ANTWAN',             
						'ALDEN',              
						'MARGARITO',          
						'COLEMAN',            
						'REFUGIO',            
						'DINO',               
						'OSVALDO',            
						'LES',                
						'DEANDRE',            
						'NORMAND',            
						'KIETH',              
						'IVORY',              
						'ANDREA',             
						'TREY',               
						'NORBERTO',           
						'NAPOLEON',           
						'JEROLD',             
						'FRITZ',              
						'ROSENDO',            
						'MILFORD',            
						'SANG',               
						'DEON',               
						'CHRISTOPER',         
						'ALFONZO',            
						'LYMAN',              
						'JOSIAH',             
						'BRANT',              
						'WILTON',             
						'RICO',               
						'JAMAAL',             
						'DEWITT',             
						'CAROL',              
						'BRENTON',            
						'YONG',               
						'OLIN',               
						'FOSTER',             
						'FAUSTINO',           
						'CLAUDIO',            
						'JUDSON',             
						'GINO',               
						'EDGARDO',            
						'BERRY',              
						'ALEC',               
						'TANNER',             
						'JARRED',             
						'DONN',               
						'TRINIDAD',           
						'TAD',                
						'SHIRLEY',            
						'PRINCE',             
						'PORFIRIO',           
						'ODIS',               
						'MARIA',              
						'LENARD',             
						'CHAUNCEY',           
						'CHANG',              
						'TOD',                
						'MEL',                
						'MARCELO',            
						'KORY',               
						'AUGUSTUS',           
						'KEVEN',              
						'HILARIO',            
						'BUD',                
						'SAL',                
						'ROSARIO',            
						'ORVAL',              
						'MAURO',              
						'DANNIE',             
						'ZACHARIAH',          
						'OLEN',               
						'ANIBAL',             
						'MILO',               
						'JED',                
						'FRANCES',            
						'THANH',              
						'DILLON',             
						'AMADO',              
						'NEWTON',             
						'CONNIE',             
						'LENNY',              
						'TORY',               
						'RICHIE',             
						'LUPE',               
						'HORACIO',            
						'BRICE',              
						'MOHAMED',            
						'DELMER',             
						'DARIO',              
						'REYES',              
						'DEE',                
						'MAC',                
						'JONAH',              
						'JERROLD',            
						'ROBT',               
						'HANK',               
						'SUNG',               
						'RUPERT',             
						'ROLLAND',            
						'KENTON',             
						'DAMION',             
						'CHI',                
						'ANTONE',             
						'WALDO',              
						'FREDRIC',            
						'BRADLY',             
						'QUINN',              
						'KIP',                
						'BURL',               
						'WALKER',             
						'TYREE',              
						'JEFFEREY',           
						'AHMED',             
						'WILLY',             
						'STANFORD',          
						'OREN',              
						'NOBLE',             
						'MOSHE',             
						'MIKEL',             
						'ENOCH',             
						'BRENDON',           
						'QUINTIN',           
						'JAMISON',           
						'FLORENCIO',         
						'DARRICK',           
						'TOBIAS',            
						'MINH',              
						'HASSAN',            
						'GIUSEPPE',          
						'DEMARCUS',          
						'CLETUS',            
						'TYRELL',            
						'LYNDON',            
						'KEENAN',            
						'WERNER',            
						'THEO',              
						'GERALDO',           
						'LOU',               
						'COLUMBUS',          
						'CHET',              
						'BERTRAM',           
						'MARKUS',            
						'HUEY',              
						'HILTON',            
						'DWAIN',             
						'DONTE',             
						'TYRON',             
						'OMER',              
						'ISAIAS',            
						'HIPOLITO',          
						'FERMIN',            
						'CHUNG',             
						'ADALBERTO',         
						'VALENTINE',         
						'JAMEY',             
						'BO',                
						'BARRETT',           
						'WHITNEY',           
						'TEODORO',           
						'MCKINLEY',          
						'MAXIMO',            
						'GARFIELD',          
						'SOL',               
						'RALEIGH',           
						'LAWERENCE',         
						'ABRAM',             
						'RASHAD',            
						'KING',              
						'EMMITT',            
						'DARON',             
						'CHONG',             
						'SAMUAL',            
						'PARIS',             
						'OTHA',              
						'MIQUEL',            
						'LACY',              
						'EUSEBIO',           
						'DONG',              
						'DOMENIC',           
						'DARRON',            
						'BUSTER',            
						'ANTONIA',           
						'WILBER',            
						'RENATO',            
						'JC',                
						'HOYT',              
						'HAYWOOD',           
						'EZEKIEL',           
						'CHAS',              
						'FLORENTINO',        
						'ELROY',             
						'CLEMENTE',          
						'ARDEN',             
						'NEVILLE',           
						'KELLEY',            
						'EDISON',            
						'DESHAWN',           
						'CARROL',            
						'SHAYNE',            
						'NATHANIAL',         
						'JORDON',            
						'DANILO',            
						'CLAUD',             
						'VAL',               
						'SHERWOOD',          
						'RAYMON',            
						'RAYFORD',           
						'CRISTOBAL',         
						'AMBROSE',           
						'TITUS',             
						'HYMAN',             
						'FELTON',            
						'EZEQUIEL',          
						'ERASMO',            
						'STANTON',           
						'LONNY',             
						'LEN',               
						'IKE',               
						'MILAN',             
						'LINO',              
						'JAROD',             
						'HERB',              
						'ANDREAS',           
						'WALTON',            
						'RHETT',             
						'PALMER',            
						'JUDE',              
						'DOUGLASS',          
						'CORDELL',           
						'OSWALDO',           
						'ELLSWORTH',         
						'VIRGILIO',          
						'TONEY',             
						'NATHANAEL',         
						'DEL',               
						'BRITT',             
						'BENEDICT',          
						'MOSE',              
						'HONG',              
						'LEIGH',             
						'JOHNSON',           
						'ISREAL',            
						'GAYLE',             
						'GARRET',            
						'FAUSTO',            
						'ASA',               
						'ARLEN',             
						'ZACK',              
						'WARNER',            
						'MODESTO',           
						'FRANCESCO',         
						'MANUAL',            
						'JAE',               
						'GAYLORD',           
						'GASTON',            
						'FILIBERTO',         
						'DEANGELO',          
						'MICHALE',           
						'GRANVILLE',         
						'WES',               
						'MALIK',             
						'ZACKARY',           
						'TUAN',              
						'NICKY',             
						'ELDRIDGE',          
						'CRISTOPHER',        
						'CORTEZ',            
						'ANTIONE',           
						'MALCOM',            
						'LONG',              
						'KOREY',             
						'JOSPEH',            
						'COLTON',            
						'WAYLON',            
						'VON',               
						'HOSEA',             
						'SHAD',              
						'SANTO',             
						'RUDOLF',            
						'ROLF',              
						'REY',               
						'RENALDO',           
						'MARCELLUS',         
						'LUCIUS',            
						'LESLEY',            
						'KRISTOFER',         
						'BOYCE',             
						'BENTON',            
						'MAN',               
						'KASEY',             
						'JEWELL',            
						'HAYDEN',            
						'HARLAND',           
						'ARNOLDO',           
						'RUEBEN',            
						'LEANDRO',           
						'KRAIG',             
						'JERRELL',           
						'JEROMY',            
						'HOBERT',            
						'CEDRICK',           
						'ARLIE',             
						'WINFORD',           
						'WALLY',             
						'PATRICIA',          
						'LUIGI',             
						'KENETH',            
						'JACINTO',           
						'GRAIG',             
						'FRANKLYN',          
						'EDMUNDO',           
						'SID',               
						'PORTER',            
						'LEIF',              
						'LAUREN',            
						'JERAMY',            
						'ELISHA',            
						'BUCK',              
						'WILLIAN',           
						'VINCENZO',          
						'SHON',              
						'MICHAL',            
						'LYNWOOD',           
						'LINDSAY',           
						'JEWEL',             
						'JERE',              
						'HAI',               
						'ELDEN',             
						'DORSEY',            
						'DARELL',            
						'BRODERICK',         
						'ALONSO',            


    				);
    				
    	$achternamen = array(
    					'Smith',
        				'Jones',
       				    'Winkler',
                        'Cooper',
                        'Cline'
    	
    	
    	);
    	
    	
    	$leeftijden = array(
    					'16',
    					'17',
    					'18',
    					'19',
    					'20',
    					'21',
    					'22',
    					'23'
    					
    	
    	);		
    	
    	$rugnummer = rand(0, 44);	
    		
    		
    				
    	$voornaam = strtolower($voornamen[array_rand($voornamen)]);
    	$achternaam = strtolower($achternamen[array_rand($achternamen)]);
    	$leeftijd = $leeftijden[array_rand($leeftijden)];
    	
    	$new_player_insert_data = array(
    		'voornaam' => $voornaam,
    		'achternaam' => $achternaam,
    		'leeftijd' => $leeftijd,
    		'geslacht' => 'male',
    		'rugnummer' => $rugnummer,
    		'FK_team_id' => $team_id
    		
    	
    	);
		
		
		
		$this->db->where('FK_team_id', $team_id);
    	$insert = $this->db->insert('korf_spelers', $new_player_insert_data);
    	
    	
    	}
    	
    	
    	//query voor het halen van de spelersgegevens
    	function get_korfbalplayer()
    	{
    	$user_id = $this->session->userdata('user_id');
    	
    	$this->db->where('FK_user_id', $user_id);
    	$this->db->select('team_id');
    	$teamidquery = $this->db->get('korf_teams');
    	
    	foreach($teamidquery->result() as $row)
    	{
    		$team_id = $row->team_id;
    	
    	}

    	
    	
    	$playeridquery = $this->db->query("select speler_id from korf_spelers where FK_team_id ='$team_id';");
    	return $playeridquery;

    	
    	
    	}
    	
    	function create_korfbalteamstats()
    	{
    		$user_id = $this->session->userdata('user_id');
    	
	    	$this->db->where('FK_user_id', $user_id);
	    	$this->db->select('team_id');
	    	$teamidquery = $this->db->get('korf_teams');
	    	
	    	
	    	foreach($teamidquery->result() as $row)
	    	{
	    		$team_id = $row->team_id;
	    	
	    	}
	    	
	    	$insert = array(
	    		'gespeeld_matchen' => 0,
	    		'gewonnen_matchen' => 0,
	    		'verloren_matchen' =>0,
	    		'gelijke_matchen' =>0,
	    		'verkochte_spelers' => 0,
	    		'gekochte_spelers' => 0,
	    		'overwinningen_op_rij' => 0,
	    		'FK_team_id' => $team_id
	    	);
	    	$this->db->insert('korf_teamstats', $insert);

    		
    	}
    	
    	function assign_trainingspunten()
    	{
    		$user_id = $this->session->userdata('user_id');
    	
    	$this->db->where('FK_user_id', $user_id);
    	$this->db->select('team_id');
    	$teamidquery = $this->db->get('korf_teams');
    	
    	foreach($teamidquery->result() as $row)
    	{
    		$team_id = $row->team_id;
    	
    	}

    	
    	
    	$playeridquery = $this->db->query("select speler_id from korf_spelers where FK_team_id ='$team_id';");
    	
    	
    	foreach($playeridquery->result() as $row)
    	{
    		$spelerid = $row->speler_id;
    		
    		$this->db->select('skill_id');
    		$this->db->from('korf_skills');
    		$this->db->where('FK_player_id', $spelerid);
    		$skillidquery = $this->db->get();
    		
    		
    		foreach($skillidquery->result() as $row)
    		{
    			$skillid = $row->skill_id;
    			
    			$insert = array(
    			'FK_skill_id' => $skillid
    			
    			);
    			
    			$this->db->insert('korf_training', $insert);
    		
    		}	
    	}
    	
    	}
    	
    	
    	//functie die elke speler skills toekent bij het maken van een team
    	function assign_korfbalskills($playerid)
		{
			//randomwoorde(1-20) teowijzen aan de skills van elke speler
		
		$new_skills_insert_data = array(
			'rebound' => rand(1,12),
			'passing' => rand(1,12),
			'stamina' => rand(1,20),
			'shotpower' => rand(1,12),
			'shotprecision' => rand(1,12),
			'playmaking' => rand(1,12),
			'intercepting' => rand(1,12),
			'leadership'  => rand(1, 20),
			'FK_player_id' => $playerid
		);
		
		$this->db->where('FK_player_id', $playerid);
		$insert = $this->db->insert('korf_skills', $new_skills_insert_data);
		
		}
		
		
		
    	
    	//functie om een speler(vrouw) aan te maken
    function create_korfbalplayer_vrouw(){
    	$user_id = $this->session->userdata('user_id');
    	
    	$this->db->where('FK_user_id', $user_id);
    	$this->db->select('team_id');
    	$teamidquery = $this->db->get('korf_teams');
    	
    	
    	foreach($teamidquery->result() as $row)
    	{
    		$team_id = $row->team_id;
    	
    	}
    	
    	$voornamen = array(
    					'josefien', 
    					'nele',
    					'anke',
    					'mieke',
    					'maria'
    				);
    				
    	$achternamen = array(
    					'vandevelde',
        				'pony',
       				    'deboi',
                        'deschelde',
                        'de moeder'
    	
    	
    	);
    	
    	
    	$leeftijden = array(
    					'16',
    					'17',
    					'18',
    					'19',
    					'20',
    					'21',
    					'22',
    					'23'
    					
    	
    	);			
    		
    	$rugnummer = rand(46, 99);	
    				
    	$voornaam = $voornamen[array_rand($voornamen)];
    	$achternaam = $achternamen[array_rand($achternamen)];
    	$leeftijd = $leeftijden[array_rand($leeftijden)];
    	
    	$new_player_insert_data = array(
    		'voornaam' => $voornaam,
    		'achternaam' => $achternaam,
    		'leeftijd' => $leeftijd,
    		'geslacht' => 'female',
    		'rugnummer' => $rugnummer,
    		'FK_team_id' => $team_id
    		
    	
    	);
		
		
		
		$this->db->where('FK_team_id', $team_id);
    	$insert = $this->db->insert('korf_spelers', $new_player_insert_data);
    	}
    	
    	
    	//maakt volleybalteam aan
    	function create_volleybalteam()
    	{
    
    	$user_id = $this->session->userdata('user_id');    	
    	    	
    	    	
    	    	
    	$new_team_insert_data = array(
    		'naam' => $this->input->post('teamnaam'),
    		'FK_user_id' => $user_id,
    		'startdatum' => 'now()'
    	
    	);
    	
    	
    	$this->db->where('FK_user_id', $user_id);
    	$insert = $this->db->insert('vol_teams', $new_team_insert_data);
    	return $insert;			
    	}

    	
    	
    	//maakt volleybalspeler aan
    	function create_volleybalplayer()
    	{
    		$user_id = $this->session->userdata('user_id');
    	
    	$this->db->where('FK_user_id', $user_id);
    	$this->db->select('team_id');
    	$teamidquery = $this->db->get('vol_teams');
    	
    	
    	foreach($teamidquery->result() as $row)
    	{
    		$team_id = $row->team_id;
    	
    	}
    	
    	$voornamen = array(
    					'josefien', 
    					'nele',
    					'anke',
    					'mieke',
    					'maria'
    				);
    				
    	$achternamen = array(
    					'vandevelde',
        				'pony',
       				    'deboi',
                        'deschelde',
                        'de moeder'
    	
    	
    	);
    	
    	
    	$leeftijden = array(
    					'16',
    					'17',
    					'18',
    					'19',
    					'20',
    					'21',
    					'22',
    					'23'
    					
    	
    	);			
    		
    		
    				
    	$voornaam = $voornamen[array_rand($voornamen)];
    	$achternaam = $achternamen[array_rand($achternamen)];
    	$leeftijd = $leeftijden[array_rand($leeftijden)];
    	
    	$new_player_insert_data = array(
    		'voornaam' => $voornaam,
    		'achternaam' => $achternaam,
    		'leeftijd' => $leeftijd,
    		'FK_team_id' => $team_id
    		
    	
    	);
		
		
		
		$this->db->where('FK_team_id', $team_id);
    	$insert = $this->db->insert('vol_spelers', $new_player_insert_data);
    	
    	}
    	
    	//maakt volleybalstadion aan
    	function create_volleybalstadion()
    {
    
    $user_id = $this->session->userdata('user_id');
    	
    	$this->db->where('FK_user_id', $user_id);
    	$this->db->select('team_id');
    	$teamidquery = $this->db->get('vol_teams');
    	
    	
    	foreach($teamidquery->result() as $row)
    	{
    		$team_id = $row->team_id;
    	
    	}
    	
    	$new_stadion_insert_data = array(
    		'naam' => $this->input->post('stadionnaam'),
    		'FK_team_id' => $team_id
    		
    	
    	);
    	
    	$this->db->where('FK_team_id', $team_id);
    	$insert = $this->db->insert('vol_stadion', $new_stadion_insert_data);
    	
    }
    
    
   		 //maakt basketbalteam aan
    	function create_basketbalteam()
    	{
    
    	$user_id = $this->session->userdata('user_id');    	
    	    	
    	    	
    	    	
    	$new_team_insert_data = array(
    		'naam' => $this->input->post('teamnaam'),
    		'FK_user_id' => $user_id,
    		'startdatum' => 'now()'
    	
    	);
    	
    	
    	$this->db->where('FK_user_id', $user_id);
    	$insert = $this->db->insert('bas_teams', $new_team_insert_data);
    	return $insert;			
    	}
    	
    	
    	
    	//maakt basketbalspeler aan
    	function create_basketbalplayer()
    	{
    		$user_id = $this->session->userdata('user_id');
    	
    	$this->db->where('FK_user_id', $user_id);
    	$this->db->select('team_id');
    	$teamidquery = $this->db->get('bas_teams');
    	
    	
    	foreach($teamidquery->result() as $row)
    	{
    		$team_id = $row->team_id;
    	
    	}
    	
    	$voornamen = array(
    					'josefien', 
    					'nele',
    					'anke',
    					'mieke',
    					'maria'
    				);
    				
    	$achternamen = array(
    					'vandevelde',
        				'pony',
       				    'deboi',
                        'deschelde',
                        'de moeder'
    	
    	
    	);
    	
    	
    	$leeftijden = array(
    					'16',
    					'17',
    					'18',
    					'19',
    					'20',
    					'21',
    					'22',
    					'23'
    					
    	
    	);			
    		
    		
    				
    	$voornaam = $voornamen[array_rand($voornamen)];
    	$achternaam = $achternamen[array_rand($achternamen)];
    	$leeftijd = $leeftijden[array_rand($leeftijden)];
    	
    	$new_player_insert_data = array(
    		'voornaam' => $voornaam,
    		'achternaam' => $achternaam,
    		'leeftijd' => $leeftijd,
    		'FK_team_id' => $team_id
    		
    	
    	);
		
		
		
		$this->db->where('FK_team_id', $team_id);
    	$insert = $this->db->insert('bas_spelers', $new_player_insert_data);
    	
    	}


	//maakt volleybalstadion aan
    	function create_basketbalstadion()
    {
    
    $user_id = $this->session->userdata('user_id');
    	
    	$this->db->where('FK_user_id', $user_id);
    	$this->db->select('team_id');
    	$teamidquery = $this->db->get('bas_teams');
    	
    	
    	foreach($teamidquery->result() as $row)
    	{
    		$team_id = $row->team_id;
    	
    	}
    	
    	$new_stadion_insert_data = array(
    		'naam' => $this->input->post('stadionnaam'),
    		'FK_team_id' => $team_id
    		
    	
    	);
    	
    	$this->db->where('FK_team_id', $team_id);
    	$insert = $this->db->insert('bas_stadion', $new_stadion_insert_data);
    	
    }



    
    }
