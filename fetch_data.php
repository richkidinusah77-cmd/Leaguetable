<?php
header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once 'config.php';

$action = $_GET['action'] ?? '';

if ($action === 'matches') {
    $sql = "SELECT m.*, ht.name as home_team_name, at.name as away_team_name 
            FROM matches m
            JOIN teams ht ON m.home_team_id = ht.id
            JOIN teams at ON m.away_team_id = at.id
            ORDER BY m.round_no, m.id";
    $result = $conn->query($sql);
    if (!$result) {
        echo json_encode(['error' => $conn->error]);
        exit;
    }
    echo json_encode($result->fetch_all(MYSQLI_ASSOC));
} 
elseif ($action === 'standings') {
    $standings = [];
    $teams = $conn->query("SELECT id, name FROM teams");
    if (!$teams) {
        echo json_encode(['error' => $conn->error]);
        exit;
    }
    while ($team = $teams->fetch_assoc()) {
        $standings[$team['id']] = [
            'team' => $team['name'],
            'played' => 0, 'won' => 0, 'drawn' => 0, 'lost' => 0,
            'gf' => 0, 'ga' => 0, 'gd' => 0, 'points' => 0
        ];
    }
    
    $matches = $conn->query("SELECT * FROM matches WHERE played = 1");
    if ($matches) {
        while ($m = $matches->fetch_assoc()) {
            $home = $m['home_team_id'];
            $away = $m['away_team_id'];
            $hs = $m['home_score'];
            $as = $m['away_score'];
            
            $standings[$home]['played']++;
            $standings[$away]['played']++;
            $standings[$home]['gf'] += $hs;
            $standings[$home]['ga'] += $as;
            $standings[$away]['gf'] += $as;
            $standings[$away]['ga'] += $hs;
            
            if ($hs > $as) {
                $standings[$home]['won']++;
                $standings[$home]['points'] += 3;
                $standings[$away]['lost']++;
            } elseif ($hs < $as) {
                $standings[$away]['won']++;
                $standings[$away]['points'] += 3;
                $standings[$home]['lost']++;
            } else {
                $standings[$home]['drawn']++;
                $standings[$home]['points']++;
                $standings[$away]['drawn']++;
                $standings[$away]['points']++;
            }
        }
    }
    
    foreach ($standings as &$s) {
        $s['gd'] = $s['gf'] - $s['ga'];
    }
    usort($standings, function($a, $b) {
        if ($a['points'] != $b['points']) return $b['points'] - $a['points'];
        return $b['gd'] - $a['gd'];
    });
    
    echo json_encode(array_values($standings));
}
else {
    echo json_encode(['error' => 'Invalid action']);
}
?>