
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width;" />
<title>Admin - Login</title>
<link rel="stylesheet"
	href="<?php echo base_url()?>assets/admin/css/style.css">
<script type="text/javascript"
	src="<?php echo base_url()?>assets/admin/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript"
	src="<?php echo base_url()?>assets/admin/js/jquery-ui-1.8.16.min.js"></script>
<script type="text/javascript"
	src="<?php echo base_url()?>assets/admin/js/excanvas.js"></script>
<script type="text/javascript"
	src="<?php echo base_url()?>assets/admin/js/jquery.visualize.js"></script>
<script type="text/javascript"
	src="<?php echo base_url()?>assets/admin/js/jquery.tablesorter.js"></script>
<script type="text/javascript"
	src="<?php echo base_url()?>assets/admin/js/jquery.date_input.min.js"></script>
<script type="text/javascript"
	src="<?php echo base_url()?>assets/admin/js/jquery.minicolors.min.js"></script>
<script type="text/javascript"
	src="<?php echo base_url()?>assets/admin/js/jquery.wysiwyg.js"></script>
<script type="text/javascript"
	src="<?php echo base_url()?>assets/admin/js/jquery.fancybox.js"></script>
<script type="text/javascript"
	src="<?php echo base_url()?>assets/admin/js/jquery.tipsy.js"></script>
<script type="text/javascript"
	src="<?php echo base_url()?>assets/admin/js/jquery.uniform.min.js"></script>
<script type="text/javascript"
	src="<?php echo base_url()?>assets/admin/js/custom.js"></script>
<link rel="stylesheet"
	href="<?php echo base_url()?>assets/admin/css/responsive.css">
<link rel="stylesheet"
	href="<?php echo base_url()?>assets/admin/css/visualize.css">
<link rel="stylesheet"
	href="<?php echo base_url()?>assets/admin/css/date_input.css">
<link rel="stylesheet"
	href="<?php echo base_url()?>assets/admin/css/jquery.minicolors.css">
<link rel="stylesheet"
	href="<?php echo base_url()?>assets/admin/css/jquery.wysiwyg.css">
<link rel="stylesheet"
	href="<?php echo base_url()?>assets/admin/css/jquery.fancybox.css">
<link rel="stylesheet"
	href="<?php echo base_url()?>assets/admin/css/tipsy.css">
<!-- 		<link rel="apple-touch-icon-precomposed" href="http://localhost/cmb/apple-touch-icon-114x114.png" /> -->
<!-- 		<link rel="shortcut icon" href="http://localhost/cmb/favicon.ico" /></head> -->


<body class="loginpage">
	<header>
	<h1>
		<a href="<?php echo base_url()?>admin/"></a>
	</h1>
	</header>
	<script type="text/javascript">
$(document).ready(function(){
	$('#username').focus();
});
</script>
	<section id="content" class="loginbox"> <?php 
	if (validation_errors())
	{
		echo '<div class="message errormsg">
		<p><p>'.validation_errors().'</p></p></div>';

	}
	?> 
	<?php echo form_open('admin/login'); ?> 
	<p>
		<label>Username:</label> <br /> <input type="text" class="text"
			name="username" value="" id="username" />
	</p>

	<p>
		<label>Password:</label> <br /> <input type="password" class="text"
			name="password" value="" id="password" />
	</p>

	<p class="formend">
		<input type="submit" class="submit" value="Login" />
	</p>
	</form>
	</section>
</body>
</html>
