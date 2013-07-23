

<?php 
// 	print_r($result[0]['fruit_name']);
// 	die();
// print_r($variety);
// die();
$country_name_column = 'country_name'.$this->current_lang;
$country_desc_column = 'country_desc'.$this->current_lang;
$producer_name_column = 'producer_name'.$this->current_lang;
$producer_slug_column = 'producer_slug'.$this->current_lang;
// $variety_desc_column = 'variety_desc'.$this->current_lang;
?>
<div class="mainContenBlock">
	<h2>
		<?php echo $countryDetail[0][$country_name_column] ?>
	</h2>


	<p style="text-align: justify;">
		<?php echo $countryDetail[0][$country_desc_column] ?>
	</p>



	<!-- 
	<p>
		<img class="size-medium wp-image-578 alignnone"
			src="<?php //echo base_url('assets/uploads/country/'.$varietyDetail[0]['variety_image'])?>"
			alt="" width="270" height="179" />
	</p>
	 -->

</div>

<div class="btnList">
	<ul>
	<?php 
		foreach ($producer as $pro)
		{
	?>
			<li><?php echo anchor($this->uri->uri_string().'/'.$pro[$producer_slug_column],'<span>'.$pro[$producer_name_column].'</span>');?></li>
	<?php 
		}
	?>
	</ul>
</div>

