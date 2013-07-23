<form action="" method="post" name="userForm">
<input type="button" value="Create New" class="submit" onclick="CreateNew();">
  <table cellpadding="0" cellspacing="0" width="100%" class="sortable">
  	<col /><col /><col width="5%" /><col width="5%" /><col width="5%" />
    <thead>
      <tr>
        <th width="10">#</th>
        <th>Producer Name(fr)</th>
        <th>Producer Country(fr)</th>
        <th>Status</th>
        <th style="text-align:center">Edit</th>
        <th style="text-align:center">Delete</th>
      </tr>
    </thead>
    <tbody>
    <?php $i=1;foreach($producers as $producer){?>
      <tr>
        <td><?php echo ($page['limitstart']+$i)?></td>
        <td>
        <a class="tooltip" rel="<?php //echo //$advertise->advertise_image;?>"><?php echo $producer->producer_name;?></a>
        </td>
        <td>
        <a class="tooltip" rel="<?php //echo //$advertise->advertise_image;?>"><?php echo $producer->country_name;?></a>
        </td>
        <td style="text-align:center"><?php if($producer->producer_active == 'on') echo 'Active' ; else echo 'Inactive';?></td>
        
        <td style="text-align:center"><a href="<?php echo site_url();?>admin/adminproducer/edit/<?php echo $producer->producer_id;?>"><?php echo icon('Edit','edit','png');?></a></td>
        <td style="text-align:center"><a onclick="Delete('<?php echo $producer->producer_id; ?>')"><?php echo icon('Delete','delete','png');?></a></td>
      </tr>
      <?php $i++; }?>
    </tbody>
  </table>  
  <div class="table_pagination right"><?php echo $pagination;?></div>  
</form>
<script type="text/javascript">
function Delete(producer){
	if(confirm('Are you to delete this producer')){
		var frm = document.userForm;
		frm.action = '<?php echo site_url();?>admin/adminproducer/delete/'+producer;
		frm.submit();
	}
}
function CreateNew(){
	window.location='<?php echo site_url();?>admin/adminproducer/create';
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
