<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des rendez-vous</title>
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
<h1>Liste des rendez-vous</h1>
<table>
    <thead>
    <tr>
        <th>Nom</th>
        <th>Email</th>
        <th>Date de rendez-vous</th>
        <th>Créneau horaire</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($appointments as $appointment) : ?>
        <tr>
            <td><?php echo htmlspecialchars($appointment['name'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlspecialchars($appointment['email'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlspecialchars($appointment['appointment_date'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><?php echo htmlspecialchars($appointment['start_time'] . ' - ' . $appointment['end_time'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td>
                <a href="/appointment/delete/<?php echo (int) $appointment['id']; ?>">Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>
