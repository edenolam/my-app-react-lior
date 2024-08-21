<?php
declare(strict_types=1);

namespace app\controllers;

use app\models\Appointment;

class AppointmentController {
    public function index(): void {
        $appointment = new Appointment();
        $appointments = $appointment->getAll();
        include '../app/views/appointments/index.php';
    }

    public function book(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $appointment_date = $_POST['appointment_date'] ?? '';
            $timeslot = $_POST['timeslot'] ?? '';
            $appointment = new Appointment();
            if ($appointment->book($name, $email, $appointment_date, $timeslot)) {
                echo "Rendez-vous enregistré avec succès.";
            } else {
                echo "Erreur lors de l'enregistrement du rendez-vous.";
            }
        } else {
            include '../app/views/appointments/book.php';
        }
    }

    public function delete(int $id): void {
        $appointment = new Appointment();
        if ($appointment->delete($id)) {
            header('Location: /appointment/index');
            exit;
        } else {
            echo "Erreur lors de la suppression du rendez-vous.";
        }
    }
}
?>
