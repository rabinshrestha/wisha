<?php 
// print_r($country_details['country']);
// echo '</br></br>fruits';
// print_r($fruit_details['fruit']);
// die();
?>
<div class="textbox">
	<h2>
		<?php echo $recipe_details[0]->recipe_name;?>
	</h2>
	<div class="textbox_content">
		<form action="<?php echo current_url();?>" method="post"
			enctype="multipart/form-data">
			<p>
				<label>For French Language:</label>
			</p>
			<p>
				<label>Recipe Name :</label> <br /> <input type="text" size="60"
					class="text" name="recipe_name"
					value="<?php 
							if(empty($recipe_details[0]->recipe_name))
							{
								if($this->input->post('recipe_name'))
									echo $this->input->post('recipe_name');
							}
							else 
							{
								echo $recipe_details[0]->recipe_name;
							}
							?>" />
			</p>

			<p>
				<label>Recipe Description:</label> <br />
				<textarea name="recipe_desc" class="wysiwyg">
					<?php 
					if(empty($recipe_details[0]->recipe_desc))
					{
						if($this->input->post('recipe_desc'))
							echo $this->input->post('recipe_desc');
					}
					else
					{
						echo $recipe_details[0]->recipe_desc;
					}
					?>
				</textarea>
			</p>
			<p>
				<label>For German Language:</label>
			</p>
			<p>
				<label>Recipe Name :</label> <br /> <input type="text" size="60"
					class="text" name="recipe_name_de"
					value="<?php 
							if(empty($recipe_details[0]->recipe_name_de))
							{
								if($this->input->post('recipe_name_de'))
									echo $this->input->post('recipe_name_de');
							}
							else 
							{
								echo $recipe_details[0]->recipe_name_de;
							}
							?>" />
			</p>

			<p>
				<label>Recipe Description:</label> <br />
				<textarea name="recipe_desc_de" class="wysiwyg">
					<?php 
					if(empty($recipe_details[0]->recipe_desc_de))
					{
						if($this->input->post('recipe_desc_de'))
							echo $this->input->post('recipe_desc_de');
					}
					else
					{
						echo $recipe_details[0]->recipe_desc_de;
					}
					?>
				</textarea>
			</p>

			<p>
				<label>Image:</label> <br /> <input type="file" size="40"
					class="text" name="userfile" value="" />
			</p>
			<p>
				<?php
        if(file_exists('./assets/uploads/recipe/_thumbs/'.$recipe_details[0]->recipe_image)){?>
				<img
					src="<?php echo base_url().'assets/uploads/recipe/_thumbs/'.$recipe_details[0]->recipe_image;?>" />
				<?php }?>
			</p>

			<p>
			
			
			<p class="onoffswitch">
				<input type="checkbox" name="recipe_active" class="onoffbtn"
				<?php if ($recipe_details[0]->recipe_active== 'on') { ?>
					checked="checked" <?php } ?> /> <label>Active</label>
			</p>
			<p>
				<input type="hidden" name="recipe_id"
					value="<?php echo $recipe_details[0]->recipe_id;?>" /> <input
					type="hidden" name="recipe_image_old"
					value="<?php echo $recipe_details[0]->recipe_image;?>" /> <input
					type="submit" class="submit" value="Submit" />
			</p>
		</form>
	</div>
</div>
