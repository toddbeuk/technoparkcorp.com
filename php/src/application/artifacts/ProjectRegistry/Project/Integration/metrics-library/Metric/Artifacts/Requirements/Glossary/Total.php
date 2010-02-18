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
 * @version $Id: Total.php 642 2010-02-09 12:29:28Z yegor256@yahoo.com $
 *
 */

/**
 * Total number of objects specified
 * 
 * @package Artifacts
 */
class Metric_Artifacts_Requirements_Glossary_Total extends Metric_Abstract
{

    /**
     * Load this metric
     *
     * @return void
     **/
    public function reload()
    {
        // we can't calculate metrics here if deliverables are not loaded
        if (!$this->_project->deliverables->isLoaded()) {
            $this->_project->deliverables->reload();
        }
            
        $this->value = count($this->_project->deliverables->glossary);
        $this->default = round(
            $this->_project->metrics['artifacts/requirements/functional/total']->objective / 10
        );
    }
        
    /**
     * Get work package
     *
     * @param string[] Names of metrics, to consider after this one
     * @return theWorkPackage
     **/
    protected function _derive(array &$metrics = array())
    {
        // if nothing to specify, skip it
        if ($this->delta <= 0) {
            return null;
        }

        // price of one glossary item
        $price = new FaZend_Bo_Money(
            $this->_project->metrics['history/cost/requirements/glossary']->value
        );

        return $this->_makeWp(
            $price->mul($this->delta), 
            sprintf(
                'to specify +%d glossary items',
                $this->delta
            )
        );
    }
        
}