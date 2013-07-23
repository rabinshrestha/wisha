<div class="textbox">
	<h2>Admin Details</h2>
	<div class="textbox_content">
		<form action="<?php echo current_url(); ?>" method="post">

			<h3>Contact details</h3>
			<p>
				<label>First Name :</label> <br /> <input type="text" size="60"
					class="text" name="first_name"
					value="<?php echo set_value('first_name', $user_details['login_firstname']); ?>" />
			</p>
			<p>
				<label>Last Name:</label> <br /> <input type="text" size="60"
					class="text" name="last_name"
					value="<?php echo set_value("last_name", $user_details['login_lastname']); ?>" />
			</p>

			<p>
				<label>Email:</label> <br /> <input type="text" size="60"
					class="text" name="user_email"
					value="<?php echo set_value('user_email', $user_details['login_email']); ?>" />
			</p>
			<p>
				<label>Login UserName:</label> <br /> <input type="text" size="60"
					class="text" name="user_name"
					value="<?php echo set_value('user_name', $user_details['login_name']); ?>" />
			</p>
			<p>
				<label>Password:</label> <br /> <input type="password" size="60"
					class="text" name="password"
					value="<?php echo set_value('password'); ?>" />
			</p>
			<p>
				<label>Confirm Password:</label> <br /> <input type="password"
					size="60" class="text" name="cofirm_password"
					value="<?php echo set_value('confirm_password'); ?>" />
			</p>
			<p>
				<input type="hidden" name="user_id"	value="<?php echo $user_details['login_id']; ?>" /> 
				<input type="submit" class="submit" value="Submit" />
			</p>
		</form>
	</div>
</div>


