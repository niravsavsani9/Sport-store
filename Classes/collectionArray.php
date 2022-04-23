<?php

#REVISION HISTORY
#   NAME                                            DATE                        COMMENTS
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         17/04/2022                   created collection array class
#NIRAVKUMAR CHANDUBHAI SAVSANI(2110222)         17/04/2022                   defined all arrays for add,remove,get,count
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
    #arrays of add - remove - count and get primary key
    //put your code here
    public $items = array();

    public function add($primary_key, $item) {
        $this->items[$primary_key] = $item;
    }

    public function remove($primary_key) {
        if (isset($this->items[$primary_key])) {
            unset($this->items[$primary_key]);
        }
    }

    public function get($primary_key) {
        if (isset($this->items[$primary_key])) {
            return($this->items[$primary_key]);
        }
    }

    public function count() {
        return count($this->items);
    }

}
