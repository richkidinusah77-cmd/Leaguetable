<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes, viewport-fit=cover">
    <title>efootball league games · eFootball Manager</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            -webkit-tap-highlight-color: transparent;
        }

        body {
            background: radial-gradient(circle at 10% 30%, #eef5ff, #e0eafc);
            font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, Helvetica, sans-serif;
            color: #0a1c1f;
            padding: 0 0 32px 0;
        }

        /* nano color palette — fresh electric pastels & deep mineral tones */
        :root {
            --nano-mint: #b8f2e2;
            --nano-teal: #2dd4bf;
            --nano-deep: #0f2e2c;
            --nano-lavender: #e0d4ff;
            --nano-electric: #5ee0fa;
            --nano-amber: #fbbf24;
            --nano-card: rgba(255, 255, 255, 0.92);
            --glass-border: rgba(45, 212, 191, 0.2);
            --shadow-sm: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.02);
            --shadow-md: 0 20px 30px -12px rgba(0, 0, 0, 0.1);
        }

        .header {
            background: linear-gradient(135deg, #0b2b26 0%, #1c4e44 50%, #1c6356 100%);
            padding: 28px 20px 32px 20px;
            text-align: center;
            border-radius: 0 0 32px 32px;
            box-shadow: var(--shadow-md);
            position: relative;
            z-index: 2;
        }

        .header h1 {
            font-size: 1.9rem;
            font-weight: 700;
            letter-spacing: -0.3px;
            background: linear-gradient(135deg, #ffffff, var(--nano-electric));
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            text-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .header p {
            font-size: 0.85rem;
            opacity: 0.9;
            color: #c1f0e8;
            margin-top: 6px;
            font-weight: 500;
        }

        .container {
            max-width: 600px;
            margin: -18px auto 0 auto;
            padding: 0 16px;
        }

        /* stats grid — fully responsive tiles */
        .stats-summary {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 12px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: var(--nano-card);
            backdrop-filter: blur(2px);
            border-radius: 28px;
            padding: 16px 8px;
            text-align: center;
            box-shadow: var(--shadow-sm);
            border: 1px solid rgba(45, 212, 191, 0.25);
            transition: all 0.2s ease;
        }

        .stat-card:active { transform: scale(0.97); }

        .stat-card h3 {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 700;
            color: #1e5a54;
            margin-bottom: 8px;
        }

        .stat-value {
            font-size: 1.75rem;
            font-weight: 800;
            background: linear-gradient(145deg, #0f2e2c, #1c6e60);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            line-height: 1.2;
        }

        .reset-btn {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(8px);
            border: 1px solid #fecaca;
            color: #b91c1c;
            padding: 12px 20px;
            border-radius: 60px;
            font-weight: 700;
            width: 100%;
            font-size: 0.9rem;
            margin-bottom: 20px;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: var(--shadow-sm);
        }

        .reset-btn:active { transform: scale(0.97); background: #fff0f0; }

        /* round section */
        .round-section {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border-radius: 32px;
            padding: 20px 16px;
            margin-bottom: 24px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--glass-border);
        }

        .round-header {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            flex-wrap: wrap;
            margin-bottom: 20px;
            gap: 12px;
        }

        .round-title {
            font-size: 1.65rem;
            font-weight: 800;
            background: linear-gradient(125deg, #134e4a, #2dd4bf);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
        }

        .round-nav button {
            background: #eef3fc;
            border: none;
            padding: 8px 22px;
            border-radius: 40px;
            font-weight: 600;
            font-size: 0.8rem;
            margin: 0 4px;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        }

        .round-nav button:active { transform: scale(0.96); background: #cbddee; }
        .round-nav button:disabled { opacity: 0.4; transform: none; }

        /* match cards — mobile first */
        .matches-grid {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .match-card {
            background: white;
            border-radius: 24px;
            padding: 12px 16px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            border: 1px solid #e2f0ef;
            transition: all 0.2s ease;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        }

        .match-card.completed {
            background: #eefaf7;
            border-left: 5px solid #2dd4bf;
        }

        .match-teams {
            font-weight: 700;
            font-size: 0.95rem;
            display: flex;
            flex-wrap: wrap;
            align-items: baseline;
            gap: 6px;
        }

        .home-team, .away-team {
            background: #f1f9f7;
            padding: 4px 10px;
            border-radius: 40px;
            font-size: 0.85rem;
        }

        .vs {
            color: #7f8e8b;
            font-size: 0.7rem;
            font-weight: 500;
        }

        .match-score {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .match-score input {
            width: 60px;
            padding: 10px 4px;
            text-align: center;
            font-size: 1rem;
            font-weight: 700;
            border: 1.5px solid #cbe5e2;
            border-radius: 28px;
            background: #ffffff;
            transition: 0.1s;
        }

        .match-score input:focus {
            border-color: #2dd4bf;
            outline: none;
        }

        .update-btn {
            background: #1d6f62;
            border: none;
            color: white;
            font-weight: 700;
            padding: 8px 18px;
            border-radius: 40px;
            font-size: 0.75rem;
            cursor: pointer;
            transition: 0.15s;
        }

        .update-btn:active { transform: scale(0.95); background: #0f554a; }

        /* info panels */
        .info-panels {
            display: flex;
            flex-direction: column;
            gap: 18px;
            margin: 16px 0 24px;
        }

        .panel {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(8px);
            border-radius: 32px;
            padding: 18px 20px;
            border: 1px solid var(--glass-border);
        }

        .panel h3 {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
            color: #0f3a35;
            border-left: 5px solid #2dd4bf;
            padding-left: 14px;
        }

        .scorer-item, .history-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #daf2ec;
            font-size: 0.9rem;
        }

        .scorer-item span:first-child { font-weight: 600; }

        /* league table — horizontal scroll on mobile */
        .table-wrapper {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(4px);
            border-radius: 32px;
            padding: 8px 4px;
            overflow-x: auto;
            border: 1px solid #d0ebe6;
        }

        .league-table {
            width: 100%;
            min-width: 560px;
            border-collapse: collapse;
            font-size: 0.8rem;
        }

        .league-table th {
            background: #0c2b27;
            color: white;
            padding: 12px 5px;
            font-weight: 600;
            font-size: 0.7rem;
        }

        .league-table td {
            padding: 10px 4px;
            text-align: center;
            border-bottom: 1px solid #cbe5e0;
            font-weight: 500;
        }

        .top-rank {
            background: #fff9e6;
            font-weight: 800;
            position: relative;
        }

        /* micro animations */
        @media (max-width: 560px) {
            .stats-summary { grid-template-columns: 1fr 1fr; gap: 10px; }
            .match-card { flex-direction: column; align-items: stretch; }
            .match-teams { justify-content: center; }
            .match-score { justify-content: space-between; }
            .round-title { font-size: 1.4rem; }
        }

        @media (max-width: 440px) {
            .stat-value { font-size: 1.4rem; }
            .update-btn { width: 100%; margin-top: 6px; }
            .match-score input { width: 55px; }
        }

        /* custom scroll */
        ::-webkit-scrollbar { width: 4px; height: 4px; }
        ::-webkit-scrollbar-track { background: #e0f2ef; border-radius: 10px; }
        ::-webkit-scrollbar-thumb { background: #2dd4bf; border-radius: 10px; }
    </style>
</head>
<body>
<div class="header">
    <h1>eFOOTBALL LEAGUE GAMES</h1>
</div>
<div class="container">
    <div class="stats-summary" id="statsSummary"></div>
    <button class="reset-btn" id="globalResetBtn">🗑️  RESET ALL RESULTS</button>
    <div class="round-section">
        <div class="round-header">
            <div class="round-title" id="roundTitle">Round 1</div>
            <div class="round-nav">
                <button id="prevRoundBtn">← PREV</button>
                <button id="nextRoundBtn">NEXT →</button>
            </div>
        </div>
        <div class="matches-grid" id="matchesGrid"></div>
    </div>
    <div class="info-panels">
        <div class="panel"><h3>🔥 TOP SCORING TEAMS</h3><div id="topScorersList"></div></div>
        <div class="panel"><h3>📋 RECENT BATTLES</h3><div id="matchHistoryList"></div></div>
    </div>
    <div class="table-wrapper">
        <table class="league-table">
            <thead><tr><th>TEAM</th><th>P</th><th>W</th><th>D</th><th>L</th><th>GF</th><th>GA</th><th>GD</th><th>PTS</th></tr>
            </thead>
            <tbody id="tableBody"></tbody>
        </table>
    </div>
</div>

<script>
    // ---------- LEAGUE DATA (EXACT SAME AS ORIGINAL FIXTURES) ----------
    const teams = ["Enzo","Nween Enock","Issah Stephen","Rich Pogba","Unruly Dazzy","Niina Ragga","Quame Dollar","Inusah Richkid","Bless Dee","Ibrahim"];
    
    const roundsRaw = [
        ["Enzo","Nween Enock"],["Issah Stephen","Rich Pogba"],["Unruly Dazzy","Niina Ragga"],["Quame Dollar","Inusah Richkid"],["Bless Dee","Ibrahim"],
        ["Nween Enock","Issah Stephen"],["Rich Pogba","Unruly Dazzy"],["Niina Ragga","Quame Dollar"],["Inusah Richkid","Bless Dee"],["Ibrahim","Enzo"],
        ["Issah Stephen","Enzo"],["Unruly Dazzy","Nween Enock"],["Quame Dollar","Rich Pogba"],["Bless Dee","Niina Ragga"],["Ibrahim","Inusah Richkid"],
        ["Enzo","Unruly Dazzy"],["Issah Stephen","Quame Dollar"],["Nween Enock","Bless Dee"],["Rich Pogba","Ibrahim"],["Niina Ragga","Inusah Richkid"],
        ["Quame Dollar","Enzo"],["Bless Dee","Issah Stephen"],["Ibrahim","Nween Enock"],["Inusah Richkid","Rich Pogba"],["Unruly Dazzy","Niina Ragga"],
        ["Enzo","Bless Dee"],["Issah Stephen","Ibrahim"],["Nween Enock","Inusah Richkid"],["Rich Pogba","Niina Ragga"],["Quame Dollar","Unruly Dazzy"],
        ["Ibrahim","Enzo"],["Inusah Richkid","Issah Stephen"],["Niina Ragga","Nween Enock"],["Unruly Dazzy","Rich Pogba"],["Bless Dee","Quame Dollar"],
        ["Enzo","Inusah Richkid"],["Issah Stephen","Niina Ragga"],["Nween Enock","Unruly Dazzy"],["Rich Pogba","Bless Dee"],["Quame Dollar","Ibrahim"],
        ["Niina Ragga","Enzo"],["Unruly Dazzy","Issah Stephen"],["Bless Dee","Nween Enock"],["Ibrahim","Rich Pogba"],["Inusah Richkid","Quame Dollar"]
    ];
    
    // generate rounds grouping (5 matches per round) and then double round-robin (home&away)
    function buildAllRounds() {
        let roundsGroup = [];
        for (let i = 0; i < roundsRaw.length; i += 5) {
            roundsGroup.push(roundsRaw.slice(i, i+5));
        }
        // first half + second half reversed (away fixtures)
        const secondHalf = roundsGroup.map(round => round.map(([h, a]) => [a, h]));
        return [...roundsGroup, ...secondHalf];
    }
    
    const allRounds = buildAllRounds();   // 18 rounds total (each with 5 matches)
    const TOTAL_MATCHES = allRounds.length * 5;   // 90 matches
    
    // ---------- PERSISTENCE (localStorage nano) ----------
    const STORAGE_KEY = "efootball_nano_matches";
    
    // matchesDB: key = "home|away|round" -> { home_score, away_score, played, updatedAt }
    let matchesDB = {};
    
    function loadMatchesFromStorage() {
        const stored = localStorage.getItem(STORAGE_KEY);
        if (stored) {
            matchesDB = JSON.parse(stored);
        } else {
            matchesDB = {};
        }
    }
    
    function persistMatches() {
        localStorage.setItem(STORAGE_KEY, JSON.stringify(matchesDB));
    }
    
    // helper: generate match key
    function getMatchKey(home, away, roundNum) {
        return `${home}|${away}|${roundNum}`;
    }
    
    // save match result (client-side, no backend)
    function saveMatchResult(home, away, round, homeScore, awayScore) {
        const key = getMatchKey(home, away, round);
        matchesDB[key] = {
            home_score: homeScore,
            away_score: awayScore,
            played: true,
            updatedAt: Date.now()
        };
        persistMatches();
        refreshAllUI();
    }
    
    function resetAllResults() {
        if (!confirm("⚠️ NANO RESET: erase all match results? This action is irreversible.")) return;
        matchesDB = {};
        persistMatches();
        refreshAllUI();
    }
    
    // ---------- STANDINGS & STATS COMPUTATION ----------
    function computeStandings() {
        const stats = {};
        teams.forEach(t => {
            stats[t] = { P: 0, W: 0, D: 0, L: 0, GF: 0, GA: 0, GD: 0, Pts: 0 };
        });
        
        for (const [key, match] of Object.entries(matchesDB)) {
            if (!match.played) continue;
            const [home, away, roundStr] = key.split('|');
            const homeScore = match.home_score;
            const awayScore = match.away_score;
            // home team
            stats[home].P += 1;
            stats[home].GF += homeScore;
            stats[home].GA += awayScore;
            // away team
            stats[away].P += 1;
            stats[away].GF += awayScore;
            stats[away].GA += homeScore;
            
            if (homeScore > awayScore) {
                stats[home].W += 1;
                stats[away].L += 1;
                stats[home].Pts += 3;
            } else if (awayScore > homeScore) {
                stats[away].W += 1;
                stats[home].L += 1;
                stats[away].Pts += 3;
            } else {
                stats[home].D += 1;
                stats[away].D += 1;
                stats[home].Pts += 1;
                stats[away].Pts += 1;
            }
        }
        
        // calculate GD for each team
        for (let t of teams) {
            stats[t].GD = stats[t].GF - stats[t].GA;
        }
        return stats;
    }
    
    function getCompletedMatchesCount() {
        let count = 0;
        for (let m of Object.values(matchesDB)) if (m.played) count++;
        return count;
    }
    
    function getTotalGoals() {
        let total = 0;
        for (let m of Object.values(matchesDB)) if (m.played) total += m.home_score + m.away_score;
        return total;
    }
    
    // display stats cards & top scorers & recent matches
    async function refreshStatsAndHistory() {
        const stats = computeStandings();
        const completedMatches = getCompletedMatchesCount();
        const totalGoals = getTotalGoals();
        const progressPercent = TOTAL_MATCHES === 0 ? 0 : Math.round((completedMatches / TOTAL_MATCHES) * 100);
        
        let highestTeam = "—";
        let highestGoals = -1;
        for (const [team, s] of Object.entries(stats)) {
            if (s.GF > highestGoals) {
                highestGoals = s.GF;
                highestTeam = team;
            }
        }
        
        const statsSummaryDiv = document.getElementById('statsSummary');
        statsSummaryDiv.innerHTML = `
            <div class="stat-card"><h3>🎮 COMPLETED</h3><div class="stat-value">${completedMatches}/${TOTAL_MATCHES}</div></div>
            <div class="stat-card"><h3>⚽ TOTAL GOALS</h3><div class="stat-value">${totalGoals}</div></div>
            <div class="stat-card"><h3>💥 TOP SCORER</h3><div class="stat-value">${highestTeam}</div><div style="font-size:0.7rem">${highestGoals} goals</div></div>
            <div class="stat-card"><h3>🏁 PROGRESS</h3><div class="stat-value">${progressPercent}%</div></div>
        `;
        
        // top scoring teams ranking
        const sortedByGF = Object.entries(stats).sort((a,b) => b[1].GF - a[1].GF).slice(0,5);
        const topScorersHtml = sortedByGF.map(([team, s], idx) => 
            `<div class="scorer-item"><span>${idx+1}. ${team}</span><span>⚽ ${s.GF}</span></div>`
        ).join('');
        document.getElementById('topScorersList').innerHTML = topScorersHtml || '<div>✨ No matches yet</div>';
        
        // recent matches (max 10, sorted by updatedAt desc)
        const matchesList = [];
        for (const [key, data] of Object.entries(matchesDB)) {
            if (data.played) {
                const [home, away, round] = key.split('|');
                matchesList.push({
                    home, away, 
                    homeScore: data.home_score, 
                    awayScore: data.away_score,
                    round: parseInt(round),
                    updatedAt: data.updatedAt || 0
                });
            }
        }
        matchesList.sort((a,b) => (b.updatedAt || 0) - (a.updatedAt || 0));
        const recent10 = matchesList.slice(0,10);
        const historyHtml = recent10.map(m => 
            `<div class="history-item"><div>${m.home} vs ${m.away}</div><div><strong>${m.homeScore} - ${m.awayScore}</strong></div></div>`
        ).join('');
        document.getElementById('matchHistoryList').innerHTML = historyHtml || '<div class="history-item">⚡ No results recorded yet</div>';
    }
    
    // update league table in DOM
    function renderStandingsTable() {
        const stats = computeStandings();
        const sorted = Object.entries(stats).sort((a,b) => b[1].Pts - a[1].Pts || b[1].GD - a[1].GD);
        const tbody = document.getElementById('tableBody');
        tbody.innerHTML = '';
        sorted.forEach(([team, s], idx) => {
            const row = tbody.insertRow();
            if (idx < 3) row.className = 'top-rank';
            row.innerHTML = `
                <td style="font-weight:700;">${team}</td>
                <td>${s.P}</td><td>${s.W}</td><td>${s.D}</td><td>${s.L}</td>
                <td>${s.GF}</td><td>${s.GA}</td><td>${s.GD}</td>
                <td style="font-weight:800; color:#0f6e5e;">${s.Pts}</td>
            `;
        });
    }
    
    // ---------- RENDER CURRENT ROUND (MOBILE FRIENDLY) ----------
    let currentRoundIdx = 0;
    
    function renderCurrentRound() {
        const roundMatches = allRounds[currentRoundIdx];
        const roundNumber = currentRoundIdx + 1;
        document.getElementById('roundTitle').innerHTML = `🌀 ROUND ${roundNumber} <span style="font-size:0.7rem;">(of ${allRounds.length})</span>`;
        
        const grid = document.getElementById('matchesGrid');
        grid.innerHTML = '';
        
        for (let [home, away] of roundMatches) {
            const key = getMatchKey(home, away, roundNumber);
            const saved = matchesDB[key];
            const isCompleted = saved && saved.played === true;
            const homeVal = isCompleted ? saved.home_score : '';
            const awayVal = isCompleted ? saved.away_score : '';
            
            const card = document.createElement('div');
            card.className = `match-card ${isCompleted ? 'completed' : ''}`;
            
            card.innerHTML = `
                <div class="match-teams">
                    <span class="home-team">${home}</span>
                    <span class="vs">VS</span>
                    <span class="away-team">${away}</span>
                </div>
                <div class="match-score">
                    <input type="number" class="score-input" id="home_${home}_${away}_${roundNumber}" placeholder="H" value="${homeVal}" ${isCompleted ? 'disabled' : ''}>
                    <span style="font-weight:bold;">—</span>
                    <input type="number" class="score-input" id="away_${home}_${away}_${roundNumber}" placeholder="A" value="${awayVal}" ${isCompleted ? 'disabled' : ''}>
                    ${!isCompleted ? `<button class="update-btn" data-home="${home}" data-away="${away}" data-round="${roundNumber}">✓ SAVE</button>` : '<span style="color:#1d6f62; font-weight:600;">✔ SCORED</span>'}
                </div>
            `;
            grid.appendChild(card);
        }
        
        // attach dynamic event listeners for update buttons (only for incomplete matches)
        document.querySelectorAll('.update-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const home = btn.getAttribute('data-home');
                const away = btn.getAttribute('data-away');
                const round = parseInt(btn.getAttribute('data-round'));
                const homeInput = document.getElementById(`home_${home}_${away}_${round}`);
                const awayInput = document.getElementById(`away_${home}_${away}_${round}`);
                let homeScore = parseInt(homeInput.value);
                let awayScore = parseInt(awayInput.value);
                if (isNaN(homeScore)) homeScore = 0;
                if (isNaN(awayScore)) awayScore = 0;
                saveMatchResult(home, away, round, homeScore, awayScore);
            });
        });
        
        // round nav buttons state
        const prevBtn = document.getElementById('prevRoundBtn');
        const nextBtn = document.getElementById('nextRoundBtn');
        if (prevBtn) prevBtn.disabled = (currentRoundIdx === 0);
        if (nextBtn) nextBtn.disabled = (currentRoundIdx === allRounds.length - 1);
    }
    
    function changeRound(delta) {
        const newRound = currentRoundIdx + delta;
        if (newRound >= 0 && newRound < allRounds.length) {
            currentRoundIdx = newRound;
            renderCurrentRound();
        }
    }
    
    // full UI refresher
    async function refreshAllUI() {
        renderCurrentRound();
        renderStandingsTable();
        refreshStatsAndHistory();
    }
    
    // ---------- INITIALIZATION ----------
    function init() {
        loadMatchesFromStorage();
        refreshAllUI();
        
        // global reset listener
        const resetBtn = document.getElementById('globalResetBtn');
        if (resetBtn) resetBtn.addEventListener('click', resetAllResults);
        
        // round nav listeners
        const prev = document.getElementById('prevRoundBtn');
        const next = document.getElementById('nextRoundBtn');
        if (prev) prev.addEventListener('click', () => changeRound(-1));
        if (next) next.addEventListener('click', () => changeRound(1));
    }
    
    // start app
    init();
</script>
</body>
</html>