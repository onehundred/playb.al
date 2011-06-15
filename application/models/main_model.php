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
    	
		date_default_timezone_set('Europe/Brussels');
		$mdate =  date("F j Y, H:i"); 
		
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
			
	function resend_password($email)
	{
		$this->db->where('email', $email);
		$query = $this->db->get('users');
		
		if($query->num_rows() == 0){
			return false;
		
		}else{
			$this->db->select('voornaam, achternaam, gebruikersnaam, paswoord');
			$this->db->from('users');
			$this->db->where('email', $email);
			$users = $this->db->get();
			
			
			foreach($users->result() as $user){
				$voornaam = $user->voornaam;
				$achternaam = $user->achternaam;
				$username = $user->gebruikersnaam;
				$paswoord = $user->paswoord;
				
				$message = $voornaam.' '.$achternaam.', klik op onderstaande link om uw paswoord te resetten: <br/>:
					<a href="playb.al/index.php/main/update_password/'.$username.'/'.$paswoord;
				
				mail($email, 'Playb.al: Paswoord vergeten', $message);
				
				
				
			}
			
			return true;	
		}
	
	}		
    
    function update_password($userid, $pass)
	{
		
		$this->db->where('paswoord', $pass);
		$this->db->where('gebruikersnaam', $userid);
		$query = $this->db->get('users');
		
		if($query->num_rows() == 0){
			return false;
		
		}else{
			return true;
		}
	}
	
	function reset_paswoord($pass, $userid){
		$hash = md5($pass);
		
		$update  = array(
			'paswoord' => $hash,
		);
		
		$this->db->where('gebruikersnaam', $userid);
		$this->db->update('users', $update);
	
	}
}