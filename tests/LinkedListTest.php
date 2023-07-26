<?php
declare(strict_types=1);
namespace tests;
require __DIR__ . "/../src/SortedLinkedList.php";

use PHPUnit\Framework\TestCase;
use src\Node;
use src\SortedLinkedList;

final class LinkedListTest extends TestCase
{
    public function testNodeCanBeCreated(): void
    {
        $node = new Node(1);
        $this->assertInstanceOf(Node::class, $node);
    }

    public function testNodeCanBeOnlyIntOrString(): void
    {
        $this->expectException(\TypeError::class);
        $node = new Node(true);
        $node = new Node(1.1);
        $node = new Node([]);
        $node = new Node(new \stdClass());
    }

    public function testNodeHasData(): void
    {
        $node = new Node(1);
        $this->assertEquals(1, $node->data);
    }

    public function testFirstNodeHasNextAsNull(): void
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

    public function testTailIsSameAsHeadWhenFirstNodeIsInserted(): void
    {
        $list = new SortedLinkedList();
        $list->insert(1);
        $this->assertEquals($list->head, $list->tail);
    }

    public function testLengthIncreasesWhenNodeIsInserted(): void
    {
        $list = new SortedLinkedList();
        $list->insert(1);
        $this->assertEquals(1, $list->length);
    }

    public function testIfTypeIsDefinedAnotherTypeWillThrowError(): void
    {
        $this->expectExceptionMessage("Data type must be the same as the rest of the list = 'integer'");
        $intList = new SortedLinkedList();
        $intList->insert(1);
        $intList->insert("1");
        $this->expectExceptionMessage("Data type must be the same as the rest of the list = 'string'");
        $stringList = new SortedLinkedList();
        $stringList->insert("1");
        $stringList->insert(1);
    }

    public function testSecondNodeIsInsertedAfterFirstNode(): void
    {
        $list = new SortedLinkedList();
        $list->insert(1);
        $list->insert(2);
        $this->assertEquals(2, $list->tail->data);
    }

    public function testNodesAreInsertedInOrder(): void
    {
        $intList = new SortedLinkedList();
        $intList->insert(3);
        $intList->insert(1);
        $intList->insert(2);
        $this->assertEquals(1, $intList->head->data);
        $this->assertEquals(2, $intList->head->next->data);
        $this->assertEquals(3, $intList->tail->data);
        $stringList = new SortedLinkedList();
        $stringList->insert("c1");
        $stringList->insert("a3");
        $stringList->insert("B2");
        $this->assertEquals("a3", $stringList->head->data);
        $this->assertEquals("B2", $stringList->head->next->data);
        $this->assertEquals("c1", $stringList->tail->data);
    }

    public function testNodeCanBeDeleted(): void
    {
        $list = new SortedLinkedList();
        $list->insert(1);
        $list->insert(3);
        $list->insert(2);

        $list->delete(1);
        $this->assertEquals(2, $list->head->data);

        $list->delete(3);
        $this->assertEquals(2, $list->tail->data);

        $list->delete(2);
        $this->assertNull($list->head);
        $this->assertNull($list->tail);
        $this->assertNull($list->type);
    }

    public function testNodesCanBePrinted(): void
    {
        $list = new SortedLinkedList();
        $list->insert(1);
        $list->insert(3);
        $list->insert(2);
        $this->expectOutputString("1\n2\n3\n");
        $list->printList();
    }

    public function testSearchReturnsNode(): void
    {
        $list = new SortedLinkedList();
        $list->insert(1);
        $list->insert(3);
        $list->insert(2);
        $this->assertInstanceOf(Node::class, $list->search(2));
        $this->assertNull($list->search(4));
    }

    public function testListCanBeCleared(): void
    {
        $list = new SortedLinkedList();
        $list->insert(1);
        $list->insert(3);
        $list->insert(2);
        $list->clear();
        $this->assertNull($list->head);
        $this->assertNull($list->tail);
        $this->assertNull($list->type);
    }

    public function testLengthCanBeRetrieved(): void
    {
        $list = new SortedLinkedList();
        $this->assertEquals(0, $list->getLength());
        $list->insert(1);
        $this->assertEquals(1, $list->getLength());
        $list->insert(2);
        $this->assertEquals(2, $list->getLength());
        $list->insert(3);
        $this->assertEquals(3, $list->getLength());
        $list->delete(1);
        $this->assertEquals(2, $list->getLength());
        $list->delete(2);
        $this->assertEquals(1, $list->getLength());
        $list->delete(3);
        $this->assertEquals(0, $list->getLength());
    }

    public function testIsEmptyReturnsCorrectValue(): void
    {
        $list = new SortedLinkedList();
        $this->assertTrue($list->isEmpty());
        $list->insert(1);
        $this->assertFalse($list->isEmpty());
    }

    public function testListCanBeConvertedToArray(): void
    {
        $list = new SortedLinkedList();
        $list->insert(1);
        $list->insert(3);
        $list->insert(2);
        $this->assertEquals([1, 2, 3], $list->toArray());
    }

    public function testTypeCanBeRetrieved(): void
    {
        $list = new SortedLinkedList();
        $this->assertNull($list->getType());
        $list->insert(1);
        $this->assertEquals("integer", $list->getType());
        $list->delete(1);
        $this->assertNull($list->getType());
        $list->insert("1");
        $this->assertEquals("string", $list->getType());
    }

    public function testSpecificPositionCanBeRetrieved(): void
    {
        $list = new SortedLinkedList();
        $list->insert(1);
        $list->insert(3);
        $list->insert(2);
        $this->assertEquals(1, $list->get(0));
        $this->assertEquals(2, $list->get(1));
        $this->assertEquals(3, $list->get(2));
        $this->assertNull($list->get(3));
    }

}