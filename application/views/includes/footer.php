</div>
<!-- end main -->
</div>
<!-- end wrap -->


<section id="footerWrap">
    <footer>
        <div id="footerLeft">
            <h2>test</h2>
            <li>test</li>
            <li>test</li>
            <li>test</li>
            <p>Maecenas sed diam eget risus varius blandit sit amet non magna. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Nullam id dolor id nibh ultricies vehicula ut id elit. Nulla vitae elit libero, a pharetra augue. Donec sed odio dui. Integer posuere erat a ante venenatis dapibus posuere velit aliquet.</p>
        </div>
        <div id="footerCenter">
            <h2>connect</h2>
                       <li><a href="http://www.facebook.com/apps/application.php?id=217760674909805">join op facebook</a></li>
   <li><a href="http://twitter.com/#!/playb_al">follow op twitter</a></li>
      
            <li><a href="http://www.facebook.com/apps/application.php?id=217760674909805&sk=app_2373072738">forum</a></li>
            <li><a href="http://getsatisfaction.com/playbal">meld een probleem</a></li>
<?php   echo safe_mailto('admin@playb.al', 'mail ons'); ?>


 
        </div>
        <div id="footerRight">
            <h2>playb.al op twitter</h2>
            <div id="twitter"></div>

        </div>
       
    </footer>
       
    <script src="<?php echo base_url();?>js/jquery.zrssfeed.min.js"></script> 
    <script type="text/javascript"> 
$('#twitter').rssfeed('http://pipes.yahoo.com/pipes/pipe.run?_id=07185e6fedce25a36a4b39cd537f98e1&_render=rss', {    limit: 1  });
</script> 
</section>
<!-- end footerWrap -->
  <section id="footerEnd">
<div><p>
playb.al 2011 - alle rechten voorbehouden

</p>
</div>
        </section> 
<?php include_once ("analytics.php") ?>
<script type="text/javascript" charset="utf-8">
  var is_ssl = ("https:" == document.location.protocol);
  var asset_host = is_ssl ? "https://s3.amazonaws.com/getsatisfaction.com/" : "http://s3.amazonaws.com/getsatisfaction.com/";
  document.write(unescape("%3Cscript src='" + asset_host + "javascripts/feedback-v2.js' type='text/javascript'%3E%3C/script%3E"));
</script> 
<script type="text/javascript" charset="utf-8">
  var feedback_widget_options = {};

  feedback_widget_options.display = "overlay";  
  feedback_widget_options.company = "playbal";
  feedback_widget_options.placement = "left";
  feedback_widget_options.color = "#222";
  feedback_widget_options.style = "idea";

  var feedback_widget = new GSFN.feedback_widget(feedback_widget_options);
</script>
</body></html>