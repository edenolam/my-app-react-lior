<?php
declare(strict_types=1);

namespace app\models;

class Appointment {
    private \mysqli $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    public function getAll(): array {
        $sql = "SELECT a.id, a.name, a.email, a.appointment_date, t.start_time, t.end_time
                FROM appointments a
                JOIN timeslots t ON a.timeslot = t.id
                ORDER BY a.appointment_date";
        $result = $this->conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function book(string $name, string $email, string $appointment_date, string $timeslot): bool {
        $stmt = $this->conn->prepare("INSERT INTO appointments (name, email, appointment_date, timeslot) VALUES (?, ?, ?, ?)");
        $stmt->bind_param('sssi', $name, $email, $appointment_date, $timeslot);
        return $stmt->execute();
    }

    public function delete(int $id): bool {
        $stmt = $this->conn->prepare("DELETE FROM appointments WHERE id = ?");
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }
}

