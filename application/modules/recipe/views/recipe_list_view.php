
<div class="btnList">
	<ul>
		<!-- 		<li><a href="le-concept-wisha"><span>Le concept Wisha</span> </a></li> -->
		<!-- 		<li><a href="fruit"><span>Les fruits</span> </a></li> -->
		<!-- 		<li><a href="#"><span>Les recettes</span> </a></li> -->
		<!-- 		<li><a href="les-projets-sociaux"><span>Les projects sociaux</span> </a> -->
		<!-- 		</li> -->
		<!-- 		<li><a href="contact"><span>Contact</span> </a></li> -->

		<?php //echo lang('home_concept');?>
		<?php 
			$recipe_column_name = 'recipe_name'.$this->current_lang;
			$recipe_column_slug = 'recipe_slug'.$this->current_lang;
// 		print_r($fruits);
			foreach ($recipies as $recipe)
			{
		?>
				<li><?php echo anchor($this->uri->uri_string().'/'.$recipe->$recipe_column_slug,'<span>'.$recipe->$recipe_column_name.'</span>');?>
		<?php 
		}
		?>
		
		

	</ul>
</div>
