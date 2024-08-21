<?php

require 'src/Models/Book.php';
require 'src/Repositories/BookRepositoryInterface.php';
require 'src/Repositories/BookRepository.php';
require 'src/Services/BookService.php';
require 'src/Controllers/BookController.php';

// Connexion à la base de données MySQL
$pdo = new PDO('mysql:host=localhost;dbname=library', 'root', 'root');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Dépendances
$bookRepository = new BookRepository($pdo);
$bookService = new BookService($bookRepository);
$bookController = new BookController($bookService);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['create'])) {
        $bookController->createBook(null, $_POST['title'], $_POST['author']);
    } elseif (isset($_POST['delete'])) {
        $bookController->deleteBook($_POST['id']);
    }
}

$books = $bookService->getAllBooks();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1 class="my-4">Library</h1>

    <form method="POST" class="mb-4">
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Author</label>
            <input type="text" class="form-control" id="author" name="author" required>
        </div>
        <button type="submit" name="create" class="btn btn-primary">Add Book</button>
    </form>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Title</th>
            <th scope="col">Author</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($books as $book): ?>
            <tr>
                <td><?php echo htmlspecialchars($book->getId()); ?></td>
                <td><?php echo htmlspecialchars($book->getTitle()); ?></td>
                <td><?php echo htmlspecialchars($book->getAuthor()); ?></td>
                <td>
                    <form method="POST" style="display:inline;">
                        <input type="hidden" name="id" value="<?php echo $book->getId(); ?>">
                        <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
