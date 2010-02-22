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
 * @author Yegor Bugayenko <egor@tpc2.com>
 * @copyright Copyright (c) TechnoPark Corp., 2001-2009
 * @version $Id$
 *
 */

/**
 * One changelog field, cost estimate of issue
 *
 * @package Model
 */
class Model_Asset_Defects_Issue_Changelog_Field_Cost extends Model_Asset_Defects_Issue_Changelog_Field_Abstract
{

    /**
     * Validate new value
     *
     * @param mixed Value to set
     * @return void
     * @throws Exception if failed
     **/
    protected function _validate($value)
    {
        validate()->type($value, 'integer', "Cost shall be INT only");
        
        return true;
    }

}
