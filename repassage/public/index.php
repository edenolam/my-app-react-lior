<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../vendor/autoload.php';

use App\Repositories\ServiceRepository;
use App\Services\GeocodingService;
use App\Services\EmailService;
use App\Controllers\ServiceController;
use PHPMailer\PHPMailer\PHPMailer;
use Dotenv\Dotenv;
use mysqli;

// Charger les variables d'environnement
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$servername = "localhost";
$username = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];
$dbname = $_ENV['DB_NAME'];

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

$serviceRepository = new ServiceRepository($conn);
$geocodingService = new GeocodingService();
$mail = new PHPMailer(true);
$emailService = new EmailService($mail);

$controller = new ServiceController($serviceRepository, $geocodingService, $emailService);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de Service de Repassage</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Formulaire de Service de Repassage</h2>
    <form action="submit_form.php" method="post" class="mt-4 p-4 border rounded bg-light">
        <div class="form-group">
            <label for="name">Nom:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="address">Adresse:</label>
            <input type="text" id="address" name="address" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="type">Type:</label>
            <select id="type" name="type" class="form-control" required>
                <option value="demand">Demande de repassage</option>
                <option value="offer">Offre de repassage</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary btn-lg btn-block">Envoyer</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
