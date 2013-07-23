<?php
defined('BASEPATH') or die('Direct access is not allowed');
$link = $this->uri->segment('2');
?>
<aside>
	<ul id="nav">
		<li><a href="<?php echo base_url() ?>admin"
		<?php if ($link == 'dashboard') { ?> class="active" <?php } ?>><?php
		if ($link == 'dashboard') {
                    echo '<strong>';
                }
                ?><img
				src="<?php echo base_url() ?>assets/admin/images/nav/dashboard.png"
				alt="" />Dashboard<?php
				if ($link == 'dashboard') {
                    echo '</strong>';
                }
                ?>
		</a></li>
	<li><a href="#" class="collapse"><img
				src="<?php echo base_url() ?>assets/admin/images/nav/users.png"
				alt="" />User Mgmt</a>
			<ul>
				<li><a href="<?php echo base_url() ?>admin/users/owner"
				<?php if ($link == 'users') { ?> class="active" <?php } ?>>Admin</a>
				</li>

			</ul>
		</li>
		<li><a href="#" class="collapse"><img
				src="<?php echo base_url() ?>assets/admin/images/nav/media.png"
				alt="" />CMS</a>
			<ul>
				<li><a href="<?php echo base_url(); ?>admin/admincms"
				<?php if ($link == 'cms') { ?> class="active" <?php } ?>>Manage CMS</a>
				</li>
			</ul>
		</li>
		<li><a href="<?php echo base_url(); ?>admin/admincontact" class=""><img
				src="<?php echo base_url() ?>assets/admin/images/nav/media.png"
				alt="" />Contact Messages</a>
		</li>
		<li><a href="#" class="collapse"><img
				src="<?php echo base_url() ?>assets/admin/images/nav/users.png"
				alt="" />Fruit Mgmt</a>
			<ul>
				<li><a href="<?php echo base_url(); ?>admin/adminfruit"
				<?php if ($link == 'adminfruit') { ?> class="active" <?php } ?>>Fruit
						Management</a></li>
			</ul>
		</li>
		
		<li><a href="#" class="collapse"><img
				src="<?php echo base_url() ?>assets/admin/images/nav/users.png"
				alt="" />Country Mgmt</a>
			<ul>
				<li><a href="<?php echo base_url() ?>admin/country/"
				<?php if ($link == 'country') { ?> class="active" <?php } ?>>Countries</a>
				</li>
			</ul>
		</li>
		<li><a class="collapse" href="#"><img
				src="<?php echo base_url() ?>assets/admin/images/nav/media.png"
				alt="" />Fruits Variety</a>
			<ul>
				<li><a href="<?php echo base_url(); ?>admin/adminvariety"
				<?php if ($link == 'adminvariety') { ?> class="active"<?php } ?>">Fruit
						Variety</a></li>
			</ul>
		</li>

		
	
		<li><a href="#" class="collapse"><img
				src="<?php echo base_url() ?>assets/admin/images/nav/users.png"
				alt="" />Producer Mgmt</a>
			<ul>
				<li><a href="<?php echo base_url() ?>admin/adminproducer/"
				<?php if ($link == 'events') { ?> class="active" <?php } ?>>Producers</a>
				</li>
			</ul>
		</li>
		<li><a href="#" class="collapse"><img
				src="<?php echo base_url() ?>assets/admin/images/nav/users.png"
				alt="" />Recipe Mgmt</a>
			<ul>
				<li><a href="<?php echo base_url() ?>admin/adminrecipe/"
				<?php if ($link == 'adminrecipe') { ?> class="active" <?php } ?>>Recipe</a>
				</li>
			</ul>
		</li>
	</ul>
</aside>
<script type="text/javascript">
    $(document).ready(function() {
        var _parent = $('a.active').parent().parent().parent().children('a.collapse').removeClass('collapse');

    });
</script>
