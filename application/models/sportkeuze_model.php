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
    				
'Nathan', 'Lucas', 'Noah', 'Louis', 'Thomas', 'Arthur', 'Mohamed', 'Milan', 'Mathis', 'Hugo', 'Simon', 'Maxime', 'Adam', 'Nicolas', 'Théo', 'Tom', 'Liam', 'Lars', 'Victor', 'Ethan', 'Wout', 'Matteo', 'Mathias', 'Gabriel', 'Daan', 'Senne', 'Luca', 'Robbe', 'Stan', 'Alexandre', 'Kobe', 'Antoine', 'Jasper', 'Alexander', 'Mathéo', 'Romain', 'Jules', 'Rune', 'Rayan', 'Ruben', 'Lukas', 'Seppe', 'Xander', 'Tristan', 'Yanis', 'Diego', 'Sacha', 'Jonas', 'Arne', 'Quinten', 'Aaron', 'Lander', 'Raphaël', 'Guillaume', 'Maxim', 'Loïc', 'Samuel', 'Dylan', 'Jelle', 'Julien', 'Elias', 'Robin', 'Sam', 'Siebe', 'Warre', 'Mauro', 'Noa', 'Martin', 'Axel', 'Enzo', 'Tibo', 'Niels', 'Benjamin', 'Ferre', 'Clément', 'Gilles', 'Jarne', 'Sander', 'Brent', 'Keano', 'Adrien', 'Jens', 'Alessio', 'Florian', 'David', 'Ilias', 'Kylian', 'Mats', 'Mathieu', 'Mattéo', 'Hamza', 'Quentin', 'Tuur', 'Ayoub', 'Arno', 'Lennert', 'Matthias', 'Baptiste', 'Amine', 'Arnaud', 'William', 'Nolan', 'Dries', 'Alexis', 'Maxence', 'Bilal', 'Mehdi', 'Oscar', 'Emile', 'Luka', 'Lorenzo', 'Lowie', 'Anas', 'Noé', 'Vincent', 'Emiel', 'Thibaut', 'Timo', 'Yassine', 'Anthony', 'Mathys', 'Ryan', 'Alex', 'Bram', 'Ali', 'Valentin', 'Milo', 'Viktor', 'Ilyas', 'Thibo', 'Bryan', 'Mohammed', 'Thibault', 'Zakaria', 'Logan', 'Ibrahim', 'Jef', 'Justin', 'Tibe', 'Dorian', 'Tim', 'Cédric', 'Alessandro', 'Pierre', 'Ward', 'Cyril', 'Vince', 'Esteban', 'Jonathan', 'Michiel', 'Jesse', 'Thor', 'Arda', 'Vic', 'Dario', 'Matisse', 'Owen', 'Emilien', 'Léo', 'Leon', 'Mateo', 'Pieter', 'Wassim', 'Sem', 'Maël', 'Charles', 'Henri', 'Jason', 'Joshua', 'Stef', 'Younes', 'Bastien', 'Imran', 'Wannes', 'Joppe', 'Augustin', 'Max', 'Youssef', 'Finn', 'Ian', 'Kasper', 'Kyan', 'Kenzo', 'Axl', 'Staf', 'Ahmed', 'Gauthier', 'Loris', 'Maarten', 'Walid', 'Daniel', 'Nils', 'Andreas', 'Mattis', 'Achille', 'Evan', 'Sébastien', 'Toon', 'Ugo', 'Ayman', 'Edouard', 'Aurélien', 'Jarno', 'Lenny', 'Sami', 'Amir', 'Léon', 'Bas', 'Cas', 'Leandro', 'Yannis', 'Julian', 'Sean', 'Thijs', 'Basile', 'Berre', 'Félix', 'Rayane', 'Ben', 'Felix', 'Muhammed', 'Nand', 'Nassim', 'Timéo', 'Corentin', 'Yannick', 'François', 'Sofiane', 'Aymeric', 'Brecht', 'Eliott', 'Brandon', 'Stijn', 'Joren', 'Yarne', 'Yassin', 'Amaury', 'Flor', 'Joran', 'Jordy', 'Louka', 'Marwan', 'Olivier', 'Yaro', 'Briek', 'Téo', 'Yoran', 'Gaspard', 'Kyano', 'Miel', 'Nick', 'Reda', 'Kevin', 'Omar', 'Casper', 'Jan', 'Killian', 'Noam', 'Dante', 'Dean', 'Iben', 'Matheo', 'Donovan', 'Ismail', 'Jack', 'Jordan', 'Loan', 'Paul', 'Pepijn', 'Colin', 'Kyllian', 'Lenn', 'Matéo', 'Mathijs', 'Mustafa', 'Willem', 'Enes', 'Flavio', 'Jayden', 'Juul', 'Kenji', 'Levi', 'Mehmet', 'Michael', 'Mikail', 'Charlie', 'Erwan', 'Florent', 'Gust', 'Laurens', 'Rémi', 'Tiziano', 'Ismaël', 'Lou', 'Mike', 'Rafaël', 'Alan', 'Eliot', 'Imad', 'Nio', 'Sasha', 'Tiago', 'Amin', 'Aymane', 'Cedric', 'Emre', 'Jérémy', 'Jean', 'Joachim', 'Marius', 'Matis', 'Maximilien', 'Tiebe', 'Tobias', 'Wolf', 'Wouter', 'Fabio', 'Floris', 'Kerem', 'Klaas', 'Leander', 'Marco', 'Rube', 'Tijl', 'Tijs', 'Zeno', 'Kaan', 'Kamiel', 'Len', 'Manu', 'Roan', 'Yusuf', 'Andrea', 'Angelo', 'Efe', 'Brian', 'Josse', 'Massimo', 'Matthew', 'Matthieu', 'Natan', 'Nicola', 'Rafael', 'Remi', 'Rik', 'Thibeau', 'Arjen', 'Damien', 'Imrane', 'Naël', 'Pablo', 'Samy', 'Seth', 'Taha', 'Ilan', 'Jorre', 'Kjell', 'Miguel', 'Roel', 'Soufiane', 'Thibe', 'Anass', 'Emmanuel', 'Gianni', 'Kilian', 'Lucien', 'Marwane', 'Rémy', 'Adriano', 'Anton', 'Antonin', 'Elliot', 'Fabian', 'Grégoire', 'Hannes', 'Isaac', 'Joseph', 'Karel', 'Kiano', 'Renzo', 'Sverre', 'Tiemen', 'Cyriel', 'Mattias', 'Sebastian', 'Valentino', 'Yassir', 'Achraf', 'Aidan', 'Gaël', 'Ilian', 'Léopold', 'Lionel', 'Marouane', 'Naïm', 'Nabil', 'Raf', 'Sylvain', 'Adil', 'Andrew', 'Bo', 'Boris', 'Gaëtan', 'Giovanni', 'Loïs', 'Niel', 'Rhune', 'Tommy', 'Xavier', 'Issam', 'Jérôme', 'Livio', 'Timothy', 'Ahmet', 'Andres', 'Antonio', 'Bruno', 'Denis', 'Elie', 'Jeff', 'Ludovic', 'Malik', 'Yari', 'Yasser', 'Yorben', 'Badr', 'Berat', 'Christopher', 'Filip', 'Igor', 'Ilyes', 'James', 'Jente', 'Keanu', 'Lohan', 'Michaël', 'Miro', 'Oliver', 'Raphael', 'Alec', 'Bjarne', 'Emil', 'Furkan', 'Gerben', 'Giel', 'Giuliano', 'Ivan', 'Jamie', 'Jaro', 'Kamil', 'Lex', 'Lode', 'Martijn', 'Maurice', 'Mika', 'Oskar', 'Sabri', 'Theo', 'Thibaud', 'Abdellah', 'Adem', 'Christian', 'Danté', 'Hasan', 'Jeremy', 'Jonah', 'Lewis', 'Luis', 'Lyam', 'Matthis', 'Mohammad', 'Nathanaël', 'Nino', 'Otto', 'Yasin', 'Alexy', 'Basil', 'Eli', 'Frederik', 'Grégory', 'Hassan', 'Jannes', 'Jari', 'Jenne', 'Jeroen', 'Mattia', 'Mirko', 'Ricardo', 'Sandro', 'Sil', 'Sofian', 'Sven', 'Talha', 'Tomas', 'Witse', 'Yani', 'Yann', 'Yoni', 'Anouar', 'Beau', 'Dimitri', 'Hendrik', 'Joaquin', 'Juan', 'Karim', 'Kenny', 'Korneel', 'Lilian', 'Louca', 'Morgan', 'Redouane', 'Roméo', 'Thorben', 'Yarno', 'Abdullah', 'Aymen', 'Bruce', 'Burak', 'Cameron', 'Cis', 'Daniël', 'Daoud', 'Devon', 'Dylano', 'Emirhan', 'Eren', 'Ibe', 'John', 'Jolan', 'Marc', 'Matt', 'Matthéo', 'Menno', 'Michel', 'Mylan', 'Roman', 'Romeo', 'Samir', 'Senna', 'Steven', 'Ulysse', 'Adrian', 'Andy', 'Brayan', 'Clovis', 'Damian', 'Diégo', 'Gabriël', 'Giuseppe', 'Hatim', 'Ilario', 'Jitse', 'Johan', 'Kenan', 'Manuel', 'Moussa', 'Pieter-Jan', 'Stefan', 'Timon', 'Vincenzo', 'Youness', 'Zayd', 'Adnane', 'Aloïs', 'Angel', 'Anis', 'Aron', 'Brahim', 'Célestin', 'Edward', 'Emilio', 'Gaston', 'Ismael', 'Jaimy', 'Jakob', 'Kjento', 'Linus', 'Mario', 'Melih', 'Mohamed-Amine', 'Otis', 'Oussama', 'Peter', 'Salvatore', 'Shawn', 'Wiebe', 'Yentl', 'Abdul', 'Achiel', 'Akram', 'Bent', 'Brieuc', 'Elouan', 'Emeric', 'Emir', 'Eric', 'Ernest', 'Ewan', 'ömer', 'Jakub', 'Jawad', 'Johannes', 'Kai', 'Kian', 'Mano', 'Melvin', 'Mirco', 'Nadir', 'Orlando', 'Osman', 'Remco', 'Remy', 'Robert', 'Sebastiaan', 'Siemen', 'Tanguy', 'Thibau', 'Timothé', 'Yohan', 'Alban', 'Allan', 'Batuhan', 'Bob', 'Bradley', 'Chadi', 'Christophe', 'Elijah', 'Fons', 'Gijs', 'Gil', 'Hadrien', 'Jaron', 'Joris', 'Jurre', 'Karsten', 'Leo', 'Loucas', 'Loukas', 'Luan', 'Mamadou', 'Matias', 'Matthijs', 'Néo', 'Nolann', 'Nuno', 'Othmane', 'Paolo', 'Philippe', 'Rens', 'Salim', 'Seb', 'Semih', 'Tarik', 'Tijn', 'Vik', 'Virgile', 'Yunus', 'Zacharie', 'Abdel', 'Alejandro', 'Audric', 'Branko', 'Charly', 'Cyprien', 'Deniz', 'Elian', 'Hakim', 'Harold', 'Ishak', 'Jacob', 'Jelte', 'Jerko', 'Kyle', 'Lasse', 'Leonardo', 'Marcus', 'Marnix', 'Marvin', 'Mil', 'Neo', 'Ozan', 'Thimo', 'Titouan', 'Zion', 'Abdallah', 'Aiden', 'Antony', 'Ayden', 'Bavo', 'Chris', 'Dieter', 'Driss', 'Eliano', 'Emanuel', 'Erdem', 'Estéban', 'Ewout', 'Gabin', 'Glenn', 'Ilhan', 'Ismaïl', 'Jimmy', 'Joël', 'Joey', 'José', 'Josué', 'Kacper', 'Kadir', 'Kerim', 'Léandre', 'Leny', 'Nizar', 'Nolhan', 'Ralph', 'Renaud', 'Riyad', 'Roy', 'Sinan', 'Souleyman', 'Sten', 'Trystan', 'Yenthe', 'Yigit', 'Ziyad', 'Ahmad', 'Aleandro', 'Amory', 'Artuur', 'Bjorn', 'Cisse', 'Cody', 'Delano', 'Dennis', 'Denzel', 'Enis', 'Ensar', 'Erik', 'Hicham', 'Hugues', 'Hüseyin', 'Idriss', 'Ilyan', 'Jaan', 'Jarod', 'Jorben', 'Jordi', 'Julius', 'Kieran', 'Kyandro', 'Kyran', 'Luc', 'Luigi', 'Merlin', 'Mylo', 'Naoufal', 'Nelson', 'Richard', 'Rob', 'Selim', 'Silas', 'Storm', 'Tao', 'Teo', 'Théodore', 'Timothée', 'Tobe', 'Viggo', 'Wesley', 'Yaël', 'Youri', 'Ziggy', 'Adriaan', 'Albert', 'Alix', 'Ayrton', 'Baran', 'Berkay', 'Birger', 'Brice', 'Cyrille', 'Dion', 'Eden', 'Edgar', 'Eduard', 'George', 'Gillian', 'Gregory', 'Hakan', 'Haroun', 'Iljo', 'Ilya', 'Jérémie', 'Jacques', 'Jad', 'Jani', 'Jim', 'Kwinten', 'Laurent', 'Marlon', 'Matti', 'Maurits', 'Metehan', 'Mouad', 'Muhammad', 'Nicholas', 'Obe', 'Quinn', 'Ramzi', 'Rien', 'Rohan', 'Safouan', 'Soulayman', 'Stanislas', 'Sybren', 'Winter', 'Wyatt', 'Yente', 'Yoren', 'Abderrahmane', 'Abel', 'Alexandro', 'Alexi', 'Anatole', 'André', 'Andries', 'Arend', 'Bastian', 'Benoît', 'Bert', 'Brend', 'Célian', 'Connor', 'Constantin', 'Darius', 'Edwin', 'Elliott', 'Elyas', 'Eray', 'Gatien', 'Halil', 'Henry', 'Ilyass', 'Jean-Baptiste', 'Jessy', 'Jibril', 'Jorn', 'Liano', 'Lowiek', 'Maddox', 'Malo', 'Marcel', 'Marouan', 'Mayron', 'Mert', 'Moshe', 'Nando', 'Neil', 'Nico', 'Patrick', 'Pol', 'Rami', 'Saad', 'Soufian', 'Steve', 'Tibeau', 'Tobi', 'Yahya', 'Ylan', 'Zander', 'Anwar', 'Bedirhan', 'Benoit', 'Chiel', 'Corneel', 'Damon', 'Dany', 'Douwe', 'Dré', 'Egon', 'Emerick', 'Enrico', 'Fabrice', 'Fadi', 'Faris', 'Flynn', 'Fré', 'Francis', 'Gabriele', 'Giorgio', 'Guust', 'Hayden', 'Hector', 'Ilano', 'Jarre', 'Jeffrey', 'Jerome', 'Jona', 'Joni', 'Julot', 'Kévin', 'Kane', 'Kas', 'Khalid', 'Kyento', 'Léandro', 'Lino', 'Luciano', 'Malcolm', 'Mathisse', 'Mattheo', 'Mauritz', 'Merlijn', 'Michele', 'Mickael', 'Nael', 'Rayen', 'Redouan', 'Rein', 'Reinout', 'Scott', 'Sebbe', 'Sepp', 'Serhat', 'Sibe', 'Siméon', 'Thiméo', 'Tijmen', 'Timeo', 'Titus', 'Torben', 'Tyron', 'Wies', 'Xandro', 'Yorrit', 'Yves', 'Zaïd', 'Aerjen', 'Alek', 'Armand', 'Arsène', 'Aubry', 'Aydan', 'Aymerick', 'Basiel', 'César', 'Calogero', 'Calvin', 'Carlos', 'Chahid', 'Chaim', 'Collin', 'Cristiano', 'Dawid', 'Dilan', 'Diogo', 'Djibril', 'Emin', 'Enrique', 'Fatih', 'Frédéric', 'Gaetano', 'Giulian', 'Gus', 'Guus', 'Harry', 'Harun', 'Haytam', 'Iliano', 'Isa', 'Isaak', 'Issa', 'Jamal', 'Jenthe', 'Jesper', 'Joaquim', 'Joeri', 'Jorbe', 'Junior', 'Keandro', 'Kelyan', 'Kenneth', 'Khalil', 'Lancelot', 'Lee', 'Loïck', 'Loic', 'Lorenz', 'Loric', 'Lucca', 'Mael', 'Malone', 'Manoa', 'Mathew', 'Mattijs', 'Maximilian', 'Mickaël', 'Mounir', 'Neal', 'Neel', 'Noach', 'Noan', 'Noham', 'Nordine', 'Nour', 'Othman', 'Raffaele', 'Ramazan', 'Raoul', 'René', 'Rodrigue', 'Rowan', 'Safwan', 'Said', 'Salaheddine', 'Sammy', 'Samuël', 'Sebastien', 'Teun', 'Timmy', 'Toby', 'Tony', 'Twan', 'Tycho', 'Waël', 'Wael', 'Xian', 'Yan', 'Ylian', 'Yoan', 'Yoann', 'Yorbe', 'Yuri', 'Adel', 'Adnan', 'Aiko', 'Akin', 'Almir', 'Anakin', 'Antoni', 'Archibald', 'Aster', 'Atilla', 'August', 'Bastiaan', 'Bernard', 'Bilel', 'Billal', 'Billy', 'Boaz', 'Branco', 'Byron', 'Clement', 'Cobe', 'Conrad', 'Constant', 'Côme', 'Damiën', 'Danny', 'Davy', 'Dilhan', 'Dominic', 'Dominik', 'Doriano', 'Doryan', 'Ennio', 'Eppo', 'Erwann', 'Ewoud', 'Fahd', 'Florentin', 'Francesco', 'Free', 'Gaspar', 'Gill', 'Goran', 'Idris', 'Ignace', 'Ilyano', 'Isaiah', 'Jamy', 'Jasin', 'Jay', 'Jayson', 'Joé', 'Joe', 'Joel', 'Jorne', 'Jorrit', 'Kimi', 'Kiran', 'Koen', 'Lénaïc', 'Lény', 'Lleyton', 'Lorian', 'Mahdi', 'Marijn', 'Matz', 'Maverick', 'Mees', 'Mehdy', 'Miraç', 'Moïse', 'Mohamad', 'Moritz', 'Muhammet', 'Naftali', 'Noha', 'Odin', 'Okan', 'Onur', 'Orhan', 'Rachid', 'Rayaan', 'Rayyan', 'Rodrigo', 'Safwane', 'Sajid', 'Salman', 'Samet', 'Shane', 'Sid', 'Silvio', 'Solal', 'Souhail', 'Soulaimane', 'Stefano', 'Sybe', 'Théophile', 'Thorsten', 'Thymen', 'Timur', 'Vadim', 'Wodan', 'Xavi', 'Yacine', 'Yolan', 'Yvan', 'Abou', 'Abraham', 'Adame', 'Aimé', 'Aksel', 'Alain', 'Alperen', 'Alpha', 'Altan', 'Amaël', 'Amadeo', 'Andréas', 'Andrès', 'Antonino', 'Arian', 'Arif', 'Arlind', 'Arwen', 'Ashton', 'Atakan', 'Bart', 'Bartel', 'Benne', 'Berkan', 'Berten', 'Brooklyn', 'Camil', 'Camille', 'Can', 'Chahine', 'Devin', 'Doran', 'Duncan', 'Ege', 'Eloi', 'Erion', 'Ervin', 'Evert', 'Eythan', 'Félicien', 'Fabrizio', 'Federico', 'Ferdinand', 'Fiorenzo', 'Firmin', 'Flavien', 'Gaétan', 'Geoffrey', 'Georges', 'Germain', 'Gianluca', 'Gino', 'Gustave', 'Han', 'Hippolyte', 'Houdayfa', 'Hubert', 'Ilyasse', 'Jano', 'Jefferson', 'Jelco', 'Jobbe', 'Johnny', 'Joost', 'Jorden', 'Jore', 'Kameron', 'Karl', 'Kean', 'Keith', 'Kemal', 'Kilyan', 'Koray', 'Kristof', 'Krystian', 'Léonard', 'Lennerd', 'León', 'Lloyd', 'Lorik', 'Lorys', 'Lothar', 'Louan', 'Maher', 'Marin', 'Marko', 'Markus', 'Massimiliano', 'Mateusz', 'Matts', 'Maxance', 'Micah', 'Mikaïl', 'Mimoun', 'Musa', 'Naoufel', 'Nawfel', 'Nigel', 'Nikita', 'Nikolaos', 'Olaf', 'Pacôme', 'Pedro', 'Pieterjan', 'Pim', 'Prince', 'Ramses', 'Ramy', 'Randy', 'Raven', 'Rayhan', 'Resul', 'Ricky', 'Robbie', 'Rodolphe', 'Ronan', 'Runar', 'Saâd', 'Saber', 'Santino', 'Sep', 'Souhaib', 'Soulaymane', 'Stéphane', 'Théotime', 'Thiago', 'Thian', 'Tibor', 'Tieme', 'Tigane', 'Timoté', 'Torre', 'Tyler', 'Umut', 'Vito', 'Waïl', 'Wail', 'Yaniss', 'Yano', 'Yaron', 'Yonah', 'Youcef', 'Zeb', 'Zico', 'Zino', 'Zoran', 'Abdelrahman', 'Abdoulaye', 'Albion', 'Alexandros', 'Alfred', 'Alparslan', 'Amjad', 'Andrés', 'Anil', 'Aniss', 'Aras', 'Arman', 'Arnoud', 'Arnout', 'Attilio', 'Auguste', 'Azad', 'Baris', 'Bartosz', 'Batiste', 'Bayram', 'Bente', 'Boran', 'Bünyamin', 'Caleb', 'Carl', 'Cengiz', 'Cesar', 'Cezar', 'Dago', 'Damiano', 'Dan', 'Davide', 'Deacon', 'Deni', 'Denny', 'Deven', 'Diede', 'Dimas', 'Dogan', 'Eben', 'Eliel', 'Elion', 'Endrit', 'Eros', 'Fenne', 'Fernando', 'Flavian', 'Flo', 'Fouad', 'Gael', 'Gauvain', 'Giano', 'Guillian', 'Harald', 'Hervé', 'Horatio', 'Houdaifa', 'Ihab', 'Ilker', 'Iyad', 'Jerom', 'Joackim', 'Jochem', 'Jochen', 'Jort', 'Josef', 'Jude', 'Juno', 'Jurian', 'Kamal', 'Karam', 'Kayden', 'Kenjy', 'Kiandro', 'Kiani', 'Kiyan', 'Konstantinos', 'Kylan', 'Largo', 'Lenno', 'Leonard', 'Lian', 'Lieven', 'Loewie', 'Loewis', 'Lorent', 'Louie', 'Luiz', 'Luke', 'Mads', 'Mahé', 'Maksymilian', 'Manoah', 'Maoro', 'Mark', 'Mathies', 'Maxandre', 'Midas', 'Mirac', 'Mirza', 'Morris', 'Muhamed', 'Murat', 'Nasim', 'Nasr', 'Naud', 'Niklas', 'Nikola', 'Nohan', 'Nouh', 'Nuri', 'Nyo', 'Obi', 'Onno', 'Paco', 'Pascal', 'Pierrick', 'Pietro', 'Pjotr', 'Régis', 'Riad', 'Riley', 'Rinus', 'Robben', 'Robrecht', 'Roeland', 'Sélim', 'Séraphin', 'Safouane', 'Sahin', 'Saif', 'Salah', 'Salih', 'Salmane', 'Samuele', 'Santiago', 'Sen', 'Serkan', 'Seyhan', 'Shimon', 'Stig', 'Sus', 'Szymon', 'Tarek', 'Tenzin', 'Terry', 'Thiebe', 'Thierry', 'Tibbe', 'Ties', 'Till', 'Timour', 'Tjorven', 'Tolga', 'Tore', 'Travis', 'Troy', 'Tygo', 'Uriel', 'Valerio', 'Vick', 'Vladimir', 'Wietse', 'Wiktor', 'Will', 'Wilson', 'Yasir', 'Yazid', 'Yben', 'Yeno', 'Ylias', 'Yorick', 'Yousri', 'Zacharia', 'Zachary', 'Zaid', 'Zakariya', 'Zano', 'Zeger', 'Ziad', 'Zias', 'Zinedine', 'Zyan', 'Abdelhamid', 'Abdelilah', 'Abdoul', 'Abdoullah', 'Abdurrahman', 'Abdülkadir', 'Aboubacar', 'Achile', 'Adama', 'Adham', 'Adib', 'Adonis', 'Aico', 'Albéric', 'Alihan', 'Alistair', 'Aloys', 'Alvin', 'Amélien', 'Amadou', 'Amar', 'Anaël', 'Anders', 'Andrei', 'Andro', 'Anes', 'Anir', 'Arash', 'Aris', 'Aristide', 'Arsen', 'Artan', 'Artur', 'Arvid', 'Aurelio', 'Ayron', 'Aziz', 'Badreddine', 'Bailey', 'Bartu', 'Bono', 'Bora', 'Bran', 'Brick', 'Broes', 'Camiel', 'Carlo', 'Cayden', 'Celal', 'Cem', 'Cengizhan', 'Chady', 'Chakir', 'Ciel', 'Cinar', 'Clarence', 'Claudio', 'Costa', 'Dajo', 'Dalil', 'Damir', 'Dani', 'Danilo', 'Dave', 'Dilano', 'Don', 'Douglas', 'Drazic', 'Dwight', 'Dylen', 'Ebe', 'Eliah', 'Elio', 'Ellis', 'Ely', 'Elyesa', 'Emiliano', 'Eneas', 'Ephraïm', 'Eron', 'Ertan', 'Ethane', 'Exaucé', 'Eyüp', 'Fadil', 'Farid', 'Fausto', 'Faysal', 'Fil', 'Fre', 'Gary', 'Gaulthier', 'Gennaro', 'Gian', 'Gio', 'Guilhem', 'Gunnar', 'Guy', 'Gökdeniz', 'Haci', 'Hadi', 'Haitam', 'Harris', 'Houcine', 'Houdaïfa', 'Houssam', 'Ibrahima', 'Iebe', 'Iker', 'Illias', 'Imam', 'Imraan', 'Ioannis', 'Ishaq', 'Islam', 'Jacky', 'Jaden', 'Jeno', 'Jentel', 'Jento', 'Jethro', 'Jibbe', 'Jihad', 'Joakim', 'Joan', 'Jorick', 'Jorik', 'Jos', 'Josias', 'Joy', 'Jul', 'Juliano', 'Jun', 'Junot', 'Kaï', 'Kaj', 'Kay', 'Kaylan', 'Keane', 'Kelvin', 'Keo', 'Kiany', 'Kjelle', 'Kris', 'Kurt', 'Kyani', 'Kyenzo', 'Kyrian', 'Léni', 'Lévi', 'Laurenz', 'Leeroy', 'Lennard', 'Lennart', 'Lenne', 'Levy', 'Lio', 'Loann', 'Logann', 'Lomme', 'Loran', 'Louay', 'Ludwig', 'Luuk', 'Lüka', 'Maé', 'Maciej', 'Mahmoud', 'Maksim', 'Malcom', 'Mani', 'Marceau', 'Marten', 'Mathice', 'Mathyas', 'Matthys', 'Mattice', 'Matty', 'Matys', 'Maximiliaan', 'Medin', 'Melchior', 'Melik', 'Millan', 'Minh', 'Misha', 'Moad', 'Mordechai', 'Mouhamed', 'Mustapha', 'Najim', 'Nathéo', 'Nathaniel', 'Nawfal', 'Nessim', 'Nicky', 'Nicolai', 'Nidal', 'Nikolas', 'Nisse', 'Nohlan', 'Nout', 'Octave', 'Oguzhan', 'Ole', 'Oliwier', 'Ouassim', 'Pär', 'Pallieter', 'Patryk', 'Paul-Emile', 'Pavel', 'Phoenix', 'Pierre-Louis', 'Pinchas', 'Polat', 'Poyraz', 'Précieux', 'Quint', 'Rafal', 'Ramon', 'Reno', 'Renz', 'Rian', 'Rick', 'Rico', 'Rida', 'Ridvan', 'Ridwan', 'Rino', 'Rinor', 'Riyan', 'Robby', 'Rony', 'Rosario', 'Rudy', 'Rui', 'Safa', 'Sahil', 'Sakir', 'Salem', 'Sascha', 'Selman', 'Sergio', 'Servaas', 'Simen', 'Sohaib', 'Sonny', 'Sullyvan', 'Sulyvan', 'Sydney', 'Süleyman', 'Térence', 'Teddy', 'Thierno', 'Thybe', 'Tibau', 'Tjörven', 'Toine', 'Tristen', 'Tunahan', 'Tybe', 'Tyméo', 'Tyson', 'Ugolin', 'Ulrich', 'Valérian', 'Valère', 'Vigo', 'Virgil', 'Vivian', 'Volkan', 'Wahib', 'Warren', 'Wassil', 'Williams', 'Wissam', 'Wojciech', 'Woud', 'Xenne', 'Xiano', 'Yentel', 'Yerco', 'Yordi', 'Yoshi', 'Zen', 'Zineddine', 'Zjef', 'Aarjen', 'Abdelillah', 'Abdelkarim', 'Abdelmalek', 'Abderahim', 'Abderahman', 'Abderrahman', 'Abdessamad', 'Achil', 'Achilles', 'Adan', 'Aeneas', 'Ahren', 'Aiman', 'Aimeric', 'Alaric', 'Aleks', 'Aleksandr', 'Alexandru', 'Alpaslan', 'Alper', 'Altin', 'Alvaro', 'Aman', 'Amani', 'Ambroise', 'Amer', 'Amos', 'Anasse', 'Andi', 'Andrey', 'Angus', 'Anisse', 'Antoon', 'Arafat', 'Arianit', 'Arion', 'Armando', 'Arthus', 'Arto', 'Arwin', 'Aryan', 'Ashraf', 'Asim', 'Aslan', 'Astor', 'Atalay', 'Aubin', 'Aurel', 'Aurelien', 'Aurian', 'Auxence', 'Avi', 'Avraham', 'Azzeddine', 'Azzedine', 'Bader', 'Balthazar', 'Bao', 'Batin', 'Bayron', 'Bazil', 'Bentley', 'Berend', 'Berk', 'Berke', 'Bernd', 'Bertrand', 'Besnik', 'Bill', 'Born', 'Boyd', 'Brego', 'Bregt', 'Brikke', 'Bugra', 'Célio', 'Carsten', 'Cedrick', 'Celestin', 'Ceylan', 'Chad', 'Chakib', 'Chams', 'Chihab', 'Christ', 'Christiaan', 'Christiano', 'Christo', 'Cihan', 'Ciro', 'Coby', 'Cor', 'Cristian', 'Cyprian', 'Délano', 'Daimy', 'Danial', 'Daran', 'Darren', 'Davino', 'Dawson', 'Dervis', 'Devlin', 'Devrim', 'Diarno', 'Didier', 'Dien', 'Dieuwert', 'Dillen', 'Dimitrios', 'Djeff', 'Dobbe', 'Domenico', 'Door', 'Ebbe', 'Edin', 'Edison', 'Edmond', 'Eduardo', 'Efekan', 'Egemen', 'Eitan', 'Ekrem', 'El', 'Eldar', 'Elioth', 'Elyan', 'Emanuele', 'Emerik', 'Endy', 'Engin', 'Enno', 'Eno', 'Eran', 'Ercan', 'Erduhan', 'Erhan', 'Erick', 'Erjon', 'Ermin', 'Erwin', 'Etan', 'Etienne', 'Evann', 'Eytan', 'Ezio', 'Faisal', 'Faouzi', 'Fares', 'Faustin', 'Fayssal', 'Fiebe', 'Fin', 'Fionn', 'Firas', 'Floran', 'Floryan', 'Francisco', 'Franck', 'Frank', 'Frans', 'Friso', 'Gabor', 'Gaetan', 'Gautier', 'Georgi', 'Gerbe', 'Giacomo', 'Gian-Luca', 'Gibril', 'Gideon', 'Gohan', 'Gorik', 'Greg', 'Grim', 'Guido', 'Guilherme', 'Gustaaf', 'Gustav', 'Gwendal', 'Güven', 'Habib', 'Haico', 'Haiko', 'Hakki', 'Halid', 'Hamid', 'Hans', 'Harley', 'Haron', 'Hasse', 'Haythem', 'Herbert', 'Hocine', 'Hossam', 'Hugolin', 'Hussain', 'Huub', 'Iñaki', 'Iban', 'Ides', 'Ieben', 'Ignacio', 'Ihsan', 'Ilandro', 'Ilies', 'Ilja', 'Ilyès', 'Isaï', 'Italo', 'Iwan', 'Izzet', 'Jaak', 'Jaap', 'Jaber', 'Jael', 'Jakke', 'Jakov', 'Jalal', 'Jappe', 'Jatse', 'Jean-Charles', 'Jean-Claude', 'Jean-Marie', 'Jean-Philippe', 'Jean-Pierre', 'Jenson', 'Jentl', 'Jeppe', 'Jeremi', 'Jerke', 'Jerôme', 'Jibrail', 'Jo', 'Joep', 'Jokke', 'Jolian', 'Jools', 'Joos', 'Joram', 'Joulian', 'Kaïn', 'Kais', 'Kalim', 'Kalvin', 'Karol', 'Kaylen', 'Kelian', 'Kenaï', 'Keylian', 'Khaled', 'Kiéro', 'Konstantin', 'Krys', 'Kuba', 'Kyaro', 'Kyliann', 'Kynan', 'Léo-Paul', 'Lance', 'Lando', 'Larbi', 'Lawrence', 'Lazlo', 'Leart', 'Leopold', 'Lillo', 'Lion', 'Loïk', 'Loghan', 'Lohann', 'Lors', 'Louison', 'Lounes', 'Lowi', 'Lowic', 'Lowik', 'Luïs', 'Lucian', 'Lucius', 'Lucka', 'Luwe', 'Lyano', 'Lylian', 'Lysander', 'Médéric', 'Maïco', 'Macéo', 'Magomed', 'Malek', 'Malory', 'Manaël', 'Manoé', 'Manoë', 'Mansur', 'Mao', 'Marcelin', 'Marek', 'Maro', 'Marty', 'Massin', 'Matei', 'Maties', 'Matiss', 'Matto', 'Mavrick', 'Maylo', 'Mehmed', 'Mendy', 'Menzo', 'Mervyn', 'Metin', 'Mica', 'Mick', 'Mihai', 'Mik', 'Mikael', 'Mikolaj', 'Mingus', 'Mireau', 'Mohamed-Amin', 'Mohamed-Yassine', 'Moon', 'Moreno', 'Mouhammed', 'Mourad', 'Movses', 'Mustafacan', 'Myron', 'Naïl', 'Nahel', 'Nail', 'Naim', 'Najib', 'Nano', 'Nant', 'Nao', 'Nattan', 'Naufal', 'Necati', 'Nestor', 'Neyo', 'Nias', 'Nic', 'Niccolþ', 'Nicolaas', 'Niek', 'Nikolaï', 'Nil', 'Nilay', 'Noe', 'Nolle', 'Noor', 'Norman', 'Nourdine', 'Ocean', 'Oguz', 'Omer', 'Opoku', 'Orion', 'Otman', 'Oumar', 'Paulin', 'Paulo', 'Per', 'Philip', 'Pierrot', 'Quillan', 'Quin', 'Quinte', 'Rafik', 'Rahim', 'Ralf', 'Rasim', 'Raul', 'Ravi', 'Recep', 'Regi', 'Rehan', 'Rex', 'Rhys', 'Rhüne', 'Riccardo', 'Rikkert', 'Rinse', 'Rocco', 'Roger', 'Roni', 'Ronin', 'Ronny', 'Roshan', 'Ruan', 'Rutger', 'Ryad', 'Sébastian', 'Salahdin', 'Salahdine', 'Saliou', 'Salomon', 'Salvino', 'Santos', 'Saul', 'Sayf', 'Selahattin', 'Semmy', 'Shaun', 'Shlomo', 'Sieben', 'Siebren', 'Siemon', 'Sky', 'Sofyan', 'Sohan', 'Sohayb', 'Sooi', 'Souleiman', 'Stanislav', 'Steff', 'Stephan', 'Sterre', 'Tahir', 'Taro', 'Taylan', 'Tayron', 'Tayssir', 'Teoman', 'Thanh', 'Thias', 'Thieme', 'Thiemen', 'Thies', 'Thijmen', 'Thyméo', 'Tiamo', 'Tieben', 'Tille', 'Timy', 'Tinus', 'Tjenne', 'Tjorben', 'Tomy', 'Tugra', 'Ty', 'Tybo', 'Umberto', 'Uwe', 'Valton', 'Vangelis', 'Vedran', 'Veysel', 'Vin', 'Vinnie', 'Vins', 'Vinz', 'Vital', 'Wahid', 'Wahil', 'Walied', 'Walt', 'Wassime', 'Waut', 'Wibe', 'Wim', 'Wonder', 'Xeno', 'Xibe', 'Xiben', 'Yago', 'Yanice', 'Yanni', 'Yaser', 'Yenno', 'Yens', 'Yerko', 'Yigithan', 'Ylli', 'Yohann', 'Yorn', 'Youssouf', 'Zéno', 'Zéphyr', 'Zain', 'Zakary', 'Zaki', 'Zef', 'Zeyd', 'Zi', 'Zidan', 'Zidane', 'Zouhir', 'Zvi', 'Zyad', 'Zyon', 'Aäron', 'Aïdan', 'Aïden', 'Aïssa', 'Abd', 'Abdelaziz', 'Abdelhakim', 'Abdeljalil', 'Abdelkader', 'Abdelmalik', 'Abdelmatine', 'Abderrahim', 'Abdirahman', 'Abdourahmane', 'Abdussamet', 'Achmed', 'Adams', 'Adelin', 'Aden', 'Adhémar', 'Adi', 'Aditya', 'Adlan', 'Aeren', 'Afrim', 'Agon', 'Agustin', 'Aitor', 'Aki', 'Akim', 'Akira', 'Akke', 'Al', 'Aléandro', 'Alae-Eddine', 'Albin', 'Aldo', 'Aleksander', 'Aleksandre', 'Aleksey', 'Aleksi', 'Alexei', 'Alexian', 'Alexio', 'Alfonso', 'Alican', 'Aliou', 'Alisan', 'Allessio', 'Almamy', 'Alonzo', 'Alpay', 'Altay', 'Amédée', 'Amédéo', 'Amadéo', 'Ammar', 'Amon', 'Ancelin', 'Anderson', 'Andrej', 'Andrik', 'Andrin', 'Angad', 'Angelino', 'Angelos', 'Anh', 'Anri', 'Anselme', 'Antar', 'Anthonin', 'Aram', 'Aran', 'Arav', 'Arbër', 'Arben', 'Arden', 'Ardian', 'Aren', 'Ares', 'Ariel', 'Aristo', 'Aristote', 'Arjan', 'Arlen', 'Armani', 'Armin', 'Arnaut', 'Arnes', 'Arold', 'Art', 'Arti', 'Arvin', 'Aschab', 'Asher', 'Ashish', 'Aston', 'Ata', 'Atacan', 'Attila', 'Atze', 'Audran', 'Auron', 'Ayan', 'Aydin', 'Ayham', 'Ayhan', 'Aylan', 'Azeddine', 'Azedine', 'Azeem', 'Azizcan', 'Béni', 'Babacar', 'Baki', 'Bakr', 'Baptist', 'Barre', 'Barry', 'Bart-Jan', 'Benedict', 'Benny', 'Benten', 'Benthe', 'Benyamin', 'Bern', 'Berne', 'Berry', 'Berthen', 'Berzan', 'Besian', 'Beytullah', 'Biagio', 'Bilâl', 'Björn', 'Blaise', 'Borre', 'Boubacar', 'Boubakar', 'Brady', 'Brain', 'Brenden', 'Brieux', 'Burhan', 'Céderic', 'Céleste', 'Caesar', 'Cafer', 'Cali', 'Calixte', 'Camron', 'Caner', 'Carlito', 'Cassien', 'Cay', 'Cebrail', 'Cederic', 'Cedrik', 'Celian', 'Celio', 'Celle', 'Cemal', 'Charel', 'Charles-Henri', 'Chayan', 'Chayton', 'Chen', 'Chendo', 'Chesney', 'Christoph', 'Christopheur', 'Chun', 'Cian', 'Cihat', 'Cillian', 'Ciryl', 'Colyn', 'Conner', 'Constantijn', 'Constantinos', 'Corenthin', 'Corian', 'Corto', 'Cruz', 'Curtis', 'Cyrian', 'Cyrile', 'Cyrus', 'Désiré', 'Dag', 'Daimen', 'Daly', 'Danthe', 'Danut', 'Darcy', 'Daren', 'Darian', 'Darko', 'Daron', 'Dauwe', 'Davud', 'Davut', 'Demetan', 'Demir', 'Demko', 'Demyan', 'Denley', 'Denni', 'Derek', 'Destan', 'Diederik', 'Dieuwe', 'Dilraj', 'Din', 'Dior', 'Diyar', 'Django', 'Djaro', 'Djessy', 'Djulian', 'Dogukan', 'Dolf', 'Dominique', 'Donart', 'Donny', 'Doreano', 'Dre', 'Dreas', 'Dree', 'Drilon', 'Driton', 'Dursun', 'Duy', 'Dyano', 'Dylario', 'Ebenezer', 'Ebubekir', 'Edan', 'Edgard', 'Ediz', 'Edon', 'Efecan', 'Efrain', 'Egzon', 'Elez', 'Eliseo', 'Eliyah', 'Elmir', 'Elton', 'Elvin', 'Elvis', 'Elya', 'Elyes', 'Eméric', 'Emilian', 'Emmerick', 'Emrys', 'Ender', 'Endi', 'Endri', 'Enea', 'Enguerrand', 'Ennes', 'Ennis', 'Enyo', 'Ephraim', 'Erbey', 'Erblin', 'Ergin', 'Eris', 'Erkan', 'Ernesto', 'Ernis', 'Ersan', 'Eryk', 'Esad', 'Eser', 'Essam', 'Estevan', 'Ethanaël', 'Euan', 'Eugène', 'Evans', 'Even', 'Everton', 'Ewann', 'Eyoub', 'Eyyüb', 'Ezékiel', 'Ezechiel', 'Fábio', 'Fabiano', 'Fabien', 'Fady', 'Fahad', 'Fahim', 'Faki', 'Falco', 'Farès', 'Farel', 'Farez', 'Farhan', 'Farouk', 'Faruk', 'Fatmir', 'Felipe', 'Fender', 'Ferran', 'Festim', 'Fik', 'Fikri', 'Filippo', 'Finley', 'Florens', 'Floriano', 'Floriant', 'Fonne', 'Frédérick', 'Franky', 'Franz', 'Frederic', 'Freek', 'Fries', 'Frits', 'Fynn', 'Géraud', 'Gérôme', 'Gaëtano', 'Gaultier', 'Gemechu', 'Gentil', 'Geordy', 'Gerd', 'Gert', 'Ghislain', 'Gia', 'Giani', 'Gibbe', 'Giele', 'Gies', 'Gilbert', 'Gilian', 'Giordano', 'Giorgi', 'Glen', 'Glodi', 'Godwin', 'Gonçalo', 'Grady', 'Griffen', 'Guilian', 'Guillermo', 'Guyan', 'Gwenaël', 'Gwenn', 'Gyllian', 'Gürkan', 'Haïtam', 'Haitham', 'Halit', 'Hamdi', 'Hamzat', 'Hanafi', 'Hany', 'Haris', 'Harrison', 'Haruki', 'Hayati', 'Hayk', 'Haytem', 'Haytham', 'Heiko', 'Henoc', 'Henrik', 'Herwan', 'Hery', 'Hidde', 'Hossein', 'Hossni', 'Hung', 'Hussein', 'Ianis', 'Iann', 'Iannis', 'Iano', 'Iarno', 'Ibragim', 'Idès', 'Ide', 'Iemen', 'Ignazio', 'Ihsaan', 'Ilay', 'Iliass', 'Ilio', 'Illian', 'Illyan', 'Ilyâs', 'Ilyo', 'Imano', 'Imed', 'Imrân', 'Indy', 'Inti', 'Isha', 'Iwein', 'Izaak', 'Jérémiah', 'Jérome', 'Jabir', 'Jade', 'Jafar', 'Jago', 'Jaiden', 'Jaimie', 'Jaldert', 'Jan-Willem', 'Janis', 'Jared', 'Jarvis', 'Jary', 'Jassim', 'Jay-Jay', 'Jean-Jacques', 'Jecheskel', 'Jelmer', 'Jenten', 'Jenz', 'Jeremiah', 'Jeremie', 'Jeroom', 'Jerre', 'Jess', 'Jetmir', 'Jetse', 'Jetze', 'Jhon', 'Jia', 'Jidse', 'Jilan', 'Jill', 'Jiri', 'Jiro', 'Joao', 'Job', 'Joffrey', 'Jon', 'Jop', 'Jord', 'Jorg', 'Jorge', 'Jorgen', 'Jorgo', 'Jorit', 'Josselin', 'Jossi', 'Jotte', 'Jozef', 'Jozua', 'Juanito', 'Julen', 'Julián', 'Juliann', 'Julianno', 'Julio', 'Jullian', 'Jullyan', 'Justen', 'Justice', 'Kéan', 'Kélyan', 'Kaïs', 'Kaleb', 'Kalyan', 'Kamuran', 'Karan', 'Kayne', 'Kayra', 'Keanan', 'Keegan', 'Ken', 'Kenai', 'Kenay', 'Keno', 'Kento', 'Keoni', 'Keran', 'Kerry', 'Keyano', 'Keylan', 'Kiaro', 'Killyan', 'Kim', 'Kinaï', 'Kingsley', 'Klajdi', 'Koby', 'Koenraad', 'Konrad', 'Kor', 'Kosuke', 'Krieke', 'Krish', 'Kuno', 'Kurtis', 'Kwint', 'Kyann', 'Kyliano', 'Kylyan', 'Kynai', 'Kythano', 'Lamine', 'Lanzo', 'Lauden', 'Lauran', 'Lauren', 'Lauro', 'Lavdrim', 'Layton', 'Lemmy', 'Lender', 'Lenderd', 'Lennon', 'Lennox', 'Lenzo', 'Leroy', 'Levente', 'Lin', 'Lior', 'Lirio', 'Lisandro', 'Liyaro', 'Lokman', 'Loqmane', 'Lorris', 'Louic', 'Louis-Victor', 'Lounès', 'Lounis', 'Loup', 'Lowen', 'Loyan', 'Luckas', 'Lucky', 'Luk', 'Médard', 'MHamed', 'Maëlan', 'Maëron', 'Maïko', 'Maano', 'Maaren', 'Magamed', 'Magnus', 'Mahieddine', 'Mahmut', 'Maik', 'Maikel', 'Maiko', 'Maksis', 'Malick', 'Mallory', 'Malon', 'Mamadi', 'Mamoudou', 'Manéo', 'Manau', 'Manel', 'Mansour', 'Maris', 'Marlone', 'Mart', 'Martial', 'Mateus', 'Mathé', 'Mathiz', 'Mathurin', 'Matice', 'Matijs', 'Matiz', 'Matte', 'Matties', 'Mattisse', 'Mattiz', 'Mattys', 'Mauri', 'Maxent', 'Maximin', 'Maximus', 'Maxwell', 'Maxyme', 'Mazen', 'Medard', 'Medhi', 'Mehmetcan', 'Mehran', 'Melek', 'Melvil', 'Mendel', 'Merdan', 'Merijn', 'Merlot', 'Merrick', 'Mertcan', 'Michée', 'Michail', 'Michal', 'Mickel', 'Micky', 'Mikel', 'Mikey', 'Miles', 'Milio', 'Mille', 'Ming', 'Mirsad', 'Mitch', 'Mitchell', 'Mohad', 'Mohamed-Ali', 'Mohamed-Ayman', 'Mohamed-Reda', 'Mohamet', 'Mohammed-Amine', 'Mon', 'Moncef', 'Monsef', 'Morten', 'Mory', 'Mostafa', 'Mouhsine', 'Moulay', 'Mounib', 'Moustapha', 'Muammer', 'Mugisha', 'Muhammed-Ali', 'Nahuel', 'Najm', 'Nandor', 'Nasri', 'Nathaël', 'Nathanael', 'Nathaniël', 'Naut', 'Nayel', 'Nazim', 'Nebi', 'Nedim', 'Nello', 'Nezar', 'Nickola', 'Nickson', 'Nielsen', 'Nik', 'Niko', 'Nikolai', 'Nilo', 'Niran', 'Nizam', 'Noaman', 'Nomane', 'Noran', 'Nordin', 'Noud', 'Nourane', 'Nourdin', 'Noureddine', 'Numa', 'Numan', 'Nunio', 'Nunzio', 'Nusret', 'Nyano', 'Nôa', 'Océan', 'Odiel', 'Oisin', 'Olsen', 'Orçun', 'Orazio', 'Orvil', 'Ossama', 'Ossian', 'Otto-Jan', 'Ouail', 'Oualid', 'Oumarou', 'Ousmane', 'Ozias', 'Parsa', 'Patricio', 'Perre', 'Pharrell', 'Philéas', 'Phillip', 'Pieke', 'Pierre-Alexandre', 'Pierre-Antoine', 'Pierre-Emmanuel', 'Pierre-Henri', 'Piet', 'Pifte', 'Preben', 'Preston', 'Prosper', 'Réda', 'Raffaël', 'Ragnar', 'Rahul', 'Ramin', 'Rani', 'Rasul', 'Raymond', 'Redon', 'Redwane', 'Regilio', 'Reindert', 'Remo', 'Renaat', 'Renato', 'Reyad', 'Rhan', 'Rhoân', 'Rias', 'Ries', 'Roald', 'Robbert', 'Roberto', 'Robinson', 'Roderick', 'Rodi', 'Rohat', 'Romann', 'Romaric', 'Romin', 'Romuald', 'Ron', 'Ross', 'Rrezon', 'Rubén', 'Ruby', 'Saël', 'Saïd', 'Sabir', 'Sabry', 'Sachin', 'Safwân', 'Salah-Eddine', 'Salahedine', 'Salavat', 'Saleh', 'Sali', 'Samed', 'Sameer', 'Samil', 'Samme', 'Samson', 'Sancho', 'Santi', 'Saro', 'Sauro', 'Saverio', 'Savino', 'Savio', 'Sayhan', 'Schilo', 'Sebahattin', 'Sebas', 'Sebastián', 'Sebe', 'Sedat', 'Sef', 'Seifedine', 'Selçuk', 'Selimhan', 'Selmen', 'Semm', 'Senn', 'Serdar', 'Serif', 'Sevan', 'Seydi', 'Seydou', 'Seyni', 'Shadi', 'Shadrach', 'Shandro', 'Shayan', 'Shayne', 'Shean', 'Shmiel', 'Shun', 'Siam', 'Sibren', 'Sid-Ahmed', 'Sidharta', 'Sidi', 'Sidney', 'Sigurd', 'Silouane', 'Silvain', 'Sim', 'Simao', 'Simeon', 'Skander', 'Skender', 'Sofyane', 'Soheil', 'Sohel', 'Solan', 'Solomon', 'Sorin', 'Souheil', 'Stéphan', 'Stanne', 'Steeven', 'Stelio', 'Stenne', 'Steph', 'Stephen', 'Stern', 'Stevens', 'Steyn', 'Stian', 'Stigg', 'Suat', 'Sully', 'Syben', 'Syed', 'Sylvester', 'Syme', 'Szabolcs', 'Sören', 'Tadeo', 'Tadeusz', 'Tahsin', 'Talal', 'Talat', 'Taoufik', 'Tars', 'Taulant', 'Tayfun', 'Theodore', 'Thibeaux', 'Thiebaut', 'Thieben', 'Thijn', 'Thimoté', 'Thoby', 'Thoma', 'Thorgal', 'Thorre', 'Thuur', 'Thylan', 'Thymo', 'Tian', 'Tibaut', 'Tiber', 'Ticho', 'Tidiane', 'Tiele', 'Tillo', 'Timée', 'Timber', 'Timoty', 'Tino', 'Tist', 'Titien', 'Tjardo', 'Tjebbe', 'Tjendo', 'Tobey', 'Tomás', 'Toma', 'Tommie', 'Toni', 'Torbe', 'Torn', 'Torr', 'Torsten', 'Toto', 'Toufik', 'Treasure', 'Tuomas', 'Turhan', 'Tyano', 'Tye', 'Tylian', 'Tymo', 'Tymon', 'Tyr', 'Tyrone', 'Tysen', 'Ubi', 'Ulric', 'Ulrick', 'Usmaan', 'Uzair', 'Valon', 'Vasco', 'Vedat', 'Veli', 'Vicente', 'Vinh', 'Vitas', 'Vittorio', 'Vojtech', 'Vos', 'Wacil', 'Wadie', 'Wadir', 'Wajih', 'Wallace', 'Walter', 'Wanne', 'Wasim', 'Wens', 'Willy', 'Winston', 'Wonne', 'Xabi', 'Xandres', 'Xano', 'Xanten', 'Xaro', 'Xen', 'Xiebe', 'Xim', 'Xin', 'Xino', 'Xiro', 'Xylian', 'Yael', 'Yagiz', 'Yahto', 'Yamin', 'Yanisse', 'Yannik', 'Yarni', 'Yavuz', 'Yazan', 'Ybe', 'Yde', 'Yechiel', 'Yelle', 'Yenthel', 'Yentho', 'Yessin', 'Yildiray', 'Yilmaz', 'Yoanis', 'Yonas', 'Yonni', 'Yoram', 'Yoris', 'Yorrick', 'Yotam', 'Youenn', 'Younès', 'Younis', 'Yuki', 'Yule', 'Yuran', 'Zéphyrin', 'Zaccaria', 'Zaccharia', 'Zackari', 'Zappa', 'Zelim', 'Zenne', 'Zep'



    				);
    				
    	$achternamen = array(
    					 'SMITH','JOHNSON','WILLIAMS','JONES','BROWN','DAVIS','MILLER','WILSON','MOORE','TAYLOR','ANDERSON','THOMAS','JACKSON','WHITE','HARRIS','MARTIN','THOMPSON','GARCIA','MARTINEZ','ROBINSON','CLARK','RODRIGUEZ','LEWIS','LEE','WALKER','HALL','ALLEN','YOUNG','HERNANDEZ','KING','WRIGHT','LOPEZ','HILL','SCOTT','GREEN','ADAMS','BAKER','GONZALEZ','NELSON','CARTER','MITCHELL','PEREZ','ROBERTS','TURNER','PHILLIPS','CAMPBELL','PARKER','EVANS','EDWARDS','COLLINS','STEWART','SANCHEZ','MORRIS','ROGERS','REED','COOK','MORGAN','BELL','MURPHY','BAILEY','RIVERA','COOPER','RICHARDSON','COX','HOWARD','WARD','TORRES','PETERSON','GRAY','RAMIREZ','JAMES','WATSON','BROOKS','KELLY','SANDERS','PRICE','BENNETT','WOOD','BARNES','ROSS','HENDERSON','COLEMAN','JENKINS','PERRY','POWELL','LONG','PATTERSON','HUGHES','FLORES','WASHINGTON','BUTLER','SIMMONS','FOSTER','GONZALES','BRYANT','ALEXANDER','RUSSELL','GRIFFIN','DIAZ','HAYES','MYERS','FORD','HAMILTON','GRAHAM','SULLIVAN','WALLACE','WOODS','COLE','WEST','JORDAN','OWENS','REYNOLDS','FISHER','ELLIS','HARRISON','GIBSON','MCDONALD','CRUZ','MARSHALL','ORTIZ','GOMEZ','MURRAY','FREEMAN','WELLS','WEBB','SIMPSON','STEVENS','TUCKER','PORTER','HUNTER','HICKS','CRAWFORD','HENRY','BOYD','MASON','MORALES','KENNEDY','WARREN','DIXON','RAMOS','REYES','BURNS','GORDON','SHAW','HOLMES','RICE','ROBERTSON','HUNT','BLACK','DANIELS','PALMER','MILLS','NICHOLS','GRANT','KNIGHT','FERGUSON','ROSE','STONE','HAWKINS','DUNN','PERKINS','HUDSON','SPENCER','GARDNER','STEPHENS','PAYNE','PIERCE','BERRY','MATTHEWS','ARNOLD','WAGNER','WILLIS','RAY','WATKINS','OLSON','CARROLL','DUNCAN','SNYDER','HART','CUNNINGHAM','BRADLEY','LANE','ANDREWS','RUIZ','HARPER','FOX','RILEY','ARMSTRONG','CARPENTER','WEAVER','GREENE','LAWRENCE','ELLIOTT','CHAVEZ','SIMS','AUSTIN','PETERS','KELLEY','FRANKLIN','LAWSON','FIELDS','GUTIERREZ','RYAN','SCHMIDT','CARR','VASQUEZ','CASTILLO','WHEELER','CHAPMAN','OLIVER','MONTGOMERY','RICHARDS','WILLIAMSON','JOHNSTON','BANKS','MEYER','BISHOP','MCCOY','HOWELL','ALVAREZ','MORRISON','HANSEN','FERNANDEZ','GARZA','HARVEY','LITTLE','BURTON','STANLEY','NGUYEN','GEORGE','JACOBS','REID','KIM','FULLER','LYNCH','DEAN','GILBERT','GARRETT','ROMERO','WELCH','LARSON','FRAZIER','BURKE','HANSON','DAY','MENDOZA','MORENO','BOWMAN','MEDINA','FOWLER','BREWER','HOFFMAN','CARLSON','SILVA','PEARSON','HOLLAND','DOUGLAS','FLEMING','JENSEN','VARGAS','BYRD','DAVIDSON','HOPKINS','MAY','TERRY','HERRERA','WADE','SOTO','WALTERS','CURTIS','NEAL','CALDWELL','LOWE','JENNINGS','BARNETT','GRAVES','JIMENEZ','HORTON','SHELTON','BARRETT','OBRIEN','CASTRO','SUTTON','GREGORY','MCKINNEY','LUCAS','MILES','CRAIG','RODRIQUEZ','CHAMBERS','HOLT','LAMBERT','FLETCHER','WATTS','BATES','HALE','RHODES','PENA','BECK','NEWMAN','HAYNES','MCDANIEL','MENDEZ','BUSH','VAUGHN','PARKS','DAWSON','SANTIAGO','NORRIS','HARDY','LOVE','STEELE','CURRY','POWERS','SCHULTZ','BARKER','GUZMAN','PAGE','MUNOZ','BALL','KELLER','CHANDLER','WEBER','LEONARD','WALSH','LYONS','RAMSEY','WOLFE','SCHNEIDER','MULLINS','BENSON','SHARP','BOWEN','DANIEL','BARBER','CUMMINGS','HINES','BALDWIN','GRIFFITH','VALDEZ','HUBBARD','SALAZAR','REEVES','WARNER','STEVENSON','BURGESS','SANTOS','TATE','CROSS','GARNER','MANN','MACK','MOSS','THORNTON','DENNIS','MCGEE','FARMER','DELGADO','AGUILAR','VEGA','GLOVER','MANNING','COHEN','HARMON','RODGERS','ROBBINS','NEWTON','TODD','BLAIR','HIGGINS','INGRAM','REESE','CANNON','STRICKLAND','TOWNSEND','POTTER','GOODWIN','WALTON','ROWE','HAMPTON','ORTEGA','PATTON','SWANSON','JOSEPH','FRANCIS','GOODMAN','MALDONADO','YATES','BECKER','ERICKSON','HODGES','RIOS','CONNER','ADKINS','WEBSTER','NORMAN','MALONE','HAMMOND','FLOWERS','COBB','MOODY','QUINN','BLAKE','MAXWELL','POPE','FLOYD','OSBORNE','PAUL','MCCARTHY','GUERRERO','LINDSEY','ESTRADA','SANDOVAL','GIBBS','TYLER','GROSS','FITZGERALD','STOKES','DOYLE','SHERMAN','SAUNDERS','WISE','COLON','GILL','ALVARADO','GREER','PADILLA','SIMON','WATERS','NUNEZ','BALLARD','SCHWARTZ','MCBRIDE','HOUSTON','CHRISTENSEN','KLEIN','PRATT','BRIGGS','PARSONS','MCLAUGHLIN','ZIMMERMAN','FRENCH','BUCHANAN','MORAN','COPELAND','ROY','PITTMAN','BRADY','MCCORMICK','HOLLOWAY','BROCK','POOLE','FRANK','LOGAN','OWEN','BASS','MARSH','DRAKE','WONG','JEFFERSON','PARK','MORTON','ABBOTT','SPARKS','PATRICK','NORTON','HUFF','CLAYTON','MASSEY','LLOYD','FIGUEROA','CARSON','BOWERS','ROBERSON','BARTON','TRAN','LAMB','HARRINGTON','CASEY','BOONE','CORTEZ','CLARKE','MATHIS','SINGLETON','WILKINS','CAIN','BRYAN','UNDERWOOD','HOGAN','MCKENZIE','COLLIER','LUNA','PHELPS','MCGUIRE','ALLISON','BRIDGES','WILKERSON','NASH','SUMMERS','ATKINS','WILCOX','PITTS','CONLEY','MARQUEZ','BURNETT','RICHARD','COCHRAN','CHASE','DAVENPORT','HOOD','GATES','CLAY','AYALA','SAWYER','ROMAN','VAZQUEZ','DICKERSON','HODGE','ACOSTA','FLYNN','ESPINOZA','NICHOLSON','MONROE','WOLF','MORROW','KIRK','RANDALL','ANTHONY','WHITAKER','OCONNOR','SKINNER','WARE','MOLINA','KIRBY','HUFFMAN','BRADFORD','CHARLES','GILMORE','DOMINGUEZ','ONEAL','BRUCE','LANG','COMBS','KRAMER','HEATH','HANCOCK','GALLAGHER','GAINES','SHAFFER','SHORT','WIGGINS','MATHEWS','MCCLAIN','FISCHER','WALL','SMALL','MELTON','HENSLEY','BOND','DYER','CAMERON','GRIMES','CONTRERAS','CHRISTIAN','WYATT','BAXTER','SNOW','MOSLEY','SHEPHERD','LARSEN','HOOVER','BEASLEY','GLENN','PETERSEN','WHITEHEAD','MEYERS','KEITH','GARRISON','VINCENT','SHIELDS','HORN','SAVAGE','OLSEN','SCHROEDER','HARTMAN','WOODARD','MUELLER','KEMP','DELEON','BOOTH','PATEL','CALHOUN','WILEY','EATON','CLINE','NAVARRO','HARRELL','LESTER','HUMPHREY','PARRISH','DURAN','HUTCHINSON','HESS','DORSEY','BULLOCK','ROBLES','BEARD','DALTON','AVILA','VANCE','RICH','BLACKWELL','YORK','JOHNS','BLANKENSHIP','TREVINO','SALINAS','CAMPOS','PRUITT','MOSES','CALLAHAN','GOLDEN','MONTOYA','HARDIN','GUERRA','MCDOWELL','CAREY','STAFFORD','GALLEGOS','HENSON','WILKINSON','BOOKER','MERRITT','MIRANDA','ATKINSON','ORR','DECKER','HOBBS','PRESTON','TANNER','KNOX','PACHECO','STEPHENSON','GLASS','ROJAS','SERRANO','MARKS','HICKMAN','ENGLISH','SWEENEY','STRONG','PRINCE','MCCLURE','CONWAY','WALTER','ROTH','MAYNARD','FARRELL','LOWERY','HURST','NIXON','WEISS','TRUJILLO','ELLISON','SLOAN','JUAREZ','WINTERS','MCLEAN','RANDOLPH','LEON','BOYER','VILLARREAL','MCCALL','GENTRY','CARRILLO','KENT','AYERS','LARA','SHANNON','SEXTON','PACE','HULL','LEBLANC','BROWNING','VELASQUEZ','LEACH','CHANG','HOUSE','SELLERS','HERRING','NOBLE','FOLEY','BARTLETT','MERCADO','LANDRY','DURHAM','WALLS','BARR','MCKEE','BAUER','RIVERS','EVERETT','BRADSHAW','PUGH','VELEZ','RUSH','ESTES','DODSON','MORSE','SHEPPARD','WEEKS','CAMACHO','BEAN','BARRON','LIVINGSTON','MIDDLETON','SPEARS','BRANCH','BLEVINS','CHEN','KERR','MCCONNELL','HATFIELD','HARDING','ASHLEY','SOLIS','HERMAN','FROST','GILES','BLACKBURN','WILLIAM','PENNINGTON','WOODWARD','FINLEY','MCINTOSH','KOCH','BEST','SOLOMON','MCCULLOUGH','DUDLEY','NOLAN','BLANCHARD','RIVAS','BRENNAN','MEJIA','KANE','BENTON','JOYCE','BUCKLEY','HALEY','VALENTINE','MADDOX','RUSSO','MCKNIGHT','BUCK','MOON','MCMILLAN','CROSBY','BERG','DOTSON','MAYS','ROACH','CHURCH','CHAN','RICHMOND','MEADOWS','FAULKNER','ONEILL','KNAPP','KLINE','BARRY','OCHOA','JACOBSON','GAY','AVERY','HENDRICKS','HORNE','SHEPARD','HEBERT','CHERRY','CARDENAS','MCINTYRE','WHITNEY','WALLER','HOLMAN','DONALDSON','CANTU','TERRELL','MORIN','GILLESPIE','FUENTES','TILLMAN','SANFORD','BENTLEY','PECK','KEY','SALAS','ROLLINS','GAMBLE','DICKSON','BATTLE','SANTANA','CABRERA','CERVANTES','HOWE','HINTON','HURLEY','SPENCE','ZAMORA','YANG','MCNEIL','SUAREZ','CASE','PETTY','GOULD','MCFARLAND','SAMPSON','CARVER','BRAY','ROSARIO','MACDONALD','STOUT','HESTER','MELENDEZ','DILLON','FARLEY','HOPPER','GALLOWAY','POTTS','BERNARD','JOYNER','STEIN','AGUIRRE','OSBORN','MERCER','BENDER','FRANCO','ROWLAND','SYKES','BENJAMIN','TRAVIS','PICKETT','CRANE','SEARS','MAYO','DUNLAP','HAYDEN','WILDER','MCKAY','COFFEY','MCCARTY','EWING','COOLEY','VAUGHAN','BONNER','COTTON','HOLDER','STARK','FERRELL','CANTRELL','FULTON','LYNN','LOTT','CALDERON','ROSA','POLLARD','HOOPER','BURCH','MULLEN','FRY','RIDDLE','LEVY','DAVID','DUKE','ODONNELL','GUY','MICHAEL','BRITT','FREDERICK','DAUGHERTY','BERGER','DILLARD','ALSTON','JARVIS','FRYE','RIGGS','CHANEY','ODOM','DUFFY','FITZPATRICK','VALENZUELA','MERRILL','MAYER','ALFORD','MCPHERSON','ACEVEDO','DONOVAN','BARRERA','ALBERT','COTE','REILLY','COMPTON','RAYMOND','MOONEY','MCGOWAN','CRAFT','CLEVELAND','CLEMONS','WYNN','NIELSEN','BAIRD','STANTON','SNIDER','ROSALES','BRIGHT','WITT','STUART','HAYS','HOLDEN','RUTLEDGE','KINNEY','CLEMENTS','CASTANEDA','SLATER','HAHN','EMERSON','CONRAD','BURKS','DELANEY','PATE','LANCASTER','SWEET','JUSTICE','TYSON','SHARPE','WHITFIELD','TALLEY','MACIAS','IRWIN','BURRIS','RATLIFF','MCCRAY','MADDEN','KAUFMAN','BEACH','GOFF','CASH','BOLTON','MCFADDEN','LEVINE','GOOD','BYERS','KIRKLAND','KIDD','WORKMAN','CARNEY','DALE','MCLEOD','HOLCOMB','ENGLAND','FINCH','HEAD','BURT','HENDRIX','SOSA','HANEY','FRANKS','SARGENT','NIEVES','DOWNS','RASMUSSEN','BIRD','HEWITT','LINDSAY','LE','FOREMAN','VALENCIA','ONEIL','DELACRUZ','VINSON','DEJESUS','HYDE','FORBES','GILLIAM','GUTHRIE','WOOTEN','HUBER','BARLOW','BOYLE','MCMAHON','BUCKNER','ROCHA','PUCKETT','LANGLEY','KNOWLES','COOKE','VELAZQUEZ','WHITLEY','NOEL','VANG',
    	
    	
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
    	$achternaam = $achternamen[array_rand($achternamen)];
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
    				
'LEA', 'EMMA', 'JULIETTE', 'ROSALIE', 'FLORENCE', 'ALICE', 'NOEMIE', 'OLIVIA', 'CAMILLE', 'CHLOE', 'ZOE', 'LAURENCE', 'MAIKA', 'JADE', 'MIA', 'ALICIA', 'MAELIE', 'SARAH', 'GABRIELLE', 'ALEXIA', 'CHARLOTTE', 'CORALIE', 'ANAIS', 'MEGANE', 'VICTORIA', 'CHARLIE', 'EVE', 'ELIZABETH', 'ANNABELLE', 'EVA', 'ELODIE', 'EMY', 'RAPHAELLE', 'CLARA', 'EMILIE', 'BEATRICE', 'MARIANNE', 'SOFIA', 'MAEVA', 'ROSE', 'OCEANE', 'ARIANE', 'MEGAN', 'MAYA', 'AURELIE', 'DELPHINE', 'LAURIE', 'LILY-ROSE', 'JUSTINE', 'LEANNE', 'MAUDE', 'AMELIA', 'SOPHIE', 'ELIANE', 'MARILOU', 'MYA', 'JASMINE', 'DAPHNEE', 'MELODIE', 'MAELLE', 'LEONIE', 'MATHILDE', 'ELOISE', 'SARA', 'JULIA', 'KAYLA', 'NAOMIE', 'ALEXANDRA', 'AMELIE', 'JEANNE', 'AUDREY', 'ALYCIA', 'SOPHIA', 'JULIANNE', 'MAGALIE', 'AMY', 'EMILY', 'FREDERIQUE', 'ANABELLE', 'YASMINE', 'CATHERINE', 'ELISABETH', 'ALYSSA', 'MAELY', 'ISABELLA', 'LIVIA', 'OCEANNE', 'STELLA', 'KELLY-ANN', 'LEA-ROSE', 'LYDIA', 'LILY', 'ARIELLE', 'LAURIANNE', 'LAURA', 'FLAVIE', 'ALYSON', 'ERIKA', 'LINA', 'REBECCA', 'OPHELIE', 'AYA', 'GABRIELLA', 'LEILA', 'MAXIM', 'MYRIAM', 'ELLIE', 'MELODY', 'LEANE', 'PENELOPE', 'DAPHNE', 'LAURALIE', 'MELIA', 'ADELE', 'MARIA', 'MELINA', 'NAOMI', 'MILA', 'SABRINA', 'SANDRINE', 'ANNA', 'ANNE-SOPHIE', 'ARIANNE', 'ROMY', 'SIMONE', 'EMMY', 'LORIE', 'ALEXANNE', 'LAYLA', 'BIANCA', 'MARIE', 'MADISON', 'MALAK', 'ALEXANE', 'ANGELIQUE', 'INES', 'LILI-ROSE', 'NELLY', 'RAFAELLE', 'JESSICA', 'MARGUERITE', 'CLOE', 'KELLY', 'MARYLOU', 'ELEONORE', 'KIM', 'ABIGAELLE', 'ASHLEY', 'ELLA', 'KORALIE', 'RACHEL', 'ELENA', 'RANIA', 'EVELYNE', 'ROMANE', 'ANNE', 'CLEMENCE', 'ESTELLE', 'LEAH', 'ABIGAEL', 'ABYGAELLE', 'FELICIA', 'ISABELLE', 'LILI', 'ALEXA', 'ALEXIE', 'AMANDA', 'MARIE-SOLEIL', 'AGATHE', 'MARION', 'SARAH-MAUDE', 'VANESSA', 'HEIDI', 'NOUR', 'ROXANNE', 'AMELYA', 'ANGELINA', 'GAELLE', 'MAXIME', 'ALYSSIA', 'EMMANUELLE', 'LAURIANE', 'LILIANE', 'MAHEE', 'MELISSA', 'NORAH', 'ELIANA', 'MARIANE', 'SALMA', 'ANABEL', 'BELLA', 'MELIANE', 'ARIEL', 'ELSA', 'ELIE', 'ELYANE', 'KELLYANN', 'BRITANY', 'DANIKA', 'MAELLY', 'SAMANTHA', 'DAHLIA', 'ELIANNE', 'LYVIA', 'MAHELIE', 'MAINA', 'NAOMY', 'VIOLETTE', 'VIVIANE', 'MADELEINE', 'MAGALY', 'MALORIE', 'MARILIE', 'NOEMY', 'NORA', 'VALENTINA', 'ABIGAIL', 'ALEXE', 'ALLYSON', 'CASSANDRA', 'CASSANDRE', 'CHELSEA', 'CONSTANCE', 'EMY-ROSE', 'JOANIE', 'ANDREA', 'BRIANNA', 'ELISE', 'EMMA-ROSE', 'FATIMA', 'KIARA', 'MARYAM', 'ROSALY', 'ANGELIE', 'CAMELIA', 'CHRISTINA', 'EMILIA', 'KASSANDRA', 'KELLY-ANNE', 'LARA', 'MARIKA', 'MILEY', 'ALESSIA', 'AVA', 'ELIA', 'IMANE', 'LAETITIA', 'LEXIE', 'LYDIANE', 'MALIKA', 'MARIAM', 'MORGANE', 'SIENNA', 'STEPHANIE', 'KATE', 'LYNA', 'MARWA', 'MEREDITH', 'NINA', 'ROXANE', 'SERENA', 'THALIE', 'ABBY', 'AMIRA', 'ANOUK', 'ARIANNA', 'AUDREY-ANNE', 'DALIE', 'ESTHER', 'JOLIANE', 'KORALY', 'LAURIE-ANNE', 'LILIANNE', 'LILOU', 'MIKAELA', 'ROSEMARIE', 'SASHA', 'ANAELLE', 'BIANKA', 'CELESTE', 'CHARLINE', 'DANAE', 'JULIANE', 'LAETICIA', 'LEA-KIM', 'LEA-MAUDE', 'LENA', 'LIA', 'LIANA', 'MAIA', 'NELLIE', 'TIFFANY', 'ANAEVE', 'ANGELA', 'CHARLIE-ROSE', 'ELISA', 'ELODY', 'GRACE', 'HIBA', 'KATHERINE', 'LILLY', 'MAITE', 'MOLLY', 'NAIMA', 'VICKY', 'ABYGAEL', 'ALEXYA', 'AMINA', 'AURELY', 'BLANCHE', 'CORALY', 'DIANA', 'HAILEY', 'HANNAH', 'IRIS', 'JOELLE', 'KENZA', 'LAILA', 'LANA', 'LEYLA', 'LILIA', 'LORALIE', 'MAHEVA', 'MARGOT', 'NAILA', 'ANDREANNE', 'ANNABEL', 'CAROLANNE', 'CLAIRE', 'CLEMENTINE', 'DALIA', 'EMIE', 'FANNY', 'JANA', 'LETICIA', 'LUNA', 'MARIE-JEANNE', 'MEGHAN', 'NICOLE', 'SELENA', 'SIRINE', 'YARA', 'AISHA', 'ANASTASIA', 'HAJAR', 'LEANA', 'LORIANNE', 'MEGANNE', 'MELIANNE', 'NADA', 'RIM', 'ROSELINE', 'RYM', 'SARAH-EVE', 'SYDNEY', 'VALERIE', 'ZARA', 'ALIX', 'ALIZEE', 'ALYSSON', 'ANNE-FREDERIQUE', 'CAMILA', 'CAROLANE', 'EUGENIE', 'GABRIELA', 'JULIANA', 'KAILA', 'KAYLEE', 'KELLYANE', 'KIMBERLY', 'LEA-JADE', 'MAHELY', 'MARILY', 'ROSIE', 'SAMUELLE', 'ANNIE', 'ELSIE', 'ERICA', 'EVE-MARIE', 'JOSEPHINE', 'JULIE', 'KLOE', 'LAURY', 'LILY', 'ROSE', 'LISA', 'MACKENZIE', 'MADYSON', 'MAEVE', 'MAILY', 'MAKAYLA', 'ZAHRA', 'ADRIANA', 'AMELIANE', 'ARIANA', 'CYNTHIA', 'DANIELA', 'ELYSE', 'FIONA', 'FLORA', 'JESSIE', 'JOLIANNE', 'LUCIE', 'LYANA', 'MAELYS', 'MARINE', 'MARISSA', 'MARYANNE', 'MAYKA', 'NAYLA', 'ROSE-MARIE', 'TALIA', 'ALEXANDRINE', 'ALIA', 'ALYS', 'ANGELICA', 'ANNE-MARIE', 'BASMA', 'BROOKE', 'CELIA', 'CORALINE', 'CORINNE', 'DINA', 'ELYANA', 'ELYZABETH', 'EVA-ROSE', 'HELOISE', 'KEIRA', 'LEIA', 'LINDSAY', 'LYA', 'MAELLA', 'MELYNA', 'NADIA', 'NADINE', 'SARAH-JADE', 'SIENA', 'ZOEY', 'ALEXIS', 'ALISON', 'ALYA', 'ANGIE', 'AUDREY-ANN', 'AXELLE', 'DANIELLA', 'JENNIFER', 'JENNY', 'KELIANE', 'LAUREN', 'LEANNA', 'LILYA', 'LILY-ANNE', 'LORY', 'LOU', 'MARIE-ANGE', 'MARIE-EVE', 'MICHELLE', 'MIKAELLA', 'MYLIE', 'OKSANA', 'OXANA', 'RITA', 'THALIA', 'VERONICA', 'VIVIANNE', 'YASMINA', 'ALIYA', 'ALLISON', 'ANGELINE', 'ANNA-EVE', 'ANN-SOPHIE', 'ASMA', 'ASSIA', 'AUDREANNE', 'BILLIE', 'BRIANA', 'BRITTANY', 'CHANEL', 'CLAUDIA', 'DOROTHEE', 'EVELYN', 'FLORIANE', 'FLORIANNE', 'GIULIA', 'JANE', 'KELLYANNE', 'KELYANE', 'LORALY', 'MAE', 'MAELIA', 'MAXYM', 'MIRANDA', 'SAMIA', 'SANDRA', 'SARA-EVE', 'SARA-MAUDE', 'SIERRA', 'SORAYA', 'STACY', 'STELLA-ROSE', 'TANIA','Emma','Marie','Julie', 'Louise', 'Lotte', 'Elise', 'Ella', 'Noor', 'Lore', 'Fien', 'Hanne', 'Amber', 'Lena', 'Lisa', 'Laura', 'Fleur', 'Charlotte', 'Nina', 'Mila', 'Eline', 'Luna', 'Anna', 'Noa', 'Elena', 'Febe', 'Nora', 'Lina', 'Amelie', 'Olivia', 'Kato', 'Sara', 'Helena', 'Juliette', 'Roos', 'Oona', 'Jade', 'Janne', 'Kaat', 'Femke', 'Nore', 'Mona', 'Yana', 'Axelle', 'Jolien', 'Manon', 'Bo', 'Camille', 'Tess', 'Fran', 'Jana', 'Marthe', 'Linde', 'Lara', 'Lily', 'Merel', 'Zoe', 'Eva', 'Lien', 'Pauline', 'Sarah', 'Laure', 'Sam', 'Leonie', 'Chloe', 'Enora', 'Sien', 'Paulien', 'Zita', 'Lise', 'Hailey', 'Margot', 'Zoë', 'Liv', 'Flore', 'Silke', 'Aya', 'Floor', 'Jill', 'Lieze', 'Alice', 'Alicia', 'Hannah', 'Amy', 'Anouk', 'June', 'Lize', 'Mirthe', 'Margaux', 'Renske', 'Alexia', 'Julia', 'Sienna', 'Aline', 'Hannelore', 'Sterre', 'Alyssa', 'Anais', 'Yasmine', 'Lauren', 'Maite',	'Isabella', 'Sophia', 'Emma', 'Olivia', 'Ava', 'Emily', 'Abigail', 'Madison', 'Chloe', 'Mia', 'Addison', 'Elizabeth', 'Ella', 'Natalie', 'Samantha', 'Alexis', 'Lily', 'Grace', 'Hailey', 'Alyssa', 'Lillian', 'Hannah', 'Avery', 'Leah', 'Nevaeh', 'Sofia', 'Ashley', 'Anna', 'Brianna', 'Sarah', 'Zoe', 'Victoria', 'Gabriella', 'Brooklyn', 'Kaylee', 'Taylor', 'Layla', 'Allison', 'Evelyn', 'Riley', 'Amelia', 'Khloe', 'Makayla', 'Aubrey', 'Charlotte', 'Savannah', 'Zoey', 'Bella', 'Kayla', 'Alexa', 'Peyton', 'Audrey', 'Claire', 'Arianna', 'Julia', 'Aaliyah', 'Kylie', 'Lauren', 'Sophie', 'Sydney', 'Camila', 'Jasmine', 'Morgan', 'Alexandra', 'Jocelyn', 'Gianna', 'Maya', 'Kimberly', 'Mackenzie', 'Katherine', 'Destiny', 'Brooke', 'Trinity', 'Faith', 'Lucy', 'Madelyn', 'Madeline', 'Bailey', 'Payton', 'Andrea', 'Autumn', 'Melanie', 'Ariana', 'Serenity', 'Stella', 'Maria', 'Molly', 'Caroline', 'Genesis', 'Kaitlyn', 'Eva', 'Jessica', 'Angelina', 'Valeria', 'Gabrielle', 'Naomi', 'Mariah', 'Natalia', 'Paige', 'Rachel',


    				);
    				
    	$achternamen = array(
    				'SMITH','JOHNSON','WILLIAMS','JONES','BROWN','DAVIS','MILLER','WILSON','MOORE','TAYLOR','ANDERSON','THOMAS','JACKSON','WHITE','HARRIS','MARTIN','THOMPSON','GARCIA','MARTINEZ','ROBINSON','CLARK','RODRIGUEZ','LEWIS','LEE','WALKER','HALL','ALLEN','YOUNG','HERNANDEZ','KING','WRIGHT','LOPEZ','HILL','SCOTT','GREEN','ADAMS','BAKER','GONZALEZ','NELSON','CARTER','MITCHELL','PEREZ','ROBERTS','TURNER','PHILLIPS','CAMPBELL','PARKER','EVANS','EDWARDS','COLLINS','STEWART','SANCHEZ','MORRIS','ROGERS','REED','COOK','MORGAN','BELL','MURPHY','BAILEY','RIVERA','COOPER','RICHARDSON','COX','HOWARD','WARD','TORRES','PETERSON','GRAY','RAMIREZ','JAMES','WATSON','BROOKS','KELLY','SANDERS','PRICE','BENNETT','WOOD','BARNES','ROSS','HENDERSON','COLEMAN','JENKINS','PERRY','POWELL','LONG','PATTERSON','HUGHES','FLORES','WASHINGTON','BUTLER','SIMMONS','FOSTER','GONZALES','BRYANT','ALEXANDER','RUSSELL','GRIFFIN','DIAZ','HAYES','MYERS','FORD','HAMILTON','GRAHAM','SULLIVAN','WALLACE','WOODS','COLE','WEST','JORDAN','OWENS','REYNOLDS','FISHER','ELLIS','HARRISON','GIBSON','MCDONALD','CRUZ','MARSHALL','ORTIZ','GOMEZ','MURRAY','FREEMAN','WELLS','WEBB','SIMPSON','STEVENS','TUCKER','PORTER','HUNTER','HICKS','CRAWFORD','HENRY','BOYD','MASON','MORALES','KENNEDY','WARREN','DIXON','RAMOS','REYES','BURNS','GORDON','SHAW','HOLMES','RICE','ROBERTSON','HUNT','BLACK','DANIELS','PALMER','MILLS','NICHOLS','GRANT','KNIGHT','FERGUSON','ROSE','STONE','HAWKINS','DUNN','PERKINS','HUDSON','SPENCER','GARDNER','STEPHENS','PAYNE','PIERCE','BERRY','MATTHEWS','ARNOLD','WAGNER','WILLIS','RAY','WATKINS','OLSON','CARROLL','DUNCAN','SNYDER','HART','CUNNINGHAM','BRADLEY','LANE','ANDREWS','RUIZ','HARPER','FOX','RILEY','ARMSTRONG','CARPENTER','WEAVER','GREENE','LAWRENCE','ELLIOTT','CHAVEZ','SIMS','AUSTIN','PETERS','KELLEY','FRANKLIN','LAWSON','FIELDS','GUTIERREZ','RYAN','SCHMIDT','CARR','VASQUEZ','CASTILLO','WHEELER','CHAPMAN','OLIVER','MONTGOMERY','RICHARDS','WILLIAMSON','JOHNSTON','BANKS','MEYER','BISHOP','MCCOY','HOWELL','ALVAREZ','MORRISON','HANSEN','FERNANDEZ','GARZA','HARVEY','LITTLE','BURTON','STANLEY','NGUYEN','GEORGE','JACOBS','REID','KIM','FULLER','LYNCH','DEAN','GILBERT','GARRETT','ROMERO','WELCH','LARSON','FRAZIER','BURKE','HANSON','DAY','MENDOZA','MORENO','BOWMAN','MEDINA','FOWLER','BREWER','HOFFMAN','CARLSON','SILVA','PEARSON','HOLLAND','DOUGLAS','FLEMING','JENSEN','VARGAS','BYRD','DAVIDSON','HOPKINS','MAY','TERRY','HERRERA','WADE','SOTO','WALTERS','CURTIS','NEAL','CALDWELL','LOWE','JENNINGS','BARNETT','GRAVES','JIMENEZ','HORTON','SHELTON','BARRETT','OBRIEN','CASTRO','SUTTON','GREGORY','MCKINNEY','LUCAS','MILES','CRAIG','RODRIQUEZ','CHAMBERS','HOLT','LAMBERT','FLETCHER','WATTS','BATES','HALE','RHODES','PENA','BECK','NEWMAN','HAYNES','MCDANIEL','MENDEZ','BUSH','VAUGHN','PARKS','DAWSON','SANTIAGO','NORRIS','HARDY','LOVE','STEELE','CURRY','POWERS','SCHULTZ','BARKER','GUZMAN','PAGE','MUNOZ','BALL','KELLER','CHANDLER','WEBER','LEONARD','WALSH','LYONS','RAMSEY','WOLFE','SCHNEIDER','MULLINS','BENSON','SHARP','BOWEN','DANIEL','BARBER','CUMMINGS','HINES','BALDWIN','GRIFFITH','VALDEZ','HUBBARD','SALAZAR','REEVES','WARNER','STEVENSON','BURGESS','SANTOS','TATE','CROSS','GARNER','MANN','MACK','MOSS','THORNTON','DENNIS','MCGEE','FARMER','DELGADO','AGUILAR','VEGA','GLOVER','MANNING','COHEN','HARMON','RODGERS','ROBBINS','NEWTON','TODD','BLAIR','HIGGINS','INGRAM','REESE','CANNON','STRICKLAND','TOWNSEND','POTTER','GOODWIN','WALTON','ROWE','HAMPTON','ORTEGA','PATTON','SWANSON','JOSEPH','FRANCIS','GOODMAN','MALDONADO','YATES','BECKER','ERICKSON','HODGES','RIOS','CONNER','ADKINS','WEBSTER','NORMAN','MALONE','HAMMOND','FLOWERS','COBB','MOODY','QUINN','BLAKE','MAXWELL','POPE','FLOYD','OSBORNE','PAUL','MCCARTHY','GUERRERO','LINDSEY','ESTRADA','SANDOVAL','GIBBS','TYLER','GROSS','FITZGERALD','STOKES','DOYLE','SHERMAN','SAUNDERS','WISE','COLON','GILL','ALVARADO','GREER','PADILLA','SIMON','WATERS','NUNEZ','BALLARD','SCHWARTZ','MCBRIDE','HOUSTON','CHRISTENSEN','KLEIN','PRATT','BRIGGS','PARSONS','MCLAUGHLIN','ZIMMERMAN','FRENCH','BUCHANAN','MORAN','COPELAND','ROY','PITTMAN','BRADY','MCCORMICK','HOLLOWAY','BROCK','POOLE','FRANK','LOGAN','OWEN','BASS','MARSH','DRAKE','WONG','JEFFERSON','PARK','MORTON','ABBOTT','SPARKS','PATRICK','NORTON','HUFF','CLAYTON','MASSEY','LLOYD','FIGUEROA','CARSON','BOWERS','ROBERSON','BARTON','TRAN','LAMB','HARRINGTON','CASEY','BOONE','CORTEZ','CLARKE','MATHIS','SINGLETON','WILKINS','CAIN','BRYAN','UNDERWOOD','HOGAN','MCKENZIE','COLLIER','LUNA','PHELPS','MCGUIRE','ALLISON','BRIDGES','WILKERSON','NASH','SUMMERS','ATKINS','WILCOX','PITTS','CONLEY','MARQUEZ','BURNETT','RICHARD','COCHRAN','CHASE','DAVENPORT','HOOD','GATES','CLAY','AYALA','SAWYER','ROMAN','VAZQUEZ','DICKERSON','HODGE','ACOSTA','FLYNN','ESPINOZA','NICHOLSON','MONROE','WOLF','MORROW','KIRK','RANDALL','ANTHONY','WHITAKER','OCONNOR','SKINNER','WARE','MOLINA','KIRBY','HUFFMAN','BRADFORD','CHARLES','GILMORE','DOMINGUEZ','ONEAL','BRUCE','LANG','COMBS','KRAMER','HEATH','HANCOCK','GALLAGHER','GAINES','SHAFFER','SHORT','WIGGINS','MATHEWS','MCCLAIN','FISCHER','WALL','SMALL','MELTON','HENSLEY','BOND','DYER','CAMERON','GRIMES','CONTRERAS','CHRISTIAN','WYATT','BAXTER','SNOW','MOSLEY','SHEPHERD','LARSEN','HOOVER','BEASLEY','GLENN','PETERSEN','WHITEHEAD','MEYERS','KEITH','GARRISON','VINCENT','SHIELDS','HORN','SAVAGE','OLSEN','SCHROEDER','HARTMAN','WOODARD','MUELLER','KEMP','DELEON','BOOTH','PATEL','CALHOUN','WILEY','EATON','CLINE','NAVARRO','HARRELL','LESTER','HUMPHREY','PARRISH','DURAN','HUTCHINSON','HESS','DORSEY','BULLOCK','ROBLES','BEARD','DALTON','AVILA','VANCE','RICH','BLACKWELL','YORK','JOHNS','BLANKENSHIP','TREVINO','SALINAS','CAMPOS','PRUITT','MOSES','CALLAHAN','GOLDEN','MONTOYA','HARDIN','GUERRA','MCDOWELL','CAREY','STAFFORD','GALLEGOS','HENSON','WILKINSON','BOOKER','MERRITT','MIRANDA','ATKINSON','ORR','DECKER','HOBBS','PRESTON','TANNER','KNOX','PACHECO','STEPHENSON','GLASS','ROJAS','SERRANO','MARKS','HICKMAN','ENGLISH','SWEENEY','STRONG','PRINCE','MCCLURE','CONWAY','WALTER','ROTH','MAYNARD','FARRELL','LOWERY','HURST','NIXON','WEISS','TRUJILLO','ELLISON','SLOAN','JUAREZ','WINTERS','MCLEAN','RANDOLPH','LEON','BOYER','VILLARREAL','MCCALL','GENTRY','CARRILLO','KENT','AYERS','LARA','SHANNON','SEXTON','PACE','HULL','LEBLANC','BROWNING','VELASQUEZ','LEACH','CHANG','HOUSE','SELLERS','HERRING','NOBLE','FOLEY','BARTLETT','MERCADO','LANDRY','DURHAM','WALLS','BARR','MCKEE','BAUER','RIVERS','EVERETT','BRADSHAW','PUGH','VELEZ','RUSH','ESTES','DODSON','MORSE','SHEPPARD','WEEKS','CAMACHO','BEAN','BARRON','LIVINGSTON','MIDDLETON','SPEARS','BRANCH','BLEVINS','CHEN','KERR','MCCONNELL','HATFIELD','HARDING','ASHLEY','SOLIS','HERMAN','FROST','GILES','BLACKBURN','WILLIAM','PENNINGTON','WOODWARD','FINLEY','MCINTOSH','KOCH','BEST','SOLOMON','MCCULLOUGH','DUDLEY','NOLAN','BLANCHARD','RIVAS','BRENNAN','MEJIA','KANE','BENTON','JOYCE','BUCKLEY','HALEY','VALENTINE','MADDOX','RUSSO','MCKNIGHT','BUCK','MOON','MCMILLAN','CROSBY','BERG','DOTSON','MAYS','ROACH','CHURCH','CHAN','RICHMOND','MEADOWS','FAULKNER','ONEILL','KNAPP','KLINE','BARRY','OCHOA','JACOBSON','GAY','AVERY','HENDRICKS','HORNE','SHEPARD','HEBERT','CHERRY','CARDENAS','MCINTYRE','WHITNEY','WALLER','HOLMAN','DONALDSON','CANTU','TERRELL','MORIN','GILLESPIE','FUENTES','TILLMAN','SANFORD','BENTLEY','PECK','KEY','SALAS','ROLLINS','GAMBLE','DICKSON','BATTLE','SANTANA','CABRERA','CERVANTES','HOWE','HINTON','HURLEY','SPENCE','ZAMORA','YANG','MCNEIL','SUAREZ','CASE','PETTY','GOULD','MCFARLAND','SAMPSON','CARVER','BRAY','ROSARIO','MACDONALD','STOUT','HESTER','MELENDEZ','DILLON','FARLEY','HOPPER','GALLOWAY','POTTS','BERNARD','JOYNER','STEIN','AGUIRRE','OSBORN','MERCER','BENDER','FRANCO','ROWLAND','SYKES','BENJAMIN','TRAVIS','PICKETT','CRANE','SEARS','MAYO','DUNLAP','HAYDEN','WILDER','MCKAY','COFFEY','MCCARTY','EWING','COOLEY','VAUGHAN','BONNER','COTTON','HOLDER','STARK','FERRELL','CANTRELL','FULTON','LYNN','LOTT','CALDERON','ROSA','POLLARD','HOOPER','BURCH','MULLEN','FRY','RIDDLE','LEVY','DAVID','DUKE','ODONNELL','GUY','MICHAEL','BRITT','FREDERICK','DAUGHERTY','BERGER','DILLARD','ALSTON','JARVIS','FRYE','RIGGS','CHANEY','ODOM','DUFFY','FITZPATRICK','VALENZUELA','MERRILL','MAYER','ALFORD','MCPHERSON','ACEVEDO','DONOVAN','BARRERA','ALBERT','COTE','REILLY','COMPTON','RAYMOND','MOONEY','MCGOWAN','CRAFT','CLEVELAND','CLEMONS','WYNN','NIELSEN','BAIRD','STANTON','SNIDER','ROSALES','BRIGHT','WITT','STUART','HAYS','HOLDEN','RUTLEDGE','KINNEY','CLEMENTS','CASTANEDA','SLATER','HAHN','EMERSON','CONRAD','BURKS','DELANEY','PATE','LANCASTER','SWEET','JUSTICE','TYSON','SHARPE','WHITFIELD','TALLEY','MACIAS','IRWIN','BURRIS','RATLIFF','MCCRAY','MADDEN','KAUFMAN','BEACH','GOFF','CASH','BOLTON','MCFADDEN','LEVINE','GOOD','BYERS','KIRKLAND','KIDD','WORKMAN','CARNEY','DALE','MCLEOD','HOLCOMB','ENGLAND','FINCH','HEAD','BURT','HENDRIX','SOSA','HANEY','FRANKS','SARGENT','NIEVES','DOWNS','RASMUSSEN','BIRD','HEWITT','LINDSAY','LE','FOREMAN','VALENCIA','ONEIL','DELACRUZ','VINSON','DEJESUS','HYDE','FORBES','GILLIAM','GUTHRIE','WOOTEN','HUBER','BARLOW','BOYLE','MCMAHON','BUCKNER','ROCHA','PUCKETT','LANGLEY','KNOWLES','COOKE','VELAZQUEZ','WHITLEY','NOEL','VANG',
    	
    	
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
    				
    	$voornaam = strtolower($voornamen[array_rand($voornamen)]);
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
    		
    		
    				
    	$voornaam = strtolower($voornamen[array_rand($voornamen)]);
    	$achternaam = strtolower($achternamen[array_rand($achternamen)]);
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
