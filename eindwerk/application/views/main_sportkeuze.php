<div id="main_sportkeuze">
<h2>Korfbal</h2>
<p><?php if(isset($korfNaam)){
	echo anchor("korfbal/start/$korfId", $korfNaam);
}else{
	
	echo anchor('sportchoice/korfbal_signup','Create korfball team');


} ?></p>
<h2>Volleybal</h2>
<p><?php if(isset($volNaam)){
		echo $volNaam;
		echo $volId;

}else{
	echo anchor('sportchoice/volleybal_signup','Create volleyball team');
	


} ?></p>
<h2>Basketbal</h2>
<p><?php if(isset($basNaam)){
	
		echo $basNaam;
		echo $basId;

}else{
	echo anchor('sportchoice/basketbal_signup','Create basketball team');
	

} ?></p>


</div>
