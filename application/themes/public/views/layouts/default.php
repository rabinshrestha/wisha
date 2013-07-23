<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php echo $template['metadata']?>
<title><?php echo $template['title']?></title>
<!-- CSS  -->
<?php /*?><style type="text/css" media="all">
@import url("css/binmatrix.allstyle.css");
</style>
<?php */?>
<?php /*?><!-- Calculator -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
<script src="js/init.js" type="text/javascript"></script>
<script src="js/jquery.uniform.js" type="text/javascript"></script>
<script src="js/jquery.cookie.js" type="text/javascript"></script>
<script src="js/counter.js" type="text/javascript"></script>
<!-- Home Banner & Carousel JS -->
<script src="js/slides.min.jquery.js"><?php */?>
</script><script type="text/javascript">
		$(function(){
			$('#slides').slides({
								fadeSpeed: 500,
								slideSpeed: 550,
				preload: true,
				preloadImage: 'img/loading.gif',
				play: 5000,
				pause: 2500,
				hoverPause: true,
				animationStart: function(current){
					$('.caption').animate({
						bottom:-35
					},100);
					if (window.console && console.log) {
						// example return of current slide number
						console.log('animationStart on slide: ', current);
					};
				},
				animationComplete: function(current){
					$('.caption').animate({
						bottom:0
					},200);
					if (window.console && console.log) {
						// example return of current slide number
						console.log('animationComplete on slide: ', current);
					};
				},
				slidesLoaded: function() {
					$('.caption').animate({
						bottom:0
					},200);
				}
			});
			
			$('#slides_two').slides({
				pagination:false,
				generatePagination: false,
				preload: true,
				preloadImage: 'img/loading.gif',
				play: 0,
				pause: 2500,
				hoverPause: true,
				animationStart: function(current){
					$('.caption').animate({
						bottom:0
					},100);
					if (window.console && console.log) {
						// example return of current slide number
						console.log('animationStart on slide: ', current);
					};
				},
				animationComplete: function(current){
					$('.caption').animate({
						bottom:0
					},200);
					if (window.console && console.log) {
						// example return of current slide number
						console.log('animationComplete on slide: ', current);
					};
				},
				slidesLoaded: function() {
					$('.caption').animate({
						bottom:0
					},200);
				}
			});
		});
		
		
	</script>

<!--google analytics-->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-38372082-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<script>
$(document).ready(function(){
if ($.browser.msie && $.browser.version == 10) {
  $("html").addClass("ie10");
}
});

</script>
</head>

<body>
<div id="wrapper">
  <div id="logo_cnr"><a href="<?php echo base_url();?>index.html"><img src="<?php echo base_url();?>assets/public/images/logo_url.gif" width="180" height="180" /></a></div>
  <?php echo $this->load->view('public/blocks/header')?>
  <?php  if(isset($template['partials']['header'])) echo $template['partials']['header']; ?>
  <div id="main_content2"> <?php echo $template['body'];?> </div>
  <?php echo $this->load->view('public/blocks/footer')?>
  <div id="copyright">© Copyright 2012 Source Separation Systems Pty Ltd. All Rights Reserved.</div>
</div>
</body>
</html>
<strong></strong>