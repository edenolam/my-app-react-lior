<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
<h1>Inscription</h1>
<form action="/user/register" method="post">
    <label for="username">Nom d'utilisateur:</label>
    <input type="text" id="username" name="username" required><br><br>

    <label for="password">Mot de passe:</label>
    <input type="password" id="password" name="password" required><br><br>

    <button type="submit">S'inscrire</button>
</form>
</body>
</html>
