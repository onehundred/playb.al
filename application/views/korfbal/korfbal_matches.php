<div>
<?php foreach($matches->result() as $row){ ?>
		<p><?php echo $row->thuisteam;?>-<?php echo $row->bezoekersteam;?>&nbsp;<?php $uitslag = $row->uitslag;
		if(isset($uitslag)){
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$uitslag;
		
		}else{ ?>
		
		
		&nbsp;<a href="../korfbal_teamorders/<?php echo $team_id; ?>">Geef nu je opstelling door.</a></p>
		
		
<?php

} } ?>


</div>