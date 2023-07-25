<?php
require_once __DIR__.'/lib/SortedLinkedList.php';
require_once __DIR__.'/lib/Node.php';

use lib\SortedLinkedList;

$numList = new SortedLinkedList();

$list = new SortedLinkedList();
$list->insert('Adam');
$list->insert('Bob');
$list->insert('banana');
$list->insert('apple');
$list->insert('Zebra');
$list->delete('Adam');

$list->printList();
