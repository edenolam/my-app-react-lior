<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prise de rendez-vous</title>
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
<h1>Prise de rendez-vous</h1>
<form action="/appointment/book" method="post">
    <label for="name">Nom:</label>
    <input type="text" id="name" name="name" required><br><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br>

    <label for="appointment_date">Date de rendez-vous:</label>
    <input type="datetime-local" id="appointment_date" name="appointment_date" required><br><br>

    <label for="timeslot">Créneau horaire:</label>
    <select id="timeslot" name="timeslot" required>
        <?php
        global $conn;
        $sql = "SELECT * FROM timeslots";
        $result = $conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            echo "<option value='{$row['id']}'>{$row['start_time']} - {$row['end_time']}</option>";
        }
        ?>
    </select><br><br>

    <button type="submit">Envoyer</button>
</form>
</body>
</html>
