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
class ArtifactGameViewSave extends JViewLegacy
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
            $response['message']='Only logged in user can edit a deck.';
            echo json_encode($response);
            JFactory::getApplication()->close();
            return;
        }

        $app = JFactory::getApplication();
        JFactory::getDocument()->setMimeEncoding( 'application/json' );
        $postData = $app->input;

        $format = $postData->get('deckFormat') == 1 ? 'Unconfirmed Ruleset' : 'Unconfirmed Ruleset 2';
        $deckName = $postData->getString('deckName');
        $deckCode = $postData->getString('id');

        $deckDescription = $postData->getString('deckDesc');
        $response = [];
        if ($postData->get('heroes')) {
            $heroes = $postData->getArrayRecursive('heroes');
        } else {
            $response['success']=false;
            $response['message']='Heroes are required.';
            echo json_encode($response);
            JFactory::getApplication()->close();
            return;
        }
        if (count($heroes)>5) {
            $response['success']=false;
            $response['message']='Only allow 5 heroes.';
            echo json_encode($response);
            JFactory::getApplication()->close();
            return;
        }
        if ($postData->get('spells')) {
            $spells = $postData->getArrayRecursive('spells');
//            var_dump($spells);
//            die;
        } else {
            $response['success']=false;
            $response['message']='Spells are required.';
            echo json_encode($response);
            JFactory::getApplication()->close();
            return;
        }
        if ($postData->get('items')) {
            $items = $postData->getArrayRecursive('items');
        } else {
            $response['success']=false;
            $response['message']='Items are required.';
            echo json_encode($response);
            JFactory::getApplication()->close();
            return;
        }
        $manaColor = $heroColor = [
            "black" => 0,
            "blue" => 0,
            "red" => 0,
            "green" => 0
        ];
        $totalMana = 0;
        $deckColor = [];
        foreach ($heroes as $hero) {
            $color = strtolower($hero['color']);
            $heroColor[$color]++;
            if(!in_array($color, $deckColor)){
                $deckColor []= $color;
            }
        }
        foreach ($spells as $spell) {
            if($spell['mana'] !== '-') {
                $totalMana += $spell['mana'];
            }
            $manaColor[strtolower($spell['color'])]++;
            if(!in_array(strtolower($spell['color']), $deckColor)){
                $deckColor []= strtolower($spell['color']);
            }
        }

        try {
            $db = JFactory::getDbo();

            if ($deckCode && $deckCode !== "" ) {
                // Exsiting Deck
                $deckId = getDeckIdByCode($deckCode);
                $deckObj = getDeckObject($deckId);
                if ($user->id !== $deckObj->author)
                {
                    $response['success']=false;
                    $response['message']='You are not authorised to save this deck.';
                    echo json_encode($response);
                    JFactory::getApplication()->close();
                    return;
                }
                $db->transactionStart();

                // Delete from gold distribution.
                $query = $db->getQuery(true);
                $query->delete($db->quoteName('#__artifactgame_gold_distribution'));
                $query->where($db->quoteName('deck_id') . ' = ' . $db->quote($deckId));
                $db->transactionCommit();
                $db->setQuery($query);
                $db->execute();


                // Delete from gold distribution.
                $query = $db->getQuery(true);
                $query->delete($db->quoteName('#__artifactgame_mana_distribution'));
                $query->where($db->quoteName('deck_id') . ' = ' . $db->quote($deckId));
                $db->transactionCommit();
                $db->setQuery($query);
                $db->execute();

                // Delete from deck card table.
                $query = $db->getQuery(true);
                $query->delete($db->quoteName('#__artifactgame_deck_card'));
                $query->where($db->quoteName('deck_id') . ' = ' . $db->quote($deckId));
                $db->transactionCommit();
                $db->setQuery($query);
                $db->execute();

                // Update deck
                $deck = new stdClass();
                $deck->id = $deckId;
                $deck->name = $deckName;
                $deck->color = implode(',', $deckColor);
                $deck->description = $deckDescription;
                $deck->format = $format;
                $deck->hero_black = $heroColor['black'];
                $deck->hero_blue = $heroColor['blue'];
                $deck->hero_red = $heroColor['red'];
                $deck->hero_green = $heroColor['green'];
                $deck->mana_black = $manaColor['black'];
                $deck->mana_blue = $manaColor['blue'];
                $deck->mana_red = $manaColor['red'];
                $deck->mana_green = $manaColor['green'];
                $deck->last_updated = JFactory::getDate();
                $db->transactionCommit();
// Update their details in the users table using id as the primary key.
                $result = JFactory::getDbo()->updateObject('#__artifactgame_decks', $deck, 'id', false);


            } else {

                $query = $db->getQuery(true);
                $columns = array('name', 'color', 'description', 'author', 'format', 'hero_black', 'hero_blue', 'hero_red', 'hero_green',
                    'mana_black', 'mana_blue', 'mana_red', 'mana_green', 'last_updated', 'published');


                $values = array(
                    $db->escape($deckName),
                    implode(',', $deckColor),
                    $db->escape($deckDescription),
                    $user->id,
                    $format,
                    $heroColor['black'],
                    $heroColor['blue'],
                    $heroColor['red'],
                    $heroColor['green'],
                    $manaColor['black'],
                    $manaColor['blue'],
                    $manaColor['red'],
                    $manaColor['green'],
                    JFactory::getDate(),
                    true,

                );


                $query
                    ->insert($db->quoteName('#__artifactgame_decks'))
                    ->columns($db->quoteName($columns))
                    ->values("'" . implode("','", $values) . "'");

                $db->setQuery($query);
                $db->execute();
                $deckId = $db->insertid();

                // Update hash.
                $deck = new stdClass();
                $deck->id = $deckId;
                $deck->hash = substr(base64_encode(md5($deckId)), 0, 16);
//                echo $deck->hash;
//                die;
                $result = JFactory::getDbo()->updateObject('#__artifactgame_decks', $deck, 'id', false);
            }

            // Insert cards into deck_card
            foreach ($heroes as $hero) {
                $query = $db->getQuery(true);
                $query
                    ->insert($db->quoteName('#__artifactgame_deck_card'))
                    ->columns($db->quoteName(['deck_id', 'card_id']))
                    ->values("'" . implode("','", [$deckId, $hero['id']]) . "'");
//            echo (string)$query;
//            die;
                $db->setQuery($query);
                $db->execute();
            }

            foreach ($spells as $spell) {
                for ($i = 0; $i < $spell['count']; ++$i) {
                    $query = $db->getQuery(true);
                    $query
                        ->insert($db->quoteName('#__artifactgame_deck_card'))
                        ->columns($db->quoteName(['deck_id', 'card_id']))
                        ->values("'" . implode("','", [$deckId, $spell['id']]) . "'");
//            echo (string)$query;
//            die;
                    $db->setQuery($query);
                    $db->execute();
                }
            }

            foreach ($items as $item) {
                for ($i = 0; $i < $item['count']; ++$i) {
                    $query = $db->getQuery(true);
                    $query
                        ->insert($db->quoteName('#__artifactgame_deck_card'))
                        ->columns($db->quoteName(['deck_id', 'card_id']))
                        ->values("'" . implode("','", [$deckId, $item['id']]) . "'");
                    $db->setQuery($query);
                    $db->execute();
                }
            }

            // Insert into gold_distribution
            $goldCost = [];
            foreach ($items as $item) {
                if (!isset($goldCost[$item['gold']])) {
                    $goldCost[$item['gold']] = 0;
                }
                $goldCost[$item['gold']]++;
            }
            foreach ($goldCost as $key => $value) {
                $query = $db->getQuery(true);
                $query
                    ->insert($db->quoteName('#__artifactgame_gold_distribution'))
                    ->columns($db->quoteName(['deck_id', 'gold_cost', 'count']))
                    ->values("'" . implode("','", [$deckId, $key, $value]) . "'");
                $db->setQuery($query);
                $db->execute();
//            $sql = "INSERT INTO gold_distribution VALUES(default, " . $deckId . "," . $key . "," . $value . ")";
//            $conn->query($sql);
            }
            // Insert into mana_distribution
            $query = $db->getQuery(true);
            $query
                ->insert($db->quoteName('#__artifactgame_mana_distribution'))
                ->columns($db->quoteName(['deck_id', 'mana', 'count_black', 'count_blue', 'count_red', 'count_green']))
                ->values("'" . implode("','", [$deckId, $totalMana, $manaColor['Black'], $manaColor['Blue'], $manaColor['Red'], $manaColor['Green']]) . "'");
            $db->setQuery($query);
            $db->execute();

        }catch (Exception $e)
        {
            // catch any database errors.
            $db->transactionRollback();
            $response['success']=false;
            $response['message']='DB Error: ' . $e->getMessage();
            echo json_encode($response);
            JFactory::getApplication()->close();
        }
//        $sql = "INSERT INTO mana_distribution VALUES(default, " . $deckId . "," . $totalMana . "," . implode(',', $manaColor) . ")";
//        $conn->query($sql);

        $response['success']=true;
        $response['message']='Successfully saved.';
        echo json_encode($response);
        JFactory::getApplication()->close();
    }
}