<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta name="viewport"
	content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Wisha</title>
<link rel="stylesheet" type="text/css"
	href="<?php echo base_url('assets/extras/css/style.css')?>" />
<script type="text/javascript" src="<?php echo base_url('assets/extras/js/jquery.js');?>" >
</script>
</head>
<body class="innerBody">
	<?php 

	/*
	 $exploded = explode('/',$this->uri->uri_string());
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
	print_r($url);
	exit;
	*/

	?>
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