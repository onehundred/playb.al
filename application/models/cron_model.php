<?php class Cron_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    
    function bots()
    {
    
    	//gaat elke divisie af, waar het getal onder de 8 is daar voegt hij een bot toe
    	$divisies = $this->db->get('korf_divisies');
    	$divRows = $divisies->num_rows();
    	$mdate =  date('Y-m-d h:i:s');
    	
    	for($i=1;$i<=$divRows;$i++){
    	
    			$this->db->where('FK_division_id', $i);
    			$teams = $this->db->get('korf_teams');
    			
    			$teamRows = $teams->num_rows();
               
            if($teamRows < 8){
            
            	$data = array(
            		'FK_division_id' => $i,
            		'naam' => 'playbal',
            		'bot' =>  0,
            		'startdatum' => $mdate
            	
            	
            	);
            	
            	
            	$teamaanvul = 8 - $teamRows;
            	
            		for($j=0;$j<$teamaanvul;$j++){
               
               	$this->db->insert('korf_teams', $data);
               		 }

            }



          }
    	

    
    
    }
    
 }  