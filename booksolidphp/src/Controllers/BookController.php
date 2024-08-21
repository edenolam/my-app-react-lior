<?php

class BookController
{
    private BookService $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function listBooks(): void
    {
        $books = $this->bookService->getAllBooks();
        foreach ($books as $book) {
            echo "ID: " . $book->getId() . ", Title: " . $book->getTitle() . ", Author: " . $book->getAuthor() . "<br>";
        }
    }

    public function createBook($id, $title, $author): void
    {
        $this->bookService->createBook($id, $title, $author);
    }

    public function deleteBook($id): void
    {
        $this->bookService->deleteBook($id);
    }
}
