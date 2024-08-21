<?php

class BookController
{
    private BookService $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function listBooks()
    {
        return $this->bookService->getAllBooks();
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
