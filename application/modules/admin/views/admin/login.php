<script type="text/javascript">
$(document).ready(function(){
	$('#username').focus();
});
</script>
	<section id="content" class="loginbox">
		<?php $this->load->view('dashboard/system_messages');?>
		<form action="<?php echo current_url();?>" method="post">
			<p>
				<label>Username:</label> <br />
				<input type="text" class="text" name="username" value="" id="username" />
			</p>
			
			<p>
				<label>Password:</label> <br />
				<input type="password" class="text" name="password" value="" id="password" />
			</p>
			
			<p class="formend">
				<input type="submit" class="submit" value="Login" />			</p>
		</form>
	</section>		