<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=7" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width;" />
<title><?php echo $template['title']?></title>
<?php echo $template['metadata']?>
</head>
<body>
<?php
$this->load->view('dashboard/header');
$this->load->view('dashboard/left_part');
?>
<section id="content">
		
		<div class="breadcrumb">
			<?php $i=0; foreach($template['breadcrumbs'] as $breadcrumb){
				if($breadcrumb['uri'] && $i>0){
					echo '  &raquo; ';
				}
				if($breadcrumb['uri']){
					echo '<a href="'.$breadcrumb['uri'].'">'.$breadcrumb['name'].'</a> ';
				}else{
					echo ($breadcrumb['name'])?'  &raquo; '.$breadcrumb['name'].' ':'';
				}$i++;
			}?>
		</div>
		<?php $this->load->view('dashboard/system_messages');?>
<?php echo $template['body'];?>
</section>
</body>
</html>