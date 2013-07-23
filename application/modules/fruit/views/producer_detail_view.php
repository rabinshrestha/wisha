

<?php 
// 	print_r($result[0]['fruit_name']);
// 	die();
// print_r($variety);
// die();
$producer_name_column = 'producer_name'.$this->current_lang;
$producer_desc_column = 'producer_desc'.$this->current_lang;
// $country_name_column = 'country_name'.$this->current_lang;
// $variety_desc_column = 'variety_desc'.$this->current_lang;
?>
<div class="mainContenBlock">
	<h2>
		<?php echo $producerDetail[0][$producer_name_column] ?>
	</h2>


	<p style="text-align: justify;">
		<?php echo $producerDetail[0][$producer_desc_column] ?>
	</p>



	<p>
		<img class="size-medium wp-image-578 alignnone"
			src="<?php echo base_url('assets/uploads/producers/'.$imageDetail[0]['image_name'])?>"
			alt="" width="270" height="179" />
	</p>

</div>

<div class="btnList">
	<ul>
		<li><?php echo anchor($this->uri->uri_string().'/gallery','<span>'.lang('common_gallery').'</span>');?>
		</li>
		<li><?php echo anchor($this->uri->uri_string().'/location','<span>'.lang('common_location').'</span>');?>
		</li>
	</ul>
</div>

