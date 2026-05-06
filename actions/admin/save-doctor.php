<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../config/auth.php';

requireLogin('admin');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirectTo('/views/admin/doctors.php');
}
verifyCsrf();

$id        = (int)trim($_POST['id']        ?? 0);
$name      = trim($_POST['name']           ?? '');
$specialty = trim($_POST['specialty']      ?? '');
$schedule  = trim($_POST['schedule']       ?? '');
$available = isset($_POST['available']) ? (int)(bool)$_POST['available'] : 1;

if (!$name || !$specialty || !$schedule) {
    flashMessage('doctor_error', 'Please fill in all required fields.', 'danger');
    redirectTo('/views/admin/doctors.php');
}

try {
    $pdo = db();

    if ($id > 0) {
        // Edit existing
        $pdo->prepare("UPDATE doctors SET name=?, specialty=?, schedule=?, available=? WHERE id=?")
            ->execute([$name, $specialty, $schedule, $available, $id]);
        flashMessage('doctor_success', 'Doctor updated successfully.', 'success');
    } else {
        // Add new
        $pdo->prepare("INSERT INTO doctors (name, specialty, schedule, available) VALUES (?, ?, ?, ?)")
            ->execute([$name, $specialty, $schedule, $available]);
        flashMessage('doctor_success', 'Doctor added successfully.', 'success');
    }
} catch (Exception $e) {
    flashMessage('doctor_error', 'Database error: ' . $e->getMessage(), 'danger');
}

redirectTo('/views/admin/doctors.php');
?>
