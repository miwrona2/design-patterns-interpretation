<?php

declare(strict_types=1);

namespace DesignPatterns\Behavioral\Iterator;

use Countable;
use Iterator;

class BookList implements Iterator, Countable
{
    /**
     * @var Book[]
     */
    private array $books = [];
    private int $currentIndex = 0;

    public function addBook(Book $book)
    {
        $this->books[] = $book;
    }

    public function removeBook(Book $bookToRemove)
    {
        foreach ($this->books as $key => $book) {
            if ($book->getAuthorAndTitle() === $bookToRemove->getAuthorAndTitle()) {
                unset($this->books[$key]);
            }
        }

        $this->books = array_values($this->books);
    }

    public function count(): int
    {
        return count($this->books);
    }

    public function current(): Book
    {
        return $this->books[$this->currentIndex];
    }

    public function key(): int
    {
        return $this->currentIndex;
    }

    public function next(): void
    {
        $this->currentIndex++;
    }

    public function rewind(): void
    {
        $this->currentIndex = 0;
    }

    public function valid(): bool
    {
        return isset($this->books[$this->currentIndex]);
    }
}

class Book
{
    private $title;

    private $author;

    public function __construct(string $title, string $author)
    {
        $this->title = $title;
        $this->author = $author;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getAuthorAndTitle(): string
    {
        return $this->getTitle() . ' by ' . $this->getAuthor();
    }
}

// Client code
$bookList = new BookList();
$book1 = new Book('1984', 'George Orwell');
$book2 = new Book('The catcher in the rye', 'J.D. Salinger');
$book3 = new Book('The old man and the sea', 'Ernest Hamingway');
$bookList->addBook($book1);
$bookList->addBook($book2);
$bookList->addBook($book3);
print_r($bookList);
$bookList->removeBook($book1);

// $bookList->rewind();
// var_dump($bookList->current());
print_r($bookList);
// print_r($bookList->current());