<?php
/**
 * Created by PhpStorm.
 * User: brand
 * Date: 01/04/2019
 * Time: 09:53
 */

class Category
{
    private $_name;
    private $_category_id;


    public function __construct($category_id,$_name)
    {
        $this->_name = $_name;
        $this->_category_id= $category_id;
    }


    public function getName()
    {
        return $this->_name;
    }

    public function getCategoryId()
    {
        return $this->_category_id;
    }







}