<?php

class BookService
{
    private BookRepositoryInterface $repository;

    public function __construct(BookRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAllBooks()
    {
        return $this->repository->findAll();
    }

    public function getBookById($id)
    {
        return $this->repository->find($id);
    }

    public function createBook($id, $title, $author): void
    {
        $book = new Book($id, $title, $author);
        $this->repository->save($book);
    }

    public function deleteBook($id): void
    {
        $this->repository->delete($id);
    }
}
