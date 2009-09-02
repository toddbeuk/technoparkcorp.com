<?php
/**
 *
 * Copyright (c) 2008, TechnoPark Corp., Florida, USA
 * All rights reserved. THIS IS PRIVATE SOFTWARE.
 *
 * Redistribution and use in source and binary forms, with or without modification, are PROHIBITED
 * without prior written permission from the author. This product may NOT be used anywhere
 * and on any computer except the server platform of TechnoPark Corp. located at
 * www.technoparkcorp.com. If you received this code occacionally and without intent to use
 * it, please report this incident to the author by email: privacy@technoparkcorp.com or
 * by mail: 568 Ninth Street South 202 Naples, Florida 34102, the United States of America,
 * tel. +1 (239) 243 0206, fax +1 (239) 236-0738.
 *
 * @author Yegor Bugaenko <egor@technoparkcorp.com>
 * @copyright Copyright (c) TechnoPark Corp., 2001-2009
 * @version $Id$
 *
 */

/**
 * Panel pages
 *
 * @package Controllers
 */
class PanelController extends FaZend_Controller_Action {

    /**
     * Pre-configuration
     *
     * @return void
     */
    public function preDispatch() {

        Zend_Layout::getMvcInstance()->setLayout('panel');

    }

    /**
     * Default and the only action for this controller
     *
     * @return void
     */
    public function indexAction() {

        if (!Model_User::isLoggedIn())
            return $this->_forward('restrict', null, null, array('msg'=>'You are not logged in'));

        $view = clone $this->view;
        $doc = $view->doc = $this->view->doc = $this->_getParam('doc');

        // permission check
        if (!Model_Pages::getInstance()->isAllowed(Model_User::me()->email, $doc))
            return $this->_forward('restrict', null, null, array('msg'=>'Document "' . $doc . '" is not available for you'));

        // convert document name into absolute PATH
        $scripts = array();
        $path = Model_Pages::resolvePath($doc, $scripts);

        /**
         *  @todo this should be improved
         */
        $this->view->document = '';
        foreach ($scripts as $script) {
            $view->addScriptPath(dirname($script));
            $this->view->document .= $view->render(pathinfo($script, PATHINFO_BASENAME));
        }

        // reconfigure VIEW in order to render this particular document file
        $view->addScriptPath(dirname($path));
        $this->view->document .= $view->render(pathinfo($path, PATHINFO_BASENAME));

    }

    /**
     * Access restricted
     *
     * @return void
     */
    public function restrictAction() {
        $this->view->message = ($this->_hasParam('msg') ? 
            $this->_getParam('msg') : false);
    }

    /**
     * Get list of options for header
     *
     * @return void
     */
    public function optsAction() {

        $title = $this->getRequest()->getPost('title');
        $acl = Model_Pages::getInstance()->getAcl();

        $current = Model_Pages::getInstance()->findBy('title', $title);
        $list = array();

        foreach ($current->parent->getPages() as $page) {
            if (!$acl->isAllowed(Model_User::me()->email, $page->resource))
                continue;
            $list[$page->title] = $page->label;
        }

        $this->_returnJSON($list);

    }

    /**
     * Redirect to document from POST
     *
     * @return void
     */
    public function redirectorAction() {

        $doc = $this->getRequest()->getPost('document');
        $this->_helper->redirector->gotoRoute(array('doc'=>$doc), 'panel', true, false);

    }

}