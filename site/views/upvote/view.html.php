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
class ArtifactGameViewUpvote extends JViewLegacy
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
        $user = JFactory::getUser();        // Get the user object


        if ($user->id === 0)
        {
            $response['success']=false;
            $response['message']='Only logged in user can upvote.';
            echo json_encode($response);
            JFactory::getApplication()->close();
            return;
        }

        $app = JFactory::getApplication();
        JFactory::getDocument()->setMimeEncoding( 'application/json' );
        $postData = $app->input;

        $deckCode = $postData->get('deckId');
        if (!$deckCode) {
            $response['success']=false;
            $response['message']='Deck ID is missing.';
            echo json_encode($response);
            JFactory::getApplication()->close();
            return;
        }
        $deckId = getDeckIdByCode($deckCode);
        if($deckId) {
            $upvotes = getUpvotesCountByUser($deckId, $user->id);
        }else{
            $response['success']=false;
            $response['message']='Invalid Deck Code.';
            echo json_encode($response);
            JFactory::getApplication()->close();
            return;
        }
        if($upvotes > 0) {
            $response['success']=false;
            $response['message']='You have already voted for this deck.';
            echo json_encode($response);
            JFactory::getApplication()->close();
            return;
        }
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $columns = array('deck_id', 'user_id');

        $values = array(
            $deckId, $user->id
            );


        $query
            ->insert($db->quoteName('#__artifactgame_upvotes'))
            ->columns($columns)
            ->values("'".implode("','", $values)."'");

        $db->setQuery($query);
        $db->execute();

        $upvotes = getUpvotesCount($deckId);
        $fields= array($db->quoteName('upvotes') . " = '" . $upvotes . "'");
        $condtions = array($db->quoteName('id') . " = '" . $deckId . "'", );
        $query
            ->update($db->quoteName('#__artifactgame_decks'))
            ->set($fields)
            ->where($condtions);
//        echo (string)$query;
//        die;
        $db->setQuery($query);
        $db->execute();

        $response['success']=true;
        $response['message']='Successfully saved.';
        $response['upvotes']=$upvotes;
        echo json_encode($response);
        JFactory::getApplication()->close();
    }
}