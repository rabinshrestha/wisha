
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
			$fruit_column_name = 'fruit_name'.$this->current_lang;
			$fruit_column_slug = 'fruit_slug'.$this->current_lang;
// 		print_r($fruits);
			foreach ($fruits as $fruit)
			{
		?>
				<li><?php echo anchor($fruit->$fruit_column_slug,'<span>'.$fruit->$fruit_column_name.'</span>');?>
		<?php 
		}
		?>
		
		

	</ul>
</div>
