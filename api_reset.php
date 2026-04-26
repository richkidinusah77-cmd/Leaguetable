<?php
require_once 'config.php';
$conn->query("TRUNCATE TABLE matches");
echo json_encode(["success" => true]);
?>