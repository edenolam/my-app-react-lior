<?php

class BookRepository implements BookRepositoryInterface
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findAll(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM books');
        $books = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $books[] = new Book($row['id'], $row['title'], $row['author']);
        }
        return $books;
    }

    public function find($id): ?Book
    {
        $stmt = $this->pdo->prepare('SELECT * FROM books WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Book($row['id'], $row['title'], $row['author']);
        }
        return null;
    }

    public function save(Book $book)
    {
        if ($book->getId()) {
            $stmt = $this->pdo->prepare('UPDATE books SET title = :title, author = :author WHERE id = :id');
            $stmt->execute([
                'title' => $book->getTitle(),
                'author' => $book->getAuthor(),
                'id' => $book->getId(),
            ]);
        } else {
            $stmt = $this->pdo->prepare('INSERT INTO books (title, author) VALUES (:title, :author)');
            $stmt->execute([
                'title' => $book->getTitle(),
                'author' => $book->getAuthor(),
            ]);
            $bookId = $this->pdo->lastInsertId();
            return new Book($bookId, $book->getTitle(), $book->getAuthor());
        }
    }

    public function delete($id): void
    {
        $stmt = $this->pdo->prepare('DELETE FROM books WHERE id = :id');
        $stmt->execute(['id' => $id]);
    }
}
