<?php 
// print_r($country_details['country']);
// echo '</br></br>fruits';
// print_r($fruit_details['fruit']);
// die();
?>
<div class="textbox">
  <h2><?php echo $variety_details[0]->variety_name;?></h2>
  <div class="textbox_content">
    <form action="<?php echo current_url();?>" method="post" enctype="multipart/form-data">
      <p>
      	<label>For French Language:</label>
      </p>
      <p>
        <label>Variety Name :</label>
        <br />
        <input type="text" size="60" class="text" name="variety_name" 
        					value="<?php 
							if(empty($variety_details[0]->variety_name))
							{
								if($this->input->post('variety_name'))
									echo $this->input->post('variety_name');
							}
							else 
							{
								echo $variety_details[0]->variety_name;
							}
							?>"/>
      </p>
     
      <p>
        <label>variety Description:</label>
        <br />
        <textarea name="variety_desc" class="wysiwyg"><?php 
							if(empty($variety_details[0]->variety_desc))
							{
								if($this->input->post('variety_desc'))
									echo $this->input->post('variety_desc');
							}
							else 
							{
								echo $variety_details[0]->variety_desc;
							}
							?></textarea>
      </p>
       <p>
      	<label>For German Language:</label>
      </p>
      <p>
        <label>variety Name :</label>
        <br />
        <input type="text" size="60" class="text" name="variety_name_de" value="<?php 
							if(empty($variety_details[0]->variety_name_de))
							{
								if($this->input->post('variety_name_de'))
									echo $this->input->post('variety_name_de');
							}
							else 
							{
								echo $variety_details[0]->variety_name_de;
							}
							?>"/>
      </p>
      
      <p>
        <label>variety Description:</label>
        <br />
        <textarea name="variety_desc_de" class="wysiwyg"><?php 
							if(empty($variety_details[0]->variety_desc_de))
							{
								if($this->input->post('variety_desc_de'))
									echo $this->input->post('variety_desc_de');
							}
							else 
							{
								echo $variety_details[0]->variety_desc_de;
							}
							?></textarea>
      </p>
      
       <p>
      	<label>Common:</label>
      </p>
      
      <p>
        <label>Fruit Name:</label>
        <br />
        <select name = "fruit_id" class="text" >
        	<?php 
        		foreach ($fruit_details['fruit'] as $fruit)
        		{
        			?>
        			<option class="text" value = <?php echo $fruit->fruit_id;?> 
        				<?php
        					if($fruit->fruit_id == $variety_details[0]->fruit_id)
        						echo "selected = 'selected'";
        					?>>
        				<?php echo $fruit->fruit_name;?>
        			</option> 
    		<?php 
        		}
        		//die();
        	?>
        </select>
        
      </p>
      
      <p>
        <label>Country Name:</label>
        <br />
        <select name = "country_ids[]" class="text" multiple="multiple">
        	<?php 
        		foreach ($country_details['country'] as $country)
        		{
        			?>
        			<option class="text" value = <?php echo $country->country_id;?> >
        				<?php echo $country->country_name;?>
        			</option> 
    		<?php 
        		}
        		//die();
        	?>
        </select>
        
      </p>
      
       <p>
        <label>Image:</label>
        <br />
        <input type="file" size="40" class="text" name="userfile" value="" />
      </p>
      <p>
      <?php
        if(file_exists('./assets/uploads/variety/_thumbs/'.$variety_details[0]->variety_image)){?>
        	<img src="<?php echo base_url().'assets/uploads/variety/_thumbs/'.$variety_details[0]->variety_image;?>" />
		<?php }?>
      </p>
     
      <p>
       <p class="onoffswitch">
                <input type="checkbox" name="variety_active" class="onoffbtn" <?php if ($variety_details[0]->variety_active== 'on') { ?> checked="checked" <?php } ?> />
                <label>Active</label>
            </p>
      <p>
      <input type="hidden" name="variety_id" value="<?php echo $variety_details[0]->variety_id;?>"  />
       <input type="hidden" name="variety_image_old" value="<?php echo $variety_details[0]->variety_image;?>"  />
      <input type="submit" class="submit" value="Submit" />
      </p>
    </form>
  </div>
</div> 
