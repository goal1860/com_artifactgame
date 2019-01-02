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
class ArtifactGameViewPublish extends JViewLegacy
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
            $response['message']='Only logged in user can modify.';
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
            $deck = getDeckObject($deckId);
        }else{
            $response['success']=false;
            $response['message']='Invalid Deck Code.';
            echo json_encode($response);
            JFactory::getApplication()->close();
            return;
        }

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $published = $deck->published;
        $fields= array($db->quoteName('published') . " = '" . !$published . "'");
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
        if($published){ // Was published
            $response['message']='Successfully unpublished. Only you can see this deck.';
        }else{
            $response['message']='Successfully published. Every one can see this deck.';
        }

        $response['status']=!$published;
        echo json_encode($response);
        JFactory::getApplication()->close();
    }
}