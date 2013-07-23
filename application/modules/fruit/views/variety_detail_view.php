

<?php 
// 	print_r($result[0]['fruit_name']);
// 	die();
// print_r($variety);
// die();
$variety_name_column = 'variety_name'.$this->current_lang;
$variety_desc_column = 'variety_desc'.$this->current_lang;
$country_name_column = 'country_name'.$this->current_lang;
$country_slug_column = 'country_slug'.$this->current_lang;
// $variety_desc_column = 'variety_desc'.$this->current_lang;
?>
<div class="mainContenBlock">
	<h2>
		<?php echo $varietyDetail[0][$variety_name_column] ?>
	</h2>


	<p style="text-align: justify;">
		<?php echo $varietyDetail[0][$variety_desc_column] ?>
	</p>



	<p>
		<img class="size-medium wp-image-578 alignnone"
			src="<?php echo base_url('assets/uploads/variety/'.$varietyDetail[0]['variety_image'])?>"
			alt="" width="270" height="179" />
	</p>

</div>

<div class="btnList">
	<ul>
	<?php 
		foreach ($country as $cou)
		{
	?>
			<li><?php echo anchor($this->uri->uri_string().'/'.$cou[$country_slug_column],'<span>'.$cou[$country_name_column].'</span>');?></li>
	<?php 
		}
	?>
	</ul>
</div>

