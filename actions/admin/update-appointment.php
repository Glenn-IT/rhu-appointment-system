<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../config/auth.php';

requireLogin('admin');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirectTo('/views/admin/appointments.php');
}
verifyCsrf();

$session  = getAdminSession();
$username = $session['username'];

$apptId   = (int)   ($_POST['appointment_id'] ?? 0);
$newStatus = trim(  $_POST['status']          ?? '');
$note      = trim(  $_POST['note']            ?? '');

$allowed = ['Approved', 'Rejected', 'Completed', 'Cancelled'];
if (!$apptId || !in_array($newStatus, $allowed)) {
    flashMessage('appt_error', 'Invalid request.', 'danger');
    redirectTo('/views/admin/appointments.php');
}

try {
    $pdo = db();

    $stmt = $pdo->prepare("SELECT id, appt_no, status FROM appointments WHERE id = ? LIMIT 1");
    $stmt->execute([$apptId]);
    $appt = $stmt->fetch();

    if (!$appt) {
        flashMessage('appt_error', 'Appointment not found.', 'danger');
        redirectTo('/views/admin/appointments.php');
    }

    $oldStatus = $appt['status'];

    // Business rules
    $transitions = [
        'Pending'   => ['Approved', 'Rejected'],
        'Approved'  => ['Completed', 'Cancelled'],
    ];
    if (!isset($transitions[$oldStatus]) || !in_array($newStatus, $transitions[$oldStatus])) {
        flashMessage('appt_error', "Cannot transition from {$oldStatus} to {$newStatus}.", 'warning');
        redirectTo('/views/admin/appointments.php');
    }

    // Update status (and optionally date/time for reschedule)
    $newDate = trim($_POST['new_date'] ?? '');
    $newTime = trim($_POST['new_time'] ?? '');
    if ($newDate && $newTime) {
        $pdo->prepare("UPDATE appointments SET status = ?, date = ?, time = ? WHERE id = ?")
            ->execute([$newStatus, $newDate, $newTime, $apptId]);
    } else {
        $pdo->prepare("UPDATE appointments SET status = ? WHERE id = ?")
            ->execute([$newStatus, $apptId]);
    }

    // Audit log
    $logNote = $note ?: "Status changed by admin";
    $pdo->prepare("
        INSERT INTO appointment_logs (appointment_id, changed_by, old_status, new_status, note)
        VALUES (?, ?, ?, ?, ?)
    ")->execute([$apptId, $username, $oldStatus, $newStatus, $logNote]);

    $msgs = [
        'Approved'  => "Appointment {$appt['appt_no']} approved.",
        'Rejected'  => "Appointment {$appt['appt_no']} rejected.",
        'Completed' => "Appointment {$appt['appt_no']} marked as completed.",
        'Cancelled' => "Appointment {$appt['appt_no']} cancelled.",
    ];
    flashMessage('appt_success', $msgs[$newStatus], 'success');
    redirectTo('/views/admin/appointments.php');

} catch (RuntimeException $e) {
    flashMessage('appt_error', 'A server error occurred. Please try again.', 'danger');
    redirectTo('/views/admin/appointments.php');
}
