<div id="main_sportkeuze">
<h2>Korfbal</h2>
<p><?php if(isset($korfNaam)){
	echo anchor("korfbal/start/$korfId", $korfNaam);
}else{
	
	echo anchor('sportkeuze/korfbal_signup','Create korfball team');


} ?></p>
<h2>Volleybal</h2>
<p><?php if(isset($volNaam)){
		echo $volNaam;
		echo $volId;

}else{
	echo anchor('sportkeuze/volleybal_signup','Create volleyball team');
	


} ?></p>
<h2>Basketbal</h2>
<p><?php if(isset($basNaam)){
	
		echo $basNaam;
		echo $basId;

}else{
	echo anchor('sportkeuze/basketbal_signup','Create basketball team');
	

} ?></p>


</div>
