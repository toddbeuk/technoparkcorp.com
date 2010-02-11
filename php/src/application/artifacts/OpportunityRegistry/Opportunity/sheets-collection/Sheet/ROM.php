<?php
/**
 * thePanel v2.0, Project Management Software Toolkit
 *
 * Redistribution and use in source and binary forms, with or without 
 * modification, are PROHIBITED without prior written permission from 
 * the author. This product may NOT be used anywhere and on any computer 
 * except the server platform of TechnoPark Corp. located at 
 * www.technoparkcorp.com. If you received this code occasionally and 
 * without intent to use it, please report this incident to the author 
 * by email: privacy@technoparkcorp.com or by mail: 
 * 568 Ninth Street South 202, Naples, Florida 34102, USA
 * tel. +1 (239) 935 5429
 *
 * @author Yegor Bugaenko <egor@technoparkcorp.com>
 * @copyright Copyright (c) TechnoPark Corp., 2001-2009
 * @version $Id$
 *
 */

require_once 'artifacts/OpportunityRegistry/Opportunity/sheets-collection/Sheet/Abstract.php';

/**
 * Vision
 *
 * @package Artifacts
 */
class Sheet_ROM extends Sheet_Abstract
{
    
    /**
     * Defaults
     *
     * @var array
     * @see __get()
     */
    protected $_defaults = array(
    );

    /**
     * Average estimate
     *
     * @return integer Average estimate
     */
    protected function _getHours() 
    {
        return 100;
    }
    
    /**
     * Get LOW boundary
     *
     * @return integer Staff-hours
     */
    protected function _getLowBoundary() 
    {
        
    }
    
    /**
     * Get HIGH boundary
     *
     * @return integer Staff-hours
     */
    protected function _getHighBoundary() 
    {
        
    }
    
}