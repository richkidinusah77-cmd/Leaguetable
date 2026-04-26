<?php
header('Content-Type: application/json');
require_once 'config.php';

$result = $conn->query("SELECT home_team, away_team, home_score, away_score, round_no, played FROM matches ORDER BY round_no, id");
$matches = [];
while ($row = $result->fetch_assoc()) {
    $matches[] = $row;
}
echo json_encode($matches);
?>