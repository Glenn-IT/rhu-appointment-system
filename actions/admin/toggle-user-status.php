<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../config/auth.php';

requireLogin('admin');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirectTo('/views/admin/users.php');
}
verifyCsrf();

$userId = (int)($_POST['user_id'] ?? 0);
if (!$userId) {
    flashMessage('user_error', 'Invalid user.', 'danger');
    redirectTo('/views/admin/users.php');
}

try {
    $pdo  = db();
    $stmt = $pdo->prepare("SELECT status FROM users WHERE id = ? LIMIT 1");
    $stmt->execute([$userId]);
    $user = $stmt->fetch();

    if (!$user) {
        flashMessage('user_error', 'User not found.', 'danger');
        redirectTo('/views/admin/users.php');
    }

    $newStatus = ($user['status'] === 'Active') ? 'Inactive' : 'Active';
    $pdo->prepare("UPDATE users SET status = ? WHERE id = ?")->execute([$newStatus, $userId]);

    $label = $newStatus === 'Active' ? 'activated' : 'deactivated';
    flashMessage('user_success', "User account {$label} successfully.", 'success');
} catch (Exception $e) {
    flashMessage('user_error', 'Database error: ' . $e->getMessage(), 'danger');
}

redirectTo('/views/admin/users.php');
?>
