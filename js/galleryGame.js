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
				imgs = $(".imgsSmall");
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
						$active = $('.pagingGallerySmall a.active').prev();
			
						
					else if (direction == "left")			
						nextImage(),
						$active = $('.pagingGallerySmall a.active').next();
					if ( $active.length == 0) { //If pagingGallery reaches the end...
						$active = $('.pagingGallerySmall a:last');
					}
					
			$(".pagingGallerySmall a").removeClass('active'); //Remove all active class
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
	$(".pagingGallerySmall").show();
	$(".pagingGallerySmall a:first").addClass("active");
			 if ($(this).data('clicked')) {
        return false;
        }
	//Get size of images, how many there are, then determin the size of the image reel.
	var imageWidth = $(".galleryWrapperSmall").width();
	var imageSum = $(".imgsSmall img").size();
	var imageReelWidth = imageWidth * imageSum;
	
	//Adjust the image reel to its new size
	$(".imgsSmall").css({'width' : imageReelWidth});
	
	//pagingGallery + Slider Function
	rotate = function(){	
		var triggerID = $active.attr("rel") - 1; //Get number of times to slide
		var imgsPosition = triggerID * imageWidth; //Determines the distance the image reel needs to slide
		$(".pagingGallerySmall a").removeClass('active'); //Remove all active class
		$active.addClass('active'); //Add active class (the $active is declared in the rotateSwitch function)
		
		

		
		//Slider Animation
			$(".imgsSmall").animate({ 
			
			left: -imgsPosition,

			
		}, 400, 'linear' );

		$(".imgsSmall").animate({opacity: 1}, 100, 'linear');
	};
	 
	
	//Rotation + Timing Event
	rotateSwitch = function(){		
		play = setInterval(function(){ //Set timer - this will repeat itself every 3 seconds
		
			$active = $('.pagingGallerySmall a.active').next();
			if ( $active.length == 0) { //If pagingGallery reaches the end...
				$active = $('.pagingGallerySmall a:first'); //go back to first
			}
			//rotate(); //Trigger the pagingGallery and slider function
		}, 7000); //Timer speed in milliseconds (3 seconds)
	};
	
	rotateSwitch(); //Run function on launch
	
	//On Hover
	$(".imgsSmall a").hover(function() {
		clearInterval(play); //Stop the rotation
	}, function() {
		rotateSwitch(); //Resume rotation
	});	
	
	//On Click
	$(".pagingGallerySmall a").click(function() {	
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