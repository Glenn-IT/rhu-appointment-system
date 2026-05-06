<?php
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../../config/auth.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirectTo('/views/admin/login.php');
}
verifyCsrf();

$username = trim($_POST['username'] ?? '');
$password = trim($_POST['password'] ?? '');

if ($username === '' || $password === '') {
    flashMessage('admin_login_error', 'Please enter your username and password.', 'warning');
    redirectTo('/views/admin/login.php');
}

try {
    $pdo  = db();
    $stmt = $pdo->prepare("
        SELECT id, username, password AS password_hash, full_name, email, role
        FROM admin_users
        WHERE username = ? AND status = 'active'
        LIMIT 1
    ");
    $stmt->execute([$username]);
    $admin = $stmt->fetch();

    if (!$admin || !password_verify($password, $admin['password_hash'])) {
        flashMessage('admin_login_error', 'Invalid admin credentials.', 'danger');
        redirectTo('/views/admin/login.php');
    }

    setAdminSession($admin);
    redirectTo('/views/admin/dashboard.php');

} catch (RuntimeException $e) {
    flashMessage('admin_login_error', 'A server error occurred. Please try again later.', 'danger');
    redirectTo('/views/admin/login.php');
}
