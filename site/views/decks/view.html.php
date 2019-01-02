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

/**
 * HTML View class for the HelloWorld Component
 *
 * @since  0.0.1
 */
class ArtifactGameViewDecks extends JViewLegacy
{
	/**
	 * Display the Hello World view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void
	 */
	function display($tpl = null)
	{
        $db    = JFactory::getDBO();
        $query = $db->getQuery(true);
        $query->select('id,author, name,format, color,last_updated, upvotes');
        $query->from('#__artifactgame_decks');
        $sql = "select d.id id, d.name name, d.hash deckCode, d.format format, d.color color,d.last_updated last_updated, d.upvotes upvotes, u.name author, d.author author_id, d.published published from #__artifactgame_decks d, #__users u where d.author=u.id";
        $db->setQuery($sql);
        $decklist = $db->loadObjectList();
        $user = JFactory::getUser();
        $userId = $user->id;
//        echo $userId;
        foreach ($decklist as $deck){
//            echo '***';
//            echo $deck->author;

            $deck->editable = $deck->author_id === $userId;
        }
//        var_dump($decklist);
//        die;
		// Assign data to the view
		$this->decklist = $decklist;
        $document = JFactory::getDocument();
        $document->addScript(JPATH_COMPONENT . '/js/jquery.3.2.1.min.js');
        $document->addScript(JPATH_COMPONENT . '/js/datatables.min.js');
        $document->addStyleSheet(JPATH_COMPONENT . '/css/datatables.min.css');
        $document->addStyleSheet(JPATH_COMPONENT . '/css/ag.css');

		// Display the view
		parent::display($tpl);
	}
}