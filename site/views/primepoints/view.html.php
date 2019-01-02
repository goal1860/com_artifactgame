<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_artifact_game
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

require_once JPATH_COMPONENT . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'pp.php';
class ArtifactGameViewprimepoints extends JViewLegacy
{

	function display($tpl = null)
	{
	    $user = JFactory::getUser();
	    $user_id = $user->id;
	    $this->points = getTotalPoints($user_id);
	    $this->history = getPPHistory($user_id);
		parent::display($tpl);
	}
}