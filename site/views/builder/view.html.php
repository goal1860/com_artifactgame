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
class ArtifactGameViewBuilder extends JViewLegacy
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
        $user = JFactory::getUser();
        $this->loggedIn = ($user->id !== 0);

//        $cat_hero = getCategoryId('hero');
//        $cat_spell = getCategoryId('spell');
//        $cat_item = getCategoryId('item');

        $this->cardlist = getCards('Hero');
        $this->spelllist = getCards('Spell');
        $this->itemlist = getCards('Item');
        $document = JFactory::getDocument();
        $document->addScript(JPATH_COMPONENT . '/js/jquery.3.2.1.min.js');
        $document->addScript(JPATH_COMPONENT . '/js/datatables.min.js');
        $document->addScript(JPATH_COMPONENT . '/js/chart.min.js');
        $document->addScript(JPATH_COMPONENT . '/js/toastr.min.js');
        $document->addScript(JPATH_COMPONENT . '/js/common.js');
        $app = JFactory::getApplication();
        $postData = $app->input;
        if ($postData->getString('id') && $postData->getString('id') !== "") {
            $document->addScript(JPATH_COMPONENT . '/js/edit.js');
            $this->deckCode = $postData->get('id');
        }else{
            $document->addScript(JPATH_COMPONENT . '/js/main.js');
            $this->deckCode = "";
        }

        $document->addStyleSheet(JPATH_COMPONENT . '/css/datatables.min.css');
        $document->addStyleSheet(JPATH_COMPONENT . '/css/ag.css');

        // Display the view
        parent::display($tpl);
    }


}