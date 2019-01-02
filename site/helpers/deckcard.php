<?php
/**
 * @package List of Items for Joomla! 3.1
 * @version $Id: view.html.php 2014-08-03 01:00:00Z Peter Vavro $
 * @author Peter Vavro
 * @copyright (C) 2014 - Peter Vavro
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

defined('_JEXEC') or die;

function getDeckList()
{
    $db    = JFactory::getDBO();
    $query = $db->getQuery(true);
    $query->select('id,name,color,last_updated');
    $query->from('#__deck');
    $db->setQuery((string) $query);
    $decklist = $db->loadObjectList();

    return $decklist;
}

function getCategoryId($catStr){
    $db    = JFactory::getDBO();
    $query = $db->getQuery(true);
    $query->select('id');
    $query->from('#__categories');
    $query->where($db->quoteName('alias')." = ".$db->quote($catStr));
    $db->setQuery((string) $query);
    $catid = $db->loadResult();
    return $catid;
}

function getK2CategoryId($catStr){
    $db    = JFactory::getDBO();
    $query = $db->getQuery(true);
    $query->select('id');
    $query->from('#__k2_categories');
    $query->where($db->quoteName('alias')." = ".$db->quote($catStr));
    $db->setQuery((string) $query);
    $catid = $db->loadResult();
    return $catid;
}

function getCards($type) {
    $db    = JFactory::getDBO();
    $query = $db->getQuery(true);
    $query->select('*');
    $query->from('#__artifactgame_card');
    $query->where($db->quoteName('type')." = ".$db->quote($type));
    $db->setQuery((string) $query);
    $itemlist = $db->loadObjectList();
    return $itemlist;
}

function getUpvotesCount($deckId) {
    $db    = JFactory::getDBO();
    $query = $db->getQuery(true);
    $query->select('count(*) as totalLikes');
    $query->from('#__artifactgame_upvotes');
    $query->where($db->quoteName('deck_id')." = ".$db->quote($deckId));
    $db->setQuery( $query);
    $upvotes = $db->loadResult();
    return $upvotes;
}

function getUpvotesCountByUser($deckId, $userId) {
    $db    = JFactory::getDBO();
    $query = $db->getQuery(true)
                ->select('count(*) as totalLikes')
                ->from('#__artifactgame_upvotes')
                ->where($db->quoteName('deck_id')." = ".$db->quote($deckId))
                ->andwhere($db->quoteName('user_id')." = ".$db->quote($userId));
    $db->setQuery( $query);
    $upvotes = $db->loadResult();
    return $upvotes;

}

function getDeckObject($deckId){
    $db    = JFactory::getDBO();
    $query = $db->getQuery(true);
    $query->select('*');
    $query->from('#__artifactgame_decks');
    $query->where($db->quoteName('id')." = ".$db->quote($deckId));
    $db->setQuery($query);
    $details = $db->loadObject();
    return $details;
}

function getDeckDetails($deckId) {
    $db    = JFactory::getDBO();
    $sql = "select d.author author, c.name name, c.id id, c.type type, c.color color, c.revealed status, c.mana mana, c.gold gold, c.sigOf sigOf, count(*) count from #__artifactgame_deck_card dc, #__artifactgame_decks d, #__artifactgame_card c where dc.deck_id=d.id and dc.card_id=c.id and  d.id='" . $deckId . "' group by dc.card_id";

    $db->setQuery($sql);
    $details = $db->loadObjectList();
    return $details;
}

function getDeckIdByCode($code) {
    $db    = JFactory::getDBO();
    $query = $db->getQuery(true);
    $query->select('id');
    $query->from('#__artifactgame_decks');
    $query->where($db->quoteName('hash')." = ".$db->quote($code));
    $db->setQuery($query);
    $id = $db->loadResult();
    return $id;
}

function getV2Cards(){
    $db    = JFactory::getDBO();
    $query = $db->getQuery(true);
    $query->select('*');
    $query->from('#__artifactgame_cardv2');
    $db->setQuery((string) $query);
    $itemlist = $db->loadObjectList();
    return $itemlist;
}