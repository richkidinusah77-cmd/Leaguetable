<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: admin_login.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: center; }
        th { background: #333; color: white; }
        input { width: 60px; padding: 5px; text-align: center; }
        button { background: #28a745; color: white; border: none; padding: 5px 10px; cursor: pointer; border-radius: 4px; }
        .logout { background: #dc3545; padding: 10px 20px; text-decoration: none; color: white; border-radius: 5px; }
        h1 { color: #333; }
    </style>
    <script>
        async function saveScore(matchId) {
            const homeScore = document.getElementById(`home_${matchId}`).value;
            const awayScore = document.getElementById(`away_${matchId}`).value;
            const response = await fetch('save_match.php', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({match_id: matchId, home_score: homeScore, away_score: awayScore})
            });
            if (response.ok) {
                alert('Saved successfully!');
                location.reload();
            } else {
                alert('Error saving scores.');
            }
        }
    </script>
</head>
<body>
    <h1>Edit Match Results</h1>
    <a href="logout.php" class="logout">Logout</a>
    <table>
        <tr><th>Home Team</th><th>Away Team</th><th>Score</th><th>Action</th></tr>
        <?php
        require_once 'config.php';
        $sql = "SELECT m.id, ht.name as home, at.name as away, m.home_score, m.away_score, m.played
                FROM matches m
                JOIN teams ht ON m.home_team_id = ht.id
                JOIN teams at ON m.away_team_id = at.id
                ORDER BY m.round_no, m.id";
        $res = $conn->query($sql);
        while ($row = $res->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['home']}</td>";
            echo "<td>{$row['away']}</td>";
            echo "<td><input type='number' id='home_{$row['id']}' value='{$row['home_score']}' size=2> - <input type='number' id='away_{$row['id']}' value='{$row['away_score']}' size=2></td>";
            echo "<td><button onclick='saveScore({$row['id']})'>Save</button></td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>