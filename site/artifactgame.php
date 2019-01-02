<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
$input = JFactory::getApplication()->input;
$vewName = $input->getView('view', '');
$task = $input->getCmd('task');
jimport('joomla.filesystem.file');
jimport('joomla.html.parameter');

if (JFile::exists(JPATH_COMPONENT.'/controllers/'.$vewName.'.php'))
{
    $classname = 'ArtifactGameController'.$vewName;
    if(!class_exists($classname))
        require_once(JPATH_COMPONENT.'/controllers/'.$vewName.'.php');
    $controller = new $classname();

}else {
// Get an instance of the controller prefixed by ArtifactGame
    $controller = JControllerLegacy::getInstance('ArtifactGame');
}
// Perform the Request task


$controller->execute($input->getCmd('task'));

// Redirect if set by the controller
$controller->redirect();