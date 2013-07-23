<?php
function icon($name,$icon,$ext='png'){
	$icon = '<img title="'.$name.'" src="'.base_url().'assets/admin/icons/'.$icon.'.'.$ext.'" alt="'.$name.'" />';
	return $icon;
}