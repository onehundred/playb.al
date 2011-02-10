<style>
	h1 { padding: .2em; margin: 0; }
	#players { float:left; width: 500px; margin-right: 2em; }
	#catalog li {width: 100px; margin-top: 15px; background-color: gray; list-style: none;}
	#rebound1, #playmaking1, #attack1, #attack2 { width: 100px; height: 100px; float: left; margin-left: 10px; }
	/* style the list to maximize the droppable hitarea */
	#rebound1 ul, #attack1 ul, #attack2 ul, #playmaking1 ul { margin: 0; height: 40px; padding-left: 4px; list-style: none; }
	
	
		#rebound2, #playmaking2, #attack3, #attack4 { width: 100px; height: 100px; float: left; margin-left: 10px; }
	/* style the list to maximize the droppable hitarea */
	#rebound2 ul, #attack4 ul, #attack3 ul, #playmaking2 ul { margin: 0; height: 40px; padding-left: 4px; list-style: none; }
	
	#captain, #setpieces{ width: 100px; height: 100px; float: left; margin-left: 10px; }
	/* style the list to maximize the droppable hitarea */
	#captain ul, #setpieces ul { margin: 0; height: 40px; padding-left: 4px; list-style: none; }
	#vak2 {width: 500px; float:right; margin-right: 300px; margin-top: 25px;}
	#vak1 {width: 500px; float:right; margin-right: 300px; margin-top: 25px;}
	#general {width: 500px; float:right; margin-right: 300px; margin-top: 25px; margin-bottom: 25px;}
	</style>

<div class="demo">
	
<div id="players">
	<h1>Korfbal</h1>	
	<div id="catalog">
		<h3><a href="#">Players</a></h3>
		<div>
			<ul>
				<?php foreach($spelers->result() as $row){  ?>
				<li><?php echo $row->voornaam.' '.$row->achternaam; ?></li>
				
				
				
				<?php } ?>
			</ul>
		</div>
			</div>
</div>



<div id="vak1">
<h2>Vak1</h2>
<div id="rebound1">
	<h3>Rebound</h3>
	<div class="ui-widget-content">
		<ul>
			<li class="placeholder">Add player</li>
		</ul>
	</div>
</div>

<div id="playmaking1">
	<h3>Playmaking</h3>
	<div class="ui-widget-content">
		<ul>
			<li class="placeholder">Add player</li>
		</ul>
	</div>
</div>

<div id="attack1">
	<h3>Attack 1</h3>
	<div class="ui-widget-content">
		<ul>
			<li class="placeholder">Add player</li>
		</ul>
	</div>
</div>

<div id="attack2">
	<h3>Attack2</h3>
	<div class="ui-widget-content">
		<ul>
			<li class="placeholder">Add player</li>
		</ul>
	</div>
</div>
</div>


<div id="vak2">
<h2>Vak2</h2>
<div id="rebound2">
	<h3>Rebound</h3>
	<div class="ui-widget-content">
		<ul>
			<li class="placeholder">Add player</li>
		</ul>
	</div>
</div>

<div id="playmaking2">
	<h3>Playmaking</h3>
	<div class="ui-widget-content">
		<ul>
			<li class="placeholder">Add player</li>
		</ul>
	</div>
</div>

<div id="attack3">
	<h3>Attack 1</h3>
	<div class="ui-widget-content">
		<ul>
			<li class="placeholder">Add player</li>
		</ul>
	</div>
</div>

<div id="attack4">
	<h3>Attack2</h3>
	<div class="ui-widget-content">
		<ul>
			<li class="placeholder">Add player</li>
		</ul>
	</div>
</div>
</div>

<div id="general">
<h2>General</h2>
<div id="captain">
	<h3>Captain</h3>
	<div class="ui-widget-content">
		<ul>
			<li class="placeholder">Add player</li>
		</ul>
	</div>
</div>

<div id="setpieces">
	<h3>Set pieces</h3>
	<div class="ui-widget-content">
		<ul>
			<li class="placeholder">Add player</li>
		</ul>
	</div>
</div>

</div>
</div>

<input type="hidden" id="teamid" value="<?php echo $this->uri->segment('3');?>" />





</div><!-- End demo -->
<script src="<?php echo base_url();?>/js/korfbal_opstelling.js"></script>
<script src="<?php echo base_url();?>/js/toastmessage/jquery.toastmessage.js"></script>



