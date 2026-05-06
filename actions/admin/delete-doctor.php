<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../config/auth.php';

requireLogin('admin');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirectTo('/views/admin/doctors.php');
}
verifyCsrf();

$id = (int)($_POST['id'] ?? 0);
if (!$id) {
    flashMessage('doctor_error', 'Invalid doctor.', 'danger');
    redirectTo('/views/admin/doctors.php');
}

try {
    $pdo = db();

    // Prevent deletion if doctor has non-cancelled/rejected appointments
    $stmt = $pdo->prepare("
        SELECT COUNT(*) FROM appointments
        WHERE doctor_id = ? AND status NOT IN ('Cancelled','Rejected')
    ");
    $stmt->execute([$id]);
    if ((int)$stmt->fetchColumn() > 0) {
        flashMessage('doctor_error', 'Cannot delete a doctor with active or pending appointments.', 'danger');
        redirectTo('/views/admin/doctors.php');
    }

    $pdo->prepare("DELETE FROM doctors WHERE id = ?")->execute([$id]);
    flashMessage('doctor_success', 'Doctor removed successfully.', 'success');
} catch (Exception $e) {
    flashMessage('doctor_error', 'Database error: ' . $e->getMessage(), 'danger');
}

redirectTo('/views/admin/doctors.php');
?>
