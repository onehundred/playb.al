<!doctype html>
<html>
  <head>
    <meta charset="UTF-8" />
    <title>Canvas Test</title>
    <link rel="stylesheet" href="<?php echo base_url();?>js/toastmessage/jquery.toastmessage.css"/>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script> 
	<script src="<?php echo base_url();?>js/toastmessage/jquery.toastmessage.js"></script>
	<script src="<?php echo base_url();?>js/jquery.blockUI.js"></script>
  </head>
<body>
  <section>
    <div>
        <canvas style="border: solid 1px #000;" id="canvas" width="800" height="400">
         This text is displayed if your browser 
         does not support HTML5 Canvas.
        </canvas>
    </div>
    <div id="links">
    <input type="hidden" id="wedstrijdid" value="<?php echo $this->uri->segment('4');?>"    
    </div>

<script>



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
	
	
    
	spelers[0] = new Speler1(390,200,10,"#0D0","1");
	spelers[1] = new Speler1(250,60,10, "#0D0","50");
	spelers[2] = new Speler1(190,340,10,"#0D0","80");
	spelers[3] = new Speler1(70,200, 10, "#0D0","43")
	
	tegenstanders[0] = new Speler1(360,200,10,"#FD0","2");
	tegenstanders[1] = new Speler1(220,60,10, "#FD0","3");
	tegenstanders[2] = new Speler1(160,340,10,"#FD0","5");
	tegenstanders[3] = new Speler1(40,200, 10, "#FD0","11");
	ball[0] = new Ball(380, 200, 5, "#000");
	ball[1] = new Ball(380, 200, 5, "#000");

	
	if(id === '1'){
		intervalID = setInterval(actie1, 10);
		return intervalID;	}
	if(id === '2'){
	intervalID = setInterval(actie2, 10);
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
		g.beginPath();
		g.fillStyle = this.color;
		g.arc(this.x, this.y, this.r, 0, Math.PI*2, true);
		g.closePath();
		g.fill();
	}
	
	this.getX = function()
	{
		return x;
	}
	
	this.getY = function()
	{
		return this.y;
	}
	
	//eerste actie ball//////////////////////////////////////////////////////
	this.dx_actie1 = -1;
	this.dy_actie1 = -1;
	this.move1 = function()
	{
		
		this.x += this.dx_actie1;
		this.y += this.dy_actie1;
	
		if(this.x <= 250)
		{
			this.dx_actie1 = -0.85;
			this.dy_actie1 = 1;
			
			spelers[0].move1_speler1();
			tegenstanders[0].move1_tegenstander1();
			
				if(this.y >= 195)
				{
					this.dx_actie1 = 0;
					this.dy_actie1 = 0;
					var naam = spelers[0].getNaam();
					$().toastmessage('showNoticeToast', 'Speler met nummer'+naam+' maakt een mooie inloper!');
					//alert("Speler met nummer"+naam+" maakt een mooie inloper");
					$('#links').unblock();
					clearInterval(intervalID);
					
				}
			}
	}
	
	//2de actie ball ////////////////////////////////////////////////
	this.dx_actie2 = -1;
	this.dy_actie2 = -1;
	this.move2 = function()
	{
		this.x += this.dx_actie2;
		this.y += this.dy_actie2;
		spelers[3].move2_speler4();
		tegenstanders[3].move2_tegenstander4();
		spelers[2].move2_speler3();
		tegenstanders[2].move2_tegenstander3();
		
		if(this.y <= 50)
		{
			this.dx_actie2 = -2;
			this.dy_actie2 = 0.3;
			
			
		}
		if(this.x <= 70){
				this.dx_actie2 = 0.4;
				this.dy_actie2 = 0.8;
				
			}
		if(this.y >= 220)
		{
			this.dx_actie2 = 0;
			this.dy_actie2 = 0;
			var naam = spelers[2].getNaam();
			$().toastmessage('showNoticeToast', 'Speler met nummer '+naam+' maakt een mooie inloper!');
			$('#links').unblock();
			clearInterval(intervalID);
			

				
				
		}	

	}

}


// speler Class	
function Speler1(x,y,r,color,naam)
{
	this.x = x;
	this.y = y;
	this.r = r;
	this.color = color;
	this.naam = naam;
	this.draw = function()
	{
		g.beginPath();
		g.fillStyle = this.color;
		g.arc(this.x, this.y, this.r, 0, Math.PI*2, true);
		g.closePath();
		g.fill();
		
		
	}
	
	this.text = function()
	{
		g.fillStyle = "#000";
		g.fillText( this.naam,this.x - 5, this.y + 2);
		
		
	}
	
	this.getNaam = function()
	{
		return naam;
	}
	
	this.getX = function()
	{
		return x;
	}
	
	this.getY = function()
	{
		return this.y;
	}
	
	//eerste actie////////////////////////////////////////////////////////////////////////////////////
	this.dx_move1_speler1 = -2;
	this.dy_move1_speler1 = 0;
	this.move1_speler1 = function()
	{	
		this.x += this.dx_move1_speler1;
		this.y += this.dy_move1_speler1;
	
		if(this.x <= 150 )
		{
			this.dx_move1_speler1 =0;
		}
		
		
	}
	this.dx_move1_tegenstander1 = -1;
	this.dy_move1_tegenstander1 = 0;
	this.move1_tegenstander1 = function()
	{
		
		this.x += this.dx_move1_tegenstander1;
		this.y += this.dy_move1_tegenstander1;
	
		if(this.x <= 150 )
		{
			this.dx_move1_tegenstander1 =0;
		}
		
	
	}
	
	
	//2de actie////////////////////////////////////////////////////
	this.dx_move2_speler4 = 0;
	this.dy_move2_speler4 = -2;
	this.move2_speler4 = function()
	{
		
		this.x += this.dx_move2_speler4;
		this.y += this.dy_move2_speler4;
	
		if(this.y <= 65  )
		{
			this.dx_move2_speler4 = 0;
			this.dy_move2_speler4 = 0;
			
		}
	}
	this.dx_move2_tegenstander4 = 0.5;
	this.dy_move2_tegenstander4 = -1;
	this.move2_tegenstander4 = function()
	{
		
		this.x += this.dx_move2_tegenstander4;
		this.y += this.dy_move2_tegenstander4;
	
		if(this.y <= 90  )
		{
			this.dx_move2_tegenstander4 = 0;
			this.dy_move2_tegenstander4 = 0;
			
		}
		
	
	}
	this.dx_move2_speler3 = -0.1;
	this.dy_move2_speler3 = -0.3;
	this.move2_speler3 = function()
	{
		
		this.x += this.dx_move2_speler3;
		this.y += this.dy_move2_speler3;
	
		if(this.y <= 220 )
		{
			this.dx_move2_speler3 = 0;
			this.dy_move2_speler3 = 0;
			
		}
	}
	this.dx_move2_tegenstander3 = -0.05;
	this.dy_move2_tegenstander3 = -0.27;
	this.move2_tegenstander3 = function()
	{
		
		this.x += this.dx_move2_tegenstander3;
		this.y += this.dy_move2_tegenstander3;
	
		if(this.y <= 240 )
		{
			this.dx_move2_tegenstander3 = 0;
			this.dy_move2_tegenstander3 = 0;
			
		}
	}

	



	
	

}





// teken speelveld
function draw()
{
	//speelveld
	g.fillStyle = "#fdc68c";
	g.fillRect (0,0,800,400);
	g.fill();
	
	//middenlijn
	g.beginPath();
    g.moveTo(400,0);
    g.lineTo(400,400);
    g.closePath();
    g.stroke();
    
    //paal
    g.beginPath();
    g.moveTo(110,200);
    g.lineTo(110, 140);
    g.lineTo(130, 140);
    g.lineTo(130, 150);
    g.lineTo(110, 150);
    g.lineTo(110, 200)
    g.closePath();
    g.stroke();
    g.fillStyle = "#fae769";
    g.fill();
    
    //middencirkel
    g.beginPath();
	g.arc(400, 200, 100, Math.PI*2, 0, true);
	g.closePath();
	g.stroke();
		
				
		
		//spelers[0].move();
		//tegenstanders[0].move();
		
}

function drawPlayers()
{
		spelers[0].draw();
		spelers[1].draw();
		spelers[2].draw();
		spelers[3].draw();
		
		tegenstanders[0].draw();
		tegenstanders[1].draw();
		tegenstanders[2].draw();
		tegenstanders[3].draw();
		
		spelers[0].text();
		spelers[1].text();
		spelers[2].text();
		spelers[3].text();
		
		tegenstanders[0].text();
		tegenstanders[1].text();
		tegenstanders[2].text();
		tegenstanders[3].text();

}

function actie1()
{
		clear();
		draw();
		drawPlayers();
				
		
		ball[0].draw();
		ball[0].move1();
}

function actie2()
{
	clear();
	draw();
	drawPlayers();
	
	ball[1].draw();
	ball[1].move2();

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
        			
        			for(var i in minuten)
        			{
        				if(acties[i] === '1'){
        					$('#links').append('<p id="1" class="actie" style="text-decoration:underline; cursor:pointer;">In minuut '+minuten[i]+' scoort: '+spelers[i]+' de '+tussenstand[i]+'</p>')
        				
        				}
        				if(acties[i] === '2'){
        					$('#links').append('<p id="2" class="actie" style="text-decoration:underline; cursor:pointer;">In minuut '+minuten[i]+' scoort: '+spelers[i]+' de '+tussenstand[i]+'</p>')
        				
        				}
        			}
        		
        		
        		}
        		
        		});


	
	$(".actie").live('click', function(){
		$('#links').block({ 
                message: '<h4>Even wachten tot de animatie is afgelopen</h4>', 
                css: { border: '1px solid #000' } 
            }); 
		var id = $(this).attr('id');
		start(id);
	});
});

</script>

  </section>
</body>
</html>