<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application de Rendez-vous</title>
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
<header>
    <nav>
        <ul>
            <li><a href="/">Accueil</a></li>
            <li><a href="/appointment/index">Rendez-vous</a></li>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="/user/logout">Déconnexion</a></li>
            <?php else: ?>
                <li><a href="/user/login">Connexion</a></li>
                <li><a href="/user/register">Inscription</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
