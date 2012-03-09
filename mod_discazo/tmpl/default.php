<?php defined('_JEXEC') or die('Restricted access'); // no direct access ?>
<ul>
<?php foreach ($items as $item) { ?>
 <li>
    <a href="<?php echo $item->link; ?>" ><?php echo $item->name; ?></a>
    </li>
<?php } ?>
</ul>
