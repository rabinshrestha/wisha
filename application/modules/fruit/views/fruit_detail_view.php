

<?php 
// 	print_r($result[0]['fruit_name']);
// 	die();
// print_r($variety);
// die();
$fruit_name_column = 'fruit_name'.$this->current_lang;
$fruit_slug_column = 'fruit_slug'.$this->current_lang;
$fruit_desc_column = 'fruit_desc'.$this->current_lang;
$variety_name_column = 'variety_name'.$this->current_lang;
$variety_slug_column = 'variety_slug'.$this->current_lang;
// $variety_desc_column = 'variety_desc'.$this->current_lang;
?>
<div class="mainContenBlock">
	<h2>
		<?php echo $fruitDetail[0][$fruit_name_column] ?>
	</h2>


	<p style="text-align: justify;">
		<?php echo $fruitDetail[0][$fruit_desc_column] ?>
	</p>



	<p>
		<img class="size-medium wp-image-578 alignnone"
			src="<?php echo base_url('assets/uploads/fruits/'.$fruitDetail[0]['fruit_image'])?>"
			alt="" width="270" height="179" />
	</p>

</div>

<div class="btnList">
	<ul>
	<?php 
		foreach ($variety as $var)
		{
	?>
			<li><?php echo anchor($this->uri->uri_string().'/'.$var[$variety_slug_column],'<span>'.$var[$variety_name_column].'</span>');?></li>
	<?php 
		}
	?>
	</ul>
</div>

