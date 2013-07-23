

<?php 
// 	print_r($result[0]['fruit_name']);
// 	die();
// print_r($variety);
// die();
$recipe_name_column = 'recipe_name'.$this->current_lang;
$recipe_desc_column = 'recipe_desc'.$this->current_lang;
// $variety_desc_column = 'variety_desc'.$this->current_lang;
?>
<div class="mainContenBlock">
	<h2>
		<?php echo $recipeDetail[0][$recipe_name_column] ?>
	</h2>


	<p style="text-align: justify;">
		<?php echo $recipeDetail[0][$recipe_desc_column] ?>
	</p>
	<p>
		<img class="size-medium wp-image-578 alignnone"
			src="<?php echo base_url('assets/uploads/recipe/'.$recipeDetail[0]['recipe_image'])?>"
			alt="" width="270" height="179" />
	</p>

</div>

