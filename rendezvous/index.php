<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prise de rendez-vous</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <label for="appointment_date">Date de rendez-vous:</label>
    <input type="text" id="appointment_date" name="appointment_date" required><br><br>

    <script>
        $(function() {
            $("#appointment_date").datepicker({
                dateFormat: 'yy-mm-dd'
            });
        });
    </script>

</head>
<body>
<h1>Prendre un rendez-vous</h1>
<form action="process.php" method="post">
    <label for="name">Nom:</label>
    <input type="text" id="name" name="name" required><br><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br>

    <label for="appointment_date">Date de rendez-vous:</label>
    <input type="datetime-local" id="appointment_date" name="appointment_date" required><br><br>

    <button type="submit">Envoyer</button>
</form>

<script>
    document.getElementById('appointmentForm').addEventListener('submit', function(e) {
        var name = document.getElementById('name').value;
        var email = document.getElementById('email').value;
        var appointment_date = document.getElementById('appointment_date').value;

        if(name === "" || email === "" || appointment_date === "") {
            alert("Tous les champs sont requis.");
            e.preventDefault();
        }

        // Ajouter d'autres validations si nécessaire
    });
</script>
</body>
</html>
