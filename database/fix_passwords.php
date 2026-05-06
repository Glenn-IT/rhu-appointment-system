<?php
$pdo = new PDO('mysql:host=localhost;dbname=rhu_rizal;charset=utf8mb4', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$patientHash = password_hash('patient123', PASSWORD_BCRYPT);
$adminHash   = password_hash('admin123',   PASSWORD_BCRYPT);

$pdo->prepare("UPDATE users SET password = ? WHERE role = 'patient'")->execute([$patientHash]);
$pdo->prepare("UPDATE admin_users SET password = ? WHERE username = 'admin'")->execute([$adminHash]);

echo "patient123 hash: $patientHash\n";
echo "admin123 hash:   $adminHash\n";
echo "Verify patient: " . (password_verify('patient123', $patientHash) ? 'OK' : 'FAIL') . "\n";
echo "Verify admin:   " . (password_verify('admin123',   $adminHash)   ? 'OK' : 'FAIL') . "\n";
echo "Done.\n";
