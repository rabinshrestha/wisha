<script src="<?php base_url().'assets/extras/js/jquery.js'?>">
</script>
<script type="text/javascript">
 $(document).ready(function(){
 var count = $('#producer_image_count').val();
		$('#add_button').click(function(){
			count++;
			//increase producer_image_count
			$('#producer_image_count').val(count);
			$('#add_image').append('<p><label>Image'+count+':</label> <br /> <input type="file" size="40" class="text"	name="userfile'+count+'" value="" />	<input type="hidden" name="producer_image_old'+count+'"	value="0" /></p>');
			
			});

	 });
</script>
<div class="textbox">
	<h2>
		<?php echo $producer_details[0]->producer_name;?>
	</h2>
	<div class="textbox_content">
		<form action="<?php echo current_url();?>" method="post"
			enctype="multipart/form-data">
			<p>
				<label>For French Language:</label>
			</p>
			<p>
				<label>Producer Name :</label> <br /> <input type="text" size="60"
					class="text" name="producer_name"
					value="<?php 
							if(empty($producer_details[0]->producer_name))
							{
								if($this->input->post('producer_name'))
									echo $this->input->post('producer_name');
							}
							else 
							{
								echo $producer_details[0]->producer_name;
							}
							?>" />
			</p>
			<p>
				<label>Producer Country :</label> <br /> <select name="country_id"
					class="text">
					<?php 
					foreach ($country_list['country'] as $country)
					{
						?>
					<option class="text" value=<?php echo $country->country_id;?>
					<?php
					if($country->country_id == $producer_details[0]->country_id)
						echo "selected = 'selected'";
					?>>
						<?php echo $country->country_name;?>
					</option>
					<?php 
					}
					//die();
					?>
				</select>

			</p>
			<p>
				<label>Producer Description:</label> <br />
				<textarea name="producer_desc" class="wysiwyg">
					<?php 
					if(empty($producer_details[0]->producer_desc))
					{
						if($this->input->post('producer_desc'))
							echo $this->input->post('producer_desc');
					}
					else
					{
						echo $producer_details[0]->producer_desc;
					}



					?>
				</textarea>
			</p>
			<p>
				<label>For German Language:</label>
			</p>
			<p>
				<label>Producer Name :</label> <br /> <input type="text" size="60"
					class="text" name="producer_name_de"
					value="<?php 
							if(empty($producer_details[0]->producer_name_de))
							{
								if($this->input->post('producer_name_de'))
									echo $this->input->post('producer_name_de');
							}
							else 
							{
								echo $producer_details[0]->producer_name_de;
							}
							?>" />
			</p>
			<p>
				<label>Producer Country :</label> <br /> <select
					name="country_id_de" class="text">
					<?php 
					foreach ($country_list['country'] as $country)
					{
						?>
					<option class="text" value=<?php echo $country->country_id;?>
					<?php
					if($country->country_id == $producer_details[0]->country_id)
						echo "selected = 'selected'";
					?>>
						<?php echo $country->country_name_de;?>
					</option>
					<?php 
					}
					//die();
					?>
				</select>

			</p>
			<p>
				<label>Producer Description:</label> <br />
				<textarea name="producer_desc_de" class="wysiwyg">
					<?php 
					if(empty($producer_details[0]->producer_desc_de))
					{
						if($this->input->post('producer_desc_de'))
							echo $this->input->post('producer_desc_de');
					}
					else
					{
						echo $producer_details[0]->producer_desc_de;
					}
					?>
				</textarea>
			</p>

			<p>
				<label>Producer Location(Google map link):</label> <br />
				<textarea name="producer_location">
					<?php 
					if(empty($producer_details[0]->producer_location))
					{
						if($this->input->post('producer_location'))
							echo $this->input->post('producer_location');
					}
					else
					{
						echo $producer_details[0]->producer_location;
					}
					?>
				</textarea>
			</p>
			<a id="add_button">Add Image</a>

			<?php 
			$i = 1;
			foreach ($image_list as $image)
			{
				// 					print_r($image_list);
				// 					die();
				?>
			<input type="hidden" name="producer_image_old<?php echo $i;?>"
				value="<?php echo $image['image_name'];?>" />
			<p>
				<label>Image<?php echo $i;?>:
				</label> <br /> <input type="file" size="40" class="text"
					name="userfile<?php echo $i;?>" value="" />
			</p>
			<p>
				<?php
       			 if(file_exists('./assets/uploads/producers/_thumbs/'.$image['image_name'])){?>
				<img
					src="<?php echo base_url().'./assets/uploads/producers/_thumbs/'.$image['image_name'];?>" />
				<?php }?>
			</p>
			<?php 

			$i++;
			}
			?>
			<p id="add_image"></p>

			<p class="onoffswitch">
				<input type="checkbox" name="producer_active" class="onoffbtn"
				<?php if ($producer_details[0]->producer_active== 'on') { ?>
					checked="checked" <?php } ?> /> <label>Active</label>
			</p>
			<p>
			
			
			<p>
				<input type="hidden" name="producer_image_count"
					id='producer_image_count' value="<?php echo $i-1;?>" /> <input
					type="hidden" name="producer_image_old_count"
					value="<?php echo $i-1;?>" />
				<?php 
				// input old image file name for deletion
				// 				echo $i-1;
				// 				die();
				?>
				<input type="hidden" name="producer_id"
					value="<?php echo $producer_details[0]->producer_id;?>" /> <input
					type="submit" class="submit" value="Submit" />
			</p>
		</form>
	</div>
</div>
