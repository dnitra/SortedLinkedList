<?php
declare(strict_types=1);
namespace tests;
require __DIR__ . "/../src/lib/Node.php";
require __DIR__ . "/../src/lib/SortedLinkedList.php";

use lib\Node;
use lib\SortedLinkedList;
use PHPUnit\Framework\TestCase;

final class LinkedListTest extends TestCase
{
    public function testNodeCanBeCreated(): void
    {
        $node = new Node(1);
        $this->assertInstanceOf(Node::class, $node);
    }

    public function testNodeCanBeOnlyIntOrStringOrFloat(): void
    {
        $this->expectException(\TypeError::class);
        $node = new Node([]);
        $node2 = new Node(new \stdClass());
        $node3 = new Node(true);
        $node4 = new Node(null);
    }

    public function testNodeHasData(): void
    {
        $node = new Node(1);
        $this->assertEquals(1, $node->data);
    }

    public function testNodeHasNext(): void
    {
        $node = new Node(1);
        $this->assertNull($node->next);
    }

    public function testNodeHasNextNode(): void
    {
        $node = new Node(1);
        $node2 = new Node(2);
        $node->next = $node2;
        $this->assertInstanceOf(Node::class, $node->next);
    }

    public function testSortedLinkedListCanBeCreated(): void
    {
        $list = new SortedLinkedList();
        $this->assertInstanceOf(SortedLinkedList::class, $list);
    }

    public function testSortedLinkedListHasHead(): void
    {
        $list = new SortedLinkedList();
        $this->assertNull($list->head);
    }
    
    public function testSortedLinkedListHasTail(): void
    {
        $list = new SortedLinkedList();
        $this->assertNull($list->tail);
    }
    
    public function testSortedLinkedListHasLength(): void
    {
        $list = new SortedLinkedList();
        $this->assertEquals(0, $list->length);
    }

    public function testHeadIsSetWhenNodeIsInserted(): void
    {
        $list = new SortedLinkedList();
        $list->insert(1);
        $this->assertInstanceOf(Node::class, $list->head);
    }

    public function testTailIsSetWhenNodeIsInserted(): void
    {
        $list = new SortedLinkedList();
        $list->insert(1);
        $this->assertInstanceOf(Node::class, $list->tail);
    }

    public function testLengthIncreasesWhenNodeIsInserted(): void
    {
        $list = new SortedLinkedList();
        $list->insert(1);
        $this->assertEquals(2, $list->length);
    }

    public function testTwoNodesCanBeInserted(): void
    {
        $list = new SortedLinkedList();
        $list->insert(1);
        $list->insert(2);
        $this->assertEquals(2, $list->length);
    }

    
}