<?php
header('Content-Type: application/json');
require_once 'config.php';

$data = json_decode(file_get_contents('php://input'), true);
$home = $data['home_team'];
$away = $data['away_team'];
$round = intval($data['round_no']);
$homeScore = intval($data['home_score']);
$awayScore = intval($data['away_score']);

$stmt = $conn->prepare("INSERT INTO matches (home_team, away_team, home_score, away_score, round_no, played) 
                        VALUES (?, ?, ?, ?, ?, 1) 
                        ON DUPLICATE KEY UPDATE home_score = ?, away_score = ?, played = 1");
$stmt->bind_param("ssiiiii", $home, $away, $homeScore, $awayScore, $round, $homeScore, $awayScore);
$stmt->execute();

echo json_encode(['success' => true]);
?>