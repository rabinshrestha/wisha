<div class="footerBlock">
	<span class="copyRight fLeft">2012 &copy; Wisha</span>
	<div class="languageBlock fRight webkit-me">
		<span>Deutsch</span>
		<ul class="dropList">
			<li><?php echo anchor($this->lang->switch_uri('de'),'Deutsch');?>
			</li>
			<li><?php echo anchor($this->lang->switch_uri('fr'),'Français');?>
			</li>

		</ul>
	</div>

</div>
</div>
<script
	type="text/javascript"
	src="<?php echo base_url('assets/extras/js/jquery-1.2.6.min.js'); ?> "></script>
<script type="text/javascript">
$(function() {
	
	$('.languageBlock span').click(function() {
  		$('.dropList').css('display','block');
	});	
	$('.dropList li a').click(function() {
  		$('.dropList').css('display','none');
	});
});


</script>
</body>
</html>
