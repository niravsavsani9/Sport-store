<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of collectionArray
 *
 * @author savsa
 */
class collectionArray {
    //put your code here
    public $items = array();
    public function add($primary_key, $item)
    {
        $this->items[$primary_key] = $item;
//        $item["primarykey"] = $one_customer;
    }
    
    public function remove($primary_key)
    {
        if(isset($this->items[$primary_key]))
        {
            #unset means its gonna delete/destroy the data or entry
            unset($this->items[$primary_key]);
        }
    }
    
    //find the data
    public function get($primary_key)
    {
        if(isset($this->items[$primary_key]))
        {
            
            return($this->items[$primary_key]);
        }
    }
    
    public function count()
    {
        return count($this->items);
    }
}
