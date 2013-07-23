<div class="textbox">
  <h2><?php echo $fruit_details[0]->fruit_name;?></h2>
  <div class="textbox_content">
    <form action="<?php echo current_url();?>" method="post" enctype="multipart/form-data">
      <p>
      	<label>For French Language:</label>
      </p>
      <p>
        <label>Fruit Name :</label>
        <br />
        <input type="text" size="60" class="text" name="fruit_name" value="<?php 
					if(empty($fruit_details[0]->fruit_name))
					{
						if($this->input->post('fruit_name'))
							echo $this->input->post('fruit_name');
					}
					else
					{
						echo $fruit_details[0]->fruit_name;
					}
					?>"/>
      </p>
      <p>
        <label>Description:</label>
        <br />
        <textarea name="fruit_desc" class="wysiwyg">
        			<?php 
					if(empty($fruit_details[0]->fruit_desc))
					{
						if($this->input->post('fruit_desc'))
							echo $this->input->post('fruit_desc');
					}
					else
					{
						echo $fruit_details[0]->fruit_desc;
					}
					?></textarea>
      </p>
      <p>
      	<label>For German Language:</label>
      </p>
      <p>
        <label>Fruit Name :</label>
        <br />
        <input type="text" size="60" class="text" name="fruit_name_de" value="<?php 
					if(empty($fruit_details[0]->fruit_name_de))
					{
						if($this->input->post('fruit_name_de'))
							echo $this->input->post('fruit_name_de');
					}
					else
					{
						echo $fruit_details[0]->fruit_name_de;
					}
					?>"/>
      </p>
      <p>
        <label>Description:</label>
        <br />
        <textarea name="fruit_desc_de" class="wysiwyg"><?php 
					if(empty($fruit_details[0]->fruit_desc_de))
					{
						if($this->input->post('fruit_desc_de'))
							echo $this->input->post('fruit_desc_de');
					}
					else
					{
						echo $fruit_details[0]->fruit_desc_de;
					}
					?></textarea>
      </p>
      <p>
        <label>Image:</label>
        <br />
        <input type="file" size="40" class="text" name="userfile" value="" />
      </p>
      <p>
      <?php
        if(file_exists('./assets/uploads/fruits/_thumbs/'.$fruit_details[0]->fruit_image)){?>
        	<img src="<?php echo base_url().'assets/uploads/fruits/_thumbs/'.$fruit_details[0]->fruit_image;?>" />
		<?php }?>
      </p>
       <p class="onoffswitch">
                <input type="checkbox" name="fruit_active" class="onoffbtn" <?php if ($fruit_details[0]->fruit_active== 'on') { ?> checked="checked" <?php } ?> />
                <label>Active</label>
            </p>
      <p>
      <p>
      <input type="hidden" name="fruit_id" value="<?php echo $fruit_details[0]->fruit_id;?>"  />
      <input type="hidden" name="fruit_image_old" value="<?php echo $fruit_details[0]->fruit_image;?>"  />
      <input type="submit" class="submit" value="Submit" />
      </p>
    </form>
  </div>
</div> 
