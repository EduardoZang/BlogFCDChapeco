<?php
include 'db.php';

try {
    $stmt = $pdo->query('SELECT 1');
    echo "Conexão bem-sucedida!";
} catch (PDOException $e) {
    die("Falha na conexão: " . $e->getMessage());
}
?>