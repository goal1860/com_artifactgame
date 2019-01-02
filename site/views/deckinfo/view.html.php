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
class artifactgameViewdeckInfo extends JViewLegacy
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
            $response['message']='Only logged in user can save a deck.';
            echo json_encode($response);
            JFactory::getApplication()->close();
            return;
        }

        $app = JFactory::getApplication();
        JFactory::getDocument()->setMimeEncoding( 'application/json' );
        $postData = $app->input;

        $deckCode = $postData->getString('id');
        if ($deckCode) {
            $deckId = getDeckIdByCode($deckCode);
        } else {
            $response['success'] = false;
            $response['message'] = 'No valid deck id in the request.';
            echo json_encode($response);
            JFactory::getApplication()->close();
            return;

        }
//array_key_exists

        $response = array('hero'=>[], 'spell'=>[], 'item'=>[]);
        $deckDetails = getDeckDetails($deckId);
        if ($user->id !== $deckDetails[0]->author)
        {
            $response['success']=false;
            $response['message']='You are not authorised to retrieve details.';
            echo json_encode($response);
            JFactory::getApplication()->close();
            return;
        }
        foreach ($deckDetails as $card){
            $type = $card->type;
            if($type === 'Hero'){
                $response['hero'] []= array('id' => $card->id, 'color'=>$card->color, 'name'=>$card->name);
            }elseif($type === 'Spell') {
                $response['spell'] []=
                    array('id' => $card->id,
                        'color'=>$card->color,
                        'name'=>$card->name,
                        'mana'=>$card->mana,
                        'hero'=>$card->sigOf,
                        'status'=>$card->status,
                        'count'=>$card->count,
                    );
            }else {
                $response['item'] [] =
                    array('id' => $card->id,
                        'name' => $card->name,
                        'gold' => $card->gold,
                        'count' => $card->count,
                    );
            }
        }
        $deck = getDeckObject($deckId);
        $response['name'] = $deck->name;
        $response['description'] = $deck->description;
        echo json_encode($response);
        JFactory::getApplication()->close();
    }
}