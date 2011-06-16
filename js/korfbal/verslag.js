var WIDTH;
var HEIGHT;
var g;
var intervalID;

var spelers = new Array();
var ball = new Array();
var tegenstanders = new Array(); 



// Main Function To Start
function start(id)
{
	//alert(id);
	g = $('#canvas')[0].getContext("2d");
	
	WIDTH = $("#canvas").width();
	HEIGHT = $("#canvas").height();
	
	
    
	spelers[0] = new Speler1((WIDTH/2)-40,HEIGHT/2,10,"#0D0","1","thuis");
	spelers[1] = new Speler1((WIDTH/100)*30,(HEIGHT/100)*18,10, "#0D0","2","thuis");
	spelers[2] = new Speler1((WIDTH/100)*24,(HEIGHT/100)*85,10,"#0D0","3","thuis");
	spelers[3] = new Speler1((WIDTH/100)*5,(HEIGHT/100)*50, 10, "#0D0","4","thuis");
	spelers[4] = new Speler1((WIDTH/2)+40,HEIGHT/2,10,"#0D0","5","thuis");
	spelers[5] = new Speler1((WIDTH/100)*73,(HEIGHT/100)*18,10,"#0D0","6","thuis");
	spelers[6] = new Speler1((WIDTH/100)*79,(HEIGHT/100)*85,10,"#0D0","7","thuis");
	spelers[7] = new Speler1((WIDTH/100)*90,(HEIGHT/100)*50,10,"#FD0","8","thuis");
	
	
	tegenstanders[0] = new Speler1((WIDTH/2)-70,HEIGHT/2,10,"#FD0","9","uit");
	tegenstanders[1] = new Speler1((WIDTH/100)*27,(HEIGHT/100)*18,10, "#FD0","10","uit");
	tegenstanders[2] = new Speler1((WIDTH/100)*21,(HEIGHT/100)*85,10,"#FD0","11","uit");
	tegenstanders[3] = new Speler1((WIDTH/100)*8,(HEIGHT/100)*50, 10, "#FD0","12","uit");
	tegenstanders[4] = new Speler1((WIDTH/2)+15,HEIGHT/2,10,"#FD0","13","uit");
	tegenstanders[5] = new Speler1((WIDTH/100)*70,(HEIGHT/100)*18,10,"#FD0","14","uit");
	tegenstanders[6] = new Speler1((WIDTH/100)*76,(HEIGHT/100)*85,10,"#FD0","15","uit");
	tegenstanders[7] = new Speler1((WIDTH/100)*93,(HEIGHT/100)*50,10,"#0D0","16","uit");
	
	ball[0] = new Ball(380, 200, 5, "#000");

	if(id === '0'){
		draw();
	}	
	if(id === '1'){
		intervalID = setInterval(actie6, 10);
		return intervalID;	}
	if(id === '2'){
		intervalID = setInterval(actie6, 10);
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
		g.fillStyle = "#FFF";
		g.font = '18px LeagueGothicRegular';
		g.fillText( this.naam,this.x + 10, this.y + 21);
		
		
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
						$().toastmessage('showNoticeToast', 'Speler met nummer'+naam+' maakt een mooie inloper!');
						//alert("Speler met nummer"+naam+" maakt een mooie inloper");
						$('#links').unblock();
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
		$().toastmessage('showNoticeToast', 'Speler met nummer'+naam+' maakt een mooie inloper!');
		$('#links').unblock();
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
		$().toastmessage('showNoticeToast', 'Speler met nummer '+naam+' trekt weg onder de paal. Goal!');
		$('#links').unblock();
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
		$().toastmessage('showNoticeToast', 'Ver shot van speler met nummer '+naam+'. Goal!');
		$('#links').unblock();
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
		$().toastmessage('showNoticeToast', 'Ver shot van speler met nummer '+naam+'. Goal!');
		$('#links').unblock();
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
		$().toastmessage('showNoticeToast', 'Speler met nummer'+naam+' maakt een prachtige inloper!');
		$('#links').unblock();
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
        			
        			for(var i in minuten)
        			{
        				if(acties[i] === '1'){
        					$('#links').append('<p id="1" class="actie" style="text-decoration:underline; cursor:pointer;">In minuut '+minuten[i]+' scoort: '+spelers[i]+' de '+tussenstand[i]+'</p>')
        				
        				}
        				if(acties[i] === '2'){
        					$('#links').append('<p id="2" class="actie" style="text-decoration:underline; cursor:pointer;">In minuut '+minuten[i]+' scoort: '+spelers[i]+' de '+tussenstand[i]+'</p>')
        				
        				}
        			}
        			
        			//teamnamen appenden
        			
        			$('#naam_thuisteam').append(get_teamnaam(verslag['thuisteamid']));
        			$('#naam_uitteam').append(get_teamnaam(verslag['uitteamid']));
        			
 					//thuisteam
 					$('#thuisteam #rebound1 #speler').append(get_spelernaam(opst_thuisteam[0],verslag['thuisteamid']));
 					$('#thuisteam #rebound1 #prestatie').append(aantal_ballen(prest_thuisteam[0])); 
 					
 					$('#thuisteam #playmaking1 #speler').append(get_spelernaam(opst_thuisteam[1],verslag['thuisteamid']));
 					$('#thuisteam #playmaking1 #prestatie').append(aantal_ballen(prest_thuisteam[1]));
 					
 					$('#thuisteam #attack1 #speler').append(get_spelernaam(opst_thuisteam[2],verslag['thuisteamid']));
 					$('#thuisteam #attack1 #prestatie').append(aantal_ballen(prest_thuisteam[2]));
 					
 					$('#thuisteam #attack2 #speler').append(get_spelernaam(opst_thuisteam[3],verslag['thuisteamid']));
 					$('#thuisteam #attack2 #prestatie').append(aantal_ballen(prest_thuisteam[3]));
 					
 					$('#thuisteam #rebound2 #speler').append(get_spelernaam(opst_thuisteam[4],verslag['thuisteamid']));
 					$('#thuisteam #rebound2 #prestatie').append(aantal_ballen(prest_thuisteam[4]));
 					
 					$('#thuisteam #playmaking2 #speler').append(get_spelernaam(opst_thuisteam[5],verslag['thuisteamid']));
 					$('#thuisteam #playmaking2 #prestatie').append(aantal_ballen(prest_thuisteam[5]));
 					
 					$('#thuisteam #attack3 #speler').append(get_spelernaam(opst_thuisteam[6],verslag['thuisteamid']));
 					$('#thuisteam #attack3 #prestatie').append(aantal_ballen(prest_thuisteam[6]));
 					
 					$('#thuisteam #attack4 #speler').append(get_spelernaam(opst_thuisteam[7],verslag['thuisteamid']));
 					$('#thuisteam #attack4 #prestatie').append(aantal_ballen(prest_thuisteam[7]));
 					
 					//uitteam
 					$('#uitteam #rebound1 #speler').append(get_spelernaam(opst_uitteam[0],verslag['uitteamid']));
 					$('#uitteam #rebound1 #prestatie').append(aantal_ballen(prest_uitteam[0])); 
 				
 					$('#uitteam #playmaking1 #speler').append(get_spelernaam(opst_uitteam[1],verslag['uitteamid']));
 					$('#uitteam #playmaking1 #prestatie').append(aantal_ballen(prest_uitteam[1]));
 					
 					$('#uitteam #attack1 #speler').append(get_spelernaam(opst_uitteam[2],verslag['uitteamid']));
 					$('#uitteam #attack1 #prestatie').append(aantal_ballen(prest_uitteam[2]));
 					
 					$('#uitteam #attack2 #speler').append(get_spelernaam(opst_uitteam[3],verslag['uitteamid']));
 					$('#uitteam #attack2 #prestatie').append(aantal_ballen(prest_uitteam[3]));
 					
 					$('#uitteam #rebound2 #speler').append(get_spelernaam(opst_uitteam[4],verslag['uitteamid']));
 					$('#uitteam #rebound2 #prestatie').append(aantal_ballen(prest_uitteam[4]));
 					
 					$('#uitteam #playmaking2 #speler').append(get_spelernaam(opst_uitteam[5],verslag['uitteamid']));
 					$('#uitteam #playmaking2 #prestatie').append(aantal_ballen(prest_uitteam[5]));
 					
 					$('#uitteam #attack3 #speler').append(get_spelernaam(opst_uitteam[6],verslag['uitteamid']));
 					$('#uitteam #attack3 #prestatie').append(aantal_ballen(prest_uitteam[6]));
 					
 					$('#uitteam #attack4 #speler').append(get_spelernaam(opst_uitteam[7],verslag['uitteamid']));
 					$('#uitteam #attack4 #prestatie').append(aantal_ballen(prest_uitteam[7]));
     		
        		
        		}
        		
        		});
        		
        		
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
        		async:false //asynchronous om da variablen van een ajax call global te kunnen maken
        		
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
	
	
	//clicken om een actie te bekijken
	$(".actie").live('click', function(){
		$('#links').block({ 
                message: '<h4>Even wachten tot de animatie is afgelopen</h4>', 
                css: { border: '1px solid #000' } 
            }); 
		var id = $(this).attr('id');
		start(id);
	});
});
