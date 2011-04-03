<?php class Cron_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
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
    
    function get_wedstrijden()
    {
    	$seizoenquery = $this->db->get('korf_cron');
    	
    	foreach($seizoenquery->result() as $rij){
    		$season = $rij->seizoen;
    		$week = $rij->week;
    	
    	}
    	
    	
    	$this->db->where('week', $week);
    	$this->db->where('seizoen', $season);
    	$wedstrijdenquery = $this->db->get('korf_wedstrijden');
    	
    	//elke wedstrijd
    	$i=1;
    	$wedstrijd = array();
    	foreach($wedstrijdenquery->result() as $row)
    	{	
    		//wedstrijdid
    		$wedstrijd[$i]['wedstrijdid'] = $row->wedstrijd_id;
    		$wedstrijd[$i]['thuisteam'] = $row->thuisteam;
    		//echo $row->thuisteam;
    		$wedstrijd[$i]['uitteam'] = $row->bezoekersteam;
    		$i++;
    	}	
    	
    	return $wedstrijd;

    }
    
    function get_statsuitteam($wedstrijd)
    {
    	//aantal wedstrijden
    	$lengte =  sizeof($wedstrijd)+1;
    	
    	$rebound1id = array();
    	$play1id = array();
    	$att1id = array();
    	$att2id = array();
    	$rebound2id = array();
    	$play2id = array();
    	$att3id = array();
    	$att4id = array();
    	
    		
    		//thuisteamstats
    		for($j=1;$j<$lengte;$j++){
    			
    			$empty = "empty";
    			
    			$this->db->select('*');
    			$this->db->from('korf_opstelling');
    			$this->db->where('FK_team_id', $wedstrijd[$j]['uitteam']);
    			$query = $this->db->get();
    			
    			if($query->num_rows() == 0){
    				$rebound1id[$j] = "empty";
    				$play1id[$j] ="empty";
    				$att1id[$j] ="empty";
    				$att2id[$j] ="empty";
    				$rebound2id[$j] ="empty";
    				$play2id[$j] ="empty";
    				$att3id[$j] ="empty";
    				$att4id[$j] ="empty";

    				
    			}else{
    			
    			foreach($query->result() as $uitrow)
    			{
    				$rebound1id[$j] = $uitrow->rebound1_speler;
    				$play1id[$j] = $uitrow->playmaking1_speler;
    				$att1id[$j] =$uitrow -> attack1_speler;
    				$att2id[$j] =$uitrow -> attack2_speler;
    				$rebound2id[$j] = $uitrow -> rebound2_speler;
    				$play2id[$j] = $uitrow -> playmaking2_speler;
    				$att3id[$j] =$uitrow -> attack3_speler;
					$att4id[$j] = $uitrow -> attack4_speler;

    			}
    				}
    		}
    		
    		//2044 reboundspelers
    		$lengterebound1 = sizeof($rebound1id) + 1;
    		
    			
    			
    				$thuisstats = array();
    				
    				
    				//rebound1 skill ophalen
    				for($k=1;$k<$lengterebound1;$k++){
    				
	    			$this->db->select('voornaam, achternaam, rebound,rebound_tr');
	    			$this->db->from('korf_training');
	    			$this->db->join('korf_skills', 'FK_skill_id = skill_id');
	    			$this->db->join('korf_spelers','FK_player_id = speler_id');
	    			$this->db->where('speler_id', $rebound1id[$k]);
	    			$reboundquery = $this->db->get();
    				
    				if($reboundquery->num_rows() == 0)
    				{
    					$uitstats[$k]['rebound'] = 0;
    					$uitstats[$k]['reboundspeler'] = "playbalspeler";
    					$uitstats[$k]['reboundspelerid'] = 0;
    				}else{
    			
	    				foreach($reboundquery->result() as $row)
	    				{
	    					 $rebound = $row->rebound;;
	    					 $rebound_tr = $row->rebound_tr;
	    					 $uitstats[$k]['rebound'] = $rebound .'.'. $rebound_tr;
	    					 $uitstats[$k]['reboundspeler'] = $row->voornaam.' '.$row->achternaam;
	    					 $uitstats[$k]['reboundspelerid'] = $rebound1id[$k];
	    					
	    			
	    				}
	    				}
    				
    				}
    				
    				//playmaking1 skill ophalen
    				
    				for($k=1;$k<$lengterebound1;$k++){
    				
	    			$this->db->select('voornaam, achternaam, playmaking,playmaking_tr');
	    			$this->db->from('korf_training');
	    			$this->db->join('korf_skills', 'FK_skill_id = skill_id');
	    			$this->db->join('korf_spelers','FK_player_id = speler_id');
	    			$this->db->where('speler_id', $play1id[$k]);
	    			$playmakingquery = $this->db->get();
    				
    				if($playmakingquery->num_rows() == 0)
    				{
    					$uitstats[$k]['playmaking'] = 0;
    					$uitstats[$k]['playmakingspeler'] = "playbalspeler";
    					$uitstats[$k]['playmakingspelerid'] = 0;
    				}else{
    			
	    				foreach($playmakingquery->result() as $row)
	    				{
	    					 $playmaking = $row->playmaking;
	    					 $playmaking_tr = $row->playmaking_tr;
	    					 $uitstats[$k]['playmaking'] = $playmaking.'.'.$playmaking_tr;
	    					 $uitstats[$k]['playmakingspeler'] = $row->voornaam.' '.$row->achternaam;
							 $uitstats[$k]['playmakingspelerid'] = $play1id[$k];
	    					 
	    			
	    				}
	    				}
    				
    				}
    				
    				//attack1 skill ophalen
    				for($k=1;$k<$lengterebound1;$k++){
    				
	    			$this->db->select('voornaam, achternaam, shotpower,shotpower_tr, shotprecision, shotprecision_tr');
	    			$this->db->from('korf_training');
	    			$this->db->join('korf_skills', 'FK_skill_id = skill_id');
	    			$this->db->join('korf_spelers','FK_player_id = speler_id');
	    			$this->db->where('speler_id', $att1id[$k]);
	    			$attackquery = $this->db->get();
    				
    				if($attackquery->num_rows() == 0)
    				{
    					$uitstats[$k]['attack'] = 0;
    					$uitstats[$k]['attackspeler'] = "playbalspeler";
    					$uitstats[$k]['attackspelerid'] = 0;
    				}else{
    			
	    				foreach($attackquery->result() as $row)
	    				{
	    				
	    						$shotpower = $row->shotpower;
	    						$shotpower_tr = $row->shotpower_tr;
	    						$shotprecision = $row->shotprecision;
	    						$shotprecision_tr = $row->shotprecision_tr;
	    					 	$uitstats[$k]['attack'] = $shotpower + $shotprecision.'.'.($shotprecision_tr + $shotpower_tr)/2;
	    					 	$uitstats[$k]['attackspeler'] = $row->voornaam.' '.$row->achternaam;
								$uitstats[$k]['attackspelerid'] =  $att1id[$k];
	    			
	    				}
	    				}
    				
    				}
    				
    				//attack2 skill ophalen
    				for($k=1;$k<$lengterebound1;$k++){
    				
	    			$this->db->select('voornaam, achternaam, shotpower,shotpower_tr, shotprecision, shotprecision_tr');
	    			$this->db->from('korf_training');
	    			$this->db->join('korf_skills', 'FK_skill_id = skill_id');
	    			$this->db->join('korf_spelers','FK_player_id = speler_id');
	    			$this->db->where('speler_id', $att2id[$k]);
	    			$attackquery2 = $this->db->get();
    				
    				if($attackquery2->num_rows() == 0)
    				{
    					$uitstats[$k]['attack2'] = 0;
    					$uitstats[$k]['attack2speler'] = "playbalspeler";
    					$uitstats[$k]['attack2spelerid'] = 0;
    				}else{
    			
	    				foreach($attackquery2->result() as $row)
	    				{
	    				
	    						$shotpower = $row->shotpower;
	    						$shotpower_tr = $row->shotpower_tr;
	    						$shotprecision = $row->shotprecision;
	    						$shotprecision_tr = $row->shotprecision_tr;
	    					 	$uitstats[$k]['attack2'] = $shotpower + $shotprecision.'.'.($shotprecision_tr + $shotpower_tr)/2;
	    					 	$uitstats[$k]['attack2speler'] = $row->voornaam.' '.$row->achternaam;
								$uitstats[$k]['attack2spelerid'] = $att2id[$k];
	    			
	    				}
	    				}
    				
    				}
    				
    				//rebound2 skill ophalen
    				for($k=1;$k<$lengterebound1;$k++){
    				
	    			$this->db->select('voornaam, achternaam, rebound,rebound_tr');
	    			$this->db->from('korf_training');
	    			$this->db->join('korf_skills', 'FK_skill_id = skill_id');
	    			$this->db->join('korf_spelers','FK_player_id = speler_id');
	    			$this->db->where('speler_id', $rebound2id[$k]);
	    			$rebound2query = $this->db->get();
    				
    				if($rebound2query->num_rows() == 0)
    				{
    					$uitstats[$k]['rebound2'] = 0;
    					$uitstats[$k]['rebound2speler'] = "playbalspeler";
    					$uitstats[$k]['rebound2spelerid'] = 0;
    				}else{
    			
	    				foreach($rebound2query->result() as $row)
	    				{
	    					 $rebound = $row->rebound;;
	    					 $rebound_tr = $row->rebound_tr;
	    					 $uitstats[$k]['rebound2'] = $rebound .'.'. $rebound_tr;
	    					 $uitstats[$k]['rebound2speler'] = $row->voornaam.' '.$row->achternaam;
							 $uitstats[$k]['rebound2spelerid'] = $rebound2id[$k];
	    					
	    			
	    				}
	    				}
    				
    				}
    				
    				//playmaking2 skill ophalen
    				for($k=1;$k<$lengterebound1;$k++){
    				
	    			$this->db->select('voornaam, achternaam, playmaking,playmaking_tr');
	    			$this->db->from('korf_training');
	    			$this->db->join('korf_skills', 'FK_skill_id = skill_id');
	    			$this->db->join('korf_spelers','FK_player_id = speler_id');
	    			$this->db->where('speler_id', $play2id[$k]);
	    			$playmaking2query = $this->db->get();
    				
    				if($playmaking2query->num_rows() == 0)
    				{
    					$uitstats[$k]['playmaking2'] = 0;
    					$uitstats[$k]['playmaking2speler'] = "playbalspeler";
    					$uitstats[$k]['playmaking2spelerid'] = 0;
    				}else{
    			
	    				foreach($playmaking2query->result() as $row)
	    				{
	    					 $playmaking = $row->playmaking;
	    					 $playmaking_tr = $row->playmaking_tr;
	    					 $uitstats[$k]['playmaking2'] = $playmaking.'.'.$playmaking_tr;
	    					 $uitstats[$k]['playmaking2speler'] = $row->voornaam.' '.$row->achternaam;
							 $uitstats[$k]['playmaking2spelerid'] =  $play2id[$k] ;
	    					 
	    			
	    				}
	    				}
    				
    				}
    				
					//attack3 skill ophalen
					for($k=1;$k<$lengterebound1;$k++){
    				
	    			$this->db->select('voornaam, achternaam, shotpower,shotpower_tr, shotprecision, shotprecision_tr');
	    			$this->db->from('korf_training');
	    			$this->db->join('korf_skills', 'FK_skill_id = skill_id');
	    			$this->db->join('korf_spelers','FK_player_id = speler_id');
	    			$this->db->where('speler_id', $att3id[$k]);
	    			$attack3query = $this->db->get();
    				
    				if($attack3query->num_rows() == 0)
    				{
    					$uitstats[$k]['attack3'] = 0;
    					$uitstats[$k]['attack3speler'] = "playbalspeler";
    					$uitstats[$k]['attack3spelerid'] = 0;
    				}else{
    			
	    				foreach($attack3query->result() as $row)
	    				{
	    				
	    						$shotpower = $row->shotpower;
	    						$shotpower_tr = $row->shotpower_tr;
	    						$shotprecision = $row->shotprecision;
	    						$shotprecision_tr = $row->shotprecision_tr;
	    					 	$uitstats[$k]['attack3'] = $shotpower + $shotprecision.'.'.($shotprecision_tr + $shotpower_tr)/2;
	    					    $uitstats[$k]['attack3speler'] = $row->voornaam.' '.$row->achternaam;
								$uitstats[$k]['attack3spelerid'] = $att3id[$k] ;
	    			
	    				}
	    				}
    				
    				}
    				
    				//attack4 skill ophalen
    				for($k=1;$k<$lengterebound1;$k++){
    				
	    			$this->db->select('voornaam, achternaam, shotpower,shotpower_tr, shotprecision, shotprecision_tr');
	    			$this->db->from('korf_training');
	    			$this->db->join('korf_skills', 'FK_skill_id = skill_id');
	    			$this->db->join('korf_spelers','FK_player_id = speler_id');
	    			$this->db->where('speler_id', $att4id[$k]);
	    			$attack4query = $this->db->get();
    				
    				if($attack4query->num_rows() == 0)
    				{
    					$uitstats[$k]['attack4'] = 0;
    					$uitstats[$k]['attack4speler'] = "playbalspeler";
    					$uitstats[$k]['attack4spelerid'] = 0 ;
    				}else{
    			
	    				foreach($attack4query->result() as $row)
	    				{
	    				
	    						$shotpower = $row->shotpower;
	    						$shotpower_tr = $row->shotpower_tr;
	    						$shotprecision = $row->shotprecision;
	    						$shotprecision_tr = $row->shotprecision_tr;
	    					 	$uitstats[$k]['attack4'] = $shotpower + $shotprecision.'.'.($shotprecision_tr + $shotpower_tr)/2;
	    					    $uitstats[$k]['attack4speler'] = $row->voornaam.' '.$row->achternaam;
								$uitstats[$k]['attack4spelerid'] = $att4id[$k] ;
	    						
	    				}
	    				}
    				
    				}
			return $uitstats;

    }
    
    function get_statsthuisteam($wedstrijd)
    {
    	//aantal wedstrijden
    	$lengte =  sizeof($wedstrijd)+1;
    	
    	$rebound1id = array();
    	$play1id = array();
    	$att1id = array();
    	$att2id = array();
    	$rebound2id = array();
    	$play2id = array();
    	$att3id = array();
    	$att4id = array();
    	
    		
    		//thuisteamstats
    		for($j=1;$j<$lengte;$j++){
    			
    			$empty = "empty";
    			
    			$this->db->select('*');
    			$this->db->from('korf_opstelling');
    			$this->db->where('FK_team_id', $wedstrijd[$j]['thuisteam']);
    			$query = $this->db->get();
    			
    			if($query->num_rows() == 0){
    				$rebound1id[$j] = "empty";
    				$play1id[$j] ="empty";
    				$att1id[$j] ="empty";
    				$att2id[$j] ="empty";
    				$rebound2id[$j] ="empty";
    				$play2id[$j] ="empty";
    				$att3id[$j] ="empty";
    				$att4id[$j] ="empty";

    				
    			}else{
    			
    			foreach($query->result() as $thuisrow)
    			{
    				$rebound1id[$j] = $thuisrow->rebound1_speler;
    				$play1id[$j] = $thuisrow->playmaking1_speler;
    				$att1id[$j] =$thuisrow -> attack1_speler;
    				$att2id[$j] =$thuisrow -> attack2_speler;
    				$rebound2id[$j] = $thuisrow -> rebound2_speler;
    				$play2id[$j] = $thuisrow -> playmaking2_speler;
    				$att3id[$j] =$thuisrow -> attack3_speler;
					$att4id[$j] = $thuisrow -> attack4_speler;

    			}
    				}
    		}
    		
    		//2044 reboundspelers
    		$lengterebound1 = sizeof($rebound1id) + 1;
    		
    			
    			
    				$thuistats = array();
    				$thuisstats_tr =array();
    				
    				//rebound1 skill ophalen
    				for($k=1;$k<$lengterebound1;$k++){
    				
	    			$this->db->select('voornaam, achternaam, rebound,rebound_tr');
	    			$this->db->from('korf_training');
	    			$this->db->join('korf_skills', 'FK_skill_id = skill_id');
	    			$this->db->join('korf_spelers','FK_player_id = speler_id');
	    			$this->db->where('speler_id', $rebound1id[$k]);
	    			$reboundquery = $this->db->get();
    				
    				if($reboundquery->num_rows() == 0)
    				{
    					$thuisstats[$k]['rebound'] = 0;
    					$thuisstats[$k]['reboundspeler'] = "playbalspeler";
    				    $thuisstats[$k]['reboundspelerid'] = 0;

    				}else{
    			
	    				foreach($reboundquery->result() as $row)
	    				{
	    					 $rebound = $row->rebound;
	    					 $rebound_tr = $row->rebound_tr;
	    					 $thuisstats[$k]['rebound'] = $rebound .'.'. $rebound_tr;
	    					 $thuisstats[$k]['reboundspeler'] = $row->voornaam.' '.$row->achternaam;
	    					 $thuisstats[$k]['reboundspelerid'] = $rebound1id[$k];
	    					
	    			
	    				}
	    				}
    				
    				}
    				
    				//playmaking1 skill ophalen
    				
    				for($k=1;$k<$lengterebound1;$k++){
    				
	    			$this->db->select('voornaam, achternaam, playmaking,playmaking_tr');
	    			$this->db->from('korf_training');
	    			$this->db->join('korf_skills', 'FK_skill_id = skill_id');
	    			$this->db->join('korf_spelers','FK_player_id = speler_id');
	    			$this->db->where('speler_id', $play1id[$k]);
	    			$playmakingquery = $this->db->get();
    				
    				if($playmakingquery->num_rows() == 0)
    				{
    					$thuisstats[$k]['playmaking'] = 0;
    					$thuisstats[$k]['playmakingspeler'] = "playbalspeler";
    				    $thuisstats[$k]['playmakingspelerid'] = 0;
    				
    				}else{
    			
	    				foreach($playmakingquery->result() as $row)
	    				{
	    					 $playmaking = $row->playmaking;
	    					 $playmaking_tr = $row->playmaking_tr;
	    					 $thuisstats[$k]['playmaking'] = $playmaking.'.'.$playmaking_tr;
	    					 $thuisstats[$k]['playmakingspeler'] = $row->voornaam.' '.$row->achternaam;
	    					 $thuisstats[$k]['playmakingspelerid'] = $play1id[$k];

	    			
	    				}
	    				}
    				
    				}
    				
    				//attack1 skill ophalen
    				for($k=1;$k<$lengterebound1;$k++){
    				
	    			$this->db->select('voornaam, achternaam, shotpower,shotpower_tr, shotprecision, shotprecision_tr');
	    			$this->db->from('korf_training');
	    			$this->db->join('korf_skills', 'FK_skill_id = skill_id');
	    			$this->db->join('korf_spelers','FK_player_id = speler_id');
	    			$this->db->where('speler_id', $att1id[$k]);
	    			$attackquery = $this->db->get();
    				
    				if($attackquery->num_rows() == 0)
    				{
    					$thuisstats[$k]['attack'] = 0;
    					$thuisstats[$k]['attackspeler'] = "playbalspeler";
    					$thuisstats[$k]['attackspelerid'] = 0;
    				}else{
    			
	    				foreach($attackquery->result() as $row)
	    				{
	    				
	    						$shotpower = $row->shotpower;
	    						$shotpower_tr = $row->shotpower_tr;
	    						$shotprecision = $row->shotprecision;
	    						$shotprecision_tr = $row->shotprecision_tr;
	    					 	$thuisstats[$k]['attack'] = $shotpower + $shotprecision.'.'.($shotprecision_tr + $shotpower_tr)/2;
	    					 	$thuisstats[$k]['attackspeler'] = $row->voornaam.' '.$row->achternaam;
	    						$thuisstats[$k]['attackspelerid'] = $att1id[$k];
	    				}
	    				}
    				
    				}
    				
    				//attack2 skill ophalen
    				for($k=1;$k<$lengterebound1;$k++){
    				
	    			$this->db->select('voornaam, achternaam, shotpower,shotpower_tr, shotprecision, shotprecision_tr');
	    			$this->db->from('korf_training');
	    			$this->db->join('korf_skills', 'FK_skill_id = skill_id');
	    			$this->db->join('korf_spelers','FK_player_id = speler_id');
	    			$this->db->where('speler_id', $att2id[$k]);
	    			$attackquery2 = $this->db->get();
    				
    				if($attackquery2->num_rows() == 0)
    				{
    					$thuisstats[$k]['attack2'] = 0;
    					$thuisstats[$k]['attack2speler'] = "playbalspeler";
    					$thuisstats[$k]['attack2spelerid'] = 0;
    				}else{
    			
	    				foreach($attackquery2->result() as $row)
	    				{
	    				
	    						$shotpower = $row->shotpower;
	    						$shotpower_tr = $row->shotpower_tr;
	    						$shotprecision = $row->shotprecision;
	    						$shotprecision_tr = $row->shotprecision_tr;
	    					 	$thuisstats[$k]['attack2'] = $shotpower + $shotprecision.'.'.($shotprecision_tr + $shotpower_tr)/2;
	    					 	$thuisstats[$k]['attack2speler'] = $row->voornaam.' '.$row->achternaam;
	    						$thuisstats[$k]['attack2spelerid'] = $att2id[$k];
	    				}
	    				}
    				
    				}
    				
    				//rebound2 skill ophalen
    				for($k=1;$k<$lengterebound1;$k++){
    				
	    			$this->db->select('voornaam, achternaam, rebound,rebound_tr');
	    			$this->db->from('korf_training');
	    			$this->db->join('korf_skills', 'FK_skill_id = skill_id');
	    			$this->db->join('korf_spelers','FK_player_id = speler_id');
	    			$this->db->where('speler_id', $rebound2id[$k]);
	    			$rebound2query = $this->db->get();
    				
    				if($rebound2query->num_rows() == 0)
    				{
    					$thuisstats[$k]['rebound2'] = 0;
    					$thuisstats[$k]['rebound2speler'] = "playbalspeler";
    					$thuisstats[$k]['rebound2spelerid'] = 0;
    				}else{
    			
	    				foreach($rebound2query->result() as $row)
	    				{
	    					 $rebound = $row->rebound;;
	    					 $rebound_tr = $row->rebound_tr;
	    					 $thuisstats[$k]['rebound2'] = $rebound .'.'. $rebound_tr;
	    					 $thuisstats[$k]['rebound2speler'] = $row->voornaam.' '.$row->achternaam;
	    					 $thuisstats[$k]['rebound2spelerid'] = $rebound2id[$k];
	    				}
	    				}
    				
    				}
    				
    				//playmaking2 skill ophalen
    				for($k=1;$k<$lengterebound1;$k++){
    				
	    			$this->db->select('voornaam, achternaam, playmaking,playmaking_tr');
	    			$this->db->from('korf_training');
	    			$this->db->join('korf_skills', 'FK_skill_id = skill_id');
	    			$this->db->join('korf_spelers','FK_player_id = speler_id');
	    			$this->db->where('speler_id', $play2id[$k]);
	    			$playmaking2query = $this->db->get();
    				
    				if($playmaking2query->num_rows() == 0)
    				{
    					$thuisstats[$k]['playmaking2'] = 0;
    					$thuisstats[$k]['playmaking2speler'] = "playbalspeler";
    					$thuisstats[$k]['playmaking2spelerid'] = 0;
    				
    				}else{
    			
	    				foreach($playmaking2query->result() as $row)
	    				{
	    					 $playmaking = $row->playmaking;
	    					 $playmaking_tr = $row->playmaking_tr;
	    					 $thuisstats[$k]['playmaking2'] = $playmaking.'.'.$playmaking_tr;
	    					 $thuisstats[$k]['playmaking2speler'] = $row->voornaam.' '.$row->achternaam;
	    					 $thuisstats[$k]['playmaking2spelerid'] = $play2id[$k];
	    			
	    				}
	    				}
    				
    				}
    				
					//attack3 skill ophalen
					for($k=1;$k<$lengterebound1;$k++){
    				
	    			$this->db->select('voornaam, achternaam, shotpower,shotpower_tr, shotprecision, shotprecision_tr');
	    			$this->db->from('korf_training');
	    			$this->db->join('korf_skills', 'FK_skill_id = skill_id');
	    			$this->db->join('korf_spelers','FK_player_id = speler_id');
	    			$this->db->where('speler_id', $att3id[$k]);
	    			$attack3query = $this->db->get();
    				
    				if($attack3query->num_rows() == 0)
    				{
    					$thuisstats[$k]['attack3'] = 0;
    					$thuisstats[$k]['attack3speler'] = "playbalspeler";
    					$thuisstats[$k]['attack3spelerid'] = 0;
    				}else{
    			
	    				foreach($attack3query->result() as $row)
	    				{
	    				
	    						$shotpower = $row->shotpower;
	    						$shotpower_tr = $row->shotpower_tr;
	    						$shotprecision = $row->shotprecision;
	    						$shotprecision_tr = $row->shotprecision_tr;
	    					 	$thuisstats[$k]['attack3'] = $shotpower + $shotprecision.'.'.($shotprecision_tr + $shotpower_tr)/2;
	    					 	$thuisstats[$k]['attack3speler'] = $row->voornaam.' '.$row->achternaam;
	    						$thuisstats[$k]['attack3spelerid'] = $att3id[$k];
	    				}
	    				}
    				
    				}
    				
    				//attack4 skill ophalen
    				for($k=1;$k<$lengterebound1;$k++){
    				
	    			$this->db->select('voornaam, achternaam, shotpower,shotpower_tr, shotprecision, shotprecision_tr');
	    			$this->db->from('korf_training');
	    			$this->db->join('korf_skills', 'FK_skill_id = skill_id');
	    			$this->db->join('korf_spelers','FK_player_id = speler_id');
	    			$this->db->where('speler_id', $att4id[$k]);
	    			$attack4query = $this->db->get();
    				
    				if($attack4query->num_rows() == 0)
    				{
    					$thuisstats[$k]['attack4'] = 0;
    					$thuisstats[$k]['attack4speler'] = "playbalspeler";
    						$thuisstats[$k]['attack4spelerid'] = 0;
    				}else{
    			
	    				foreach($attack4query->result() as $row)
	    				{
	    				
	    						$shotpower = $row->shotpower;
	    						$shotpower_tr = $row->shotpower_tr;
	    						$shotprecision = $row->shotprecision;
	    						$shotprecision_tr = $row->shotprecision_tr;
	    					 	$thuisstats[$k]['attack4'] = $shotpower + $shotprecision.'.'.($shotprecision_tr + $shotpower_tr)/2; //gedeeld door 2 omwille van dubbele skilloptelling
	    					 	$thuisstats[$k]['attack4speler'] = $row->voornaam.' '.$row->achternaam;
	    						$thuisstats[$k]['attack4spelerid'] = $att4id[$k];
	    				}
	    				}
    				
    				}
			return $thuisstats;
    
    }
    //speel wedstrijden
    function play_games($thuis, $uit, $wedstrijd)
    {
    	$lengte = sizeof($thuis);
    	$uitslag = array();
    	
    	for($i=1;$i<$lengte+1;$i++){
    	
    		$wedstrijdid = $wedstrijd[$i]['wedstrijdid'];
    		$thuisteamid = $wedstrijd[$i]['thuisteam'];
    		$uitteamid = $wedstrijd[$i]['uitteam'];
    		
    		
    	//spelersprestaties ingeven voor thuisteam
			//reboundspeler
		$rebound1_th = $this->speler_stats($thuis[$i]['reboundspelerid'],$thuis[$i]['rebound'], 'rebound');
			//playmakingspeler
		$playmaking1_th = $this->speler_stats($thuis[$i]['playmakingspelerid'],$thuis[$i]['playmaking'], 'playmaking');
			//attack1
		$attack1_th = $this->speler_stats($thuis[$i]['attackspelerid'],$thuis[$i]['attack'], 'attack');
			//attack2
		$attack2_th = $this->speler_stats($thuis[$i]['attack2spelerid'],$thuis[$i]['attack2'], 'attack');
			//rebound2
		$rebound2_th = $this->speler_stats($thuis[$i]['rebound2spelerid'],$thuis[$i]['rebound2'], 'rebound');
			//playmaking2
		$playmaking2_th = $this->speler_stats($thuis[$i]['playmaking2spelerid'],$thuis[$i]['playmaking2'], 'playmaking');	
			//attack3
		$attack3_th = $this->speler_stats($thuis[$i]['attack3spelerid'],$thuis[$i]['attack3'], 'attack');		
			//attack4
		$attack4_th = $this->speler_stats($thuis[$i]['attack4spelerid'],$thuis[$i]['attack4'], 'attack');		
    	
    	
    	//spelersprestaties ingeven voor uitteam
			//reboundspeler
		$rebound1_uit = $this->speler_stats($uit[$i]['reboundspelerid'],$uit[$i]['rebound'], 'rebound');
			//playmakingspeler
		$playmaking1_uit = $this->speler_stats($uit[$i]['playmakingspelerid'],$uit[$i]['playmaking'], 'playmaking');
			//attack1
		$attack1_uit = $this->speler_stats($uit[$i]['attackspelerid'],$uit[$i]['attack'], 'attack');
			//attack2
		$attack2_uit = $this->speler_stats($uit[$i]['attack2spelerid'],$uit[$i]['attack2'], 'attack');
			//rebound2
		$rebound2_uit = $this->speler_stats($uit[$i]['rebound2spelerid'],$uit[$i]['rebound2'], 'rebound');
			//playmaking2
		$playmaking2_uit = $this->speler_stats($uit[$i]['playmaking2spelerid'],$uit[$i]['playmaking2'], 'playmaking');	
			//attack3
		$attack3_uit = $this->speler_stats($uit[$i]['attack3spelerid'],$uit[$i]['attack3'], 'attack');		
			//attack4
		$attack4_uit = $this->speler_stats($uit[$i]['attack4spelerid'],$uit[$i]['attack4'], 'attack');	
    		
    		//totaal opmaken adhv de sterkte/zwakte van de spelers
    		$thuistotaal = $rebound1_th + $playmaking1_th + $attack1_th + $attack2_th + $rebound2_th + $playmaking2_th + $attack3_th + $attack4_th;    		
    		$uittotaal = $rebound1_uit + $playmaking1_uit + $attack1_uit + $attack2_uit + $rebound2_uit + $playmaking2_uit + $attack3_uit + $attack4_uit; 

		// inititaliseren van arrays voor het opslagen van de gegevens
		$uitslag['thuis'] = 0;
		$uitslag['uit'] = 0;
		$acties = '';
		$spelers = '';
		$tussenstand = '';
		$minuten = '';
		//in array steken om random speler te laten scoren
		$thuisspelerarray = array($thuis[$i]['attack2speler'],$thuis[$i]['attackspeler'],$thuis[$i]['attack3speler'],$thuis[$i]['attack4speler'],$thuis[$i]['reboundspeler'],$thuis[$i]['rebound2speler'],$thuis[$i]['playmakingspeler'],$thuis[$i]['playmaking2speler']);
		$uitspelerarray = array($uit[$i]['attack2speler'],$uit[$i]['attackspeler'],$uit[$i]['attack3speler'],$uit[$i]['attack4speler'],$uit[$i]['reboundspeler'],$uit[$i]['rebound2speler'],$uit[$i]['playmakingspeler'],$uit[$i]['playmaking2speler']);


		
		//matchacties en goals
		for($j=1;$j<60;$j++){
			$randkans1 = rand(0,2);
			$randmin1 = rand($j,$j+1);
			$randomspeler = rand(0,7);
			if($randkans1 == 1 || $randkans1 == 2){
					if($thuistotaal + rand(0,400) >= $uittotaal + rand(0,400))
					{
						$uitslag['thuis'] = $uitslag['thuis'] + 1;
						$minuten .= $randmin1.';';
						$acties .= rand(1,2).';';
						$spelers .= $thuisspelerarray[$randomspeler].';';
						$tussenstand .= $uitslag['thuis'].'-'.$uitslag['uit'].';';
					}else{
						$uitslag['uit'] = $uitslag['uit'] + 1;
						$acties .= '1;';
						$spelers .= $uitspelerarray[$randomspeler].';';
						$tussenstand .= $uitslag['thuis'].'-'.$uitslag['uit'].';';
						$minuten .= $randmin1.';';
		
					
					}
			}

		
		}
						
						
		
		//gelijkstand
		if($uitslag['thuis'] == $uitslag['uit']){
			//insert verslag
			$insert = array(
				'FK_wedstrijd_id' => $wedstrijdid,
				'minuten' => $minuten,
				'acties' => $acties,
				'spelers' => $spelers,
				'tussenstand' => $tussenstand
			
			);
			
			$this->db->insert('korf_verslagen', $insert);
			
			//haal de thuisteamgegevens op
			$this->db->select('gespeeld, gelijk, doelpunten_voor, doelpunten_tegen, divisiepunten');
			$this->db->from('korf_teams');
			$this->db->where('team_id', $thuisteamid);
			$thuisteamquery = $this->db->get();
			
			foreach($thuisteamquery->result() as $row)
			{
				$gespeeld = $row->gespeeld;
				$gelijk = $row->gelijk;
				$voor = $row->doelpunten_voor;
				$tegen = $row->doelpunten_tegen;
				$punten = $row->divisiepunten;
			
			}
			
			$thuisupdate = array(
				'gespeeld' => $gespeeld +1,
				'gelijk' => $gelijk + 1,
				'doelpunten_voor' => $voor + $uitslag['thuis'],
				'doelpunten_tegen' => $tegen + $uitslag['uit'], 
				'divisiepunten' => $punten + 1
			
			);
			
			$this->db->where('team_id', $thuisteamid);
			$this->db->update('korf_teams', $thuisupdate);
			
			//haal de uitteamgegevens op
			$this->db->select('gespeeld, gelijk, doelpunten_voor, doelpunten_tegen, divisiepunten');
			$this->db->from('korf_teams');
			$this->db->where('team_id', $uitteamid);
			$uitteamquery = $this->db->get();
			
			foreach($uitteamquery->result() as $row)
			{
				$gespeeld = $row->gespeeld;
				$gelijk = $row->gelijk;
				$voor = $row->doelpunten_voor;
				$tegen = $row->doelpunten_tegen;
				$punten = $row->divisiepunten;
			
			}

			
			$uitupdate = array(
				'gespeeld' => $gespeeld +1,
				'gelijk' => $gelijk + 1,
				'doelpunten_voor' => $voor + $uitslag['uit'],
				'doelpunten_tegen' => $tegen + $uitslag['thuis'], 
				'divisiepunten' => $punten + 1
			
			);
			
			$this->db->where('team_id', $uitteamid);
			$this->db->update('korf_teams', $uitupdate);
			
		}
		
		//thuisteam wint////////////////////////////
		if($uitslag['thuis'] > $uitslag['uit']){
		//insert verslag
			$insert = array(
				'FK_wedstrijd_id' => $wedstrijdid,
				'minuten' => $minuten,
				'acties' => $acties,
				'spelers' => $spelers,
				'tussenstand' => $tussenstand

			
			);
			
			$this->db->insert('korf_verslagen', $insert);
			
			//haal de thuisteamgegevens op
			$this->db->select('gespeeld, gewonnen, doelpunten_voor, doelpunten_tegen, divisiepunten');
			$this->db->from('korf_teams');
			$this->db->where('team_id', $thuisteamid);
			$thuisteamquery = $this->db->get();
			
			foreach($thuisteamquery->result() as $row)
			{
				$gespeeld = $row->gespeeld;
				$gewonnen = $row->gewonnen;
				$voor = $row->doelpunten_voor;
				$tegen = $row->doelpunten_tegen;
				$punten = $row->divisiepunten;
			
			}
			
			$thuisupdate = array(
				'gespeeld' => $gespeeld +1,
				'gewonnen' => $gewonnen + 1,
				'doelpunten_voor' => $voor + $uitslag['thuis'],
				'doelpunten_tegen' => $tegen + $uitslag['uit'], 
				'divisiepunten' => $punten + 2
			
			);
			
			$this->db->where('team_id', $thuisteamid);
			$this->db->update('korf_teams', $thuisupdate);
			
			//haal de uitteamgegevens op
			$this->db->select('gespeeld, verloren, doelpunten_voor, doelpunten_tegen');
			$this->db->from('korf_teams');
			$this->db->where('team_id', $uitteamid);
			$uitteamquery = $this->db->get();
			
			foreach($uitteamquery->result() as $row)
			{
				$gespeeld = $row->gespeeld;
				$verloren = $row->verloren;
				$voor = $row->doelpunten_voor;
				$tegen = $row->doelpunten_tegen;
				
			
			}

			
			$uitupdate = array(
				'gespeeld' => $gespeeld +1,
				'verloren' => $verloren + 1,
				'doelpunten_voor' => $voor + $uitslag['uit'],
				'doelpunten_tegen' => $tegen + $uitslag['thuis']
				
			
			);
			
			$this->db->where('team_id', $uitteamid);
			$this->db->update('korf_teams', $uitupdate);
			
		
		
		
		}
		
		//uitteam wint////////////////////////////
		if($uitslag['thuis'] < $uitslag['uit']){
		//insert verslag
			$insert = array(
				'FK_wedstrijd_id' => $wedstrijdid,
				'minuten' => $minuten,
				'acties' => $acties,
				'spelers' => $spelers,
				'tussenstand' => $tussenstand

			
			);
			
			$this->db->insert('korf_verslagen', $insert);
			
			//haal de thuisteamgegevens op
			$this->db->select('gespeeld, verloren, doelpunten_voor, doelpunten_tegen');
			$this->db->from('korf_teams');
			$this->db->where('team_id', $thuisteamid);
			$thuisteamquery = $this->db->get();
			
			foreach($thuisteamquery->result() as $row)
			{
				$gespeeld = $row->gespeeld;
				$verloren = $row->verloren;
				$voor = $row->doelpunten_voor;
				$tegen = $row->doelpunten_tegen;
				
			
			}
			
			$thuisupdate = array(
				'gespeeld' => $gespeeld +1,
				'verloren' => $verloren + 1,
				'doelpunten_voor' => $voor + $uitslag['thuis'],
				'doelpunten_tegen' => $tegen + $uitslag['uit']
				
			
			);
			
			$this->db->where('team_id', $thuisteamid);
			$this->db->update('korf_teams', $thuisupdate);
			
			//haal de uitteamgegevens op
			$this->db->select('gespeeld, gewonnen, doelpunten_voor, doelpunten_tegen, divisiepunten');
			$this->db->from('korf_teams');
			$this->db->where('team_id', $uitteamid);
			$uitteamquery = $this->db->get();
			
			foreach($uitteamquery->result() as $row)
			{
				$gespeeld = $row->gespeeld;
				$gewonnen = $row->gewonnen;
				$voor = $row->doelpunten_voor;
				$tegen = $row->doelpunten_tegen;
				$punten = $row->divisiepunten;
				
			
			}

			
			$uitupdate = array(
				'gespeeld' => $gespeeld +1,
				'gewonnen' => $gewonnen + 1,
				'doelpunten_voor' => $voor + $uitslag['uit'],
				'doelpunten_tegen' => $tegen + $uitslag['thuis'], 
				'divisiepunten' => $punten + 2
				
			
			);
			
			$this->db->where('team_id', $uitteamid);
			$this->db->update('korf_teams', $uitupdate);
			
		
		
		
		}

		$einduitslag = array(
			'uitslag' => $uitslag['thuis'].'-'.$uitslag['uit']
		
		);		
		
		$this->db->where('wedstrijd_id', $wedstrijdid);
		$this->db->update('korf_wedstrijden', $einduitslag);
		
    	}
    	   //return $uitslag; 
    }
    
    function speler_stats($id, $hoofdskill, $positie){
			if($id == 0){
				$prestatie = 0;
				return $prestatie;
				
			}else{
					//echo $thuis[$i]['rebound'];
			    $prestatie = ($hoofdskill*4)+rand(-10, 10); //(rebound = 80%)(stamina=20%)(random factor)
       				$this->db->where('FK_speler_id', $id);
				$statsquery = $this->db->get('korf_spelerstats');
				
				//als er nog geen entry bestaat == eerste wedstrijd voor deze speler
				if($statsquery->num_rows() == 0){
					$data = array(
						'FK_speler_id' => $id,
						'prestatie_laatste' => $prestatie,
						'prestatie_beste' =>$prestatie,
						'laatste_positie' => $positie
					
					);
					
					$this->db->insert('korf_spelerstats',$data);
				
				}else{
					foreach($statsquery->result() as $row){
						$beste = $row->prestatie_beste;
					}
						if($beste < $prestatie){
							$beste_final = $prestatie;
						}else{
							$beste_final = $beste;
						
						} 
					
					 
					$data = array(
						'prestatie_laatste' => $prestatie,
						'prestatie_beste' => $beste_final,
						'laatste_positie' => $positie
					
					);
					$this->db->where('FK_speler_id',$id);
					$this->db->update('korf_spelerstats', $data); 
				
					
				}
				return $prestatie;
			}

		
		}

    
 }