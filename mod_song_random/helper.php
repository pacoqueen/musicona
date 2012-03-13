<?php
defined('_JEXEC') or die('Direct Access to this location is not allowed.');

class ModSongRandomHelper {
  /**
   * Returns a random song
   */
  public function getSongRandom($album = '', $show_player_plugin = 0, $player_plugin, $player_plugin_options) {
    // get a reference to the database
    $db = &JFactory::getDBO();

    switch($album) {
    case '':
      // All albums
      $query = 'SELECT so.* FROM #__songs AS so LEFT JOIN #__albums al ON so.albumid = al.id WHERE so.published = 1 AND al.published = 1 ';
      break;
    default:
      $query = 'SELECT so.* FROM #__songs AS so LEFT JOIN #__albums al ON so.albumid = al.id WHERE so.published = 1 AND al.published = 1 and so.albumid = ' . $album;
    }
    $db->setQuery($query);
    $items = ($items = $db->loadObjectList())?$items:array();

    $songID = rand(0, sizeof($items)-1);
    $item = $items[$songID];

    // Add a ' ' to the options field
    if ($player_plugin_options != "") {
      $player_plugin_options = " " . $player_plugin_options;
    }

    // Wrap the mp3 name in {play}{/play} tags for plugin.
    if ($item->mp3 != '' && $show_player_plugin) {
      $item->plugin_code = JHTML::_('content.prepare',"{" . $player_plugin . $player_plugin_options . "}images".DS."songs".DS. $item->mp3 . "{/" . $player_plugin . "}");
    } else {
      $item->plugin_code = '';
    }
    return $item;
  }

}