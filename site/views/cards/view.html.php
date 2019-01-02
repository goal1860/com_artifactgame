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
class ArtifactGameViewCards extends JViewLegacy
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
        $document = JFactory::getDocument();
        $document->addScript(JPATH_COMPONENT . '/js/jquery.3.2.1.min.js');
        $document->addScript(JPATH_COMPONENT . '/js/datatables.min.js');
        $document->addScript(JPATH_COMPONENT . '/js/cardlist.js');
        $document->addStyleSheet(JPATH_COMPONENT . '/css/datatables.min.css');
                $document->addStyleSheet(JPATH_COMPONENT . '/css/ag.css');

        $view = JRequest::getWord('view');
        $task = 'category';
        $application = JFactory::getApplication();
        $model = $this->getModel('itemlist');
        $db = JFactory::getDbo();


        // Get category
        $id = getK2CategoryId('all-cards');
        JTable::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR.'/tables');
        $category = JTable::getInstance('K2Category', 'Table');
        $category->load($id);
        $category->event = new stdClass;

        // State check
        if (!$category->published || $category->trash)
        {
            JError::raiseError(404, JText::_('K2_CATEGORY_NOT_FOUND'));
        }


        if (K2_JVERSION != '15')
        {

            $languageFilter = $application->getLanguageFilter();
            $languageTag = JFactory::getLanguage()->getTag();
            if ($languageFilter && $category->language != $languageTag && $category->language != '*')
            {
                return;
            }
        }



        // Merge params
        $cparams = class_exists('JParameter') ? new JParameter($category->params) : new JRegistry($category->params);


        // Get the meta information before merging params since we do not want them to be inherited
        $category->metaDescription = $cparams->get('catMetaDesc');
        $category->metaKeywords = $cparams->get('catMetaKey');
        $category->metaRobots = $cparams->get('catMetaRobots');
        $category->metaAuthor = $cparams->get('catMetaAuthor');

        if ($cparams->get('inheritFrom'))
        {
            $masterCategory = JTable::getInstance('K2Category', 'Table');
            $masterCategory->load($cparams->get('inheritFrom'));
            $cparams = class_exists('JParameter') ? new JParameter($masterCategory->params) : new JRegistry($masterCategory->params);
        }
        $params = $cparams;

        // Category link
//        $category->link = urldecode(JRoute::_(K2HelperRoute::getCategoryRoute($category->id.':'.urlencode($category->alias))));

        // Category image
//        $category->image = K2HelperUtilities::getCategoryImage($category->image, $params);

        // Category plugins
        $dispatcher = JDispatcher::getInstance();
        JPluginHelper::importPlugin('content');

        if (K2_JVERSION != '15')
        {
            $dispatcher->trigger('onContentPrepare', array(
                'com_k2.category',
                &$category,
                &$params,
                0
            ));
        }
        else
        {
            $dispatcher->trigger('onPrepareContent', array(
                &$category,
                &$params,
                0
            ));
        }



        // Category K2 plugins
        $category->event->K2CategoryDisplay = '';
        JPluginHelper::importPlugin('k2');
        $results = $dispatcher->trigger('onK2CategoryDisplay', array(
            &$category,
            &$params,
            0
        ));
        $category->event->K2CategoryDisplay = trim(implode("\n", $results));
        $category->text = $category->description;
        $dispatcher->trigger('onK2PrepareContent', array(
            &$category,
            &$params,
            0
        ));
        $category->description = $category->text;

        $this->assignRef('category', $category);

        // Category children
        $ordering = $params->get('subCatOrdering');
        $children = $model->getCategoryFirstChildren($id, $ordering);

        if (count($children))
        {
            foreach ($children as $child)
            {
                if ($params->get('subCatTitleItemCounter'))
                {
                    $child->numOfItems = $model->countCategoryItems($child->id);
                }
                $child->image = K2HelperUtilities::getCategoryImage($child->image, $params);
                $child->name = htmlspecialchars($child->name, ENT_QUOTES);
//                $child->link = urldecode(JRoute::_(K2HelperRoute::getCategoryRoute($child->id.':'.urlencode($child->alias))));
                $subCategories[] = $child;
            }
            $this->assignRef('subCategories', $subCategories);
        }

        // Set limit
        $limit = $params->get('num_leading_items') + $params->get('num_primary_items') + $params->get('num_secondary_items') + $params->get('num_links');

        // Set featured flag
        JRequest::setVar('featured', $params->get('catFeaturedItems'));

        // Set layout
//        $this->setLayout('category');

        // Set title
//        $title = $category->name;
//        $category->name = htmlspecialchars($category->name, ENT_QUOTES);

        // Set ordering
        if ($params->get('singleCatOrdering'))
        {
            $ordering = $params->get('singleCatOrdering');
        }
        else
        {
            $ordering = $params->get('catOrdering');
        }

//        $addHeadFeedLink = $params->get('catFeedLink');






        // Set limit for model
        if (!$limit)
            $limit = 1000;
        JRequest::setVar('limit', $limit);

        // Get items
        if (!isset($ordering))
        {
            $items = $model->getData($id);
        }
        else
        {
            $items = $model->getData($id, $ordering);
        }

        //Prepare items
        $cache = JFactory::getCache('com_k2_extended');
        $model = $this->getModel('item');

        for ($i = 0; $i < sizeof($items); $i++)
        {

            // Ensure that all items have a group. If an item with no group is found then assign to it the leading group
//            $items[$i]->itemGroup = 'leading';

            //$items[$i] = $model->prepareItem($items[$i], $view, $task);
            JTable::getInstance('K2Category', 'Table');
            $items[$i] = $cache->call(array(
                $model,
                'prepareItem'
            ), $items[$i], $view, $task);

            // Plugins
            //$items[$i] = $model->execPlugins($items[$i], $view, $task);


        }

        // Set title
        $document = JFactory::getDocument();
        $application = JFactory::getApplication();
//        $menus = $application->getMenu();
//        $menu = $menus->getActive();



        if (K2_JVERSION != '15')
        {

            // Menu metadata options
            if ($params->get('menu-meta_description'))
            {
                $document->setDescription($params->get('menu-meta_description'));
            }

            if ($params->get('menu-meta_keywords'))
            {
                $document->setMetadata('keywords', $params->get('menu-meta_keywords'));
            }

            if ($params->get('robots'))
            {
                $document->setMetadata('robots', $params->get('robots'));
            }

            // Menu page display options
            if ($params->get('page_heading'))
            {
                $params->set('page_title', $params->get('page_heading'));
            }
            $params->set('show_page_title', $params->get('show_page_heading'));

        }




        $items = getV2Cards();

        $this->assignRef('items', $items);




        $this->assignRef('params', $params);




        $nullDate = $db->getNullDate();
        $this->assignRef('nullDate', $nullDate);
        $dispatcher = JDispatcher::getInstance();

        $summary = $model->getTypeSummary();


        $this->assignRef('summary', $summary);
		// Display the view
		parent::display($tpl);
	}
}