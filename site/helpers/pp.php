<?php
/**
 * @package List of Items for Joomla! 3.1
 * @version $Id: view.html.php 2014-08-03 01:00:00Z Peter Vavro $
 * @author Peter Vavro
 * @copyright (C) 2014 - Peter Vavro
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 **/

defined('_JEXEC') or die;

function getPPHistory($user_id){
    $db    = JFactory::getDBO();
    $query = $db->getQuery(true);
    $query->select('*');
    $query->from('#__artifactgame_pphistory');
    $query->where($db->quoteName('user_id')." = ".$db->quote($user_id));
    $query->order('datetime DESC');
    $query->setLimit(50);
    $db->setQuery($query);
    $details = $db->loadObjectList();
    return $details;
}

function getTotalPoints($user_id){
    $db    = JFactory::getDBO();
    $query = $db->getQuery(true);
    $query->select('sum(points)');
    $query->from('#__artifactgame_pphistory');
    $query->where($db->quoteName('user_id')." = ".$db->quote($user_id));

    $db->setQuery($query);
    $points = $db->loadResult();
    if(!$points) $points = 0;
    return $points;
}