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