<?php
// process.php

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "rendezvous";

// Créer une connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

// Récupérer les données du formulaire
$name = $_POST['name'];
$email = $_POST['email'];
$appointment_date = $_POST['appointment_date'];

if(empty($name) || empty($email) || empty($appointment_date)) {
    die("Tous les champs sont requis.");
}

if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Adresse email invalide.");
}

$sql = "SELECT * FROM appointments WHERE appointment_date = '$appointment_date'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    die("Ce créneau est déjà réservé.");
} else {
    $sql = "INSERT INTO appointments (name, email, appointment_date) VALUES ('$name', '$email', '$appointment_date')";
    if ($conn->query($sql) === TRUE) {
        echo "Rendez-vous enregistré avec succès.";
    } else {
        echo "Erreur : " . $sql . "<br>" . $conn->error;
    }
}


// Fermer la connexion
$conn->close();

