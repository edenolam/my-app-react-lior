<?php

require 'src/Models/Book.php';
require 'src/Repositories/BookRepositoryInterface.php';
require 'src/Repositories/BookRepository.php';
require 'src/Services/BookService.php';
require 'src/Controllers/BookController.php';

// Dépendances
$bookRepository = new BookRepository();
$bookService = new BookService($bookRepository);
$bookController = new BookController($bookService);

// Exécution des actions
$bookController->createBook(1, "1984", "George Orwell");
$bookController->createBook(2, "Brave New World", "Aldous Huxley");
$bookController->listBooks();
$bookController->deleteBook(1);
$bookController->listBooks();
