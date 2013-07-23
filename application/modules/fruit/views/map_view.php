<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta name="viewport"
	content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<title>Wisha</title>
<link rel="stylesheet" type="text/css"
	href="<?php echo base_url('assets/extras/css/style.css')?>" />
</head>
<body class="innerBody">
	<!-- wrap -->
	<div id="wrapper">
		<div class="header headerInner">
			<div class="headerBlock">
				<a href="<?php echo site_url();?>" title="WISHA"><img
					src="<?php echo base_url('assets/extras/images/inner-logo.png');?>"
					alt="WISHA" title="WISHA" /> </a> <a
					href="<?php echo site_url();?>" class="homeBtn"> </a> <a
					href="<?php 
// 							$url = '';//$this->uri->uri_string();
					$exploded = explode('/',current_url());
					// 	$explode = array_pop($exploded);
					// 							print_r($exploded);
					// 							die();
					$count = count($exploded);
					$url = '';
					for($i = 0; $i<($count-1);$i++)
					{
					$url[]= $exploded[$i];
					}
					$url = implode('/', $url);
					echo $url;
							
						?>"
					class="backBtn"> </a>
			</div>
		</div>
		
		<!-- for google map -->
		<div>
		<iframe width="320" height="480" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" 
				src="<?php echo $producerDetail[0]['producer_location'];?>">
		</iframe>
		</div>