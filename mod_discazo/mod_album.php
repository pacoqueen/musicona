<?php
//no direct access
defined('_JEXEC') or die('Direct Access to this location is not allowed.');

// include the helper file
require_once(dirname(__FILE__).DS.'helper.php');

// get a parameter from the module's configuration
$albumCount = $params->get('albumcount');

// get the items to display from the helper
$items = ModAlbumHelper::getAlbums($albumCount);

// include the template for display
require(JModuleHelper::getLayoutPath('mod_album'));