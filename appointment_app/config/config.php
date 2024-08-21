<?php
declare(strict_types=1);

const DB_SERVER = 'localhost';
const DB_USERNAME = 'root';
const DB_PASSWORD = 'root';
const DB_NAME = 'rendezvous';

$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) {
    die('Erreur de connexion: ' . $conn->connect_error);
}
