<?php
defined('_JEXEC') or die('Direct Access to this location is not allowed.');

class ModAlbumHelper {
  /**
   * Returns a list of albums
   */
  public function getAlbums($albumCount) {
    // get a reference to the database
    $db = &JFactory::getDBO();

    // get a list of $userCount randomly ordered users
    $query = 'SELECT al.* FROM jos_albums AS al LEFT JOIN jos_artists ar ON al.artistid = ar.id WHERE al.published = 1 AND ar.published = 1 ORDER BY al.ordering ASC LIMIT 0, ' . $albumCount;

    $db->setQuery($query);
    $items = ($items = $db->loadObjectList())?$items:array();

    for ( $item = 0; $item < sizeof($items); $item++ ) {
      //              http://localhost/index.php?option=com_musicona&view=album&album_id=1&Itemid=10
      $items[$item]->link = JRoute::_('index.php?option=com_musicona&view=album&album_id=' . $items[$item]->id);
      // $items[$item]->link = JRoute::_('index.php?option=com_musicona&view=album&cid=' . $items[$item]->id);
    }

    return $items;
  }
}
