<div class="textbox">
	<h2>
		<?php echo $country_details[0]->country_name;?>
	</h2>
	<div class="textbox_content">
		<form action="<?php echo current_url();?>" method="post"
			enctype="multipart/form-data">
			<p>
				<label>For French Language:</label>
			</p>
			<p>
				<label>Country Name :</label> <br /> <input type="text" size="60"
					class="text" name="country_name"
					value="<?php 
					if(empty($country_details[0]->country_name))
					{
						if($this->input->post('country_name'))
							echo $this->input->post('country_name');
					}
					else
					{
						echo $country_details[0]->country_name;
					}
					?>" />
			</p>
			<p>
				<label>Description:</label> <br />
				<textarea name="country_desc" class="wysiwyg">
					<?php 
					if(empty($country_details[0]->country_desc))
					{
						if($this->input->post('country_desc'))
							echo $this->input->post('country_desc');
					}
					else
					{
						echo $country_details[0]->country_desc;
					}
					?>
				</textarea>
			</p>
			<p>
				<label>For French Language:</label>
			</p>
			<p>
				<label>Country Name :</label> <br /> <input type="text" size="60"
					class="text" name="country_name_de"
					value="<?php 
					if(empty($country_details[0]->country_name_de))
					{
						if($this->input->post('country_name_de'))
							echo $this->input->post('country_name_de');
					}
					else
					{
						echo $country_details[0]->country_name_de;
					}
					?>" />
			</p>
			<p>
				<label>Description:</label> <br />
				<textarea name="country_desc_de" class="wysiwyg">
					<?php 
					if(empty($country_details[0]->country_desc_de))
					{
						if($this->input->post('country_desc_de'))
							echo $this->input->post('country_desc_de');
					}
					else
					{
						echo $country_details[0]->country_desc_de;
					}
					?>
				</textarea>
			</p>
			<p class="onoffswitch">
				<input type="checkbox" name="country_active" class="onoffbtn"
				<?php if ($country_details[0]->country_active== 'on') { ?>
					checked="checked" <?php } ?> /> <label>Active</label>
			</p>
			<p>
			
			
			<p>
				<input type="hidden" name="country_id"
					value="<?php echo $country_details[0]->country_id;?>" /> <input
					type="submit" class="submit" value="Submit" />
			</p>
		</form>
	</div>
</div>
