<?php
header('Content-Type: application/json');
require_once 'config.php';

$teamsRes = $conn->query("SELECT name FROM teams");
$teams = [];
while ($row = $teamsRes->fetch_assoc()) $teams[] = $row['name'];

$stats = [];
foreach ($teams as $t) {
    $stats[$t] = ['P'=>0,'W'=>0,'D'=>0,'L'=>0,'GF'=>0,'GA'=>0,'GD'=>0,'Pts'=>0];
}

$matches = $conn->query("SELECT home_team, away_team, home_score, away_score FROM matches WHERE played = 1");
while ($m = $matches->fetch_assoc()) {
    $home = $m['home_team']; $away = $m['away_team'];
    $hs = $m['home_score']; $as = $m['away_score'];
    $stats[$home]['GF'] += $hs; $stats[$home]['GA'] += $as;
    $stats[$away]['GF'] += $as; $stats[$away]['GA'] += $hs;
    $stats[$home]['P']++; $stats[$away]['P']++;
    if ($hs > $as) {
        $stats[$home]['W']++; $stats[$home]['Pts'] += 3;
        $stats[$away]['L']++;
    } elseif ($hs < $as) {
        $stats[$away]['W']++; $stats[$away]['Pts'] += 3;
        $stats[$home]['L']++;
    } else {
        $stats[$home]['D']++; $stats[$home]['Pts'] += 1;
        $stats[$away]['D']++; $stats[$away]['Pts'] += 1;
    }
}
foreach ($stats as &$s) $s['GD'] = $s['GF'] - $s['GA'];
uasort($stats, function($a,$b) {
    if ($a['Pts'] != $b['Pts']) return $b['Pts'] - $a['Pts'];
    return $b['GD'] - $a['GD'];
});
echo json_encode($stats);
?>