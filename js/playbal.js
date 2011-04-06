// playb.al
/////////////////////////////////////////////////////////////////
// ZWART WIT NAAR KLEUR begin
/////////////////////////////////////////////////////////////////
	// dient om images niet te laten flashen, werkt niet
	$(window).load(function(){
		
		// images infaden voor flash te vermijden, werkt niet
		$('#korfbalbg, #basketbalbg, #volleybalbg').fadeIn(500);
		
		// clone image
		$('#korfbalbg, #basketbalbg, #volleybalbg').each(function(){
			var el = $(this);
			el.css({"position":"absolute"}).wrap("<div class='img_wrapper' style='display: inline-block'>").clone().addClass('img_grayscale').css({"position":"absolute","z-index":"2","opacity":"0"}).insertBefore(el).queue(function(){
				var el = $(this);
				el.parent().css({"width":this.width,"height":this.height});
				el.dequeue();
			});
			this.src = grayscale(this.src);
		});
		
		// Fade image 
		$('#korfbalbg, #basketbalbg, #volleybalbg').mouseover(function(){
			$(this).parent().find('img:first').stop().animate({opacity:1}, 100);
		})

		$('.img_grayscale').mouseout(function(){
			$(this).stop().animate({opacity:0}, 1600);
		});		
	});
	
	// z-w canvas methode
	function grayscale(src){
		var canvas = document.createElement('canvas');
		var ctx = canvas.getContext('2d');
		var imgObj = new Image();
		imgObj.src = src;
		canvas.width = imgObj.width;
		canvas.height = imgObj.height; 
		ctx.drawImage(imgObj, 0, 0); 
		var imgPixels = ctx.getImageData(0, 0, canvas.width, canvas.height);
		for(var y = 0; y < imgPixels.height; y++){
			for(var x = 0; x < imgPixels.width; x++){
				var i = (y * 4) * imgPixels.width + x * 4;
				var avg = (imgPixels.data[i] + imgPixels.data[i + 1] + imgPixels.data[i + 2]) / 3;
				imgPixels.data[i] = avg; 
				imgPixels.data[i + 1] = avg; 
				imgPixels.data[i + 2] = avg;
			}
		}
		ctx.putImageData(imgPixels, 0, 0, 0, 0, imgPixels.width, imgPixels.height);
		return canvas.toDataURL();
    }	
/////////////////////////////////////////////////////////////////
// ZWART WIT NAAR KLEUR end
/////////////////////////////////////////////////////////////////
// HOMEPAGE ANIMATIONS begin
/////////////////////////////////////////////////////////////////
    $(function() {
    	$("#startKorfbal").click(function () {
			$('.korfbalAnimation').show(),
			$('.korfbalAnimation').css('transform', 'translate(0px, -135px) rotate(90deg) scale(0.6,0.6) skew(0deg)'),
			$('.korfbal').delay(200).animate({opacity: 0}, 1000, 'easeInBounce'),
			$('.volleybal, .basketbal, #login').delay(10).animate({opacity: 0}, 1, 'easeInBounce');
			$('.makeAccount').delay(1350).fadeIn(500);
			//setTimeout('window.location = "index.php/main/signup/"',1000);  
      		return true;
		});
	});
    $(function() {
    	$("#startBasketbal").click(function () {
			$('.basketbalAnimation').show(),
			$('.basketbalAnimation').css('transform', 'translate(0px, -135px) rotate(90deg) scale(0.6,0.6) skew(0deg)'),
			$('.basketbal').delay(200).animate({opacity: 0}, 1000, 'easeInBounce'),
			$('.korfbal, .volleybal, #login').delay(10).animate({opacity: 0}, 1, 'easeInBounce'),
	   		$('.makeAccount').delay(1350).fadeIn(500);
      			
			//setTimeout('window.location = "index.php/main/signup/"',1000);  
      		return true;
		});
	});
    $(function() {
    	$("#startVolleybal").click(function () {
			$('.volleybalAnimation').show(),
			$('.volleybalAnimation').css('transform', 'translate(0px, -135px) rotate(90deg) scale(0.6,0.6) skew(0deg)'),
			$('.volleybal').delay(200).animate({opacity: 0}, 1000, 'easeInBounce'),
			$('.korfbal, .basketbal, #login').delay(10).animate({opacity: 0}, 1, 'easeInBounce'),
	   		$('.makeAccount').delay(1350).fadeIn(500);
      		
			//setTimeout('window.location = "index.php/main/signup/"',1000);  
      		return true;
		});
	});
	$(function() {
    	$("#makeAccountClose").click(function () {
			$('.makeAccount').fadeOut(),
			$('.korfbalAnimation, .basketbalAnimation, .volleybalAnimation').hide(),

	   		$('.korfbal, .basketbal, .volleybal, #login').animate({opacity: 1}, 1, 'linear').show();
	   		      		
			//setTimeout('window.location = "index.php/main/signup/"',1000);  
      		return true;
		});
	});
	$(function() {
    	$("#closeLogin").click(function () {
			$('.login').fadeOut('fast'),
			$('.korfbalAnimation, .basketbalAnimation, .volleybalAnimation').hide(),

	   		$('.korfbal, .basketbal, .volleybal, #login, .players, .gameRight').animate({opacity: 1}, 1, 'linear').show();

		});
	});
	$(function() {
    	$("#closeProfile").click(function () {
			$('.profile').fadeOut('fast'),
	   		$('.korfbal, .basketbal, .volleybal, #login, .players, .gameRight, .sportnav').animate({opacity: 1}, 1, 'linear').show();


		});
	});
	$(function() {
    	$("#switchAccountToLogin").click(function () {
			$('.makeAccount').fadeOut('fast'),
			$('.login').animate({opacity: 1}, 1, 'linear').show();

		});
	});
/////////////////////////////////////////////////////////////////
// HOMEPAGE ANIMATIONS end
/////////////////////////////////////////////////////////////////
// LOGIN begin
/////////////////////////////////////////////////////////////////
$(function() {
    	$("#login").click(function () {
    	
		$('.korfbal, .basketbal, .volleybal').animate({opacity: 0}, 1, 'linear').hide();

	
	   	$('.login').show().animate({opacity: 1}, 1500, 'linear');	
		});
});
$(function() {
    	$("#profile").click(function () {
    	
		$('.korfbal, .basketbal, .volleybal, .players, .gameRight').animate({opacity: 0}, 1, 'linear').hide();		
	   	$('.profile').show().animate({opacity: 1}, 1500, 'linear');	
		});
});
/////////////////////////////////////////////////////////////////
// LOGIN  end
/////////////////////////////////////////////////////////////////
// TOUCHSWIPE begin
/////////////////////////////////////////////////////////////////		
		var IMG_WIDTH = 1138;
			var currentImg=0;
			var maxImages=4;
			var speed=500;
			
			var imgs;
				
			var swipeOptions=
			{
				triggerOnTouchEnd : true,	
				swipeStatus : swipeStatus,
				allowPageScroll:"vertical",
				threshold:200
			}
			
			$(function()
			{				
				imgs = $(".imgs");
				imgs.swipe( swipeOptions );
			});
		
				
			/**
			* Catch each phase of the swipe.
			* move : we drag the div.
			* cancel : we animate back to where we were
			* end : we animate to the next image
			*/			
			function swipeStatus(event, phase, direction, distance)
			{
				//If we are moving before swipe, and we are going Lor R in X mode, or U or D in Y mode then drag.
				if( phase=="move" && (direction=="left" || direction=="right") )
				{
					var duration=0;
					
					if (direction == "left")
						scrollImages((IMG_WIDTH * currentImg) + distance, duration);
					
					else if (direction == "right")
						scrollImages((IMG_WIDTH * currentImg) - distance, duration);
					
				}
				
				else if ( phase == "cancel")
				{
					scrollImages(IMG_WIDTH * currentImg, speed);
				}
				
				else if ( phase =="end" )
				{
					if (direction == "right")
						previousImage(),
						$active = $('.pagingGallery a.active').prev();
			
						
					else if (direction == "left")			
						nextImage(),
						$active = $('.pagingGallery a.active').next();
					if ( $active.length == 0) { //If pagingGallery reaches the end...
						$active = $('.pagingGallery a:last');
					}
					
			$(".pagingGallery a").removeClass('active'); //Remove all active class
		$active.addClass('active'); //Add active class (the $active is declared in the rotateSwitch function)
				}
			}
					
			
		
			function previousImage()
			{
				currentImg = Math.max(currentImg-1, 0);
				scrollImages( IMG_WIDTH * currentImg, speed);
			}

			function nextImage()
			{
				currentImg = Math.min(currentImg+1, maxImages-1);
				scrollImages( IMG_WIDTH * currentImg, speed);
			}
			
				
			/**
			* Manuallt update the position of the imgs on drag
			*/
			function scrollImages(distance, duration)
			{
				imgs.css("-webkit-transition-duration", (duration/1000).toFixed(1) + "s");
				
				//inverse the number we set in the css
				var value = (distance<0 ? "" : "-") + Math.abs(distance).toString();
				
				imgs.css("-webkit-transform", "translate3d("+value +"px,0px,0px)");
			}
/////////////////////////////////////////////////////////////////
// TOUCHSWIPE end
/////////////////////////////////////////////////////////////////
// IMAGE GALLERY begin
/////////////////////////////////////////////////////////////////
$(document).ready(function() {
	//Set Default State of each portfolio piece
	$(".pagingGallery").show();
	$(".pagingGallery a:first").addClass("active");
			 if ($(this).data('clicked')) {
        return false;
        }
	//Get size of images, how many there are, then determin the size of the image reel.
	var imageWidth = $(".galleryWrapper").width();
	var imageSum = $(".imgs img").size();
	var imageReelWidth = imageWidth * imageSum;
	
	//Adjust the image reel to its new size
	$(".imgs").css({'width' : imageReelWidth});
	
	//pagingGallery + Slider Function
	rotate = function(){	
		var triggerID = $active.attr("rel") - 1; //Get number of times to slide
		var imgsPosition = triggerID * imageWidth; //Determines the distance the image reel needs to slide
$('#galleryLeftHide, #galleryRightHide').fadeIn('fast').fadeOut(400);
		$(".pagingGallery a").removeClass('active'); //Remove all active class
		$active.addClass('active'); //Add active class (the $active is declared in the rotateSwitch function)
		
		

		
		//Slider Animation
			$(".imgs").animate({ 
			
			left: -imgsPosition,

			
		}, 400, 'linear' );

		$(".imgs").animate({opacity: 1}, 100, 'linear');
	};
	 
	
	//Rotation + Timing Event
	rotateSwitch = function(){		
		play = setInterval(function(){ //Set timer - this will repeat itself every 3 seconds
		
			$active = $('.pagingGallery a.active').next();
			if ( $active.length == 0) { //If pagingGallery reaches the end...
				$active = $('.pagingGallery a:first'); //go back to first
			}
			//rotate(); //Trigger the pagingGallery and slider function
		}, 7000); //Timer speed in milliseconds (3 seconds)
	};
	
	rotateSwitch(); //Run function on launch
	
	//On Hover
	$(".imgs a").hover(function() {
		clearInterval(play); //Stop the rotation
	}, function() {
		rotateSwitch(); //Resume rotation
	});	
	
	//On Click
	$(".pagingGallery a").click(function() {	
		$active = $(this); //Activate the clicked pagingGallery
		//Reset Timer
						

		clearInterval(play); //Stop the rotation
		rotate(); //Trigger rotation immediately
		rotateSwitch(); // Resume rotation
		return false; //Prevent browser jump to link anchor
	});	
	
});
     
  
/////////////////////////////////////////////////////////////////
// IMAGE GALLERY end
/////////////////////////////////////////////////////////////////
// PLAYER PROGRESS begin
/////////////////////////////////////////////////////////////////
$(function() {
	init();
	function init(){
				var teamid = $('#teamid').val();
				$('#chartCanvas1').empty();
				//alert(teamid);
				$.ajax({
    			type: "POST",
    			url: "http://playb.al/index.php/Json/korfbal_jsonPlayers",
    			data:  { teamid: teamid,
            			
            			
        				},
    			dataType: "json",
        		success: function(data){
        		var spelers = data;
        		
        		var reboundtotaal = 0;
        		var passingtotaal = 0;
        		var interceptingtotaal = 0;
        		var shotpowertotaal = 0;
        		var shotprecisiontotaal = 0;
        		var leadershiptotaal = 0;
        		var playmakingtotaal = 0;
        		var staminatotaal = 0;
        		
        		
        		for(var i in spelers){
	        		$( ".rebound"+spelers[i].spelerid).progressbar({
					value: spelers[i].rebound * 5
					});
					$( ".passing"+spelers[i].spelerid ).progressbar({
						value: spelers[i].passing * 5
					});
					$( ".intercepting"+spelers[i].spelerid ).progressbar({
						value: spelers[i].intercepting * 5
					});
					$( ".shotpower"+spelers[i].spelerid).progressbar({
						value: spelers[i].shotpower * 5
					});
					$( ".shotprecision"+spelers[i].spelerid).progressbar({
						value: spelers[i].shotprecision * 5
					});
					$( ".leadership"+spelers[i].spelerid ).progressbar({
						value: spelers[i].leadership * 5
					});
					$( ".playmaking"+spelers[i].spelerid ).progressbar({
						value: spelers[i].playmaking * 5
					});
					$( ".stamina"+spelers[i].spelerid ).progressbar({
						value: spelers[i].stamina * 5
					});
					
					
					//alert(spelers[i].rebound_tr);
					$( ".rebound_tr"+spelers[i].spelerid).progressbar({
					 value: spelers[i].rebound_tr / 10
					});
					$( ".passing_tr"+spelers[i].spelerid ).progressbar({
						value: spelers[i].passing_tr /10 
					});
					$( ".intercepting_tr"+spelers[i].spelerid ).progressbar({
						value: spelers[i].intercepting_tr / 10
					});
					$( ".shotpower_tr"+spelers[i].spelerid).progressbar({
						value: spelers[i].shotpower_tr  / 10
					});
					$( ".shotprecision_tr"+spelers[i].spelerid).progressbar({
						value: spelers[i].shotprecision_tr / 10
					});
					$( ".leadership_tr"+spelers[i].spelerid ).progressbar({
						value: spelers[i].leadership_tr / 10
					});
					$( ".playmaking_tr"+spelers[i].spelerid ).progressbar({
						value: spelers[i].playmaking_tr / 10
					});
					$( ".stamina_tr"+spelers[i].spelerid ).progressbar({
						value: spelers[i].stamina_tr / 10
					});

					
					reboundtotaal =+ spelers[i].rebound + reboundtotaal;	
					passingtotaal =+ spelers[i].passing + passingtotaal;
					interceptingtotaal =+ spelers[i].intercepting + interceptingtotaal;
					shotpowertotaal =+ spelers[i].shotpower + shotpowertotaal;
					shotprecisiontotaal =+ spelers[i].shotprecision + shotprecisiontotaal;
					leadershiptotaal =+ spelers[i].leadership + leadershiptotaal;
					playmakingtotaal =+ spelers[i].playmaking + playmakingtotaal;
					staminatotaal =+ spelers[i].stamina + staminatotaal;				//alert(spelersskills);
				}
/////////////////////////////////////////////////////////////////
// CHARTS TRAINING begin
/////////////////////////////////////////////////////////////////				
			 var chart1 = new AwesomeChart('chartCanvas1');
/*             chart1.title = "Worldwide browser market share: December 2010"; */
   			 chart1.chartType = "horizontal bars";
             chart1.data = [reboundtotaal,passingtotaal,interceptingtotaal,shotpowertotaal,shotprecisiontotaal, leadershiptotaal,playmakingtotaal, staminatotaal];
             chart1.labels = ['rebound','playmaking','shotpower','shotprecision','passing','stamina', 'intercepting', 'leidersvermogen'];
             chart1.colors = ['#CCC', '#336b80', '#df1f2e', '#945D59', '#93BBF4', '#F493B8'];
             chart1.randomColors = false;
             chart1.draw();   
/////////////////////////////////////////////////////////////////
// CHARTS TRAINING end
/////////////////////////////////////////////////////////////////							
        		
        		}
        		
  				});
		
				}


	$('#training').click(function(){
	
	var teamid = $('#teamid').val();
	$('#myModal p').remove();
	$('#myModal div').remove();
	//alert(teamid);
	
	
	$(".target option:selected").each(function () {
                var option = $(this).val();
                //alert(option);
                
                //stamina
                if(option === 'stamina'){
                	var url = "http://playb.al/index.php/training/train_stamina";
                	//alert('stamina');
                }
                //passing
                if(option === 'passing'){
                	var url = "http://playb.al/index.php/training/train_passing";
                }
                //shotpower
                if(option === 'shotpower'){
                	var url = "http://playb.al/index.php/training/train_shotpower";
                }
                //shotprecision
                if(option === 'shotprecision'){
                	var url = "http://playb.al/index.php/training/train_shotprecision";
                //alert('shotprecision');
                
                }
                //intercepting
                if(option === 'intercepting'){
                	var url = "http://playb.al/index.php/training/train_intercepting";
                //alert('intercepting');
                
                }
                //rebound
                if(option === 'rebound'){
                var url = "http://playb.al/index.php/training/train_rebound";
                //alert('rebound');
                
                }
                //playmaking
                if(option === 'playmaking'){
                var url = "http://playb.al/index.php/training/train_playmaking";
                //alert('playmaking');
                
                }
                
                
                 $.ajax({
	    			type: "POST",
	    			url: url,
	    			data: { teamid: teamid
	            			},
	        		dataType: "json",
	        		success: function(data){
	        		
	        		var spelers = data;
	        		
	        		if(data.energiecheck === false){
	        		$().toastmessage('showErrorToast', "U heeft te weinig energiepunten.");
	        		//alert('U hebt te weinig energiepunten');
	        		}
	        		else{
	        		
		        		for(var i in spelers){
		        			
		    				var progress = spelers[i].totaal / 10;
		    				//alert(progress);
		    				
		    				
		    				if(spelers[i].niveau){
		    					$('#myModal').append('<p>'+spelers[i].naam +' is gestegen naar niveau '+spelers[i].niveau+'</p>');
		        			$('#myModal').append('<div background-color=red; style=height:10px; id=progressbar'+i+'></div>');
		        			
		        			$( "#progressbar"+i ).progressbar({
								value: progress
							});

		    				
		    				}else{
		    				
		    				
		        			
		        			$('#myModal').append('<p>'+spelers[i].naam +' is '+spelers[i].gestegen+' punten gestegen. En heeft een totaal van '+ spelers[i].totaal+'</p>');
		        			$('#myModal').append('<div style=height:10px; id=progressbar'+i+'></div>');
		        			
		        			$( "#progressbar"+i ).progressbar({
								value: progress
							});
		        			
		        			
		        			//alert(spelers[i].naam + spelers[i].skill);
		   						    					 
	    					 
	    					 
	    					 }
	    					 
	    					 $('#myModal').reveal({
		        			
		        			 animation: 'fade',                   //fade, fadeAndPop, none
	    					 animationspeed: 300,                       //how fast animtions are
	    					 closeonbackgroundclick: true,              //if you click background will modal close?
	    					 dismissmodalclass: 'close-reveal-modal'    //the class of a button or element that will close an open modal
	    					 });

		        		}
	    			}
	    			}
	  				});
                

              });
	
	
	});
	
	
});
/////////////////////////////////////////////////////////////////
// PLAYER PROGRESS end
/////////////////////////////////////////////////////////////////