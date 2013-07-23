<!DOCTYPE html>
<html>
<head>
<title>PhotoSwipe</title>
<meta name="author"
	content="Ste Brennan - Code Computerlove - http://www.codecomputerlove.com/" />
<meta
	content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0;"
	name="viewport" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<link
	href="<?php echo base_url().'assets/extras/css/mobile/styles.css';?>"
	type="text/css" rel="stylesheet" />

<link
	href="<?php echo base_url().'assets/extras/css/mobile/photoswipe.css';?>"
	type="text/css" rel="stylesheet" />

<script type="text/javascript"
	src="<?php echo base_url().'assets/extras/js/mobile/klass.min.js';?>"></script>
<script type="text/javascript"
	src="<?php echo base_url().'assets/extras/js/mobile/code.photoswipe-3.0.5.min.js';?>"></script>

<script type="text/javascript">

		(function(window, PhotoSwipe){
			document.addEventListener('DOMContentLoaded', function(){
			
				var
					options = {},
					instance = PhotoSwipe.attach( window.document.querySelectorAll('#Gallery a'), options );
			
			}, false);
			
			
		}(window, window.Code.PhotoSwipe));
		
	</script>


</head>
<body>

	<div>
		<ul id="Gallery" class="gallery">
			<?php 
			foreach ($imageDetail as $image)
			{
				?>
			<li><a
				href="<?php echo base_url().'assets/uploads/producers/'.$image['image_name']?>"><img
					src="<?php echo base_url().'assets/uploads/producers/_thumbs/'.$image['image_name']?>"
					/> </a></li>
			<?php
			}
			?>
		</ul>

	</div>
</body>
</html>
