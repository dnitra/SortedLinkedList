<?php
require_once __DIR__ . '/SortedLinkedList.php';

use src\SortedLinkedList;

$numList = new SortedLinkedList();

$list = new SortedLinkedList();
$list->insert('Adam');
$list->insert('Bob');
$list->insert('banana');
$list->insert('apple');
$list->insert('Zebra');
$list->delete('Adam');
$list->printList();

echo $list->getLength();
echo "\n";
echo $list->getType();
echo "\n";
echo $list->search('apple')->data;
echo "\n";
echo $list->get(1);
echo "\n";

$newArray = $list->toArray();
print_r($newArray);

$list->clear();
echo $list->isEmpty()? 'true' : 'false';