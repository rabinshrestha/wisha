<form action="" method="post" name="userForm">
    <input type="button" value="Create New Owner" class="submit" onclick="CreateNew();">
    <table cellpadding="0" cellspacing="0" width="100%" class="sortable">
        <col width="1%" /><col /><col /><col /><col /><col width="5%" /><col width="5%" />
        <thead>
            <tr>
                <th width="10">#</th>

                <th>First Name</th>
                <th>Last name</th>
                <th>Email</th>
                
                <th>Status</th>
                <th style="text-align:center">Edit</th>
                <th style="text-align:center">Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($users as $user) { ?>
                <tr>
                    <td><?php echo ($page['limitstart'] + $i); ?></td>

                    <td><?php echo $user->login_firstname; ?></td>
                    <td><?php echo $user->login_lastname; ?></td>
                    <td><?php echo $user->login_email; ?></td>
                    
                    <td><?php echo $user->login_status == 1 ? 'Active' : 'Inactive'; ?></td>
                    <td style="text-align:center"><a href="<?php echo base_url(); ?>admin/users/edit/<?php echo $user->login_id; ?>"><?php echo icon('Edit', 'edit', 'png'); ?></a></td>
                    <td style="text-align:center"><a onclick="Delete('<?php echo $user->login_id; ?>')"><?php echo icon('Delete', 'delete', 'png'); ?></a></td>
                </tr>
    <?php $i++;
} ?>
        </tbody>
    </table>  
    <div class="table_pagination right"><?php echo $pagination; ?></div>  
</form>
<script type="text/javascript">
        function Delete(user_id) {
            if (confirm('Are you sure to delete this user?')) {
                var frm = document.userForm;
                frm.action = '<?php echo site_url(); ?>admin/users/delete/' + user_id;
                frm.submit();
            }
        }
        function CreateNew() {
            window.location = '<?php echo site_url(); ?>admin/users/create';
        }
</script>
