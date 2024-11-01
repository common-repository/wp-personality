<?php
/*
Plugin Name: WordPress Personality
Plugin URI: http://blakepeterman.com/
Description: This is a plugin to give a little more personality to the WordPress admin panel.  This is indeed a serviceware plugin.
Author: Blake Peterman
Version: 1.1
Author URI: http://blakepeterman.com/
*/
function gettheline() {
	global $current_user;
    get_currentuserinfo();
    $user = $current_user->display_name;
	$info = file_get_contents('http://blakepeterman.com/wp-personality/personality-data.php');
	$info = str_replace("%user%", $user, $info);
	return $info;
	
}

function personality() {
	$chosen = gettheline();
	echo "<p id='personality'>$chosen</p>";
}

add_action( 'admin_notices', 'personality' );

function personality_css() {
	$x = is_rtl() ? 'left' : 'right';

	echo "
	<style type='text/css'>
	#personality {
		float: $x;
		padding-$x: 15px;
		padding-top: 5px;		
		margin: 0;
		font-size: 11px;
	}
	</style>
	";
}

add_action( 'admin_head', 'personality_css' );
?>