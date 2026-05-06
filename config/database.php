<?php
// ============================================================
// RHU Rizal — PDO Database Connection
// ============================================================

require_once __DIR__ . '/config.php';

/**
 * Returns a singleton PDO instance.
 * Throws a RuntimeException on connection failure.
 *
 * Usage:
 *   $pdo = db();
 *   $stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
 */
function db(): PDO
{
    static $pdo = null;

    if ($pdo === null) {
        $dsn = sprintf(
            'mysql:host=%s;dbname=%s;charset=%s',
            DB_HOST,
            DB_NAME,
            DB_CHARSET
        );

        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        } catch (PDOException $e) {
            // Do NOT expose $e->getMessage() in production.
            throw new RuntimeException('Database connection failed. Please contact the system administrator.');
        }
    }

    return $pdo;
}
