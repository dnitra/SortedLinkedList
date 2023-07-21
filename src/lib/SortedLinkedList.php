<?php

namespace lib;

use lib\Node;

class SortedLinkedList
{

    public $head;
    public $tail;
    public $length;

    public function __construct()
    {
        $this->head = null;
        $this->tail = null;
        $this->length = 0;
    }

    public function insert(String|Int|Float $data) : void{

        if ($this->head === null){
            $this->head = new Node($data);
            $this->tail = $this->head;
            $this->length++;
            return;
        }


    }



}