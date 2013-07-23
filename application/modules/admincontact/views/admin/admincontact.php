<form action="" method="post" name="userForm">
	<!-- 
<input type="button" value="Create New" class="submit" onclick="CreateNew();">
 -->
	<table cellpadding="0" cellspacing="0" width="100%" class="sortable">
		<col />
		<col />
		<col />
		<col width="5%" />
		<col width="5%" />
		<thead>
			<tr>
				<th width="10">#</th>
				<th>From</th>
				<th>Subject</th>
				<th style="text-align: center">Status</th>
				<th style="text-align: center">Detail</th>
				<th style="text-align: center">Delete</th>
			</tr>
		</thead>
		<tbody>

			<?php $i=1;foreach($message as $mess){?>
			<tr>
				<td><?php echo ($page['limitstart']+$i)?></td>
				<td><a class="tooltip" rel=""><?php echo $mess->contact_first_name;?>
				</a>
				</td>
				<td><a class="tooltip" rel=""><?php echo $mess->contact_subject;?> </a>
				</td>


				<td style="text-align: center"><?php if($mess->contact_isread == 1) echo 'Read'; else echo 'Unread';?>
				</td>
				<td style="text-align: center"><a
					href="<?php echo site_url();?>admin/admincontact/detail/<?php echo $mess->contact_id;?>"><?php echo icon('Show','show','png');?>
				</a></td>
				<td style="text-align: center"><a
					onclick="Delete('<?php echo $mess->contact_id; ?>')"><?php echo icon('Delete','delete','png');?>
				</a></td>
			</tr>
			<?php $i++; 
}?>
		</tbody>
	</table>
	<div class="table_pagination right">
		<?php echo $pagination;?>
	</div>
</form>
<script type="text/javascript">
function Delete(message){
	if(confirm('Are you to delete this message')){
		var frm = document.userForm;
		frm.action = '<?php echo site_url();?>admin/admincontact/delete/'+message;
		frm.submit();
	}
}

$(document).ready(function(){
	$('.tooltip').live({
		mouseenter:
           function()
           {	
		   		var image = $(this).attr('rel');
           },
        mouseleave:
           function()
           {
           }
	})
});
</script>
