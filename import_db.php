<?php
$host = 'YOUR_DB_HOST';
$port = '3306';
$db   = 'YOUR_DB_NAME';
$user = 'YOUR_DB_USER';
$pass = 'YOUR_DB_PASSWORD';

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE                  => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    $pdo->exec('SET SESSION sql_require_primary_key = 0;');
    $sql = file_get_contents('basededonnée/if0_40646255_ada.sql');
    $pdo->exec($sql);
    echo "Database imported successfully.\n";
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
