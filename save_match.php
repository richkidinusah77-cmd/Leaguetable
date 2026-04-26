<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    http_response_code(403);
    die('Unauthorized');
}

require_once 'config.php';
$data = json_decode(file_get_contents('php://input'), true);
$match_id = intval($data['match_id']);
$home_score = intval($data['home_score']);
$away_score = intval($data['away_score']);

$stmt = $conn->prepare("UPDATE matches SET home_score = ?, away_score = ?, played = 1 WHERE id = ?");
$stmt->bind_param("iii", $home_score, $away_score, $match_id);
if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => $stmt->error]);
}
?>