<?php class Cron_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        ini_set('memory_limit', '192M');
    }
    
    function get_croninfo(){
    	$query = $this->db->get('korf_cron');
    	return $query;
    }
    
    //om de 2 dagen
    function update_week($week)
    {
    	if($week == 14){
    		$update = array(
    		'week' => 1
    	
    	);
    	
    	$this->db->update('korf_cron', $update);
    	}
    	else{
    	$update = array(
    		'week' => $week +1
    	
    	);
    	
    	$this->db->update('korf_cron', $update);
    	}
    }
    
    //om de maand ongeveer
    
    function update_seizoen($seizoen)
    {
    	$update = array(
    		'seizoen' => $seizoen +1
    	
    	);
    	
    	$this->db->update('korf_cron', $update);
    	
    	
    	
    	$query = $this->db->get('korf_teams');
    	
    	foreach($query->result() as $row)
    	{
    		$team_id = $row->team_id;
    		
    		
    		$legen = array(
    			'gespeeld' => 0,
    			'gewonnen' => 0, 
    			'gelijk' => 0,
    			'verloren' => 0,
    			'doelpunten_voor' => 0,
    			'doelpunten_tegen' => 0,
    			'divisiepunten' => 0,
    			'geupdate' => 0
    			
    		
    		);
    		
    		$this->db->where('team_id', $team_id);
    		$this->db->update('korf_teams', $legen);
    	
    	}
    	
    	
    	

    }
    
    
    function promotion_division1()
    {
    	//verdienen te zakken naar divisie 2
	
		$this->db->select('*');
    	$this->db->from('korf_teams');
    	$this->db->join('korf_divisies','FK_division_id = divisie_id');
    	$this->db->where('divisie', 1);
    	$this->db->where('sub_divisie', 1);
    	$this->db->order_by('divisiepunten asc, doelpunten_tegen desc');
    	$this->db->limit(2);
    	$degradatie1 = $this->db->get();
    	
    	$i =1;
    	foreach($degradatie1->result() as $row)
    	{
    		$degrTeamId[$i] = $row->team_id;
    		$degrDivId[$i] = $row->FK_division_id; 
    		$i++;  		
    	
    	}

	for($i=1;$i<3;$i++){
		//verdienen promotie naar divisie1
    	$this->db->select('*');
    	$this->db->from('korf_teams');
    	$this->db->join('korf_divisies','FK_division_id = divisie_id');
    	$this->db->where('divisie', 2);
    	$this->db->where('sub_divisie', $i);
    	$this->db->order_by('divisiepunten desc, doelpunten_voor desc');
    	$this->db->limit(1);
    	$promotie2 = $this->db->get();
    	
    	foreach($promotie2->result() as $row)
    	{
    		
    		$promTeamId = $row->team_id;
    		$promDivId = $row->FK_division_id;
    		$update = array(
    			'FK_division_id' => $degrDivId[$i],
    			'geupdate' => 1
    		);
    		
    		$this->db->where('team_id',$promTeamId );
    		$this->db->update('korf_teams', $update);
    		
    		$update2 =array(
    			'FK_division_id' => $promDivId,
    			'geupdate' => 1
    			    		);
    		
    		$this->db->where('team_id', $degrTeamId[$i]);
    		$this->db->update('korf_teams', $update2);
    		
    	}
    	}
    }
    //promotie naar 2de en degradatie naar 3de
	function promotion_division2()
	{
		$getal = 0; 
    //verdienen degradatie naar 3de
    for($i=1;$i<3;$i++){
    	$this->db->select('team_id, FK_division_id');
    	$this->db->from('korf_teams');
    	$this->db->join('korf_divisies','FK_division_id = divisie_id');
    	$this->db->where('divisie', 2);
    	$this->db->where('sub_divisie', $i);
    	$this->db->where('geupdate', 0);
    	$this->db->order_by('divisiepunten asc, doelpunten_tegen desc');
    	$this->db->limit(2);
    	$degradatie = $this->db->get();
    	
    	$k =1 + $getal;
    	foreach($degradatie ->result() as $row)
    	{
    		
    		$degrTeamId[$k] = $row->team_id;
    		$degrDivId[$k] = $row->FK_division_id; 
    		$k++;  		
    	
    	}
    	
    	//verdienen promotie naar 2de
    	$l =1 +$getal;
    	for($j=1+$getal;$j<3+$getal;$j++)
    	{
    		//echo $j;
    		
    		
    		$this->db->select('*');
    		$this->db->from('korf_teams');
    		$this->db->join('korf_divisies','FK_division_id = divisie_id');
    		$this->db->where('divisie', 3);
    		$this->db->where('sub_divisie', $j);
    		$this->db->where('geupdate', 0);
    		$this->db->order_by('divisiepunten desc, doelpunten_voor desc');
    		$this->db->limit(1);
    		$promotie2 = $this->db->get();
    		
    		
    		foreach($promotie2->result() as $row)
    		{
    			
    		$promTeamId = $row->team_id;
    		$promDivId = $row->FK_division_id;
    		
    		//echo $l;
    		//echo $degrDivId[$l];
    		//echo $degrTeamId[$l];
    		//echo $promTeamId;
    		//echo $promDivId;
    		//echo '<br/>';
    		
    		$update = array(
    			'FK_division_id' => $degrDivId[$l],
    			'geupdate' => 1
    		);
    		
    		$this->db->where('team_id',$promTeamId );
    		$this->db->update('korf_teams', $update);
    		
    		$update2 =array(
    			'FK_division_id' => $promDivId,
    			'geupdate' => 1
    		);
    		
    		$this->db->where('team_id', $degrTeamId[$l]);
    		$this->db->update('korf_teams', $update2);
    		
    		}
    		$l++;
    	}
    	$getal = $getal + 2;	
    	}
    
    }
    
    //promotie naar divisie 3 en degradatie naar divisie 4
    function promotion_division3()
    {
    	$getal = 0; 
    //verdienen degradatie naar 4de
    for($i=1;$i<5;$i++){
    	$this->db->select('team_id, FK_division_id');
    	$this->db->from('korf_teams');
    	$this->db->join('korf_divisies','FK_division_id = divisie_id');
    	$this->db->where('divisie', 3);
    	$this->db->where('sub_divisie', $i);
    	$this->db->where('geupdate', 0);
    	$this->db->order_by('divisiepunten asc, doelpunten_tegen desc');
    	$this->db->limit(2);
    	$degradatie = $this->db->get();
    	
    	$k =1 + $getal;
    	foreach($degradatie ->result() as $row)
    	{
    		
    		$degrTeamId[$k] = $row->team_id;
    		$degrDivId[$k] = $row->FK_division_id; 
    		$k++;  		
    	
    	}
    	
    	//verdienen promotie naar 3de
    	$l =1 +$getal;
    	for($j=1+$getal;$j<3+$getal;$j++)
    	{
    		//echo $j;
    		
    		
    		$this->db->select('*');
    		$this->db->from('korf_teams');
    		$this->db->join('korf_divisies','FK_division_id = divisie_id');
    		$this->db->where('divisie', 4);
    		$this->db->where('sub_divisie', $j);
    		$this->db->where('geupdate', 0);
    		$this->db->order_by('divisiepunten desc, doelpunten_voor desc');
    		$this->db->limit(1);
    		$promotie2 = $this->db->get();
    		
    		
    		foreach($promotie2->result() as $row)
    		{
    			
    		$promTeamId = $row->team_id;
    		$promDivId = $row->FK_division_id;
    		
    		//echo $l;
    		//echo $degrDivId[$l];
    		//echo $degrTeamId[$l];
    		//echo $promTeamId;
    		//echo $promDivId;
    		//echo '<br/>';
    		
    		$update = array(
    			'FK_division_id' => $degrDivId[$l],
    			'geupdate' => 1
    		);
    		
    		$this->db->where('team_id',$promTeamId );
    		$this->db->update('korf_teams', $update);
    		
    		$update2 =array(
    			'FK_division_id' => $promDivId,
    			'geupdate' => 1
    		);
    		
    		$this->db->where('team_id', $degrTeamId[$l]);
    		$this->db->update('korf_teams', $update2);
    		
    		}
    		$l++;
    	}
    	$getal = $getal + 2;	
    	}

    

	
	}
	//promovatie naar 4de en degradatie naar 5de
	function promotion_division4()
	{
		$getal = 0; 
    //verdienen degradatie naar 5de
    for($i=1;$i<9;$i++){
    	$this->db->select('team_id, FK_division_id');
    	$this->db->from('korf_teams');
    	$this->db->join('korf_divisies','FK_division_id = divisie_id');
    	$this->db->where('divisie', 4);
    	$this->db->where('sub_divisie', $i);
    	$this->db->where('geupdate', 0);
    	$this->db->order_by('divisiepunten asc, doelpunten_tegen desc');
    	$this->db->limit(2);
    	$degradatie = $this->db->get();
    	
    	$k =1 + $getal;
    	foreach($degradatie ->result() as $row)
    	{
    		
    		$degrTeamId[$k] = $row->team_id;
    		$degrDivId[$k] = $row->FK_division_id; 
    		$k++;  		
    	
    	}
    	
    	//verdienen promotie naar 4de
    	$l =1 +$getal;
    	for($j=1+$getal;$j<3+$getal;$j++)
    	{
    		//echo $j;
    		
    		
    		$this->db->select('*');
    		$this->db->from('korf_teams');
    		$this->db->join('korf_divisies','FK_division_id = divisie_id');
    		$this->db->where('divisie', 5);
    		$this->db->where('sub_divisie', $j);
    		$this->db->where('geupdate', 0);
    		$this->db->order_by('divisiepunten desc, doelpunten_voor desc');
    		$this->db->limit(1);
    		$promotie2 = $this->db->get();
    		
    		
    		foreach($promotie2->result() as $row)
    		{
    			
    		$promTeamId = $row->team_id;
    		$promDivId = $row->FK_division_id;
    		
    		//echo $l;
    		//echo $degrDivId[$l];
    		//echo $degrTeamId[$l];
    		//echo $promTeamId;
    		//echo $promDivId;
    		//echo '<br/>';
    		
    		$update = array(
    			'FK_division_id' => $degrDivId[$l],
    			'geupdate' => 1
    		);
    		
    		$this->db->where('team_id',$promTeamId );
    		$this->db->update('korf_teams', $update);
    		
    		$update2 =array(
    			'FK_division_id' => $promDivId,
    			'geupdate' => 1
    		);
    		
    		$this->db->where('team_id', $degrTeamId[$l]);
    		$this->db->update('korf_teams', $update2);
    		
    		}
    		$l++;
    	}
    	$getal = $getal + 2;	
    	}
	}
	
	function promotion_division5()
	{
		$getal = 0; 
    //verdienen degradatie naar 6de
    for($i=1;$i<17;$i++){
    	$this->db->select('team_id, FK_division_id');
    	$this->db->from('korf_teams');
    	$this->db->join('korf_divisies','FK_division_id = divisie_id');
    	$this->db->where('divisie', 5);
    	$this->db->where('sub_divisie', $i);
    	$this->db->where('geupdate', 0);
    	$this->db->order_by('divisiepunten asc, doelpunten_tegen desc');
    	$this->db->limit(2);
    	$degradatie = $this->db->get();
    	
    	$k =1 + $getal;
    	foreach($degradatie ->result() as $row)
    	{
    		
    		$degrTeamId[$k] = $row->team_id;
    		$degrDivId[$k] = $row->FK_division_id; 
    		$k++;  		
    	
    	}
    	
    	//verdienen promotie naar 5de
    	$l =1 +$getal;
    	for($j=1+$getal;$j<3+$getal;$j++)
    	{
    		//echo $j;
    		
    		
    		$this->db->select('*');
    		$this->db->from('korf_teams');
    		$this->db->join('korf_divisies','FK_division_id = divisie_id');
    		$this->db->where('divisie', 6);
    		$this->db->where('sub_divisie', $j);
    		$this->db->where('geupdate', 0);
    		$this->db->order_by('divisiepunten desc, doelpunten_voor desc');
    		$this->db->limit(1);
    		$promotie2 = $this->db->get();
    		
    		
    		foreach($promotie2->result() as $row)
    		{
    			
    		$promTeamId = $row->team_id;
    		$promDivId = $row->FK_division_id;
    		
    		//echo $l;
    		//echo $degrDivId[$l];
    		//echo $degrTeamId[$l];
    		//echo $promTeamId;
    		//echo $promDivId;
    		//echo '<br/>';
    		
    		$update = array(
    			'FK_division_id' => $degrDivId[$l],
    			'geupdate' => 1
    		);
    		
    		$this->db->where('team_id',$promTeamId );
    		$this->db->update('korf_teams', $update);
    		
    		$update2 =array(
    			'FK_division_id' => $promDivId,
    			'geupdate' => 1
    		);
    		
    		$this->db->where('team_id', $degrTeamId[$l]);
    		$this->db->update('korf_teams', $update2);
    		
    		}
    		$l++;
    	}
    	$getal = $getal + 2;	
    	}

	}
	
	function promotion_division6()
	{
		$getal = 0; 
    //verdienen degradatie naar 7de
    for($i=1;$i<33;$i++){
    	$this->db->select('team_id, FK_division_id');
    	$this->db->from('korf_teams');
    	$this->db->join('korf_divisies','FK_division_id = divisie_id');
    	$this->db->where('divisie', 6);
    	$this->db->where('sub_divisie', $i);
    	$this->db->where('geupdate', 0);
    	$this->db->order_by('divisiepunten asc, doelpunten_tegen desc');
    	$this->db->limit(2);
    	$degradatie = $this->db->get();
    	
    	$k =1 + $getal;
    	foreach($degradatie ->result() as $row)
    	{
    		
    		$degrTeamId[$k] = $row->team_id;
    		$degrDivId[$k] = $row->FK_division_id; 
    		$k++;  		
    	
    	}
    	
    	//verdienen promotie naar 6de
    	$l =1 +$getal;
    	for($j=1+$getal;$j<3+$getal;$j++)
    	{
    		//echo $j;
    		
    		
    		$this->db->select('*');
    		$this->db->from('korf_teams');
    		$this->db->join('korf_divisies','FK_division_id = divisie_id');
    		$this->db->where('divisie', 7);
    		$this->db->where('sub_divisie', $j);
    		$this->db->where('geupdate', 0);
    		$this->db->order_by('divisiepunten desc, doelpunten_voor desc');
    		$this->db->limit(1);
    		$promotie2 = $this->db->get();
    		
    		
    		foreach($promotie2->result() as $row)
    		{
    			
    		$promTeamId = $row->team_id;
    		$promDivId = $row->FK_division_id;
    		
    		//echo $l;
    		//echo $degrDivId[$l];
    		//echo $degrTeamId[$l];
    		//echo $promTeamId;
    		//echo $promDivId;
    		//echo '<br/>';
    		
    		$update = array(
    			'FK_division_id' => $degrDivId[$l],
    			'geupdate' => 1
    		);
    		
    		$this->db->where('team_id',$promTeamId );
    		$this->db->update('korf_teams', $update);
    		
    		$update2 =array(
    			'FK_division_id' => $promDivId,
    			'geupdate' => 1
    		);
    		
    		$this->db->where('team_id', $degrTeamId[$l]);
    		$this->db->update('korf_teams', $update2);
    		
    		}
    		$l++;
    	}
    	$getal = $getal + 2;	
    	}

	
	}
    
    function promotion_division7()
    {
    	$getal = 0; 
    //verdienen degradatie naar 8ste
    for($i=1;$i<65;$i++){
    	$this->db->select('team_id, FK_division_id');
    	$this->db->from('korf_teams');
    	$this->db->join('korf_divisies','FK_division_id = divisie_id');
    	$this->db->where('divisie', 7);
    	$this->db->where('sub_divisie', $i);
    	$this->db->where('geupdate', 0);
    	$this->db->order_by('divisiepunten asc, doelpunten_tegen desc');
    	$this->db->limit(2);
    	$degradatie = $this->db->get();
    	
    	$k =1 + $getal;
    	foreach($degradatie ->result() as $row)
    	{
    		
    		$degrTeamId[$k] = $row->team_id;
    		$degrDivId[$k] = $row->FK_division_id; 
    		$k++;  		
    	
    	}
    	
    	//verdienen promotie naar 7de
    	$l =1 +$getal;
    	for($j=1+$getal;$j<3+$getal;$j++)
    	{
    		//echo $j;
    		
    		
    		$this->db->select('*');
    		$this->db->from('korf_teams');
    		$this->db->join('korf_divisies','FK_division_id = divisie_id');
    		$this->db->where('divisie', 8);
    		$this->db->where('sub_divisie', $j);
    		$this->db->where('geupdate', 0);
    		$this->db->order_by('divisiepunten desc, doelpunten_voor desc');
    		$this->db->limit(1);
    		$promotie2 = $this->db->get();
    		
    		
    		foreach($promotie2->result() as $row)
    		{
    			
    		$promTeamId = $row->team_id;
    		$promDivId = $row->FK_division_id;
    		
    		//echo $l;
    		//echo $degrDivId[$l];
    		//echo $degrTeamId[$l];
    		//echo $promTeamId;
    		//echo $promDivId;
    		//echo '<br/>';
    		
    		$update = array(
    			'FK_division_id' => $degrDivId[$l],
    			'geupdate' => 1
    		);
    		
    		$this->db->where('team_id',$promTeamId );
    		$this->db->update('korf_teams', $update);
    		
    		$update2 =array(
    			'FK_division_id' => $promDivId,
    			'geupdate' => 1
    		);
    		
    		$this->db->where('team_id', $degrTeamId[$l]);
    		$this->db->update('korf_teams', $update2);
    		
    		}
    		$l++;
    	}
    	$getal = $getal + 2;	
    	}

    
    
    }
    
    
    function promotion_division8()
    {
		$getal = 0; 
    //verdienen degradatie naar 9de
    for($i=1;$i<129;$i++){
    	$this->db->select('team_id, FK_division_id');
    	$this->db->from('korf_teams');
    	$this->db->join('korf_divisies','FK_division_id = divisie_id');
    	$this->db->where('divisie', 8);
    	$this->db->where('sub_divisie', $i);
    	$this->db->where('geupdate', 0);
    	$this->db->order_by('divisiepunten asc, doelpunten_tegen desc');
    	$this->db->limit(2);
    	$degradatie = $this->db->get();
    	
    	$k =1 + $getal;
    	foreach($degradatie ->result() as $row)
    	{
    		
    		$degrTeamId[$k] = $row->team_id;
    		$degrDivId[$k] = $row->FK_division_id; 
    		$k++;  		
    	
    	}
    	
    	//verdienen promotie naar 8ste
    	$l =1 +$getal;
    	for($j=1+$getal;$j<3+$getal;$j++)
    	{
    		//echo $j;
    		
    		
    		$this->db->select('*');
    		$this->db->from('korf_teams');
    		$this->db->join('korf_divisies','FK_division_id = divisie_id');
    		$this->db->where('divisie', 9);
    		$this->db->where('sub_divisie', $j);
    		$this->db->where('geupdate', 0);
    		$this->db->order_by('divisiepunten desc, doelpunten_voor desc');
    		$this->db->limit(1);
    		$promotie2 = $this->db->get();
    		
    		
    		foreach($promotie2->result() as $row)
    		{
    			
    		$promTeamId = $row->team_id;
    		$promDivId = $row->FK_division_id;
    		
    		//echo $l;
    		//echo $degrDivId[$l];
    		//echo $degrTeamId[$l];
    		//echo $promTeamId;
    		//echo $promDivId;
    		//echo '<br/>';
    		
    		$update = array(
    			'FK_division_id' => $degrDivId[$l],
    			'geupdate' => 1
    		);
    		
    		$this->db->where('team_id',$promTeamId );
    		$this->db->update('korf_teams', $update);
    		
    		$update2 =array(
    			'FK_division_id' => $promDivId,
    			'geupdate' => 1
    		);
    		
    		$this->db->where('team_id', $degrTeamId[$l]);
    		$this->db->update('korf_teams', $update2);
    		
    		}
    		$l++;
    	}
    	$getal = $getal + 2;	
    	}


	}
    //elke minuut om na te kijken
    function check_transfers()
    {	
    	$query = $this->db->get('korf_transfers');
    	
    	foreach($query->result() as $row)
    	{
    		$deadline = $row->deadline;
    		$spelerid = $row->FK_speler_id;
    		$hoogste_bieder = $row->FK_hoogste_bieder;
    		$huidigbod = $row->huidig_bod;
    		$transferid = $row->transfer_id;
    		
    		
    		$mdate =  date('Y-m-d h:i:s');
    	
    		if($deadline <= $mdate)
    		{
    			if($huidigbod == null)
    			{
    				$update = array(
    				'transfer' => 0
    				
    				);
    				
    				$this->db->where('speler_id', $spelerid);
    				$this->db->update('korf_spelers', $update);
    			}else{
    				$update = array(
    					'transfer' => 0,
    					'FK_team_id'=> $hoogste_bieder    				
    				
    				
    				);
    				
    				$this->db->where('speler_id', $spelerid);
    				$this->db->update('korf_spelers', $update);
    			
    			}
    			
    			$this->db->where('transfer_id', $transferid);
    			$this->db->delete('korf_transfers');
    	
    		}
    	
    	}
    	
    	
    
    
    }
    
    
    function create_divisions()
    {
    		//divisie 1
		
		$divisie1 = array(
			'divisie' => 1,
			'sub_divisie' => 1
		);
		
		$this->db->insert('korf_divisies', $divisie1);
		
		
		//divisie 2 
		
		for($i=1;$i<3;$i++)
		{
			$divisie2 = array(
			'divisie' => 2,
			'sub_divisie' => $i
		);
		
		$this->db->insert('korf_divisies',$divisie2);
		
		}
		
		
		//divisie3
		
		for($i=1;$i<5;$i++)
		{
			$divisie3 = array(
			'divisie' => 3,
			'sub_divisie' => $i
		);
		
		$this->db->insert('korf_divisies',$divisie3);
		
		}
		
		//divisie4
		for($i=1;$i<9;$i++)
		{
			$divisie4 = array(
			'divisie' => 4,
			'sub_divisie' => $i
		);
		
		$this->db->insert('korf_divisies',$divisie4);
		
		}
		
		
		//divisie5
		
		for($i=1;$i<17;$i++)
		{
			$divisie5 = array(
			'divisie' => 5,
			'sub_divisie' => $i
		);
		
		$this->db->insert('korf_divisies',$divisie5);
		
		}
		
		//divisie6
		
		for($i=1;$i<33;$i++)
		{
			$divisie6 = array(
			'divisie' => 6,
			'sub_divisie' => $i
		);
		
		$this->db->insert('korf_divisies',$divisie6);
		
		}
		
		
		//divisie7
		
		for($i=1;$i<65;$i++)
		{
			$divisie7 = array(
			'divisie' => 7,
			'sub_divisie' => $i
		);
		
		$this->db->insert('korf_divisies',$divisie7);
		
		}
		
		//divisie8
		
		for($i=1;$i<129;$i++)
		{
			$divisie8 = array(
			'divisie' => 8,
			'sub_divisie' => $i
		);
		
		$this->db->insert('korf_divisies',$divisie8);
		
		}
		
		//divisie9
		
		for($i=1;$i<257;$i++)
		{
			$divisie9 = array(
			'divisie' => 9,
			'sub_divisie' => $i
		);
		
		$this->db->insert('korf_divisies',$divisie9);
		
		}

    
    }
    
    //elk nieuw seizoen ŽŽn keer runnen
    //create scriptje aanmaken voor extra divisies bij te voegen
    function bots()
    {
    
    	//gaat elke divisie af, waar het getal onder de 8 is daar voegt hij een bot toe
    	$divisies = $this->db->get('korf_divisies');
    	//$divRows = $divisies->num_rows();
    	$mdate =  date('Y-m-d h:i:s');
    	
    	foreach($divisies->result() as $row){
    			$divisieid = $row->divisie_id;
    	
    			$this->db->where('FK_division_id', $divisieid );
    			$teams = $this->db->get('korf_teams');
    			
    			$teamRows = $teams->num_rows();
               
            if($teamRows < 8){
            
            	$data = array(
            		'FK_division_id' => $divisieid,
            		'naam' => 'playbal',
            		'bot' =>  0,
            		'gespeeld' => 0,
            		'gewonnen' => 0,
            		'verloren' => 0,
            		'gelijk' => 0,
            		'doelpunten_voor' => 0,
            		'doelpunten_tegen' => 0,
            		'divisiepunten' => 0,
            		'energie' => 100,
            		'moraal' => 100,
            		'startdatum' => $mdate
            	
            	
            	);
            	
            	
            	$teamaanvul = 8 - $teamRows;
            	
            		for($j=0;$j<$teamaanvul;$j++){
               
               	$this->db->insert('korf_teams', $data);
               		 }

            }



          }
    	

    
    
    }
    
    
    function energy_point()
    {
    	$this->db->select('energie,team_id');
    	$query = $this->db->get('korf_teams');
    	
    	foreach($query->result() as $row)
    	{
    		$teamid = $row->team_id;
    		$energie = $row->energie;
    		if($energie < 100){
    		$updateenergie = $energie + 1;
    		
    		$update = array(
    			'energie' => $updateenergie
    		);
    		
    		$this->db->where('team_id', $teamid);
    		$this->db->update('korf_teams', $update);
    		}
    			
    		
    	
    	}
    
    
    
    }
    
    //teams tegen elkaar uitzetten per divisie
    function arrange_matches()
    {
    	
    	
    	$naamarray = array();
    	
    	
    	$seizoenquery = $this->db->get('korf_cron');
    	
    	foreach($seizoenquery->result() as $rij){
    		$season = $rij->seizoen;
    	
    	}
    	
    	
    	$divisies = $this->db->get('korf_divisies');
    	$mdate =  date('Y-m-d h:i:s');
    	
    	foreach($divisies->result() as $row){
    		$divisieid = $row->divisie_id;
    	
		
		$this->db->where('FK_division_id', $divisieid);
    	$query = $this->db->get('korf_teams');
    	
    	
    	$j=1;
    	
    	foreach($query->result() as $row)
    	{
    		$naamarray[$j] = $row->team_id; 
    		$j++;
    		
    	}
    	
    	//week1
    	$match1 = array(
    		'thuisteam' => $naamarray[1],
    		'bezoekersteam' => $naamarray[2],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 1
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match1);
    	
    	$match2 = array(
    		'thuisteam' => $naamarray[3],
    		'bezoekersteam' => $naamarray[4],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 1
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match2);
    	
    	$match3 = array(
    		'thuisteam' => $naamarray[5],
    		'bezoekersteam' => $naamarray[6],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 1
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match3);
    	
    	$match4 = array(
    		'thuisteam' => $naamarray[7],
    		'bezoekersteam' => $naamarray[8],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 1
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match4);
    	
    	
    	//week2
    	
    	$match5 = array(
    		'thuisteam' => $naamarray[4],
    		'bezoekersteam' => $naamarray[1],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 2
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match5);
    	
    	$match6 = array(
    		'thuisteam' => $naamarray[2],
    		'bezoekersteam' => $naamarray[3],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 2
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match6);
    	
    	$match7 = array(
    		'thuisteam' => $naamarray[8],
    		'bezoekersteam' => $naamarray[5],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 2
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match7);
    	
    	$match8 = array(
    		'thuisteam' => $naamarray[6],
    		'bezoekersteam' => $naamarray[7],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 2
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match8);
    	
    	
    	//week3
    	
    	$match9 = array(
    		'thuisteam' => $naamarray[1],
    		'bezoekersteam' => $naamarray[6],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 3
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match9);
    	
    	
    	$match10 = array(
    		'thuisteam' => $naamarray[5],
    		'bezoekersteam' => $naamarray[2],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 3
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match10);
    	
    	$match11 = array(
    		'thuisteam' => $naamarray[3],
    		'bezoekersteam' => $naamarray[8],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 3
    		
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match11);
    	
    	$match12 = array(
    		'thuisteam' => $naamarray[4],
    		'bezoekersteam' => $naamarray[7],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 3
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match12);
    	
    	//week4
    	
    	$match13 = array(
    		'thuisteam' => $naamarray[8],
    		'bezoekersteam' => $naamarray[1],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 4
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match13);
    	
    	
    	$match14 = array(
    		'thuisteam' => $naamarray[2],
    		'bezoekersteam' => $naamarray[7],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 4
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match14);
    	
    	$match15 = array(
    		'thuisteam' => $naamarray[6],
    		'bezoekersteam' => $naamarray[3],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 4
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match15);
    	
    	$match16 = array(
    		'thuisteam' => $naamarray[5],
    		'bezoekersteam' => $naamarray[4],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 4
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match16);
    	
    	//week5
    	
    	$match17 = array(
    		'thuisteam' => $naamarray[1],
    		'bezoekersteam' => $naamarray[3],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 5
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match17);
    	
    	
    	$match18 = array(
    		'thuisteam' => $naamarray[5],
    		'bezoekersteam' => $naamarray[7],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 5
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match18);
    	
    	$match19 = array(
    		'thuisteam' => $naamarray[2],
    		'bezoekersteam' => $naamarray[4],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 5
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match19);
    	
    	$match20 = array(
    		'thuisteam' => $naamarray[6],
    		'bezoekersteam' => $naamarray[8],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 5
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match20);
    	
    	
    	//week6
    	
    	$match21 = array(
    		'thuisteam' => $naamarray[5],
    		'bezoekersteam' => $naamarray[1],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 6
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match21);
    	
    	
    	$match22 = array(
    		'thuisteam' => $naamarray[7],
    		'bezoekersteam' => $naamarray[3],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 6
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match22);
    	
    	$match23 = array(
    		'thuisteam' => $naamarray[6],
    		'bezoekersteam' => $naamarray[2],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 6
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match23);
    	
    	$match24 = array(
    		'thuisteam' => $naamarray[8],
    		'bezoekersteam' => $naamarray[4],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 6
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match24);
    	
    	
    	//week7
    	
    	$match25 = array(
    		'thuisteam' => $naamarray[1],
    		'bezoekersteam' => $naamarray[7],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 7
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match25);
    	
    	
    	$match26 = array(
    		'thuisteam' => $naamarray[3],
    		'bezoekersteam' => $naamarray[5],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 7
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match26);
    	
    	$match27 = array(
    		'thuisteam' => $naamarray[2],
    		'bezoekersteam' => $naamarray[8],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 7
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match27);
    	
    	$match28 = array(
    		'thuisteam' => $naamarray[4],
    		'bezoekersteam' => $naamarray[6],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 7
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match28);
    	
    	
    	//alles omdraaien voor de tweede helft van het seizoen
    	
    	
    	//week8
    	$match29 = array(
    		'thuisteam' => $naamarray[2],
    		'bezoekersteam' => $naamarray[1],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 8
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match29);
    	
    	$match30 = array(
    		'thuisteam' => $naamarray[4],
    		'bezoekersteam' => $naamarray[3],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 8
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match30);
    	
    	$match31 = array(
    		'thuisteam' => $naamarray[6],
    		'bezoekersteam' => $naamarray[5],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 8
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match31);
    	
    	$match32 = array(
    		'thuisteam' => $naamarray[8],
    		'bezoekersteam' => $naamarray[7],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 8
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match32);
    	
    	
    	//week9
    	
    	$match33 = array(
    		'thuisteam' => $naamarray[1],
    		'bezoekersteam' => $naamarray[4],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 9
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match33);
    	
    	$match34 = array(
    		'thuisteam' => $naamarray[3],
    		'bezoekersteam' => $naamarray[2],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 9
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match34);
    	
    	$match35 = array(
    		'thuisteam' => $naamarray[5],
    		'bezoekersteam' => $naamarray[8],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 9
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match35);
    	
    	$match36 = array(
    		'thuisteam' => $naamarray[7],
    		'bezoekersteam' => $naamarray[6],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 9
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match36);
    	
    	
    	//week10
    	
    	$match37 = array(
    		'thuisteam' => $naamarray[6],
    		'bezoekersteam' => $naamarray[1],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 10
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match37);
    	
    	
    	$match38 = array(
    		'thuisteam' => $naamarray[2],
    		'bezoekersteam' => $naamarray[5],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 10
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match38);
    	
    	$match39 = array(
    		'thuisteam' => $naamarray[8],
    		'bezoekersteam' => $naamarray[3],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 10
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match39);
    	
    	$match40 = array(
    		'thuisteam' => $naamarray[7],
    		'bezoekersteam' => $naamarray[4],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 10
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match40);
    	
    	//week11
    	
    	$match41 = array(
    		'thuisteam' => $naamarray[1],
    		'bezoekersteam' => $naamarray[8],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 11
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match41);
    	
    	
    	$match42 = array(
    		'thuisteam' => $naamarray[7],
    		'bezoekersteam' => $naamarray[2],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 11
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match42);
    	
    	$match43 = array(
    		'thuisteam' => $naamarray[3],
    		'bezoekersteam' => $naamarray[6],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 11
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match43);
    	
    	$match44 = array(
    		'thuisteam' => $naamarray[4],
    		'bezoekersteam' => $naamarray[5],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 11
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match44);
    	
    	//week12
    	
    	$match45 = array(
    		'thuisteam' => $naamarray[3],
    		'bezoekersteam' => $naamarray[1],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 12
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match45);
    	
    	
    	$match46 = array(
    		'thuisteam' => $naamarray[7],
    		'bezoekersteam' => $naamarray[5],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 12
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match46);
    	
    	$match47 = array(
    		'thuisteam' => $naamarray[4],
    		'bezoekersteam' => $naamarray[2],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 12
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match47);
    	
    	$match48 = array(
    		'thuisteam' => $naamarray[8],
    		'bezoekersteam' => $naamarray[6],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 12
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match48);
    	
    	
    	//week13
    	
    	$match49 = array(
    		'thuisteam' => $naamarray[1],
    		'bezoekersteam' => $naamarray[5],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 13
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match49);
    	
    	
    	$match50 = array(
    		'thuisteam' => $naamarray[3],
    		'bezoekersteam' => $naamarray[7],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 13
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match50);
    	
    	$match51 = array(
    		'thuisteam' => $naamarray[2],
    		'bezoekersteam' => $naamarray[6],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 13
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match51);
    	
    	$match52 = array(
    		'thuisteam' => $naamarray[4],
    		'bezoekersteam' => $naamarray[8],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 13
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match52);
    	
    	
    	//week14
    	
    	$match53 = array(
    		'thuisteam' => $naamarray[7],
    		'bezoekersteam' => $naamarray[1],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 14
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match53);
    	
    	
    	$match54 = array(
    		'thuisteam' => $naamarray[5],
    		'bezoekersteam' => $naamarray[3],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 14
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match54);
    	
    	$match55 = array(
    		'thuisteam' => $naamarray[8],
    		'bezoekersteam' => $naamarray[2],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 14
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match55);
    	
    	$match56 = array(
    		'thuisteam' => $naamarray[6],
    		'bezoekersteam' => $naamarray[4],
    		'FK_divisie_id' => $divisieid,
    		'seizoen' => $season,
    		'week' => 14
    	
    	);
    	
    	$insert = $this->db->insert('korf_wedstrijden', $match56);

    	
    	
    
    	//print_r($naamarray);
    	
    	}
    		
    }
    
    function update_financien()
    {
    	$cron = $this->db->get('korf_cron');
		foreach($cron->result() as $row)
		{
			$week = $row->week;
			$seizoen = $row->seizoen;
		}
    	
    	$this->db->where('bot', 1);
    	$teams = $this->db->get('korf_teams');
    	foreach($teams->result() as $row)
    	{
    		$teamid = $row->team_id;
    		
    		$this->db->where('week', $week);
    		$this->db->where('seizoen', $seizoen);
    		$this->db->where('FK_team_id',$teamid);
    		$totaalquery = $this->db->get('korf_financien');
    		
    		foreach($totaalquery->result() as $row)
    		{
				$totaal = $row->totaal;
				$sponsors = $row->sponsors;
				$wedstrijd = $row->wedstrijdinkomsten;
				$gek_spelers = $row->gekochte_spelers;
				$ver_spelers = $row->verkochte_spelers;
				$spelersloon = $row->spelersloon;
				$stadion = $row->stadion;
				
							
				$inkomsten = $sponsors + $wedstrijd + $ver_spelers;
				$uitgaven = $spelersloon + $stadion + $gek_spelers;
				$uitkomst = $inkomsten - $uitgaven;
				
				$totaal_nieuw = $totaal + $uitkomst;
			}
    		    		
    		//sponsorbedragen en spelerslonen aanvullen elke week 1 keer op een vaste dag
    		$this->db->select('*');
    		$this->db->from('korf_team_sponsors');
    		$this->db->join('korf_sponsors','FK_sponsor_id = sponsor_id');	
    		$this->db->where('FK_team_id', $teamid);
    		$sponsors = $this->db->get();
    		
    		$bedrag = 0;
    		foreach($sponsors->result() as $row)
    		{
    			$bedrag = $bedrag + $row->bedrag; 
    		
    		}
    		
    		$this->db->select('*');
    		$this->db->from('korf_skills');
    		$this->db->join('korf_spelers','FK_player_id = speler_id');
    		$this->db->where('FK_team_id', $teamid);
    		$spelers = $this->db->get();
    		
    		$loon = 0;
    		foreach($spelers->result() as $row)
    		{
    			$loon = $loon + ($row->rebound * 50) + ($row->stamina * 25) + ($row->passing * 50 ) + ($row->shotprecision * 25) + ($row->shotpower * 25) + ($row->intercepting * 70) + ($row->playmaking * 50);
    		
    		}
    		
    		
    		if($week == 14){
    			$week_insert = 1;
    			$seizoen_insert = $seizoen +1;
    		}else{
				$week_insert = $week+1;
				$seizoen_insert = $seizoen;    		
    		}

    		$insert = array(
    			'sponsors' => $bedrag,
    			'spelersloon' => $loon,
    			'week' => $week_insert,
    			'seizoen' => $seizoen_insert,
    			'FK_team_id' =>$teamid,
    			'stadion' => 0,
    			'gekochte_spelers' => 0,
    			'verkochte_spelers' => 0,
    			'wedstrijdinkomsten' => 0,
    			'totaal' => $totaal_nieuw
    		);
    		
    		$this->db->where('FK_team_id', $teamid);
    		$this->db->insert('korf_financien',$insert);
    	}
    	    
    }
    
   
    
 }