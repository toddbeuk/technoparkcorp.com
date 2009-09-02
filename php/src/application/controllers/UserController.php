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

require_once 'FaZend/Controller/controllers/UserController.php';

/**
 * User controller
 *
 * @package Controllers
 */
class UserController extends Fazend_UserController {

    /**
     * Pre-configuration
     *
     * @return void
     */
    public function preDispatch() {

        $layout = Zend_Layout::getMvcInstance();
        $layout->setLayout('panel');

    }

    /**
     * Settings
     *
     * @return void
     */
    public function settingsAction() {

        if (!Model_User::isLoggedIn())
            return $this->_redirectFlash('You are not logged in yet', 'index');

        $form = FaZend_Form::create('Settings', $this->view);

        $user = Model_User::me();
        $form->email->setValue($user->email);

        if (!$form->isFilled())
            return;

        $email = $form->email->getValue();

        $user->email = $email;
        $user->save();

        if ($form->password->getValue()) {
            $user->password = $form->password->getValue();
            $user->save();
        }

        $user->logIn();

        $this->_redirectFlash('Changes were successfuly saved', 'index', 'panel', 'default');
    }

}