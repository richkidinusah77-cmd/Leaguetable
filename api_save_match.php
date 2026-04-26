<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'config.php';

// Get JSON input
$input = json_decode(file_get_contents('php://input'), true);
if (!$input) {
    echo json_encode(["success" => false, "error" => "No JSON data received"]);
    exit;
}

$home = trim($input['home_team']);
$away = trim($input['away_team']);
$round = intval($input['round_no']);
$homeScore = intval($input['home_score']);
$awayScore = intval($input['away_score']);

// Validate
if (empty($home) || empty($away) || $round < 1) {
    echo json_encode(["success" => false, "error" => "Invalid match data"]);
    exit;
}

// First, ensure the teams exist in the `teams` table (they already do, but just in case)
$checkHome = $conn->query("SELECT id FROM teams WHERE name = '$home'");
$checkAway = $conn->query("SELECT id FROM teams WHERE name = '$away'");
if ($checkHome->num_rows == 0 || $checkAway->num_rows == 0) {
    echo json_encode(["success" => false, "error" => "One of the teams does not exist in database"]);
    exit;
}

// Insert or update match
$sql = "INSERT INTO matches (home_team, away_team, round_no, home_score, away_score, played) 
        VALUES (?, ?, ?, ?, ?, 1)
        ON DUPLICATE KEY UPDATE home_score = ?, away_score = ?, played = 1";
$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo json_encode(["success" => false, "error" => "Prepare failed: " . $conn->error]);
    exit;
}
$stmt->bind_param("ssiiiii", $home, $away, $round, $homeScore, $awayScore, $homeScore, $awayScore);
if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => $stmt->error]);
}
$stmt->close();
$conn->close();
?>