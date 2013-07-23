
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width;" />
<title>Admin - Dashboard</title>
<link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/style.css">
		<script type="text/javascript" src="<?php echo base_url() ?>assets/admin/js/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>assets/admin/js/jquery-ui-1.8.16.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>assets/admin/js/excanvas.js"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>assets/admin/js/jquery.visualize.js"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>assets/admin/js/jquery.tablesorter.js"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>assets/admin/js/jquery.date_input.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>assets/admin/js/jquery.minicolors.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>assets/admin/js/jquery.wysiwyg.js"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>assets/admin/js/jquery.fancybox.js"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>assets/admin/js/jquery.tipsy.js"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>assets/admin/js/jquery.uniform.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url() ?>assets/admin/js/custom.js"></script>
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/responsive.css">
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/visualize.css">
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/date_input.css">
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/jquery.minicolors.css">
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/jquery.wysiwyg.css">
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/jquery.fancybox.css">
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/uniform.default.min.css">
		<link rel="stylesheet" href="<?php echo base_url() ?>assets/admin/css/tipsy.css">
		<link rel="apple-touch-icon-precomposed" href="<?php echo base_url() ?>apple-touch-icon-114x114.png" />
		<link rel="shortcut icon" href="<?php echo base_url() ?>favicon.ico" /></head>
<body>
<header>	
	<h1><a href="<?php echo base_url() ?>admin/"></a></h1>
    <a style="color:#FFF" href="<?php echo base_url() ?>" target="_blank">Visit Website</a>
		<section class="userprofile">
			<ul>
				<li><a href="#"><img src="<?php echo base_url() ?>assets/admin/images/nav/settings.png" alt="" /> Settings</a>
					<ul>
						<li><a href="<?php echo base_url() ?>admin/logout">Logout</a></li>
					</ul>
				</li>
			</ul>
		</section>
</header><aside>
    <ul id="nav">
        <li><a href="<?php echo base_url() ?>admin" class="active"><strong><img src="<?php echo base_url() ?>assets/admin/images/nav/dashboard.png" alt="" />Dashboard</strong></a></li>
        <li><a href="#" class="collapse"><img src="<?php echo base_url() ?>assets/admin/images/nav/media.png" alt="" />Attribute Mgmt</a>
            <ul>
                <li><a href="<?php echo base_url() ?>admin/boats">Manage Boat</a></li>
                <li><a href="<?php echo base_url() ?>admin/sizes">Manage Boat size</a></li>	
                <li><a href="<?php echo base_url() ?>admin/activity">Manage Activities</a></li>
                <li><a href="<?php echo base_url() ?>admin/locations">Manage Departing Locations</a></li>				
                <li><a href="<?php echo base_url() ?>admin/experiences">Manage Experiences</a></li>				
            </ul>
        </li>
        <li><a href="#" class="collapse"><img src="<?php echo base_url() ?>assets/admin/images/nav/users.png" alt="" />Email Templates</a>
            <ul>
                <li><a href="<?php echo base_url() ?>admin/emails">Manage Email Templates</a></li>
            </ul>
        </li>
        <li><a href="#" class="collapse"><img src="<?php echo base_url() ?>assets/admin/images/nav/media.png" alt="" />CMS</a>
            <ul>
                <li><a href="<?php echo base_url() ?>admin/cms">Manage CMS</a></li>
            </ul>
        </li>
        <li><a class="collapse" href="#"><img src="<?php echo base_url() ?>assets/admin/images/nav/media.png" alt="" />Crew Background</a>
            <ul>
                <li><a  href="<?php echo base_url() ?>admin/sailing"">Sailing Experience</a></li>
                <li><a  href="<?php echo base_url() ?>admin/water"">Water sports Experience</a></li>
                <li><a  href="<?php echo base_url() ?>admin/fishing"">Fishing Experience</a></li>
            </ul>            
        </li>		
        <li><a href="<?php echo base_url() ?>admin/setting" class=""><img src="<?php echo base_url() ?>assets/admin/images/nav/media.png" alt="" />Site Setting</a> </li>
        <li><a href="#" class="collapse"><img src="<?php echo base_url() ?>assets/admin/images/nav/users.png" alt="" />User Mgmt</a>
            <ul>
                <li><a href="<?php echo base_url() ?>admin/users/crew" >Crew</a></li>
                <li><a href="<?php echo base_url() ?>admin/users/owner" >Owner</a></li>
            </ul>
        </li>
        <li><a href="#" class="collapse"><img src="<?php echo base_url() ?>assets/admin/images/nav/users.png" alt="" />Event Mgmt</a>
            <ul>
                <li><a href="<?php echo base_url() ?>admin/events/requests" >Crew created event request</a></li>
                <li><a href="<?php echo base_url() ?>admin/events/posts" >Owner created event post</a></li>
            </ul>
        </li>
        <li><a href="#" class="collapse"><img src="<?php echo base_url() ?>assets/admin/images/nav/users.png" alt="" />Advertisement Mgmt</a>
            <ul>
                <li><a href="<?php echo base_url() ?>admin/advertisement/" >Advertisements</a></li>
            </ul>
        </li>
    </ul>
</aside>
<script type="text/javascript">
    $(document).ready(function() {
        var _parent = $('a.active').parent().parent().parent().children('a.collapse').removeClass('collapse');

    });
</script><section id="content">
		
		<div class="breadcrumb">
			<a href="<?php echo base_url() ?>admin">Admin</a>   &raquo; Dashboard 		</div>
		<table width="100%" cellpadding="0" cellspacing="0" class="today_stats">
			<tr>
				<td><a href="<?php echo base_url() ?>admin/orders"><strong></strong> Orders</a></td>
				<td class="last"><strong></strong> <a href="<?php echo base_url() ?>admin/quotations">Quotations</a></td>
			</tr>
		</table></section>
</body>
</html>