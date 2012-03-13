<?php
//no direct access
defined('_JEXEC') or die('Direct Access to this location is not allowed.');

// include the helper file
require_once(dirname(__FILE__).DS.'helper.php');

// get a parameter from the module's configuration
$albumID = $params->get('albumid');
$show_player_plugin = $params->get('show_player_plugin');
$player_plugin = $params->get('player_plugin');
$player_plugin_options = $params->get('player_plugin_options');

// get the items to display from the helper
$item = ModSongRandomHelper::getSongRandom($albumID, $show_player_plugin, $player_plugin, $player_plugin_options);

// include the template for display
require(JModuleHelper::getLayoutPath('mod_song_random'));