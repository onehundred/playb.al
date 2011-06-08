<?php class Main_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    
    function validate($username, $password)
    {
    	$this->db->where('gebruikersnaam', $username);
    	$this->db->where('paswoord', md5($password));
    	
    	$query1 = $this->db->get('users');
    	
    	
    	if($query1->num_rows==1)
    	{
    			return true;
    	}
    	
    	$this->db->where('email', $this->input->post('username'));
    	$this->db->where('paswoord', md5($this->input->post('password')));
    	
    	$query2 = $this->db->get('users');
    	
    	if($query2->num_rows==1)
    	{
    			return true;
    	}

    
    }
    
    
    function create_user($username, $paswoord, $voornaam, $achternaam, $email)
    {
    	

		$mdate =  date('Y-m-d h:i:s');
		
    	$new_user_insert_data = array(
    		'voornaam' => $voornaam,
    		'achternaam' => $achternaam,
    		'email' => $email,
    		'gebruikersnaam' => $username,
    		'paswoord' => md5($paswoord),
    		'datum_creatie' => $mdate
    	
    	);
    	
    	$insert = $this->db->insert('users', $new_user_insert_data);
    	return $insert;
    
    }
    
    function check_username($username, $email){
    	$check = array();
    
    	$this->db->where('gebruikersnaam', $username);
    	$query = $this->db->get('users');
    	
    	if($query->num_rows() != 0){
    		$check['username'] = false;
     	
    	}else{
    		$check['username'] = true;
     	
    	}
    	
    	
    	$this->db->where('email', $email);
    	$query2 = $this->db->get('users');
    	
    	if($query2->num_rows() != 0){
    		$check['email'] = false;
     	
    	}else{
    		$check['email'] = true;
     	
    	}
    	
    	return $check;
    
    }
			
			
    
    
}