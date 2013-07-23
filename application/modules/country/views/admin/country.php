<form action="" method="post" name="userForm">
<input type="button" value="Create New" class="submit" onclick="CreateNew();">
  <table cellpadding="0" cellspacing="0" width="100%" class="sortable">
  	<col /><col /><col /><col width="5%" /><col width="5%" />
    <thead>
      <tr>
        <th width="10">#</th>
        <th>Country Name(fr)</th>
        <th>Country Name(de)</th>
        <th style="text-align:center">Status</th>
        <th style="text-align:center">Edit</th>
        <th style="text-align:center">Delete</th>
      </tr>
    </thead>
    <tbody>
    <?php $i=1;foreach($countries as $country){?>
      <tr>
        <td><?php echo ($page['limitstart']+$i)?></td>
        <td>
        <a class="tooltip" rel="<?php //echo //$advertise->advertise_image;?>"><?php echo $country->country_name;?></a>
        </td>
         <td>
        <a class="tooltip" rel="<?php //echo //$advertise->advertise_image;?>"><?php echo $country->country_name_de;?></a>
        </td>
        

        <td style="text-align:center"><?php if($country->country_active=='on') echo 'Active'; else echo 'Inactive';?></td>
        <td style="text-align:center"><a href="<?php echo site_url();?>admin/country/edit/<?php echo $country->country_id;?>"><?php echo icon('Edit','edit','png');?></a></td>
        <td style="text-align:center"><a onclick="Delete('<?php echo $country->country_id; ?>')"><?php echo icon('Delete','delete','png');?></a></td>
      </tr>
      <?php $i++; }?>
    </tbody>
  </table>  
  <div class="table_pagination right"><?php echo $pagination;?></div>  
</form>
<script type="text/javascript">
function Delete(country){
	if(confirm('Are you to delete this state')){
		var frm = document.userForm;
		frm.action = '<?php echo site_url();?>admin/country/delete/'+country;
		frm.submit();
	}
}
function CreateNew(){
	window.location='<?php echo site_url();?>admin/country/create';
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
