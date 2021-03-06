<?php defined('_JEXEC') or die('Restricted access'); ?>

<?php JHTML::_('behavior.tooltip'); ?>

<?php
	// Set toolbar items for the page
	$edit		= JRequest::getVar('edit',true);
	$text = !$edit ? JText::_( 'New' ) : JText::_( 'Edit' );
	JToolBarHelper::title(   JText::_( 'Song' ).': <small><small>[ ' . $text.' ]</small></small>' );
	JToolBarHelper::save();
	if (!$edit)  {
		JToolBarHelper::cancel();
	} else {
		// for existing items the button is renamed `close`
		JToolBarHelper::cancel( 'cancel', 'Close' );
	}
	JToolBarHelper::help( 'screen.song.edit' );
?>

<script language="javascript" type="text/javascript">
	function submitbutton(pressbutton) {
		var form = document.adminForm;
		if (pressbutton == 'cancel') {
			submitform( pressbutton );
			return;
		}

		// do field validation
		if (form.name.value == ""){
			alert( "<?php echo JText::_( 'Song item must have a title', true ); ?>" );
		} else if (form.albumid.value == "0"){
			alert( "<?php echo JText::_( 'You must select an album', true ); ?>" );
		} else {
			submitform( pressbutton );
		}
	}
</script>
<style type="text/css">
	table.paramlist td.paramlist_key {
		width: 92px;
		text-align: left;
		height: 30px;
	}
</style>

<form action="index.php" method="post" name="adminForm" id="adminForm">
<div class="col50">
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'Details' ); ?></legend>

		<table class="admintable">
				<tr>
					<td class="key">
						<label for="name">
							<?php echo JText::_( 'Name' ); ?>:
						</label>
					</td>
					<td >
						<input class="inputbox" type="text" name="name" id="name" size="60" maxlength="255" value="<?php echo $this->song->name; ?>" />
					</td>
				</tr>
				<tr>
					<td class="key">
						<label for="alias">
							<?php echo JText::_( 'Alias' ); ?>:
						</label>
					</td>
					<td >
						<input class="inputbox" type="text" name="alias" id="alias" size="60" maxlength="255" value="<?php echo $this->song->alias; ?>" />
					</td>
				</tr>
				<tr>
					<td class="key">
						<?php echo JText::_( 'Published' ); ?>:
					</td>
					<td>
						<?php echo $this->lists['published']; ?>
					</td>
				</tr>
				<tr>
					<td class="key">
						<label for="albumid">
							<?php echo JText::_( 'Album' ); ?>:
						</label>
					</td>
					<td>
						<?php echo $this->lists['albumid'];?>
					</td>
				</tr>
				<tr>
					<td valign="top" class="key">
						<label for="ordering">
							<?php echo JText::_( 'Ordering' ); ?>:
						</label>
					</td>
					<td>
						<?php echo $this->lists['ordering']; ?>
					</td>
				</tr>
				<?php
				if ($this->song->id) {
					?>
					<tr>
						<td class="key">
							<label>
								<?php echo JText::_( 'ID' ); ?>:
							</label>
						</td>
						<td>
							<strong><?php echo $this->song->id;?></strong>
						</td>
					</tr>
					<?php
				}
				?>
	</table>
	</fieldset>

			<fieldset class="adminform">
				<legend><?php echo JText::_( 'Information' ); ?></legend>

				<table class="admintable">
				<tr>
					<td class="key">
					<label for="number">
						<?php echo JText::_( 'Song Number' ); ?>:
						</label>
					</td>
					<td>
						<input class="inputbox" type="text" name="number" id="number" size="10" maxlength="10" value="<?php echo $this->song->number; ?>" />
					</td>
				</tr>
				<tr>
					<td class="key">
						<label for="mp3">
							<?php echo JText::_( 'MP3' ); ?>:
						</label>
					</td>
					<td >
						<?php echo $this->lists['mp3']; ?>
					</td>
				</tr>				
             	<tr>
					<td class="key">
						<label for="link">
							<?php echo JText::_( 'Link' ); ?>:
						</label>
					</td>
					<td >
						<input class="inputbox" type="text" name="link" id="link" value="<?php echo $this->song->link; ?>" />
					</td>
				</tr>
              </table>
			</fieldset>

</div>
<div class="col50">
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'Parameters' ); ?></legend>

		<table class="admintable">
		<tr>
			<td colspan="2">
				<?php 
		echo $this->params->render();
?>
			</td>
		</tr>
		</table>
	</fieldset>
</div>

<div class="col50">
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'Description' ); ?></legend>

		<table class="admintable">
		</table>
	</fieldset>
</div>
<div class="clr"></div>

<input type="hidden" name="option" value="com_musicona" />
<input type="hidden" name="cid[]" value="<?php echo $this->song->id; ?>" />
<input type="hidden" name="task" value="" />
</form>
