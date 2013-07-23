
<div class="mainContenBlock">
	<h2>
		<?php 
		$title = 'cms_title'.$this->current_lang;
		echo $value->$title;
		?>
	</h2>
	<p>
		<?php
		$desc = 'cms_desc'.$this->current_lang;
		echo $value->$desc;
		//die();
		?>
	</p>
	<img src="<?php echo base_url('assets/extras/images/img-1.gif');?>"
		alt="
		" title="" />
</div>
<!--     <div class="btnList"> -->
<!--     	<ul> -->
<!--         	<li><a href="#"><span>Voir toute la galerie</span></a></li> -->
<!--             <li><a href="#"><span>Voir toute la galerie</span></a></li> -->
<!--         </ul> -->
<!--     </div> -->
