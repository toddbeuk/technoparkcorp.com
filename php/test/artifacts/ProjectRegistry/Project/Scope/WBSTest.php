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

require_once 'FaZend/Test/TestCase.php';
require_once 'AbstractProjectTest.php';

/**
 * Test WBS
 *
 * @package test
 */
class WBSTest extends AbstractProjectTest {

    public function testGeneralMechanismWorks() {
        $wbs = $this->project->WBS;
        logg(count($wbs) . ' work packages in WBS');
    }

    public function testActivitiesAreAvailable() {
        $list = $this->project->WBS->getActivities();
        logg(count($list) . ' activities found from WBS');
    }

}