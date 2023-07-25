<?php
namespace lib;

class Node
{
    public $data;
    public $next;
//string or int or float
    public function __construct(String|Int $data)
    {
        $this->data = $data;
        $this->next = null;
    }
}
