<?php
require_once __DIR__ . '/../../config/auth.php';
require_once __DIR__ . '/../../config/database.php';
requireLogin('admin');
verifyCsrf();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirectTo('/views/admin/profile.php');
}

$admin   = getAdminSession();
$adminId = (int) $admin['id'];

$current = $_POST['current_password'] ?? '';
$newPwd  = $_POST['new_password']     ?? '';
$confirm = $_POST['confirm_password'] ?? '';

$errors = [];
if (!$current || !$newPwd || !$confirm) $errors[] = 'All password fields are required.';
if ($newPwd !== $confirm)               $errors[] = 'New passwords do not match.';
if (strlen($newPwd) < 8)               $errors[] = 'New password must be at least 8 characters.';

if ($errors) {
    flashMessage('password_error', implode(' ', $errors), 'danger');
    redirectTo('/views/admin/profile.php');
}

try {
    $stmt = db()->prepare("SELECT password FROM admin_users WHERE id=? LIMIT 1");
    $stmt->execute([$adminId]);
    $hash = $stmt->fetchColumn();

    if (!$hash || !password_verify($current, $hash)) {
        flashMessage('password_error', 'Current password is incorrect.', 'danger');
        redirectTo('/views/admin/profile.php');
    }

    $newHash = password_hash($newPwd, PASSWORD_BCRYPT, ['cost' => BCRYPT_COST]);
    $upd = db()->prepare("UPDATE admin_users SET password=? WHERE id=?");
    $upd->execute([$newHash, $adminId]);

    flashMessage('password_success', 'Password changed successfully.', 'success');
    redirectTo('/views/admin/profile.php');

} catch (\PDOException $e) {
    flashMessage('password_error', 'A database error occurred. Please try again.', 'danger');
    redirectTo('/views/admin/profile.php');
}
