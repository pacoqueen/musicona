<?php defined('_JEXEC') or die('Restricted access'); // no direct access ?>
<ul>
<?php foreach ($items as $item) { ?>
  <li>
    <?php
        if ($item->albumart_front){
	    echo '<a href="'.$item->link.'"><img src="images/albumart/'.$item->albumart_front.'" hspace="6" height="100px" width="100px" alt="'.$item->name.' '.JText::_( 'Front Albumart' ).'"/></a>';
        }
    ?>
  </li>
<?php } ?>
</ul>
