<?php
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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->handleFormSubmission($_POST);
}

header('Location: index.php');
exit;
?>
