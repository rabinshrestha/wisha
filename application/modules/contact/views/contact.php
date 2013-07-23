<?php 
/*
 if($this->session->flashdata('contact_error'))
 {
print_r($this->session->flashdata('contact_error'));
die();
}
*/
?>

<script>

	$(document).ready(function(){
	
		$("#validate").click(function(){
			//console.log($('#your-first-name').val());
				var test = true;
				var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

				$('#error-firstname').hide();
				$('#error-email').hide();
				$('#error-subject').hide();
				$('#error-message').hide();
				$('#error-captcha').hide();
				$('#error-captcha-unmatch').hide();
				
				if($('#your-first-name').val() == '')
				{
					test = false;
					$('#error-firstname').show();
					//$('#error-firstname').after('<span>please enter your first name.</span>');
				}


				// for email address validation
				var emailAddVal = $('#your-email').val();
				if(emailAddVal == '')
				{
					test = false;
					$('#error-email').show();
				}
				else if(!emailReg.test(emailAddVal))
				{
					test = false;
					$('#error-email').show();
				}

				if($('#your-subject').val() == '')
				{
					test = false;
					$('#error-subject').show();
				}
				if($('#your-msg').val() == '')
				{
					test = false;
					$('#error-message').show();
				}
				if($('#your-captcha').val() == '')
				{
					test = false;
					$('#error-captcha').show();
				}

				if(test)
				{
					$('#contact-form').submit();
				}
		});
});
</script>

<div class="mainContenBlock">
	<h2>Contact</h2>
	<div class="" style="float: left; padding: 20px">
		<form action="<?php echo current_url().'/sucess';?>" method="post"
			id="contact-form">
			<div align="left">
				<?php echo lang('contact_firstname').' *'?>
				<br> <span> <input type="text" id="your-first-name"
					name="your-first-name"
					value="<?php 
									echo set_value('your-first-name');
									echo $this->session->flashdata('contact_first_name');
									
								?>"
					size="40">
				</span>
				<h4 style="display: none; color: red;" id="error-firstname">
					<?php echo lang('contact_firstname_error');?>
				</h4>
			</div>
			<div align="left">
				<?php echo lang('contact_lastname')?>
				<br> <span> <input type="text" name="your-last-name"
					value="<?php 
									echo set_value('your-last-name');
									echo $this->session->flashdata('contact_last_name');
								?>"
					size="40">
				</span>
			</div>
			<div align="left">
				<?php echo lang('contact_email').' *'?>
				<br> <span> <input id="your-email" type="text" name="your-email"
					value="<?php 
									echo set_value('your-email');
									echo $this->session->flashdata('contact_email');
								?>"
					size="40">
				</span>
				<h4 style="display: none; color: red;" id="error-email">
					<?php echo lang('contact_email_error');?>
				</h4>
			</div>
			<div align="left">
				<?php echo lang('contact_captcha').' *';
				// create captcha
				$vals = array(
						'img_path'	 => './assets/captcha/',
						'img_url'	 => base_url().'assets/captcha/',
// 						'font_path'	 => './path/to/fonts/texb.ttf',
// 						'img_width'	 => '60',
// 						'img_height' => 20,
						'expiration' => 3600
				);
				$cap = create_captcha($vals);
				$data = array(
						'captcha_time'	=> $cap['time'],
						'ip_address'	=> $this->input->ip_address(),
						'word'	 => $cap['word']
				);

				$query = $this->db->insert_string('captcha', $data);
				$this->db->query($query);
				// 				echo $cap['image'];
				?>
				<br>
				<!-- 				<div> -->
				<!-- 					<img alt="captcha" -->
				<!-- 						src="./Contact_files/46799463.png" width="60" height="20">  -->
				<span><?php echo $cap['image'];?> </span> <span><input type="text"
					name="your-captcha" id="your-captcha" value="" size="14"> </span>
				<h4 style="display: none; color: red;" id="error-captcha">
					<?php echo lang('contact_captcha_error');?>
				</h4>
				<h4 id="error-captcha-unmatch" style="color: red;"><?php 
				if($this->session->flashdata('contact_captcha_error'))
				{
					echo lang('contact_captcha_error_unmatch');
				}
				
				?></h4>
				<!-- 				</div> -->

			</div>
			<div align="left">
				<?php echo lang('contact_subject').' *'?>
				<br> <span> <input type="text" id="your-subject" name="your-subject"
					value="<?php 
									echo set_value('your-subject');
									echo $this->session->flashdata('contact_subject');
								?>"
					size="40">
				</span>
				<h4 style="display: none; color: red;" id="error-subject">
					<?php echo lang('contact_subject_error');?>
				</h4>
			</div>
			<div align="left">
				<?php echo lang('contact_message').' *'?>
				<br> <span> <textarea id="your-msg" name="your-message" cols="40"
						rows="10"><?php 
						echo set_value('your-message');
						echo $this->session->flashdata('contact_message');
						?></textarea>
				</span>
				<h4 style="display: none; color: red;" id="error-message">
					<?php echo lang('contact_message_error');?>
				</h4>
			</div>

		</form>
		<div align="left">
			<span><button id="validate">
					<?php echo lang('contact_submit');?>
				</button> </span>
		</div>
	</div>
	<div style="clear: both"></div>

</div>
