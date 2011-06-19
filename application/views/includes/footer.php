</div>
<!-- end main -->
</div>
<!-- end wrap -->


<section id="footerWrap">
    <footer>
        <div id="footerLeft">
            <h2>share</h2>
<li>deel playb.al op je favoriete netwerk</li>
<br />
<div class="share1168">
<div class="addthis_toolbox addthis_default_style ">
<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
<a class="addthis_button_tweet"></a>
<a class="addthis_counter addthis_pill_style"></a>
</div>

</div>
      
        
 
     <div class="share896">
<div class="addthis_toolbox addthis_default_style ">
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_preferred_4"></a>
<a class="addthis_button_compact"></a>
<a class="addthis_counter addthis_bubble_style"></a>
</div>
</div>
  </div>
<script type="text/javascript">var addthis_config = {"data_track_clickback":true};</script>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4df7d8130a0d7723"></script>
        
        
        <div id="footerCenter">
            <h2>connect</h2>
                       <li><a href="http://www.facebook.com/apps/application.php?id=217760674909805">join op facebook</a></li>
   <li><a href="http://twitter.com/#!/playb_al">follow op twitter</a></li>
      
            <li><a href="http://www.facebook.com/apps/application.php?id=217760674909805&sk=app_2373072738">forum</a></li>
            <li><a href="http://getsatisfaction.com/playbal">meld een probleem</a></li>
   <li><a href="mailto:admin@playb.al">mail ons</a></li>


 
        </div>
        <div id="footerRight">
            <h2>playb.al op twitter</h2>
            <div id="twitter"></div>

        </div>
       
    </footer>

<script src="<?php echo base_url();?>js/jquery.zrssfeed.min.js"></script>

<script type="text/javascript">
$(document).ready(function () {
$('#twitter').rssfeed('http://pipes.yahoo.com/pipes/pipe.run?_id=91c45a1271d535b13439a88d7cd8a56e&_render=rss', {    limit: 1  });

$('#twitter_status').rssfeed('http://pipes.yahoo.com/pipes/pipe.run?_id=07185e6fedce25a36a4b39cd537f98e1&_render=rss', {    limit: 1  });

$('#twitter_update').rssfeed('http://pipes.yahoo.com/pipes/pipe.run?_id=fa9fa99002ab82cad3452ef36de1ba79&_render=rss', {    limit: 1  });

$('#twitter_nieuws').rssfeed('http://pipes.yahoo.com/pipes/pipe.run?_id=ab0170ce4004bb6019052b1e74ad2c3b&_render=rss', {    limit: 1  });

});
</script>
</section>
<!-- end footerWrap -->
  <section id="footerEnd">

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
  feedback_widget_options.placement = "right";
  feedback_widget_options.color = "#222";
  feedback_widget_options.style = "idea";

  var feedback_widget = new GSFN.feedback_widget(feedback_widget_options);
</script>
</body></html>