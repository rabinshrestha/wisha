<?php if(validation_errors()){?>
<div class="message errormsg"><p><?php echo validation_errors(); ?></p></div>
<?php }?>
<?php 
if($this->session->flashdata('success_save')){?>
	<div class="message success"><p><?php echo $this->session->flashdata('success_save');?></p></div>
<?php }?>
<?php 
if($this->session->flashdata('failure_save')){?>
	<div class="message errormsg"><p><?php echo $this->session->flashdata('failure_save');?></p></div>
<?php }?>
<?php 
if($this->session->flashdata('login_error')){?>
	<div class="message errormsg"><p><?php echo $this->session->flashdata('login_error');?></p></div>
<?php }?>
<?php
if($this->session->flashdata('page_errror')){?>
	<div class="message errormsg"><p><?php echo $this->session->flashdata('page_errror');?></p></div>
<?php }?>
<?php 
if($this->session->flashdata('success_delete')){?>
	<div class="message success"><p><?php echo $this->session->flashdata('success_delete');?></p></div>
<?php }?>
<?php 
if($this->session->flashdata('failure_delete')){?>
	<div class="message errormsg"><p><?php echo $this->session->flashdata('failure_delete');?></p></div>
<?php }?>
<?php 
if($this->session->flashdata('warning_message')){?>
	<div class="message warning"><p><?php echo $this->session->flashdata('warning_message');?></p></div>
<?php }?>