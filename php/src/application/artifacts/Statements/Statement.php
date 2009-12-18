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
 * One fin statement
 *
 * @package Artifacts
 */
class theStatement extends Zend_Db_Table_Row implements ArrayAccess, Iterator, Countable
{
    
    /**
     * Rowset with payments
     *
     * @var thePayment[]
     **/
    protected $_rowset;
    
    /**
     * Getter dispatcher
     *
     * @param string Name of property to get
     * @return mixed
     **/
    public function __get($name) 
    {
        $method = '_get' . ucfirst($name);
        if (method_exists($this, $method))
            return $this->$method();
            
        $var = '_' . $name;
        if (property_exists($this, $var))
            return $this->$var;
        
        FaZend_Exception::raise('Statement_PropertyOrMethodNotFound', 
            "Can't find what is '$name' in " . get_class($this));
    }

    /**
     * Find statement by supplier
     *
     * @param string Email of the supplier
     * @return theStatement
     **/
    public static function findBySupplier($email) 
    {
        return thePayment::retrieve(false)
            ->from('payment', array('supplier'))
            ->group('supplier')
            ->where('supplier = ?', $email)
            ->setRowClass('theStatement')
            ->fetchRow();
    }

    /**
     * Get full list of statements
     *
     * @return theStatement[]
     **/
    public static function retrieveAll() 
    {
        return thePayment::retrieve(false)
            ->from('payment', array('supplier'))
            ->group('supplier')
            ->setRowClass('theStatement')
            ->fetchAll();
    }
    
    /**
     * Calculate balance
     *
     * @return Model_Cost
     **/
    protected function _getBalance() 
    {
        return thePayment::getStatementBalance($this);
    }
    
    /**
     * Calculate total volume
     *
     * @return Model_Cost
     **/
    protected function _getVolume() 
    {
        return thePayment::getStatementVolume($this);
    }
    
    /**
     * Get email of supplier
     *
     * @return string
     **/
    protected function _getSupplier() 
    {
        return parent::__get('supplier');
    }
    
    /**
     * Payment exists?
     * 
     * The method is required by ArrayAccess interface, don't delete it.
     *
     * @param integer Id of the payment
     * @return boolean
     */
    public function offsetExists($id) 
    {
        $payment = $this->offsetGet($id);
        return $payment->exists();
    }

    /**
     * Get one statement
     * 
     * The method is required by ArrayAccess interface, don't delete it.
     *
     * @param integer Id of the payment
     * @return boolean
     */
    public function offsetGet($id) 
    {
        return new thePayment(intval($id));
    }

    /**
     * This method is required by ArrayAccess, but is forbidden
     * 
     * The method is required by ArrayAccess interface, don't delete it.
     *
     * @return void
     */
    public function offsetSet($email, $value) 
    {
        FaZend_Exception::raise('StatementException', "Statements are not editable directly");
    }

    /**
     * This method is required by ArrayAccess, but is forbidden
     * 
     * The method is required by ArrayAccess interface, don't delete it.
     *
     * @return void
     */
    public function offsetUnset($email) 
    {
        FaZend_Exception::raise('StatementException', "Statements are not editable directly");
    }

    /**
     * Return current element
     * 
     * The method is required by Iterator interface, don't delete it.
     *
     * @return theStatement
     */
    public function current() 
    {
        return $this->_getRowset()->current();
    }
    
    /**
     * Return next
     * 
     * The method is required by Iterator interface, don't delete it.
     *
     * @return theStatement
     */
    public function next() 
    {
        return $this->_getRowset()->next();
    }
    
    /**
     * Return key
     * 
     * The method is required by Iterator interface, don't delete it.
     *
     * @return theStatement
     */
    public function key() 
    {
        return $this->_getRowset()->key();
    }
    
    /**
     * Is valid?
     * 
     * The method is required by Iterator interface, don't delete it.
     *
     * @return boolean
     */
    public function valid() 
    {
        return $this->_getRowset()->valid();
    }
    
    /**
     * Rewind
     * 
     * The method is required by Iterator interface, don't delete it.
     *
     * @return theStatement
     */
    public function rewind() 
    {
        return $this->_getRowset()->rewind();
    }
    
    /**
     * Count them
     * 
     * The method is required by Countable interface, don't delete it.
     *
     * @return theStatement
     */
    public function count() 
    {
        return $this->_getRowset()->count();
    }
    
    /**
     * Get rowset with payments
     *
     * @return thePayment[]
     **/
    protected function _getRowset() 
    {
        if (!isset($this->_rowset))
            $this->_rowset = thePayment::retrieveByStatement($this);
        return $this->_rowset;
    }

}