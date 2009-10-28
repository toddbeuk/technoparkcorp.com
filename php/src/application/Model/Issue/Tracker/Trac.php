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
 * Trac tracker
 *
 * @package Model
 */
class Model_Issue_Tracker_Trac extends Model_Issue_Tracker_Abstract {

    const URI = 'http://trac.fazend.com';

    /**
     * The project related to this Trac
     *
     * @var Model_Project
     */
    protected $_project;
    
    /**
	 * Construct the class
     *
     * @param Model_Project The project, owner of this trac
     * @return void
     */
	public function __construct(Model_Project $project) {
	    $this->_project = $project;
	}

    /**
     * Get XML RPC client instance
     *
     * @return Zend_XmlRpc_Client
     **/
    public function getXmlRpcTicketProxy() {
        // this is the URL of trac hack XMLRPC
        return Model_Client_Rpc::factory(
            $this->_project,
            self::URI . '/' . $this->_project->name . '/xmlrpc',
            'ticket');
    }

}
