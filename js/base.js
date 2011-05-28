// playb.al


$(document).ready(function() {
$('#wrap').fadeIn(5000);

});
//mediaqueries begin 
/**
 * @author alexander.farkas
 * @version 1.2
 */
(function($){
    $.testMedia = function(str){
        var date = new Date().getTime(), styleS, div = $('<div class="testMediaQuery' + date + '"></div>').css({
            visibility: 'hidden',
            position: 'absolute'
        }).appendTo('body'), style = document.createElement('style');
        style.setAttribute('type', 'text/css');
    	style.setAttribute('media', str);
        style = $(style).prependTo('head');
        styleS = document.styleSheets[0];
        if (styleS.cssRules || styleS.rules) {
            if (styleS.insertRule) {
                styleS.insertRule('.testMediaQuery' + date + ' {display:none !important;}', styleS.cssRules.length);
            } else if (styleS.addRule) {
                styleS.addRule('.testMediaQuery' + date, 'display:none');
            }
        }
        var ret = div.css('display') === 'none';
        div.remove();
        style.remove();
        return ret;
    };
    $.arrayInString = function(str, arr){
        var ret = -1;
        $.each(arr, function(i, item){
			if (str.indexOf(item) != -1) {
                ret = i;
                return false;
            }
        });
        return ret;
    };
    $.enableMediaQuery = (function(){
        var styles = [], styleLinks, date = new Date().getTime();
        function parseMedia(link){
            var medias = link.getAttribute('media'), 
				pMin = /\(\s*min-width\s*:\s*(\d+)px\s*\)/, 
				pMax = /\(\s*max-width\s*:\s*(\d+)px\s*\)/, 
				resMin, 
				resMax, 
				supportedMedia = ['handheld', 'all', 'screen', 'projection', 'tty', 'tv', 'print'], 
				curMedia, 
	            mediaString = [];
	            medias = (!medias) ? ['all'] : medias.split(',');
			
            for (var i = 0, len = medias.length; i < len; i++) {
				curMedia = $.arrayInString(medias[i], supportedMedia);
				
                if (curMedia != -1) {
					
                    curMedia = supportedMedia[curMedia];
                    if (!resMin) {
                        resMin = pMin.exec(medias[i]);
                        if (resMin) {
                            resMin = parseInt(resMin[1], 10);
                        }
                    }
                    if (!resMax) {
                        resMax = pMax.exec(medias[i]);
                        if (resMax) {
                            resMax = parseInt(resMax[1], 10);
                        }
                    }
                    mediaString.push(curMedia);
                }
            }
			if (resMin || resMax) {
				styles.push({
					obj: link,
					min: resMin,
					max: resMax,
					medium: mediaString.join(','),
					used: false
				});
			}
        }
        return {
            init: function(){
                if (!styleLinks) {
					var resizeTimer;
                    styleLinks = $('link[rel*=style]').each(function(){
                        parseMedia(this);
                    });
                    $.enableMediaQuery.adjust();
                    $(window).bind('resize.mediaQueries', function(){
						clearTimeout(resizeTimer);
						resizeTimer = setTimeout( $.enableMediaQuery.adjust , 29);
					});
                }
            },
            adjust: function(){
                var width 		= $(window).width(),
					addStyles	= [],
					changeQuery,
					shouldUse,
					i, len
				;
				
                for (i = 0, len = styles.length; i < len; i++) {
					shouldUse = !styles[i].obj.disabled && ((!(styles[i].min && styles[i].min > width) && !(styles[i].max && styles[i].max < width)) || (!styles[i].max && !styles[i].min));
                    if ( shouldUse ) {
                        var n = styles[i].obj.cloneNode(true);
                        n.setAttribute('media', styles[i].medium);
                        n.className = 'insertStyleforMedia' + date;
						addStyles.push(n);
						if( !styles[i].used ){
							styles[i].used = true;
							changeQuery = true;
						}
                    } else if( styles[i].used !== shouldUse ){
						styles[i].used = false;
						changeQuery = true;
					}
                }
				
				if(changeQuery){
					$('link.insertStyleforMedia' + date).remove();
					var head = document.getElementsByTagName('head');
					for(i = 0, len = addStyles.length; i < len; i++){
						head[0].appendChild(addStyles[i]);
					}
					//repaint
					$('body').css('zoom', '1').css('zoom', '');
				}
            }
        };
    })();
	//make some odd assumption before dom-ready
	$.support.mediaQueries = !( $.browser.msie && parseFloat($.browser.version, 10) < 9) || ($.browser.mozilla && parseFloat($.browser.version, 10) < 1.9 );
    setTimeout(function(){
		if (!$.isReady && document.body && !$.support.mediaQueries) {
	        try {
				$.enableMediaQuery.init();
	        } catch (e) {}
	    } 
	}, 1);
    $(function(){
		//test media query compatibility
		$.support.mediaQueries = $.testMedia('only all');
		if (!$.support.mediaQueries) {
            $.enableMediaQuery.init();
        }
    });
})(jQuery);

/////////////////////////////////////////////////////////////////
// ZWART WIT NAAR KLEUR begin
/////////////////////////////////////////////////////////////////
	$(window).load(function(){
		
		// images infaden voor flash te vermijden
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
			$('.korfbalAnimation').show();
			$('.korfbalAnimation').css('transform', 'translate(0px, -135px) rotate(90deg) scale(0.6,0.6) skew(0deg)');
			$('.korfbal').delay(200).animate({opacity: 0}, 1000, 'easeInBounce');
			$('.volleybal, .basketbal, #login').delay(10).animate({opacity: 0}, 1, 'easeInBounce');
			$('.makeAccount').delay(1350).fadeIn(500);
			//setTimeout('window.location = "index.php/main/signup/"',1000);  
      		return true;
		});
	});
    $(function() {
    	$("#startBasketbal").click(function () {
			$('.basketbalAnimation').show();
			$('.basketbalAnimation').css('transform', 'translate(0px, -135px) rotate(90deg) scale(0.6,0.6) skew(0deg)');
			$('.basketbal').delay(200).animate({opacity: 0}, 1000, 'easeInBounce');
			$('.korfbal, .volleybal, #login').delay(10).animate({opacity: 0}, 1, 'easeInBounce');
	   		$('.makeAccount').delay(1350).fadeIn(500);
      			
			//setTimeout('window.location = "index.php/main/signup/"',1000);  
      		return true;
		});
	});
    $(function() {
    	$("#startVolleybal").click(function () {
			$('.volleybalAnimation').show();
			$('.volleybalAnimation').css('transform', 'translate(0px, -135px) rotate(90deg) scale(0.6,0.6) skew(0deg)');
			$('.volleybal').delay(200).animate({opacity: 0}, 1000, 'easeInBounce');
			$('.korfbal, .basketbal, #login').delay(10).animate({opacity: 0}, 1, 'easeInBounce');
	   		$('.makeAccount').delay(1350).fadeIn(500);
      		
			//setTimeout('window.location = "index.php/main/signup/"',1000);  
      		return true;
		});
	});
	$(function() {
    	$("#makeAccountClose").click(function () {
			$('.makeAccount').fadeOut();
			$('.korfbalAnimation, .basketbalAnimation, .volleybalAnimation').hide();

	   		$('.korfbal, .basketbal, .volleybal, #login').animate({opacity: 1}, 1, 'linear').show();
	   		      		
			//setTimeout('window.location = "index.php/main/signup/"',1000);  
      		return true;
		});
	});
	$(function() {
    	$("#closeLogin").click(function () {
			$('.login').fadeOut('fast');
			$('.korfbalAnimation, .basketbalAnimation, .volleybalAnimation').hide();

	   		$('.korfbal, .basketbal, .volleybal, #login, .gameRight, .gameLeft').animate({opacity: 1}, 1, 'linear').show();

		});
	});
	$(function() {
    	$("#closeProfile").click(function () {
			$('.profile').fadeOut('fast');
	   		$('.korfbal, .basketbal, .volleybal, #login, .gameRight, .gameLeft, .sportnav').animate({opacity: 1}, 1, 'linear').show();


		});
	});
	$(function() {
    	$("#switchAccountToLogin").click(function () {
			$('.makeAccount').fadeOut('fast');
			$('.login').animate({opacity: 1}, 1, 'linear').show();

		});
	});
/////////////////////////////////////////////////////////////////
// HOMEPAGE ANIMATIONS end
/////////////////////////////////////////////////////////////////
// TEAM ANIMATIONS begin
/////////////////////////////////////////////////////////////////
    $(function() {
    	$("#watchSkills").click(function () {
			$('#watchSkills').fadeIn();
			      		
		});
	});
    /////////////////////////////////////////////////////////////////
// TEAM ANIMATIONS end
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
    	
		$('.korfbal, .basketbal, .volleybal, .gameRight, .gameLeft').animate({opacity: 0}, 1, 'linear').hide();		
	   	$('.profile').show().animate({opacity: 1}, 1500, 'linear');	
		});
});
/////////////////////////////////////////////////////////////////
// LOGIN  end
/////////////////////////////////////////////////////////////////
// TOUCHSWIPE begin
/////////////////////////////////////////////////////////////////		
		var IMG_WIDTH = innerWidth;
			var currentImg=0;
			var maxImages=5;
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
// clearlink begin
window.onload = clearCurrentLink;

function clearCurrentLink(){
    var a = document.getElementsByTagName("A");
    for(var i=0;i<a.length;i++)
        if(a[i].href == window.location.href.split("#")[0])
            removeNode(a[i]);
}

function removeNode(n){
    if(n.hasChildNodes())
        for(var i=0;i<n.childNodes.length;i++)
            n.parentNode.insertBefore(n.childNodes[i].cloneNode(true),n);
    n.parentNode.removeChild(n);
}
// clearlink end
//formtowizard begin
(function($) {
    $.fn.formToWizard = function(options) {
        options = $.extend({  
            submitButton: "" 
        }, options); 
        
        var element = this;

        var steps = $(element).find("fieldset");
        var count = steps.size();
        var submmitButtonName = "#" + options.submitButton;
        $(submmitButtonName).hide();

        // 2
        $(element).before("<ul id='steps'></ul>");

        steps.each(function(i) {
            $(this).wrap("<div id='step" + i + "'></div>");
            $(this).append("<p id='step" + i + "commands'></p>");

            // 2
            var name = $(this).find("legend").html();
            $("#steps").append("<li id='stepDesc" + i + "'>Step " + (i + 1) + "<span>" + name + "</span></li>");

            if (i == 0) {
                createNextButton(i);
                selectStep(i);
            }
            else if (i == count - 1) {
                $("#step" + i).hide();
                createPrevButton(i);
            }
            else {
                $("#step" + i).hide();
                createPrevButton(i);
                createNextButton(i);
            }
        });

        function createPrevButton(i) {
            var stepName = "step" + i;
            $("#" + stepName + "commands").append("<a href='#' id='" + stepName + "Prev' class='prev'>< Back</a>");

            $("#" + stepName + "Prev").bind("click", function(e) {
                $("#" + stepName).hide();
                $("#step" + (i - 1)).show();
                $(submmitButtonName).hide();
                selectStep(i - 1);
            });
        }

        function createNextButton(i) {
            var stepName = "step" + i;
            $("#" + stepName + "commands").append("<a href='#' id='" + stepName + "Next' class='next'>Next ></a>");

            $("#" + stepName + "Next").bind("click", function(e) {
                $("#" + stepName).hide();
                $("#step" + (i + 1)).show();
                if (i + 2 == count)
                    $(submmitButtonName).show();
                selectStep(i + 1);
            });
        }

        function selectStep(i) {
            $("#steps li").removeClass("current");
            $("#stepDesc" + i).addClass("current");
        }

    }
})(jQuery); 
//formtowizard end