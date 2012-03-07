<?php
/**
 * @package	Music
 * @subpackage	Songs
 * @copyright	Copyright (C) 2005 - 2007 Open Source Matters. All rights reserved.
 * @copyright   Copyright (C) 2009 Daniel Scott (http://danieljamesscott.org). All rights reserved.
 * @copyright   Copyright (C) 2012 Francisco José Rodríguez Bogado (http://qinn.es). All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant to the
 * GNU General Public License, and as distributed it includes or is derivative
 * of works licensed under the GNU General Public License or other free or open
 * source software licenses. See COPYRIGHT.php for copyright notices and
 * details.
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport( 'joomla.application.component.controller' );
/**
 * Song Song Controller
 *
 * @package		Joomla
 * @subpackage	Song
 * @since 1.5
 */
class MusicControllerSongs extends JController
{
	function __construct()
	{
		parent::__construct();

		// Register Extra tasks
		$this->registerTask( 'add', 'edit' );
	}

	function display()
  	{
	  JRequest::setVar( 'view'  , 'songs');
	  parent::display();
	}

	function edit()
	{
		JRequest::setVar( 'view', 'song' );
		JRequest::setVar('hidemainmenu', 1);

		parent::display();

		// Checkin the song
		$model = $this->getModel('song');
		$model->checkout();
	}

	function save()
	{
		$post	= JRequest::get('post');
		$song_id	= JRequest::getVar( 'cid', array(0), 'post', 'array' );
		$post['id'] = (int) $song_id[0];

		$model = $this->getModel('song');

		if ($model->store($post)) {
			$msg = JText::_( 'Song Saved' );
		} else {
			$msg = JText::_( 'Error Saving Song' );
		}

		// Check the table in so it can be edited.... we are done with it anyway
		$model->checkin();
		$link = 'index.php?option=com_musicona';
		$this->setRedirect($link, $msg);
	}

	function remove()
	{
		global $mainframe;

		$song_id = JRequest::getVar( 'cid', array(), 'post', 'array' );
		JArrayHelper::toInteger($song_id);

		if (count( $song_id ) < 1) {
			JError::raiseError(500, JText::_( 'Select an item to delete' ) );
		}

		$model = $this->getModel('song');
		if(!$model->delete($song_id)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}

		$this->setRedirect( 'index.php?option=com_musicona' );
	}


	function publish()
	{
		global $mainframe;

		$song_id = JRequest::getVar( 'cid', array(), 'post', 'array' );
		JArrayHelper::toInteger($song_id);

		if (count( $song_id ) < 1) {
			JError::raiseError(500, JText::_( 'Select an item to publish' ) );
		}

		$model = $this->getModel('song');
		if(!$model->publish($song_id, 1)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}

		$this->setRedirect( 'index.php?option=com_musicona' );
	}


	function unpublish()
	{
		global $mainframe;

		$song_id = JRequest::getVar( 'cid', array(), 'post', 'array' );
		JArrayHelper::toInteger($song_id);

		if (count( $song_id ) < 1) {
			JError::raiseError(500, JText::_( 'Select an item to unpublish' ) );
		}

		$model = $this->getModel('song');
		if(!$model->publish($song_id, 0)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}

		$this->setRedirect( 'index.php?option=com_musicona' );
	}

	function cancel()
	{
		// Checkin the song
		$model = $this->getModel('song');
		$model->checkin();

		$this->setRedirect( 'index.php?option=com_musicona' );
	}


	function orderup()
	{
		$model = $this->getModel('song');
		$model->move(-1);

		$this->setRedirect( 'index.php?option=com_musicona');
	}

	function orderdown()
	{
		$model = $this->getModel('song');
		$model->move(1);

		$this->setRedirect( 'index.php?option=com_musicona');
	}

	function saveorder()
	{
		$song_id 	= JRequest::getVar( 'cid', array(), 'post', 'array' );
		$order 	= JRequest::getVar( 'order', array(), 'post', 'array' );
		JArrayHelper::toInteger($song_id);
		JArrayHelper::toInteger($order);

		$model = $this->getModel('song');
		$model->saveorder($song_id, $order);

		$msg = 'New ordering saved';
		$this->setRedirect( 'index.php?option=com_musicona', $msg );
	}
}
?>
