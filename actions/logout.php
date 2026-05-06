<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/auth.php';

$wasAdmin = isLoggedIn('admin');

session_unset();
session_destroy();

if ($wasAdmin) {
    header('Location: ' . BASE_URL . '/views/admin/login.php');
} else {
    header('Location: ' . BASE_URL . '/index.php');
}
exit;
