<?php 
// print_r($category_status);
// // print_r($cms_details[0]);
// if(empty($category_status['concept']['cms_id']))
	// {
	// 	echo 'its empty';
	// }
	// print_r($cms_details[0]);
	// die();
	// die();
?>
<div class="textbox">
	<h2>
		<?php echo $cms_details[0]->cms_title;?>
	</h2>
	<?php 
	//print_r($category_status);
	//die();
	?>
	<div class="textbox_content">
		<form action="<?php echo current_url();?>" method="post"
			enctype="multipart/form-data">
			<p>
				<label>For French Language:</label>
			</p>
			<p>
				<label>CMS Title :</label> <br /> <input type="text" size="60"
					class="text" name="cms_title"
					value="<?php 
					if(empty($cms_details[0]->cms_title))
					{
						if($this->input->post('cms_title'))
							echo $this->input->post('cms_title');
					}
					else
					{
						echo $cms_details[0]->cms_title;
					}
					?>" />
			</p>
			<p>
				<label>CMS Description:</label> <br />
				<textarea name="cms_desc" class="wysiwyg">
					<?php 
					if(empty($cms_details[0]->cms_desc))
					{
						if($this->input->post('cms_desc'))
							echo $this->input->post('cms_desc');
					}
					else
					{
						echo $cms_details[0]->cms_desc;
					}
					?>
				</textarea>
			</p>


			<p>
				<label>For German Language:</label>
			</p>
			<p>
				<label>CMS Title :</label> <br /> <input type="text" size="60"
					class="text" name="cms_title_de"
					value="<?php 
					if(empty($cms_details[0]->cms_title_de))
					{
						if($this->input->post('cms_title_de'))
							echo $this->input->post('cms_title_de');
					}
					else
					{
						echo $cms_details[0]->cms_title_de;
					}
					?>" />
			</p>
			<p>
				<label>CMS Description:</label> <br />
				<textarea name="cms_desc_de" class="wysiwyg">
					<?php 
					if(empty($cms_details[0]->cms_desc_de))
					{
						if($this->input->post('cms_desc_de'))
							echo $this->input->post('cms_desc_de');
					}
					else
					{
						echo $cms_details[0]->cms_desc_de;
					}
					?>
				</textarea>
			</p>

			<p>
				<label>CMS Category :</label> <br /> <select name="cms_category"
					class="text">
					<option class="text" value="concept"
					<?php
					if($cms_details[0]->cms_category == 'concept')
						echo "selected = 'selected'";
					?>>concept</option>
					<option class="text" value="project"
					<?php
					if($cms_details[0]->cms_category == 'project')
						echo "selected = 'selected'";
					?>>project</option>
				</select>
				<!-- 
				 <input type="text" size="60"
					class="text" name="cms_category"
					value="<?php 	
					/*
					if(empty($cms_details[0]->cms_category))
					{
						if($this->input->post('cms_category'))
							echo $this->input->post('cms_category');
					}
					else
					{
						echo $cms_details[0]->cms_category;
					}
					*/
					?>" />
				 -->
			</p>
			<?php
			$show_checkbox = 0;
			// condition to show/unshow checkbox

			// if no active cms for either concept or project then show
			if(empty($category_status['concept']['cms_id']) || empty($category_status['project']['cms_id']))
			{
				$show_checkbox = 1;
			}

			else
			{
				// if the active cms is edited then show
				if(($category_status['concept']['cms_id'] == $cms_details[0]->cms_id) || ($category_status['project']['cms_id'] == $cms_details[0]->cms_id))
				{
					// 					echo 'type = "checkbox" ';
					// 					echo 'class="onoffbtn"';
					$show_checkbox = 1;
				}

			}

			//
			?>

			<p class="onoffswitch">

				<input id="cms_active" name="cms_active"
				<?php
				if($show_checkbox == 1)
				{
					echo 'class = "onoffbtn" ';
					echo 'type = "checkbox" ';
				}
				else
				{
					echo 'type = "hidden" ';
				}
				?>
				<?php
				if ($cms_details[0]->cms_active== 'on') {
				?>
					checked="checked" <?php } ?> />
				<?php 
				if($show_checkbox == 1)
				{
					?>
				<label for="cms_active">Active</label>
				<?php 
				}
				?>
			</p>
			<p>
				<input type="hidden" name="cms_id"
					value="<?php echo $cms_details[0]->cms_id;?>" /> <input
					type="submit" class="submit" value="Submit" />
			</p>
		</form>
	</div>
</div>
