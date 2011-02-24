$(function() {
		
		$( "#catalog li" ).draggable({ 
			cursor: 'cursor',
			helper: 'original',
			revert: true,
			appendTo: "body"
			
		});
		
		
		var teamid = $("#teamid").val();
		var originalr1 = $('#rebound1 li').text();
		var originalp1 = $('#playmaking1 li').text();
		var originala1 = $('#attack1 li').text();
		var originala2 = $('#attack2 li').text();
		
		var originalr2 = $('#rebound2 li').text();
		var originalp2 = $('#playmaking2 li').text();
		var originala3 = $('#attack3 li').text();
		var originala4 = $('#attack4 li').text();
		//alert(originalr1);
		//alert(teamid);
		
		$( "#rebound1 ul").droppable({
			activeClass: "ui-state-default",
			hoverClass: "ui-state-hover",
			accept: ":not(.ui-sortable-helper)",
			drop: function( event, ui ) {
				$( this ).find( ".placeholder" ).remove();
				$(this).empty();
				$( "<li></li>" ).text( ui.draggable.text() ).appendTo( this );
				//$(this).empty();
				
				
				
				var spelerstring = $(this).text(ui.droppable);
				var speler = spelerstring.split("id:");
				var spelername = speler[0];
				var spelerid = speler[1];
				
				var geslachtstring = $('#dpop'+spelerid).find("#geslacht").text();
				var geslachtarray = geslachtstring.split(": ");
				var geslacht = geslachtarray[1];
				//alert(geslacht);
				
				//reboundskills halen
				var reboundstring = $('#dpop'+spelerid).find("#rebound").text();
				var reboundarray = reboundstring.split(":");
				var rebound = reboundarray[1];
				//alert(rebound);
				
				//staminaskill halen
				var staminastring = $('#dpop'+spelerid).find("#stamina").text();
				var staminaarray = staminastring.split(":");
				var stamina = staminaarray[1];
				//alert(stamina);
				
				var positie = 'rebound1';
				//alert(positie);
				//alert (speler[1]);	
  				$.ajax({
    			type: "POST",
    			url: "http://playb.al/index.php/korfbal/korfbal_reorder",
    			data: { spelername: spelername,
            			positie: positie,
            			teamid: teamid,
            			geslacht: geslacht, 
            			spelerid : spelerid
            			
        				},
        		dataType: "json",
        		success: function(data){
    			
    			if(data.check === 'valid'){
					$().toastmessage('showSuccessToast', ""+spelername+" "+"has been assigned to position"+" "+positie+"");
				}
				if(data.check === 'invalid vrouwen'){
					$().toastmessage('showErrorToast', "Er kunnen maximum 2 vrouwen in een vak staan");
					$('#rebound1 li').text(originalr1);
				}
				if(data.check ==='invalid mannen'){
					$().toastmessage('showErrorToast', "Er kunnen maximum 2 mannen in een vak staan");
					$('#rebound1 li').text(originalr1);
				
				}
    			
    			
				
      
                }
  				});
  				return false;
  				}
		});
		
		
		$( "#playmaking1 ul" ).droppable({
			activeClass: "ui-state-default",
			hoverClass: "ui-state-hover",
			accept: ":not(.ui-sortable-helper)",
			drop: function( event, ui ) {
				$( this ).find( ".placeholder" ).remove();
				$(this).empty();
				$( "<li></li>" ).text( ui.draggable.text() ).appendTo( this );
				
				var spelerstring = $(this).text(ui.droppable);
				var speler = spelerstring.split("id:");
				var spelername = speler[0];
				var spelerid = speler[1];
				
				var geslachtstring = $('#dpop'+spelerid).find("#geslacht").text();
				var geslachtarray = geslachtstring.split(": ");
				var geslacht = geslachtarray[1];
				var positie = "playmaking1";
				
  				$.ajax({
    			type: "POST",
    			url: "http://playb.al/index.php/korfbal/korfbal_reorder",
    			data:  { spelername: spelername,
            			positie: positie,
            			teamid: teamid,
            			geslacht: geslacht,
            			spelerid : spelerid
            			},
    			dataType: "json",
        		success: function(data){
    			
    			if(data.check === 'valid'){
					$().toastmessage('showSuccessToast', ""+spelername+" "+"has been assigned to position"+" "+positie+"");
				}
				if(data.check === 'invalid vrouwen'){
					$().toastmessage('showErrorToast', "Er kunnen maximum 2 vrouwen in een vak staan");
					$('#playmaking1 li').text(originalp1);
				
				}
				if(data.check ==='invalid mannen'){
					$().toastmessage('showErrorToast', "Er kunnen maximum 2 mannen in een vak staan");
					$('#playmaking1 li').text(originalp1);
				
				}
      
                }
  				});
  				return false;
  				}
		})
		
		$( "#attack1 ul" ).droppable({
			activeClass: "ui-state-default",
			hoverClass: "ui-state-hover",
			accept: ":not(.ui-sortable-helper)",
			drop: function( event, ui ) {
				$( this ).find( ".placeholder" ).remove();
				$(this).empty();
				$( "<li></li>" ).text( ui.draggable.text() ).appendTo( this );
				
				var spelerstring = $(this).text(ui.droppable);
				var speler = spelerstring.split("id:");
				var spelername = speler[0];
				var spelerid = speler[1];
				
				var geslachtstring = $('#dpop'+spelerid).find("#geslacht").text();
				var geslachtarray = geslachtstring.split(": ");
				var geslacht = geslachtarray[1];
				
				var positie = "attack1";
				
  				$.ajax({
    			type: "POST",
    			url: "http://playb.al/index.php/korfbal/korfbal_reorder",
    			data:  { spelername: spelername,
            			positie: positie,
            			teamid: teamid,
            			geslacht: geslacht,
            			spelerid : spelerid
            			
        				},
    			dataType: "json",
        		success: function(data){
    			
    			if(data.check === 'valid'){
					$().toastmessage('showSuccessToast', ""+spelername+" "+"has been assigned to position"+" "+positie+"");
				}
				if(data.check === 'invalid vrouwen'){
					$().toastmessage('showErrorToast', "Er kunnen maximum 2 vrouwen in een vak staan");
					$('#attack1 li').text(originala1);
				
				}
				if(data.check ==='invalid mannen'){
					$().toastmessage('showErrorToast', "Er kunnen maximum 2 mannen in een vak staan");
					$('#attack1 li').text(originala1);
				
				}


      
                }
  				});
  				return false;
  				}
		});
		
		$( "#attack2 ul" ).droppable({
			activeClass: "ui-state-default",
			hoverClass: "ui-state-hover",
			accept: ":not(.ui-sortable-helper)",
			drop: function( event, ui ) {
				$( this ).find( ".placeholder" ).remove();
				$(this).empty();
				$( "<li></li>" ).text( ui.draggable.text() ).appendTo( this );
				
				var spelerstring = $(this).text(ui.droppable);
				var speler = spelerstring.split("id:");
				var spelername = speler[0];
				var spelerid = speler[1];
				
				var geslachtstring = $('#dpop'+spelerid).find("#geslacht").text();
				var geslachtarray = geslachtstring.split(": ");
				var geslacht = geslachtarray[1];
				
				var positie = "attack2";
				
  				$.ajax({
    			type: "POST",
    			url: "http://playb.al/index.php/korfbal/korfbal_reorder",
    			data:  { spelername: spelername,
            			positie: positie,
            			teamid: teamid,
            			geslacht: geslacht,
            			spelerid : spelerid
            			
        				},
    			dataType: "json",
        		success: function(data){
    			
    			if(data.check === 'valid'){
					$().toastmessage('showSuccessToast', ""+spelername+" "+"has been assigned to position"+" "+positie+"");
				}
				if(data.check === 'invalid vrouwen'){
					$().toastmessage('showErrorToast', "Er kunnen maximum 2 vrouwen in een vak staan");
					$('#attack2 li').text(originala2);
				
				}
				if(data.check ==='invalid mannen'){
					$().toastmessage('showErrorToast', "Er kunnen maximum 2 mannen in een vak staan");
					$('#attack2 li').text(originala2);
				
				}

      
                }
  				});
  				return false;
  				}
		});
		
		
			$( "#rebound2 ul" ).droppable({
			activeClass: "ui-state-default",
			hoverClass: "ui-state-hover",
			accept: ":not(.ui-sortable-helper)",
			drop: function( event, ui ) {
				$( this ).find( ".placeholder" ).remove();
				$(this).empty();
				$( "<li></li>" ).text( ui.draggable.text() ).appendTo( this );
				
				var spelerstring = $(this).text(ui.droppable);
				var speler = spelerstring.split("id:");
				var spelername = speler[0];
				var spelerid = speler[1];
				
				var geslachtstring = $('#dpop'+spelerid).find("#geslacht").text();
				var geslachtarray = geslachtstring.split(": ");
				var geslacht = geslachtarray[1];
				
				var positie = "rebound2";
				
  				$.ajax({
    			type: "POST",
    			url: "http://playb.al/index.php/korfbal/korfbal_reorder",
    			data:  { spelername: spelername,
            			positie: positie,
            			teamid: teamid,
            			geslacht: geslacht,
            			spelerid : spelerid
            			
        				},
    			dataType: "json",
        		success: function(data){
    			
    			if(data.check === 'valid'){
					$().toastmessage('showSuccessToast', ""+spelername+" "+"has been assigned to position"+" "+positie+"");
				}
				if(data.check === 'invalid vrouwen'){
					$().toastmessage('showErrorToast', "Er kunnen maximum 2 vrouwen in een vak staan");
					$('#rebound2 li').text(originalr2);
				
				}
				if(data.check ==='invalid mannen'){
					$().toastmessage('showErrorToast', "Er kunnen maximum 2 mannen in een vak staan");
					$('#rebound2 li').text(originalr2);
				
				}


      
                }
  				});
  				return false;
  				}
		});
		
		
			$( "#playmaking2 ul" ).droppable({
			activeClass: "ui-state-default",
			hoverClass: "ui-state-hover",
			accept: ":not(.ui-sortable-helper)",
			drop: function( event, ui ) {
				$( this ).find( ".placeholder" ).remove();
				$(this).empty();
				$( "<li></li>" ).text( ui.draggable.text() ).appendTo( this );
				
				var spelerstring = $(this).text(ui.droppable);
				var speler = spelerstring.split("id:");
				var spelername = speler[0];
				var spelerid = speler[1];
				
				var geslachtstring = $('#dpop'+spelerid).find("#geslacht").text();
				var geslachtarray = geslachtstring.split(": ");
				var geslacht = geslachtarray[1];
				
				var positie = "playmaking2";
				
  				$.ajax({
    			type: "POST",
    			url: "http://playb.al/index.php/korfbal/korfbal_reorder",
    			data:  { spelername: spelername,
            			positie: positie,
            			teamid: teamid,
            			geslacht: geslacht,
            			spelerid : spelerid
            			
        				},
    			dataType: "json",
        		success: function(data){
    			
    			if(data.check === 'valid'){
					$().toastmessage('showSuccessToast', ""+spelername+" "+"has been assigned to position"+" "+positie+"");
				}
				if(data.check === 'invalid vrouwen'){
					$().toastmessage('showErrorToast', "Er kunnen maximum 2 vrouwen in een vak staan");
					$('#playmaking2 li').text(originalp2);
				
				}
				if(data.check ==='invalid mannen'){
					$().toastmessage('showErrorToast', "Er kunnen maximum 2 mannen in een vak staan");
					$('#playmaking2 li').text(originalp2);
				
				}


      
                }
  				});
  				return false;
  				}
		});
		
			$( "#attack3 ul" ).droppable({
			activeClass: "ui-state-default",
			hoverClass: "ui-state-hover",
			accept: ":not(.ui-sortable-helper)",
			drop: function( event, ui ) {
				$( this ).find( ".placeholder" ).remove();
				$(this).empty();
				$( "<li></li>" ).text( ui.draggable.text() ).appendTo( this );
				
				var spelerstring = $(this).text(ui.droppable);
				var speler = spelerstring.split("id:");
				var spelername = speler[0];
				var spelerid = speler[1];
				
				var geslachtstring = $('#dpop'+spelerid).find("#geslacht").text();
				var geslachtarray = geslachtstring.split(": ");
				var geslacht = geslachtarray[1];
				
				var positie = "attack3";
				
  				$.ajax({
    			type: "POST",
    			url: "http://playb.al/index.php/korfbal/korfbal_reorder",
    			data:  { spelername: spelername,
            			positie: positie,
            			teamid: teamid,
            			geslacht: geslacht,
            			spelerid : spelerid
            			
        				},
    			dataType: "json",
        		success: function(data){
    			
    			if(data.check === 'valid'){
					$().toastmessage('showSuccessToast', ""+spelername+" "+"has been assigned to position"+" "+positie+"");
				}
				if(data.check === 'invalid vrouwen'){
					$().toastmessage('showErrorToast', "Er kunnen maximum 2 vrouwen in een vak staan");
					$('#attack3 li').text(originala3);
				
				}
				if(data.check ==='invalid mannen'){
					$().toastmessage('showErrorToast', "Er kunnen maximum 2 mannen in een vak staan");
					$('#attack3 li').text(originala3);
				
				}


      
                }
  				});
  				return false;
  				}
		});
		
			$( "#attack4 ul" ).droppable({
			activeClass: "ui-state-default",
			hoverClass: "ui-state-hover",
			accept: ":not(.ui-sortable-helper)",
			drop: function( event, ui ) {
				$( this ).find( ".placeholder" ).remove();
				$(this).empty();
				$( "<li></li>" ).text( ui.draggable.text() ).appendTo( this );
				
				var spelerstring = $(this).text(ui.droppable);
				var speler = spelerstring.split("id:");
				var spelername = speler[0];
				var spelerid = speler[1];
				
				var geslachtstring = $('#dpop'+spelerid).find("#geslacht").text();
				var geslachtarray = geslachtstring.split(": ");
				var geslacht = geslachtarray[1];
				
				var positie = "attack4";
				
  				$.ajax({
    			type: "POST",
    			url: "http://playb.al/index.php/korfbal/korfbal_reorder",
    			data:  { spelername: spelername,
            			positie: positie,
            			teamid: teamid,
            			geslacht: geslacht,
            			spelerid : spelerid
            			
        				},
    			dataType: "json",
        		success: function(data){
    			
    			if(data.check === 'valid'){
					$().toastmessage('showSuccessToast', ""+spelername+" "+"has been assigned to position"+" "+positie+"");
				}
				if(data.check === 'invalid vrouwen'){
					$().toastmessage('showErrorToast', "Er kunnen maximum 2 vrouwen in een vak staan");
					$('#attack4 li').text(originala4);
				
				}
				if(data.check ==='invalid mannen'){
					$().toastmessage('showErrorToast', "Er kunnen maximum 2 mannen in een vak staan");
					$('#attack4 li').text(originala4);
				
				}


      
                }
  				});
  				return false;
  				}
		});
		
		
			$( "#captain ul" ).droppable({
			activeClass: "ui-state-default",
			hoverClass: "ui-state-hover",
			accept: ":not(.ui-sortable-helper)",
			drop: function( event, ui ) {
				$( this ).find( ".placeholder" ).remove();
				$(this).empty();
				$( "<li></li>" ).text( ui.draggable.text() ).appendTo( this );
				
				var spelername = $(this).text(ui.droppable);
				var positie = "captain";
				
  				$.ajax({
    			type: "POST",
    			url: "http://playb.al/index.php/korfbal/korfbal_reorder",
    			data:  { spelername: spelername,
            			positie: positie,
            			teamid: teamid,
            			spelerid : spelerid
            			
        				},
    			success: function() {
    			$().toastmessage('showSuccessToast', ""+spelername+" "+"has been assigned to position"+" "+positie+"");

      
                }
  				});
  				return false;
  				}
		});
		
			$( "#setpieces ul" ).droppable({
			activeClass: "ui-state-default",
			hoverClass: "ui-state-hover",
			accept: ":not(.ui-sortable-helper)",
			drop: function( event, ui ) {
				$( this ).find( ".placeholder" ).remove();
				$(this).empty();
				$( "<li></li>" ).text( ui.draggable.text() ).appendTo( this );
				
				var spelername = $(this).text(ui.droppable);
				var positie = "setpieces";
				
  				$.ajax({
    			type: "POST",
    			url: "http://playb.al/index.php/korfbal/korfbal_reorder",
    			data:  { spelername: spelername,
            			positie: positie,
            			teamid: teamid,
            			spelerid : spelerid
            			
        				},
    			dataType: "json",
        		success: function(data){
    			
    			if(data.check === 'valid'){
					$().toastmessage('showSuccessToast', ""+spelername+" "+"has been assigned to position"+" "+positie+"");
				}
				if(data.check === 'invalid vrouwen'){
					$().toastmessage('showErrorToast', "Er kunnen maximum 2 vrouwen in een vak staan");
					
				
				}
				if(data.check ==='invalid mannen'){
					$().toastmessage('showErrorToast', "Er kunnen maximum 2 mannen in een vak staan");
					
				
				}

      
                }
  				});
  				return false;
  				}
		})
	});
	
	
	$(function () {
        $('.bubbleInfo').each(function () {
            var distance = 10;
            var time = 250;
            var hideDelay = 50;

            var hideDelayTimer = null;

            var beingShown = false;
            var shown = false;
            var trigger = $('.trigger', this);
            var info = $('.popup', this).css('opacity', 0);


            $([trigger.get(0), info.get(0)]).mouseover(function () {
                if (hideDelayTimer) clearTimeout(hideDelayTimer);
                if (beingShown || shown) {
                    // don't trigger the animation again
                    return;
                } else {
                    // reset position of info box
                    beingShown = true;

                    info.css({
                        top: -90,
                        left: -33,
                        display: 'block'
                    }).animate({
                        top: '-=' + distance + 'px',
                        opacity: 1
                    }, time, 'swing', function() {
                        beingShown = false;
                        shown = true;
                    });
                }

                return false;
            }).mouseout(function () {
                if (hideDelayTimer) clearTimeout(hideDelayTimer);
                hideDelayTimer = setTimeout(function () {
                    hideDelayTimer = null;
                    info.animate({
                        top: '-=' + distance + 'px',
                        opacity: 0
                    }, time, 'swing', function () {
                        shown = false;
                        info.css('display', 'none');
                    });

                }, hideDelay);

                return false;
            });
        });
    });

