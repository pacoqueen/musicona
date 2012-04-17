<?php defined('_JEXEC') or die('Restricted access'); // no direct access ?>
<?php 
    $albumid = $item->albumid;
    $db =& JFactory::getDBO();
    $sql = "SELECT * FROM #__albums WHERE id=" . $albumid;
    $db->setQuery($sql);
    $results = $db->loadObjectList();
    if (count($results)){
        foreach($results as $r){
            echo "<!-- mod_random: album art -->";
            if ($r->albumart_front){
                echo "<div class=albumart_random>"; 
                echo '<img src="images/albumart/' . $r->albumart_front . '" hspace="6" height="100px" width="100px" alt="'. $r->album->name . ' ' . JText::_( 'Front Albumart' ) . '" />'; 
                echo "</div>";
            }
        }
    }
?>
<a href="<?php echo 'images/songs/' . $item->mp3; ?>" ><?php echo $item->name; ?></a>
<?php print $item->plugin_code; ?>


