$(function() {
		
		$( "#catalog li" ).draggable({ 
			cursor: 'cursor',
			helper: 'original',
			revert: true,
			appendTo: "body"
			
		});
		
		
		var teamid = $("#teamid").val();
		//alert(teamid);
		
		$( "#rebound1 ul").droppable({
			activeClass: "ui-state-default",
			hoverClass: "ui-state-hover",
			accept: ":not(.ui-sortable-helper)",
			drop: function( event, ui ) {
				$( this ).find( ".placeholder" ).remove();
				$(this).empty();
				$( "<li></li>" ).text( ui.draggable.text() ).appendTo( this );
				
				var spelername = $(this).text(ui.droppable);
				var positie = 'rebound1';
				//alert(positie);	
  				$.ajax({
    			type: "POST",
    			url: "http://playb.al/index.php/korfbal/korfbal_reorder",
    			data: { spelername: spelername,
            			positie: positie,
            			teamid: teamid
            			
        				},
    			success: function() {
    			$().toastmessage('showSuccessToast', ""+spelername+" "+"has been assigned to position"+" "+positie+"");

      
                }
  				});
  				return false;
  				}
		})
		
		
		$( "#playmaking1 ul" ).droppable({
			activeClass: "ui-state-default",
			hoverClass: "ui-state-hover",
			accept: ":not(.ui-sortable-helper)",
			drop: function( event, ui ) {
				$( this ).find( ".placeholder" ).remove();
				$(this).empty();
				$( "<li></li>" ).text( ui.draggable.text() ).appendTo( this );
				
				var spelername = $(this).text(ui.droppable);
				var positie = "playmaking1";
				
  				$.ajax({
    			type: "POST",
    			url: "http://playb.al/index.php/korfbal/korfbal_reorder",
    			data:  { spelername: spelername,
            			positie: positie,
            			teamid: teamid
            			
        				},
    			success: function() {
    			$().toastmessage('showSuccessToast', ""+spelername+" "+"has been assigned to position"+" "+positie+"");

      
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
				
				var spelername = $(this).text(ui.droppable);
				var positie = "attack1";
				
  				$.ajax({
    			type: "POST",
    			url: "http://playb.al/index.php/korfbal/korfbal_reorder",
    			data:  { spelername: spelername,
            			positie: positie,
            			teamid: teamid
            			
        				},
    			success: function() {
    			$().toastmessage('showSuccessToast', ""+spelername+" "+"has been assigned to position"+" "+positie+"");

      
                }
  				});
  				return false;
  				}
		})
		
		$( "#attack2 ul" ).droppable({
			activeClass: "ui-state-default",
			hoverClass: "ui-state-hover",
			accept: ":not(.ui-sortable-helper)",
			drop: function( event, ui ) {
				$( this ).find( ".placeholder" ).remove();
				$(this).empty();
				$( "<li></li>" ).text( ui.draggable.text() ).appendTo( this );
				
				var spelername = $(this).text(ui.droppable);
				var positie = "attack2";
				
  				$.ajax({
    			type: "POST",
    			url: "http://playb.al/index.php/korfbal/korfbal_reorder",
    			data:  { spelername: spelername,
            			positie: positie,
            			teamid: teamid
            			
        				},
    			success: function() {
    			$().toastmessage('showSuccessToast', ""+spelername+" "+"has been assigned to position"+" "+positie+"");
      
                }
  				});
  				return false;
  				}
		})
		
		
			$( "#rebound2 ul" ).droppable({
			activeClass: "ui-state-default",
			hoverClass: "ui-state-hover",
			accept: ":not(.ui-sortable-helper)",
			drop: function( event, ui ) {
				$( this ).find( ".placeholder" ).remove();
				$(this).empty();
				$( "<li></li>" ).text( ui.draggable.text() ).appendTo( this );
				
				var spelername = $(this).text(ui.droppable);
				var positie = "rebound2";
				
  				$.ajax({
    			type: "POST",
    			url: "http://playb.al/index.php/korfbal/korfbal_reorder",
    			data:  { spelername: spelername,
            			positie: positie,
            			teamid: teamid
            			
        				},
    			success: function() {
    			$().toastmessage('showSuccessToast', ""+spelername+" "+"has been assigned to position"+" "+positie+"");

      
                }
  				});
  				return false;
  				}
		})
		
		
			$( "#playmaking2 ul" ).droppable({
			activeClass: "ui-state-default",
			hoverClass: "ui-state-hover",
			accept: ":not(.ui-sortable-helper)",
			drop: function( event, ui ) {
				$( this ).find( ".placeholder" ).remove();
				$(this).empty();
				$( "<li></li>" ).text( ui.draggable.text() ).appendTo( this );
				
				var spelername = $(this).text(ui.droppable);
				var positie = "playmaking2";
				
  				$.ajax({
    			type: "POST",
    			url: "http://playb.al/index.php/korfbal/korfbal_reorder",
    			data:  { spelername: spelername,
            			positie: positie,
            			teamid: teamid
            			
        				},
    			success: function() {
    			$().toastmessage('showSuccessToast', ""+spelername+" "+"has been assigned to position"+" "+positie+"");

      
                }
  				});
  				return false;
  				}
		})
		
			$( "#attack3 ul" ).droppable({
			activeClass: "ui-state-default",
			hoverClass: "ui-state-hover",
			accept: ":not(.ui-sortable-helper)",
			drop: function( event, ui ) {
				$( this ).find( ".placeholder" ).remove();
				$(this).empty();
				$( "<li></li>" ).text( ui.draggable.text() ).appendTo( this );
				
				var spelername = $(this).text(ui.droppable);
				var positie = "attack3";
				
  				$.ajax({
    			type: "POST",
    			url: "http://playb.al/index.php/korfbal/korfbal_reorder",
    			data:  { spelername: spelername,
            			positie: positie,
            			teamid: teamid
            			
        				},
    			success: function() {
    			$().toastmessage('showSuccessToast', ""+spelername+" "+"has been assigned to position"+" "+positie+"");

      
                }
  				});
  				return false;
  				}
		})
		
			$( "#attack4 ul" ).droppable({
			activeClass: "ui-state-default",
			hoverClass: "ui-state-hover",
			accept: ":not(.ui-sortable-helper)",
			drop: function( event, ui ) {
				$( this ).find( ".placeholder" ).remove();
				$(this).empty();
				$( "<li></li>" ).text( ui.draggable.text() ).appendTo( this );
				
				var spelername = $(this).text(ui.droppable);
				var positie = "attack4";
				
  				$.ajax({
    			type: "POST",
    			url: "http://playb.al/index.php/korfbal/korfbal_reorder",
    			data:  { spelername: spelername,
            			positie: positie,
            			teamid: teamid
            			
        				},
    			success: function() {
    			$().toastmessage('showSuccessToast', ""+spelername+" "+"has been assigned to position"+" "+positie+"");

      
                }
  				});
  				return false;
  				}
		})
		
		
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
            			teamid: teamid
            			
        				},
    			success: function() {
    			$().toastmessage('showSuccessToast', ""+spelername+" "+"has been assigned to position"+" "+positie+"");

      
                }
  				});
  				return false;
  				}
		})
		
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
            			teamid: teamid
            			
        				},
    			success: function() {
    			$().toastmessage('showSuccessToast', ""+spelername+" "+"has been assigned to position"+" "+positie+"");

      
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

