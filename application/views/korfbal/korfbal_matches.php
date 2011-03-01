<div class="players">
<?php for($i=1;$i<15;$i++){ ?>
		<p><?php echo $matches[$i]['thuis'];?>-<?php echo $matches[$i]['uit'];?>&nbsp;<?php $uitslag = $matches[$i]['uitslag'];
		if(isset($uitslag)){
			echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$uitslag;
		
		}else{ ?>
		
		
		&nbsp;<a href="../korfbal_teamorders/<?php echo $team_id; ?>">Geef nu je opstelling door.</a></p>
		
		
<?php

} } ?>


</div>
<div class="gameRight">test</div>