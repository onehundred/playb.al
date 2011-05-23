// playb.al


$(document).ready(function() {
$('#wrap').fadeIn(5000);

});
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