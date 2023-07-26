## SortedLinkedList PHP Library

The SortedLinkedList PHP library provides an implementation of a single linked list that keeps its elements sorted in alphanumeric order. It allows you to store either string or integer values in the list. This library ensures efficient insertion, deletion, and search operations while maintaining the sorted order of elements.

### Getting Started

To use the SortedLinkedList library, follow these steps:

1. **Installation**: Simply include the SortedLinkedList.php file in your project.

```php
require_once 'path/to/SortedLinkedList.php';
```

2. **Creating a SortedLinkedList**:

```php
$sortedList = new src\SortedLinkedList();
```

### Functions

1. `insert(string|int $data): void`: Insert a new element with the given value into the SortedLinkedList, maintaining its sorted order.

2. `delete(string|int $data): void`: Remove the first occurrence of the given value from the SortedLinkedList, if it exists.

3. `printList(): void`: Output the elements of the SortedLinkedList to the standard output.

4. `search(string|int $data): ?Node`: Search for the given value in the SortedLinkedList and return the first node containing that value, or null if not found.

5. `getLength(): int`: Get the current length (number of elements) of the SortedLinkedList.

6. `isEmpty(): bool`: Check if the SortedLinkedList is empty.

7. `getType(): ?string`: Get the data type (string or int) that the SortedLinkedList can hold. Returns null if the list is empty.

8. `toArray(): array`: Convert the SortedLinkedList into an array while preserving the sorted order of elements.

9. `get(int $position): null|string|int`: Get the value of the element at the specified position in the SortedLinkedList, where the position starts from 0.

10. `clear(): void`: Remove all elements from the SortedLinkedList, effectively emptying the list.

### Usage Examples

#### Insertion:

```php
$sortedList = new src\SortedLinkedList();

$sortedList->insert("apple");
$sortedList->insert("orange");
$sortedList->insert("banana");
$sortedList->insert("grape");

$sortedList->printList(); // Output: apple banana grape orange
```

#### Deletion:

```php
$sortedList = new src\SortedLinkedList();

$sortedList->insert(10);
$sortedList->insert(30);
$sortedList->insert(20);
$sortedList->insert(40);

$sortedList->delete(20);

$sortedList->printList(); // Output: 10 30 40
```

### Note

- The SortedLinkedList class supports both string and integer values. When inserting elements, the list must maintain its sorted order based on alphanumeric comparisons.
- For the delete() function, only the first occurrence of the specified value will be removed if it exists.
- This library is mainly for educational purposes. It is not recommended to use this library in production environments. The best practice is to use the built-in array functions in PHP to perform operations on arrays or use the built-in SPL data structures like SplDoublyLinkedList which is a doubly linked list that allows you to insert elements at the beginning or end of the list and is implemented in C for better performance.
- If you have read all the way to this point, thank you for your time and interest in hiring me for this position. I look forward to hearing from you soon.
- **Fun fact**: my brother-in-law is a software engineer at Guri.ai company in California, USA. He told me he is in regular contact with you for integration of the Guri.ai API with the company's website. Small world :)
