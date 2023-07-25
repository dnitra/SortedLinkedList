<?php

namespace lib;

use lib\Node;

class SortedLinkedList
{

    public ?Node $head;
    public ?Node $tail;
    public int $length;
    public ?string $type;

    public function __construct()
    {
        $this->head = null;
        $this->tail = null;
        $this->type = null;
        $this->length = 0;
    }

    public function insert(string|int $data): void
    {
        if ($this->head === null) {
            $this->insertNodeWhenHeadIsNull($data);
            return;
        }
        $this->checkDataTypeOfNewNode($data);
        $this->insertNodeInList($data);
    }

    public function delete(string|int $data): void
    {
        if ($this->head === null) {
            return;
        }
        if ($this->compareAlphanumericOrder($data, $this->head->data) === 0) {
            $this->deleteHead();
            return;
        }
        $currentNode = $this->head;
        while ($currentNode->next !== null) {
            if ($this->compareAlphanumericOrder($data, $currentNode->next->data) === 0) {
                $this->deleteCurrentNode($currentNode);
                return;
            }
            $currentNode = $currentNode->next;
        }
    }

    public function printList(): void
    {
        $currentNode = $this->head;
        while ($currentNode !== null) {
            echo $currentNode->data . "\n";
            $currentNode = $currentNode->next;
        }
    }

    public function search(string|int $data): ?Node
    {
        $currentNode = $this->head;
        while ($currentNode !== null) {
            if ($this->compareAlphanumericOrder($data, $currentNode->data) === 0) {
                return $currentNode;
            }
            $currentNode = $currentNode->next;
        }
        return null;
    }

    public function getLength(): int
    {
        return $this->length;
    }

    public function isEmpty(): bool
    {
        return $this->length === 0;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function toArray(): array
    {
        $currentNode = $this->head;
        $array = [];
        while ($currentNode !== null) {
            $array[] = $currentNode->data;
            $currentNode = $currentNode->next;
        }
        return $array;
    }

    public function get(int $position): null|string|int
    {
        $currentNode = $this->head;
        if($position >= $this->length) {
            return null;
        }
        for ($i = 0; $i < $position; $i++) {
            $currentNode = $currentNode->next;
        }
        return $currentNode->data;
    }

    public function clear(): void
    {
        $this->head = null;
        $this->tail = null;
        $this->type = null;
        $this->length = 0;
    }

    private function deleteHead(): void
    {
        $this->head = $this->head->next;
        $this->length--;
        $this->checkIfListIsEmptyAfterDelete();
    }

    private function checkIfListIsEmptyAfterDelete(): void
    {
        if ($this->head === null) {
            $this->tail = null;
            $this->type = null;
            $this->length = 0;
        }
    }

    private function deleteCurrentNode($currentNode): void
    {
        if ($this->tail === $currentNode->next) {
            $this->tail = $currentNode;
        }
        $currentNode->next = $currentNode->next->next;
        $this->length--;
        $this->checkIfListIsEmptyAfterDelete();
    }

    private function insertNodeWhenHeadIsNull($data): void
    {
        $this->head = new Node($data);
        $this->type = gettype($data);
        $this->tail = $this->head;
        $this->length++;
    }

    private function insertNodeInList($data): void
    {
        if ($this->compareAlphanumericOrder($data, $this->head->data) < 0) {
            $this->insertNodeBeforeHead($data);
            return;
        }
        $currentNode = $this->head;
        while ($currentNode->next !== null) {

            if ($this->compareAlphanumericOrder($data, $currentNode->next->data) < 0) {
                $this->insertNodeBeforeCurrentNode($data, $currentNode);
                return;
            }
            $currentNode = $currentNode->next;
        }
        $this->replaceTailWithNewNode($data);
    }

    private function checkDataTypeOfNewNode($data): void
    {
        if ($this->type !== gettype($data)) {
            throw new \InvalidArgumentException("Data type must be the same as the rest of the list = '$this->type'");
        }
    }

    private function insertNodeBeforeCurrentNode($data, $currentNode): void
    {
        $newNode = new Node($data);
        $newNode->next = $currentNode->next;
        $currentNode->next = $newNode;
        $this->length++;
    }

    private function insertNodeBeforeHead($data): void
    {
        $newNode = new Node($data);
        $newNode->next = $this->head;
        $this->head = $newNode;
        $this->length++;
    }

    private function replaceTailWithNewNode($data): void
    {
        $newNode = new Node($data);
        $this->tail->next = $newNode;
        $this->tail = $newNode;
        $this->length++;
    }

    private function compareAlphanumericOrder($value1, $value2): int
    {
        return strcmp(strtolower(strval($value1)), strtolower(strval($value2)));
    }

}