<?php
require __DIR__ . '/config/database.php';
$pdo = db();
$r = $pdo->query('SELECT COUNT(*) AS cnt FROM appointments')->fetch();
echo 'DB connected. Appointments in DB: ' . $r['cnt'] . PHP_EOL;

$r2 = $pdo->query('SELECT COUNT(*) AS cnt FROM users')->fetch();
echo 'Users in DB: ' . $r2['cnt'] . PHP_EOL;

$r3 = $pdo->query('SELECT COUNT(*) AS cnt FROM doctors')->fetch();
echo 'Doctors in DB: ' . $r3['cnt'] . PHP_EOL;

echo 'All config files OK.' . PHP_EOL;
