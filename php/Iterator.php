<?php

declare(strict_types=1);

namespace DesignPatterns\Behavioral\Iterator;

use Countable;
use Iterator;

class BookIterator implements Iterator, Countable
{
    private int $currentIndex = 0;
    private BookList $bookList;

    public function __construct(BookList $bookList)
    {
        $this->bookList = $bookList;
    }

    public function count(): int
    {
        return count($this->bookList->getBooks());
    }

    public function current(): Book
    {
        return $this->bookList->getBooks()[$this->currentIndex];
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
        return isset($this->bookList->getBooks()[$this->currentIndex]);
    }
}

class BookList
{
    private array $books = [];

    /** 
     * @return Book[]
     */
    public function getBooks(): array
    {
        return $this->books;
    }

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