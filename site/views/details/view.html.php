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

require_once JPATH_COMPONENT . DIRECTORY_SEPARATOR . 'helpers' . DIRECTORY_SEPARATOR . 'deckcard.php';
class ArtifactGameViewDetails extends JViewLegacy
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

        $cat_hero = getCategoryId('hero');
        $cat_spell = getCategoryId('spell');
        $cat_item = getCategoryId('item');

        $app = JFactory::getApplication();
        $deckCode = $app->input->getString('id');
        $id = getDeckIdByCode($deckCode);
        $db    = JFactory::getDBO();
        $query = $db->getQuery(true);
        $query  ->select('id,name,format, description, color,last_updated, hash, author, published')
                ->from('#__artifactgame_decks')
                ->where($db->quoteName('id') . ' = ' . $db->quote($id));
        $db->setQuery((string) $query);
        $deck = $db->loadObject();
        // Get heroes
//        $query = $db->getQuery(true);
//        $query  ->select('id,name,format, color,last_updated')
//            ->from('#__artifactgame_deck_card')
//            ->where($db->quoteName('id') . ' = ' . $db->quote($id));
        $sql = "SELECT i.id id, i.name title, i.color color FROM #__artifactgame_deck_card c, #__artifactgame_card i WHERE c.deck_id = " . $id . " AND c.card_id = i.id AND i.type ='Hero'";
        //$sql = "SELECT i.id id, title, i.feature_3 color FROM #__artifactgame_deck_card c, #__listofitems_items i WHERE c.deck_id = " . $id . " AND c.card_id = i.id AND i.catid =" . $cat_hero;
        $db->setQuery($sql);
        $this->heroes = $db->loadObjectList();


        $sql = "SELECT i.id id FROM #__artifactgame_deck_card c, #__artifactgame_card i WHERE c.deck_id = " . $id . " AND c.card_id = i.id AND i.type ='Spell'";
        //$sql = "SELECT i.id as id FROM #__artifactgame_deck_card c, #__listofitems_items i WHERE c.deck_id = " . $id . " AND c.card_id = i.id AND i.catid = " . $cat_spell;
        $db->setQuery($sql);
        $this->spells = $db->loadObjectList();

        $sql = "SELECT i.id id, i.name name, i.color color, mana cost, count(i.id) count  FROM #__artifactgame_deck_card c, #__artifactgame_card i WHERE c.deck_id = " . $id . " AND c.card_id = i.id AND i.type ='Spell' group by i.id";
        //$sql = "SELECT i.id id, feature_3 as color, feature_9 as cost, title as name, count(card_id) as count FROM #__artifactgame_deck_card c, #__listofitems_items i WHERE c.deck_id = " . $id . " AND c.card_id = i.id AND i.catid = ". $cat_spell . " GROUP BY c.card_id";
        $db->setQuery($sql);
        $this->spellLines = $db->loadObjectList();

        $sql = "SELECT i.id id FROM #__artifactgame_deck_card c, #__artifactgame_card i WHERE c.deck_id = " . $id . " AND c.card_id = i.id AND i.type ='Item'";
        //$sql = "SELECT i.id id FROM #__artifactgame_deck_card c, #__listofitems_items i WHERE c.deck_id = " . $id . " AND c.card_id = i.id AND i.catid = " . $cat_item;
        $db->setQuery($sql);
        $this->items = $db->loadObjectList();

        $sql = "SELECT i.id id, i.name name, gold cost, count(i.id) count FROM #__artifactgame_deck_card c, #__artifactgame_card i WHERE c.deck_id = " . $id . " AND c.card_id = i.id AND i.type ='Item' group by i.id";
        //$sql = "SELECT i.id id, feature_3 as color, feature_9 as cost, title as name, count(card_id) as count FROM #__artifactgame_deck_card c, #__listofitems_items i WHERE c.deck_id = " . $id . " AND c.card_id = i.id AND i.catid = ". $cat_item . " GROUP BY c.card_id";
        $db->setQuery($sql);
        $this->itemLines = $db->loadObjectList();
        $this->upvotes = getUpvotesCount($id);
		// Assign data to the view
		$this->deck = $deck;
        $user = JFactory::getUser();
        $userId = $user->id;

//            echo '***';
//            echo $deck->author;

        $this->editable = $deck->author === $userId;

        $document = JFactory::getDocument();
        $document->addScript(JPATH_COMPONENT . '/js/jquery.3.2.1.min.js');
        $document->addScript(JPATH_COMPONENT . '/js/chart.min.js');
        $document->addStyleSheet(JPATH_COMPONENT . '/css/datatables.min.css');
        $document->addStyleSheet(JPATH_COMPONENT . '/css/ag.css');
		// Display the view
		parent::display($tpl);
	}
}