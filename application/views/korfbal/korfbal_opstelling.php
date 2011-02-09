<style>
	h1 { padding: .2em; margin: 0; }
	#products { float:left; width: 500px; margin-right: 2em; }
	#catalog li {width: 100px;}
	#defense1, #defense2, #defense3, #defense4 { width: 200px; float: left; margin-left: 10px; }
	/* style the list to maximize the droppable hitarea */
	#defense1 ul, #defense2 ul, #defense3 ul, #defense4 ul { margin: 0; padding: 1em 0 1em 3em; list-style: none; }
	</style>
	<script>
	$(function() {
		
		$( "#catalog li" ).draggable({ 
			cursor: 'cursor',
			helper: 'original',
			revert: true,
			appendTo: "body"
			
		});
		
		
		$( "#defense1 ul, #defense2 ul, #defense3 ul, #defense4 ul" ).droppable({
			activeClass: "ui-state-default",
			hoverClass: "ui-state-hover",
			accept: ":not(.ui-sortable-helper)",
			drop: function( event, ui ) {
				$( this ).find( ".placeholder" ).remove();
				$(this).empty();
				$( "<li></li>" ).text( ui.draggable.text() ).appendTo( this );
				
				var spelername = $(this).text(ui.droppable);
				
				alert(spelername);
				//alert(defensename);	
				var dataString = 'spelername='+ spelername;
  				//alert (dataString);return false;
  				$.ajax({
    			type: "POST",
    			url: "http://playb.al/index.php/korfbal/korfbal_reorder",
    			data: dataString,
    			success: function() {
    			alert("Player has been assigned");
      
                }
  				});
  				return false;
  		
			
			

				
			}
		})
	});
	</script>



<div class="demo">
	
<div id="products">
	<h1 class="ui-widget-header">Korfbal</h1>	
	<div id="catalog">
		<h3><a href="#">Players</a></h3>
		<div>
			<ul>
				<?php foreach($spelers->result() as $row){  ?>
				<li><?php echo $row->voornaam.' '.$row->achternaam; ?></li>
				
				
				<?php } ?>
			</ul>
		</div>
			</div>
</div>

<div id="defense1">
	<h1 class="ui-widget-header">Defense 1</h1>
	<div class="ui-widget-content">
		<ul>
			<li class="placeholder">Add player</li>
		</ul>
	</div>
</div>

<div id="defense2">
	<h1 class="ui-widget-header">Defense 2</h1>
	<div class="ui-widget-content">
		<ul>
			<li class="placeholder">Add player</li>
		</ul>
	</div>
</div>

<div id="defense3">
	<h1 class="ui-widget-header">Defense 3</h1>
	<div class="ui-widget-content">
		<ul>
			<li class="placeholder">Add player</li>
		</ul>
	</div>
</div>

<div id="defense4">
	<h1 class="ui-widget-header">Defense 4</h1>
	<div class="ui-widget-content">
		<ul>
			<li class="placeholder">Add player</li>
		</ul>
	</div>
</div>

</div><!-- End demo -->



