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

/**
 * One element in collection of deliverables
 *
 * @package Artifacts
 */
abstract class Deliverables_Abstract
{
    
    const REGEX = '/(?:[A-Z][a-z]+){2,}|(?:UC|R|QOS)\d+(?:\.\d+)*/';
    
    /**
     * Name of this deliverable
     *
     * @var string
     */
    protected $_name;

    /**
     * Text description of this deliverable
     *
     * @var string
     */
    protected $_description;
    
    /**
     * Protocol of downloading from repository
     *
     * @var string
     */
    protected $_protocol = '';

    /**
     * Construct the class
     *
     * @param string Name of the deliverable
     * @param string Text description of it
     * @return void
     */
    public function __construct($name, $description)
    {
        $this->_name = $name;
        $this->_description = $description;
    }

    /**
     * Convert it to string
     *
     * @return string
     **/
    public function __toString()
    {
        return $this->_name;
    }
    
    /**
     * This deliverable is accepted by the designated person
     *
     * @return boolean
     * @see isBaselined
     */
    public function isAccepted() 
    {
        return false;
    }
    
    /**
     * This deliverable is baselined by CCB, meaning delivered to the customer
     *
     * @return boolean
     * @see isAccepted
     */
    public function isBaselined() 
    {
        return false;
    }
    
    /**
     * Getter dispatcher
     *
     * @param string Name of property to get
     * @return string
     **/
    public function __get($name)
    {
        $method = '_get' . ucfirst($name);
        if (method_exists($this, $method)) {
            return $this->$method();
        }
            
        $var = '_' . $name;
        if (property_exists($this, $var)) {
            return $this->$var;
        }
        
        FaZend_Exception::raise(
            'PropertyOrMethodNotFound', 
            "Can't find what is '$name' in " . get_class($this)
        );        
    }
    
    /**
     * Call dispatcher
     *
     * @param string Name of the method
     * @param string List of args
     * @return string
     **/
    public function __call($method, array $args)
    {
        if (substr($method, 0, 3) == 'set') {
            $property = '_' . lcfirst(substr($method, 3));
            if (property_exists($this, $property)) {
                if (count($args)) {
                    $value = array_shift($args);
                } else {
                    $value = true;
                }
                $this->$property = $value;
                return $this;
            }
            FaZend_Exception::raise(
                'PropertyNotFound', 
                "Can't find property '$property' in " . get_class($this)
            );        
        }
        
        FaZend_Exception::raise(
            'MethodNotFound', 
            "Can't find what is '$method' in " . get_class($this)
        );        
    }
    
    /**
     * Discover links
     *
     * @param theProject Project to work with
     * @param array List of links
     * @return void
     **/
    public function discoverTraceabilityLinks(theProject $project, array &$links) 
    {
        if (!preg_match_all(self::REGEX, $this->_description, $matches)) {
            return;
        }
            
        foreach ($matches[0] as $match) {
            if (!isset($project->deliverables[$match])) {
                continue;
            }
            
            // don't trace to itself
            if ($this->_name == $match) {
                continue;
            }
                
            $links[] = new theTraceabilityLink(
                $project->deliverables[$this->_name],
                $project->deliverables[$match],
                0.2,
                1,
                'description says: ' . $this->_description
            );
        }
    }
    
    /**
     * Return type of this deliverable
     *
     * @return string
     **/
    protected function _getType()
    {
        return lcfirst(preg_replace('/^Deliverables_/', '', get_class($this)));
    }
    
    /**
     * Get collection of ALL properties
     *
     * @return string
     **/
    protected function _getAttributes()
    {
        $reflector = new ReflectionObject($this);
        $data = array();
        foreach ($reflector->getProperties(ReflectionProperty::IS_PROTECTED) as $property) {
            $name = $property->getName();
            if (in_array($name, array('_name', '_description'))) {
                continue;
            }

            $name = substr($name, 1);
            $value = $this->$name;
            
            if (is_bool($value)) {
                $value = $value ? 'TRUE' : 'FALSE';
            }
            $data[] = $name . '=' . $value;
        }
        return implode('; ', $data);
    }
    
}
