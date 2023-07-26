<?php
namespace src;

class Node
{
    public $data;
    public $next;
    public function __construct(String|Int $data)
    {
        $this->data = $data;
        $this->next = null;
    }
}
