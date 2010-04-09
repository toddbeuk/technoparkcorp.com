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
 * @copyright Copyright (c) FaZend.com
 * @version $Id$
 * @category FaZend
 */

/**
 * Gallery of objects
 *
 * @package helpers
 */
class Helper_Gallery extends FaZend_View_Helper
{

    /**
     * Icon name
     *
     * @var string
     */
    protected $_icon = 'document';

    /**
     * Source of data
     *
     * @var array
     */
    protected $_source;

    /**
     * Link to be added to each element
     *
     * @var string
     */
    protected $_link = null;

    /**
     * Title to show (name of property)
     *
     * @var string
     */
    protected $_title;

    /**
     * Builds the gallery object
     *
     * @return Helper_Table
     */
    public function gallery()
    {
        return $this;
    }

    /**
     * Converts it to HTML
     *
     * @return string HTML
     */
    public function __toString()
    {
        $html = '<div class="gallery">';

        $icon = $this->getView()->icon($this->_icon);
        foreach ($this->_source as $key=>$element) {

            $link = Model_Pages::resolveLink($this->_link, $element, $key);

            // if this link is not allowed for current user
            if (!Model_Pages::getInstance()->isAllowed($link))
                continue;

            $html .= "<div class='element'>" . $icon;

            if (isset($this->_link)) {
                // create a label for each element
                if ($this->_title == '__key') {
                    $title = $key;
                } else {
                    if (method_exists($element, $this->_title))
                        $title = $element->{$this->_title}();
                    else
                        $title = $element->{$this->_title};
                }
                
                $html .= '<br/>' .
                    "<a href='" . $link . "' title='{$link}'>" .
                    $this->getView()->escape($title) . "</a>";
            }

            $html .= '</div>';
        }

        // configure CSS for this gallery
        $this->getView()->includeCSS('helper/gallery.css');

        return $html . '</div>';
    }

    /**
     * Set data source
     *
     * @param Iterator
     * @return Helper_Table
     */
    public function setSource(Iterator $iterator)
    {
        $this->_source = $iterator;
        return $this;
    }

    /**
     * Set the name of icon to show
     *
     * @param string Name of icon
     * @return Helper_Table
     */
    public function setIcon($icon)
    {
        $this->_icon = $icon;
        return $this;
    }

    /**
     * Set the link
     *
     * @param string Link to use for each element
     * @return Helper_Table
     */
    public function setLink($link)
    {
        $this->_link = $link;

        if (preg_match('/\{(.*?)\}/', $this->_link, $matches))
            $this->setTitle($matches[1]);

        return $this;
    }

    /**
     * Set the name of icon to show
     *
     * @param string Name of title property
     * @return Helper_Table
     */
    public function setTitle($title)
    {
        $this->_title = $title;
        return $this;
    }

}