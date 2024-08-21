<?php

class BookRepository implements BookRepositoryInterface
{
    private array $books = [];

    public function findAll(): array
    {
        return $this->books;
    }

    public function find($id)
    {
        foreach ($this->books as $book) {
            if ($book->getId() === $id) {
                return $book;
            }
        }
        return null;
    }

    public function save(Book $book): void
    {
        $this->books[$book->getId()] = $book;
    }

    public function delete($id): void
    {
        unset($this->books[$id]);
    }
}
