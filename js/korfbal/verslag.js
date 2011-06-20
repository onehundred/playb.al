var WIDTH;
var HEIGHT;
var g;
var intervalID;

var spelers = new Array();
var ball = new Array();
var tegenstanders = new Array();

var status = 0; 



// Main Function To Start
function start(id,thuisteam,uitteam)
{
	//alert(id);
	g = $('#canvas')[0].getContext("2d");
	
	WIDTH = $("#canvas").width();
	HEIGHT = $("#canvas").height();
	
	
    
	spelers[0] = new Speler1((WIDTH/2)-40,HEIGHT/2,10,"#0D0",thuisteam,"thuis");
	spelers[1] = new Speler1((WIDTH/100)*30,(HEIGHT/100)*18,10, "#0D0",thuisteam,"thuis");
	spelers[2] = new Speler1((WIDTH/100)*24,(HEIGHT/100)*85,10,"#0D0",thuisteam,"thuis");
	spelers[3] = new Speler1((WIDTH/100)*5,(HEIGHT/100)*50, 10, "#0D0",thuisteam,"thuis");
	spelers[4] = new Speler1((WIDTH/2)+40,HEIGHT/2,10,"#0D0",thuisteam,"thuis");
	spelers[5] = new Speler1((WIDTH/100)*73,(HEIGHT/100)*18,10,"#0D0",thuisteam,"thuis");
	spelers[6] = new Speler1((WIDTH/100)*79,(HEIGHT/100)*85,10,"#0D0",thuisteam,"thuis");
	spelers[7] = new Speler1((WIDTH/100)*90,(HEIGHT/100)*50,10,"#FD0",thuisteam,"thuis");
	
	
	tegenstanders[0] = new Speler1((WIDTH/2)-70,HEIGHT/2,10,"#FD0",uitteam,"uit");
	tegenstanders[1] = new Speler1((WIDTH/100)*27,(HEIGHT/100)*18,10, "#FD0",uitteam,"uit");
	tegenstanders[2] = new Speler1((WIDTH/100)*21,(HEIGHT/100)*85,10,"#FD0",uitteam,"uit");
	tegenstanders[3] = new Speler1((WIDTH/100)*8,(HEIGHT/100)*50, 10, "#FD0",uitteam,"uit");
	tegenstanders[4] = new Speler1((WIDTH/2)+15,HEIGHT/2,10,"#FD0",uitteam,"uit");
	tegenstanders[5] = new Speler1((WIDTH/100)*70,(HEIGHT/100)*18,10,"#FD0",uitteam,"uit");
	tegenstanders[6] = new Speler1((WIDTH/100)*76,(HEIGHT/100)*85,10,"#FD0",uitteam,"uit");
	tegenstanders[7] = new Speler1((WIDTH/100)*93,(HEIGHT/100)*50,10,"#0D0",uitteam,"uit");
	
	ball[0] = new Ball(380, 200, 5, "#000");
	ball[1] = new Ball(420, 200, 5, "#000");
	
	if(id === '1'){
		intervalID = setInterval(actie1, 10);
		return intervalID;	}
	if(id === '2'){
		intervalID = setInterval(actie2, 10);
		return intervalID;
	}
	if(id === '3'){
		intervalID = setInterval(actie3, 10);
		return intervalID;
	}
	if(id === '4'){
		intervalID = setInterval(actie4, 10);
		return intervalID;
	}
	if(id === '5'){
		intervalID = setInterval(actie5, 10);
		return intervalID;
	}
	if(id === '6'){
		intervalID = setInterval(actie6, 10);
		return intervalID;
	}
	if(id === '9'){
		intervalID = setInterval(actie9, 10);
		return intervalID;
	}
	if(id === '10'){
		intervalID = setInterval(actie10, 10);
		return intervalID;
	}
	if(id === '11'){
		intervalID = setInterval(actie11, 10);
		return intervalID;
	}
	if(id === '12'){
		intervalID = setInterval(actie12, 10);
		return intervalID;
	}
	if(id === '13'){
		intervalID = setInterval(actie13, 10);
		return intervalID;
	}
}

//ball class
function Ball(x,y,r,color)
{
	this.x = x;
	this.y = y;
	this.r = r;
	this.color = color;
	
	this.draw = function()
	{
			var bal=new Image();
			bal.src="http://playb.al/img/gameball.png";
			g.drawImage(bal,this.x,this.y);
	}
	
	this.getX = function()
	{
		return this.x;
	}
	
	this.getY = function()
	{
		return this.y;
	}
	
	
	this.move = function(dx,dy){	
		this.x = beweeg_horizontaal(this.x, dx);
		this.y = beweeg_verticaal(this.y, dy);
	 }
}
//horizontaal bewegen over het canvas
function beweeg_horizontaal(x, dx){
	var verplaats = x + dx;	
	return verplaats;
}
//verticaal bewegen over het canvas
function beweeg_verticaal(y, dy){
	var verplaats = y + dy;	
	return verplaats;
}

// speler Class	
function Speler1(x,y,r,color,naam, team)
{
	this.x = x;
	this.y = y;
	this.r = r;
	this.color = color;
	this.naam = naam;
	this.draw = function()
	{
	
		if(team == "thuis"){
			var speler=new Image();
			speler.src="http://playb.al/img/player_ours.png";
			g.drawImage(speler,this.x,this.y);
		}else{
			var speler=new Image();
			speler.src="http://playb.al/img/player_theirs.png";
			g.drawImage(speler,this.x,this.y);
		
		}
	}
	
	this.text = function()
	{
		/*g.fillStyle = "#FFF";
		g.font = '12px LeagueGothicRegular';
		g.fillText( this.naam,this.x - 5, this.y + 40);*/
		
		
	}
	
	this.getNaam = function()
	{
		return naam;
	}
	
	this.move = function(dx, dy){
		this.x = beweeg_horizontaal(this.x, dx);
		this.y = beweeg_verticaal(this.y, dy);
	}
	
}





// teken speelveld
function draw()
{
	//speelveld
	var img=new Image();
	img.src="http://playb.al/img/field.png";
	g.drawImage(img,0,0);

}

function drawPlayers()
{
		spelers[0].draw();
		spelers[1].draw();
		spelers[2].draw();
		spelers[3].draw();
		spelers[4].draw();
		spelers[5].draw();
		spelers[6].draw();
		spelers[7].draw();
		
		tegenstanders[0].draw();
		tegenstanders[1].draw();
		tegenstanders[2].draw();
		tegenstanders[3].draw();
		tegenstanders[4].draw();
		tegenstanders[5].draw();
		tegenstanders[6].draw();
		tegenstanders[7].draw();
		
		spelers[0].text();
		spelers[1].text();
		spelers[2].text();
		spelers[3].text();
		spelers[4].text();
		spelers[5].text();
		spelers[6].text();
		spelers[7].text();
		
		tegenstanders[0].text();
		tegenstanders[1].text();
		tegenstanders[2].text();
		tegenstanders[3].text();
		tegenstanders[4].text();
		tegenstanders[5].text();
		tegenstanders[6].text();
		tegenstanders[7].text();

}
var i = 1;
function actie1()
{
		clear();
		draw();
		drawPlayers();
		ball[0].draw();
		
		ball[0].move(-1,-1)
	 	if(ball[0].getX() <= (WIDTH/100)*30)
		{
			spelers[0].move(-3, 0);
			tegenstanders[0].move(-2,0);
			
			ball[0].move(-0.1,3)
		}
		if(ball[0].getY() >= HEIGHT/2){
						ball[0].move(0,0)
						var naam = spelers[0].getNaam();
						$().toastmessage('showNoticeToast', naam+' maakt een mooie inloper!');
						//alert("Speler met nummer"+naam+" maakt een mooie inloper");
						$('#links').unblock();
						$('#replay').show();
						$('#stop_replay').show();
						clearInterval(intervalID);
						
		}
}

function actie2()
{	
	//alert(i);
	i++;
	clear();
	draw();
	drawPlayers();
	ball[0].draw();
		
	if(i < 180){
		tegenstanders[5].move(-0.8, 0);
		tegenstanders[6].move(-1, 0);
		spelers[5].move(-0.5, 0);
		spelers[6].move(-0.8, 0);
		
	}	
	if( i > 0 && i<149 ){
		ball[0].move(-1,1);
		}

	if(i >= 150 && i < 300){
		ball[0].move(-1.2, -1);
	}
	if(i >= 300 && i < 400){
		ball[0].move(2, -1);
	}
	if(i >= 450 && i < 600){
		ball[0].move(-1.2, 2);
	}
	if(i > 450 && i < 510){
		spelers[2].move(-0.5, -2);
		tegenstanders[2].move(-0.5, -1);
	}
	if(i > 520){
		ball[0].move(0, 0);
		var naam = spelers[2].getNaam();
		$().toastmessage('showNoticeToast', naam+' maakt een mooie inloper!');
		$('#links').unblock();
		$('#replay').show();
		$('#stop_replay').show();
		clearInterval(intervalID);
		i = 1;
	}
	//op het einde i terug resetten naar 1
}
function actie3(){
	i++;
	clear();
	draw();
	drawPlayers();
	ball[0].draw();
	
	if( i > 0 && i < 60){
		ball[0].move(-2, -2);
		spelers[3].move(1, 0);
		tegenstanders[3].move(1, 0.5);
	}
	if( i >= 150 && i < 200){
		ball[0].move(-3, 0.5);
	}
	
	if( i >= 70 && i < 180){
		
		spelers[3].move(0, -1);
	
	}
	if( i >= 200 && i < 285){
		ball[0].move(0.3, 1);
	}
	if( i > 285){
		ball[0].move(0, 0);
		var naam = spelers[3].getNaam();
		$().toastmessage('showNoticeToast', naam+' scoort door een wegtrekker onder de paal!');
		$('#links').unblock();
		$('#replay').show();
		$('#stop_replay').show();
		clearInterval(intervalID);
		i = 1;
	}

}

function actie4(){
	i++;
	clear();
	draw();
	drawPlayers();
	ball[0].draw();
		if(i < 180){
		tegenstanders[5].move(-0.8, 0);
		tegenstanders[6].move(-1, 0);
		spelers[5].move(-0.5, 0);
		spelers[6].move(-0.8, 0);
		
	}
	if( i > 0 && i < 60){
		ball[0].move(-2, -2);
		
	}
	if( i >= 60 && i< 100){
		ball[0].move(2, 2);
		spelers[0].move(-1, -1.3);
		tegenstanders[0].move(-2, -1);
	}
	if(i >= 110){
		ball[0].move(-3, 0.5);
	}
	
	if(i > 177){
		ball[0].move(0, 0);
		var naam = spelers[3].getNaam();
		$().toastmessage('showNoticeToast', naam+' doet een ver shot. Goal!');
		$('#links').unblock();
		$('#replay').show();
		$('#stop_replay').show();
		clearInterval(intervalID);
		i = 1;
	}
}

function actie5(){
	i++;
	clear();
	draw();
	drawPlayers();
	ball[0].draw();
	if( i > 0 && i < 60){
		ball[0].move(-2, -2);
		tegenstanders[2].move(0, -0.5);
		tegenstanders[1].move(0, 0.5);
	}
	if( i >= 70 && i< 200){
		ball[0].move(-0.5, 2);
	}
	if(i >= 200){
			ball[0].move(-0.8, -2);
	
	}
	if(i > 273){
		ball[0].move(0, 0);
		var naam = spelers[2].getNaam();
		$().toastmessage('showNoticeToast', naam+' doet een ver shot. Goal!');
		$('#links').unblock();
		$('#replay').show();
		$('#stop_replay').show();
		clearInterval(intervalID);
		i = 1;

	}

}

function actie6(){
	i++;
	clear();
	draw();
	drawPlayers();
	ball[0].draw();
	
	if( i > 0 && i < 80){
		ball[0].move(-2.4, 2);
		spelers[1].move(-2, 0);
		tegenstanders[2].move(0, -0.5);
		tegenstanders[1].move(-1.5, 0.5);
	}
	
	if(i >= 85 && i < 155){
		ball[0].move(-2.1, -2);
		spelers[0].move(-3, -0.5);
		tegenstanders[0].move(-2.5, -0.3);
	}
	if(i >= 160 && i < 220){
		ball[0].move(0.8, -2.2);
		
	}
	if(i >= 230 && i < 270){
		ball[0].move(1.5, 2);
		spelers[2].move(2, -1);
		tegenstanders[2].move(2, -1);
	}
	if(i >= 275 && i < 315){
		spelers[2].move(-3, -2);
		tegenstanders[2].move(-0.5, -0.5);
	}
	if(i >= 290 && i < 310){
		ball[0].move(0, 3);
	}

	if(i > 330){
		ball[0].move(0, 0);
		var naam = spelers[2].getNaam();
		$().toastmessage('showNoticeToast', naam+' maakt een prachtige inloper!');
		$('#links').unblock();
		$('#replay').show();
		$('#stop_replay').show();
		clearInterval(intervalID);
		i = 1;

	
	}


}

function actie9(){
	//alert(i);
	i++;
	clear();
	draw();
	drawPlayers();
	ball[1].draw();
		
	if(i < 180){
		tegenstanders[1].move(0.8, 0);
		tegenstanders[2].move(1, 0);
		spelers[1].move(0.5, 0);
		spelers[3].move(0.8, 0);
		
	}	
	if( i > 0 && i<149 ){
		ball[1].move(1,-0.8);
		}

	if(i >= 150 && i < 300){
		tegenstanders[7].move(0,0.1);
		ball[1].move(1.2, 1);
	}
	if(i >= 310 && i < 440){
		ball[1].move(-1, 1);
	}
	if(i >= 470 && i < 560){
		ball[1].move(0.4, -2);
	}
	if(i > 450 && i < 500){
		spelers[5].move(0.5, 0.5);
		tegenstanders[5].move(1.5, 2);
	}
	if(i > 580){
		ball[1].move(0, 0);
		var naam = tegenstanders[5].getNaam();
		$().toastmessage('showNoticeToast', naam+' maakt een prachtige inloper!');
		$('#links').unblock();
		$('#replay').show();
		$('#stop_replay').show();
		clearInterval(intervalID);
		i = 1;
	}
	//op het einde i terug resetten naar 1
}

function actie10(){
	i++;
	clear();
	draw();
	drawPlayers();
	ball[1].draw();
	
	if( i > 0 && i < 60){
		ball[1].move(2, 2);
		tegenstanders[6].move(-1.2, -0.5);
		tegenstanders[7].move(-1, -0);
		spelers[7].move(-1, -1);
	}
	if( i >= 150 && i < 200){
		ball[1].move(3, -0.5);
	}
	
	if( i >= 70 && i < 180){
		
		tegenstanders[7].move(0, 0.7);
	
	}
	if( i >= 200 && i < 295){
		ball[1].move(-0.1, -1);
	}
	if( i > 295){
		ball[1].move(0, 0);
		var naam = tegenstanders[7].getNaam();
		$().toastmessage('showNoticeToast', naam+' scoort door een wegtrekker onder de paal!');
		$('#links').unblock();
		$('#replay').show();
		$('#stop_replay').show();
		clearInterval(intervalID);
		i = 1;
	}

}

function actie11(){
	i++;
	clear();
	draw();
	drawPlayers();
	ball[1].draw();
		if(i < 180){
		spelers[1].move(0.5, 0);
		spelers[2].move(0.8, 0);
		tegenstanders[1].move(0.5, 0);
		tegenstanders[2].move(0.8, 0);
		
	}
	if( i > 0 && i < 100){
		ball[1].move(1.5, 1.5);
		tegenstanders[6].move(-0.5,0);
		
	}
	if( i >= 110 && i< 155){
		ball[1].move(-2, -2);
		tegenstanders[4].move(1, 1.3);
		spelers[4].move(2, 1);
	}
	if(i >= 170){
		ball[1].move(3, -0.9);
	}
	
	if(i > 236){
		ball[1].move(0, 0);
		var naam = tegenstanders[4].getNaam();
		$().toastmessage('showNoticeToast', naam+' doet een ver shot. Goal!');
		$('#links').unblock();
		$('#replay').show();
		$('#stop_replay').show();
		clearInterval(intervalID);
		i = 1;
	}
}

function actie12(){
	i++;
	clear();
	draw();
	drawPlayers();
	ball[1].draw();
	if( i > 0 && i < 60){
		ball[1].move(1.5, 1.5);
		spelers[6].move(-1, -0.5);
		spelers[5].move(0, 0.5);
		tegenstanders[6].move(-2, -1);
		tegenstanders[5].move(0, -1);
	}
	if( i >= 70 && i< 200){
		ball[1].move(0.5, -2);
	}
	if(i >= 210){
			ball[1].move(1.2, 2);
	
	}
	if(i > 295){
		ball[1].move(0, 0);
		var naam = tegenstanders[5].getNaam();
		$().toastmessage('showNoticeToast', naam+' doet een ver shot. Goal!');
		$('#links').unblock();
		$('#replay').show();
		$('#stop_replay').show();
		clearInterval(intervalID);
		i = 1;

	}
}
function actie13(){
	i++;
	clear();
	draw();
	drawPlayers();
	ball[1].draw();
	
	if( i > 0 && i < 80){
		ball[1].move(2.4, -2);
		tegenstanders[5].move(0.5, -0.5);
		spelers[6].move(0.2, 0);
		spelers[5].move(0.2, 0);
	}
	
	if(i >= 85 && i < 165){
		ball[1].move(2, 2);
		tegenstanders[4].move(3, 0.5);
		spelers[4].move(2.5, 0.3);
	}
	if(i >= 170 && i < 270){
		tegenstanders[6].move(-0.5, -0.5);
		ball[1].move(-2, 1);
		
	}
	if(i >= 280 && i < 345){
		ball[1].move(1.5, -1);
		tegenstanders[5].move(-2, 1);
		spelers[5].move(-2, 1);
	}
	if(i >= 355 && i < 400){
		tegenstanders[5].move(3.5, 2);
		spelers[5].move(0.5, 0.5);
	}
	if(i >= 400 && i < 415){
		ball[1].move(-1.5, -2.5);
	}

	if(i > 420){
		ball[1].move(0, 0);
		var naam = spelers[2].getNaam();
		$().toastmessage('showNoticeToast', naam+' maakt een prachtige inloper!');
		$('#links').unblock();
		$('#replay').show();
		$('#stop_replay').show();
		clearInterval(intervalID);
		i = 1;

	
	}

}
//elke keer moeten de circles terug verdwijnen van het canvas
function clear() 
{
	g.fillStyle = "#fff";
	g.fillRect(0, 0, WIDTH, HEIGHT);
}

// Use JQuery to wait for document load
$(document).ready(function()
{
	
	var wedstrijdid = $('#wedstrijdid').val();
	$('#loading').hide();
	$('#prestaties').hide();
	$('.gameLeft').hide();
	$('#terminating').hide();
	
	
	$('#loading').ajaxSuccess(function() {
  		$(this).hide();
  		$('#prestaties').show();
  		$('.gameLeft').show();
  		
	});
	
	$('#loading').ajaxStart(function() {
 	 $(this).show();
	});
			$.ajax({
    			type: "POST",
    			url: "http://playb.al/index.php/Json/korfbal_jsonReview",
    			data:  { wedstrijdid: wedstrijdid,
            			
            			
        				},
    			dataType: "json",
        		success: function(data){
        			append_replay();
        			var verslag = data;
        			//alert(verslag['acties']);
        			var minuten = verslag['minuten'].split(';');
        			var acties = verslag['acties'].split(';');
        			var spelers = verslag['spelers'].split(';');
        			var tussenstand = verslag['tussenstand'].split(';');
        			
        			
        			//prestaties van het thuisteam
        			var prest_thuisteam = verslag['prest_thuisteam'].split(';');
        			//prestaties van het uitteam
        			var prest_uitteam = verslag['prest_uitteam'].split(';');
        			
        			//opstelling van het thuisteam
        			var opst_thuisteam = verslag['opst_thuisteam'].split(';');
        			//opstelling van het uitteam
        			var opst_uitteam = verslag['opst_uitteam'].split(';');
        			//alert(verslag['thuisteamid']);
        			//alert(verslag['uitteamid']);
        			
        			
        			for(var i =0;i<minuten.length-1;i++)
        			{
        			
        			$('#links').append('<p id="'+acties[i]+'" class="actie entry" style="cursor:pointer;">In minuut '+minuten[i]+' scoort: '+spelers[i]+' de '+tussenstand[i]+'</p>');
        			}
        			
        			//teamnamen appenden
        			
        			var naam_thuisteam = get_teamnaam(verslag['thuisteamid']);
        			var naam_uitteam = get_teamnaam(verslag['uitteamid']) 
        			
        			$('#naam_thuisteam').append(naam_thuisteam);
        			$('#naam_uitteam').append(naam_uitteam);
        			
 					//thuisteam
 					$('#thuisteam #rebound1_verslag #speler').append(get_spelernaam(opst_thuisteam[0],verslag['thuisteamid']));
 					$('#thuisteam #rebound1_verslag #prestatie').append(aantal_ballen(prest_thuisteam[0])); 
 					
 					$('#thuisteam #playmaking1_verslag #speler').append(get_spelernaam(opst_thuisteam[1],verslag['thuisteamid']));
 					$('#thuisteam #playmaking1_verslag #prestatie').append(aantal_ballen(prest_thuisteam[1]));
 					
 					$('#thuisteam #attack1_verslag #speler').append(get_spelernaam(opst_thuisteam[2],verslag['thuisteamid']));
 					$('#thuisteam #attack1_verslag #prestatie').append(aantal_ballen(prest_thuisteam[2]));
 					
 					$('#thuisteam #attack2_verslag #speler').append(get_spelernaam(opst_thuisteam[3],verslag['thuisteamid']));
 					$('#thuisteam #attack2_verslag #prestatie').append(aantal_ballen(prest_thuisteam[3]));
 					
 					$('#thuisteam #rebound2_verslag #speler').append(get_spelernaam(opst_thuisteam[4],verslag['thuisteamid']));
 					$('#thuisteam #rebound2_verslag #prestatie').append(aantal_ballen(prest_thuisteam[4]));
 					
 					$('#thuisteam #playmaking2_verslag #speler').append(get_spelernaam(opst_thuisteam[5],verslag['thuisteamid']));
 					$('#thuisteam #playmaking2_verslag #prestatie').append(aantal_ballen(prest_thuisteam[5]));
 					
 					$('#thuisteam #attack3_verslag #speler').append(get_spelernaam(opst_thuisteam[6],verslag['thuisteamid']));
 					$('#thuisteam #attack3_verslag #prestatie').append(aantal_ballen(prest_thuisteam[6]));
 					
 					$('#thuisteam #attack4_verslag #speler').append(get_spelernaam(opst_thuisteam[7],verslag['thuisteamid']));
 					$('#thuisteam #attack4_verslag #prestatie').append(aantal_ballen(prest_thuisteam[7]));
 					
 					//uitteam
 					$('#uitteam #rebound1_verslag #speler').append(get_spelernaam(opst_uitteam[0],verslag['uitteamid']));
 					$('#uitteam #rebound1_verslag #prestatie').append(aantal_ballen(prest_uitteam[0])); 
 				
 					$('#uitteam #playmaking1_verslag #speler').append(get_spelernaam(opst_uitteam[1],verslag['uitteamid']));
 					$('#uitteam #playmaking1_verslag #prestatie').append(aantal_ballen(prest_uitteam[1]));
 					
 					$('#uitteam #attack1_verslag #speler').append(get_spelernaam(opst_uitteam[2],verslag['uitteamid']));
 					$('#uitteam #attack1 #prestatie').append(aantal_ballen(prest_uitteam[2]));
 					
 					$('#uitteam #attack2_verslag #speler').append(get_spelernaam(opst_uitteam[3],verslag['uitteamid']));
 					$('#uitteam #attack2_verslag #prestatie').append(aantal_ballen(prest_uitteam[3]));
 					
 					$('#uitteam #rebound2_verslag #speler').append(get_spelernaam(opst_uitteam[4],verslag['uitteamid']));
 					$('#uitteam #rebound2_verslag #prestatie').append(aantal_ballen(prest_uitteam[4]));
 					
 					$('#uitteam #playmaking2_verslag #speler').append(get_spelernaam(opst_uitteam[5],verslag['uitteamid']));
 					$('#uitteam #playmaking2_verslag #prestatie').append(aantal_ballen(prest_uitteam[5]));
 					
 					$('#uitteam #attack3_verslag #speler').append(get_spelernaam(opst_uitteam[6],verslag['uitteamid']));
 					$('#uitteam #attack3_verslag #prestatie').append(aantal_ballen(prest_uitteam[6]));
 					
 					$('#uitteam #attack4_verslag #speler').append(get_spelernaam(opst_uitteam[7],verslag['uitteamid']));
 					$('#uitteam #attack4_verslag #prestatie').append(aantal_ballen(prest_uitteam[7]));
     				
     				
     					//clicken om een actie te bekijken
					$(".actie").live('click', function(){
						$('#links').block({ 
				                message: '<h4>Even wachten tot de animatie is afgelopen</h4>', 
				                css: { border: '1px solid #000' } 
				            }); 
				        $('#replay').hide();
				        $('#stop_replay').hide();
						var id = $(this).attr('id');
						start(id,naam_thuisteam, naam_uitteam);
					});
					
					
					var infLoopStop=true;
					var infLoop=null;
					var show_things = null;
					var j=0;
					
					$('#replay a').live('click', function(){
						$('#replay a').hide();
						$('#replay a').remove();
						$('#links').hide();
					
						infLoopStop = false;
						infLoop();
					});			
					
					
					$('#stop_replay').click(function(){
						infLoopStop=true;
						infLoop();
						j=0;
					});
					
					//na 7 seconden terug laten zien
					show_things = function(){
						$('#terminating').hide();
						$('#links').show();
						$('#tussenstand p').remove();
						append_replay();
					}
					
					//infinite loop
					infLoop=function(){
							
					 		if(j == minuten.length-1){
								infLoopStop=true;
								j=0;
							}
							if(infLoopStop == false){
								start(acties[j],naam_thuisteam, naam_uitteam);
								$('#tussenstand').append('<p class="tussenstand">'+tussenstand[j]+'</p>');
								window.setTimeout(infLoop,8000);
								j++;
							}
							if(infLoopStop == true){
								$('#terminating').show();
								window.setTimeout(show_things,8000);
								infLoopStop = null;
							}

								 
					};
					
				
					
					
					
        		
        		}
        		
        		});
        		
     function append_replay(){
     	$('#replay').append('<a class="question" href="#">volledige replay</a>');
     }	
     //functie die de namen van de ploegen gaat ophalen   		
	function get_teamnaam(teamid){
		var teamnaam = ''; 
		 $.ajax({
    			type: "POST",
    			url: "http://playb.al/index.php/Json/korfbal_jsonTeamNaam",
    			data:  { teamid: teamid,
            			
            			
        				},
    			dataType: "json",
        		success: function(data){
        			teamnaam = data.teamnaam;
        			
        			
        		},
        		async:false //asynchronous om da variablen van een ajax call global te kunnen maken
        		
			});

		return teamnaam;
	
	
	}
	//functie die de naam van de speler gaat halen 
	
	function get_spelernaam(id, teamid){
		var groepid = $('#teamid').val();
		//alert(teamid);
		if(id == 0){
			return "lege plek";
		}else{
				var voornaam;
				var achternaam;
			  $.ajax({
    			type: "POST",
    			url: "http://playb.al/index.php/Json/korfbal_jsonSpelerNaam",
    			data:  { spelerid: id,
            			
            			
        				},
    			dataType: "json",
        		success: function(data){
        			voornaam =  data.voornaam;
        			achternaam = data.achternaam;
        			
        			
        		},
        		async:false //async:false om da variablen van een ajax call global te kunnen maken
        		
			});
			//alert(voornaam);
			
			if(groepid == teamid){
				return '<a href="http://playb.al/index.php/korfbal/korfbal_player/'+teamid+'/'+id+'">'+voornaam+' '+ achternaam+'</a>';
			}else{
				return '<a href="http://playb.al/index.php/korfbal_other_team/korfbal_player/'+teamid+'/'+id+'">'+voornaam+' '+ achternaam+'</a>';
			
			}
						
		
		}
	}
	//functie die het aantal bal images teruggeeft
	function aantal_ballen(prestatie){
		if(prestatie>=0 && prestatie<10){
				return  'Slechte prestatie';
			}
		if(prestatie>=10 && prestatie<20){
				return  '<img style="width:25px; height:25px;" src="http://playb.al/img/korfbal.png"/>';
			}
			
		if(prestatie>=20 && prestatie<30){
				return  '<img style="width:25px; height:25px;" src="http://playb.al/img/korfbal.png"/><img style="width:25px; height:25px;" src="http://playb.al/img/korfbal.png"/>';
			}
		
		if(prestatie>=30 && prestatie<40){
				return  '<img style="width:25px; height:25px;" src="http://playb.al/img/korfbal.png"/><img style="width:25px; height:25px;" src="http://playb.al/img/korfbal.png"/><img style="width:25px; height:25px;" src="http://playb.al/img/korfbal.png"/>';
			}
		
		if(prestatie>=40 && prestatie<50){
				return  '<img style="width:25px; height:25px;" src="http://playb.al/img/korfbal.png"/><img style="width:25px; height:25px;" src="http://playb.al/img/korfbal.png"/><img style="width:25px; height:25px;" src="http://playb.al/img/korfbal.png"/><img style="width:25px; height:25px;" src="http://playb.al/img/korfbal.png"/>';
			}	
			
		if(prestatie>=50 && prestatie<60){
				return  '<img style="width:25px; height:25px;" src="http://playb.al/img/korfbal.png"/><img style="width:25px; height:25px;" src="http://playb.al/img/korfbal.png"/><img style="width:25px; height:25px;" src="http://playb.al/img/korfbal.png"/><img style="width:25px; height:25px;" src="http://playb.al/img/korfbal.png"/><img style="width:25px; height:25px;" src="http://playb.al/img/korfbal.png"/>';
			}
			
		if(prestatie>=60 && prestatie<70){
				return  '<img style="width:25px; height:25px;" src="http://playb.al/img/korfbal.png"/><img style="width:25px; height:25px;" src="http://playb.al/img/korfbal.png"/><img style="width:25px; height:25px;" src="http://playb.al/img/korfbal.png"/><img style="width:25px; height:25px;" src="http://playb.al/img/korfbal.png"/><img style="width:25px; height:25px;" src="http://playb.al/img/korfbal.png"/><img style="width:25px; height:25px;" src="http://playb.al/img/korfbal.png"/>';
			}	
			
			
		if(prestatie>=70 && prestatie<80){
				return  '<img style="width:25px; height:25px;" src="http://playb.al/img/korfbal.png"/><img style="width:25px; height:25px;" src="http://playb.al/img/korfbal.png"/><img style="width:25px; height:25px;" src="http://playb.al/img/korfbal.png"/><img style="width:25px; height:25px;" src="http://playb.al/img/korfbal.png"/><img style="width:25px; height:25px;" src="http://playb.al/img/korfbal.png"/><img style="width:25px; height:25px;" src="http://playb.al/img/korfbal.png"/><img style="width:25px; height:25px;" src="http://playb.al/img/korfbal.png"/>';
			}		
			
		//nog verder aan te vullen			
			
				
	}
	
	

});
