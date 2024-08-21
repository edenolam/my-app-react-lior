<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rendezvous";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
die("La connexion a échoué : " . $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];

// Récupérer l'utilisateur
$sql = "SELECT * FROM users WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
$user = $result->fetch_assoc();
if (password_verify($password, $user['password'])) {
$_SESSION['user_id'] = $user['id'];
header("Location: dashboard.php");
} else {
echo "Mot de passe incorrect.";
}
} else {
echo "Nom d'utilisateur non trouvé.";
}

$conn->close();

