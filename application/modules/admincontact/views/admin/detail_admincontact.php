<div class="textbox">
	<h2>
		<?php echo $message[0]->contact_subject;?>
	</h2>
	<div class="textbox_content">
		<?php 
		// 		print_r($message);
		// 		exit;
		?>

		<p>
			<label>Subject :</label> <br /> <input type="text" size="60"
				 value="<?php echo $message[0]->contact_subject;?>" />
		</p>
		<p>
			<label>E-mail :</label> <br /> <input type="text" size="60"
				 value="<?php echo $message[0]->contact_email;?>" />
		</p>
		<p>
			<label>From :</label> <br /> <input type="text" size="60"
				 value="<?php echo $message[0]->contact_first_name;?>" />
		</p>
		<p>
			<label>Message:</label> <br />
			<textarea >
					<?php echo $message[0]->contact_message;?>
				</textarea>
		</p>
	</div>
</div>
