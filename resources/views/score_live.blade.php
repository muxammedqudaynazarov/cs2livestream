<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CS2 Turnir Scoreboard</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700;900&display=swap');

        /* Asosiy tana sozlamalari */
        body {
            /* OBS da ishlatsangiz #00ff00 (yashil) qiling. Veb-sayt uchun #111 (to'q qora) yozib qoldirdim */
            background-color: #111;
            font-family: 'Montserrat', sans-serif;
            color: white;
            margin: 0;
            padding: 50px;
            display: flex;
            justify-content: center; /* O'rtaga joylashtirish */
        }

        .cs2-scoreboard {
            width: 900px;
            background: rgba(15, 15, 20, 0.85);
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            overflow: hidden;
            backdrop-filter: blur(10px);
        }

        /* HISOB QISMI */
        .score-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(180deg, rgba(30, 30, 40, 1) 0%, rgba(15, 15, 20, 1) 100%);
            border-bottom: 2px solid #333;
        }

        .team-box {
            display: flex;
            align-items: center;
            padding: 15px 30px;
            width: 35%;
        }

        .ct-box {
            background: linear-gradient(90deg, rgba(89, 155, 206, 0.2) 0%, transparent 100%);
            border-left: 5px solid #599BCE;
        }

        .t-box {
            background: linear-gradient(-90deg, rgba(224, 183, 62, 0.2) 0%, transparent 100%);
            border-right: 5px solid #E0B73E;
            justify-content: flex-end;
        }

        .team-name {
            font-size: 18px;
            font-weight: 700;
            letter-spacing: 2px;
        }

        .ct-box .team-name {
            color: #599BCE;
            margin-right: 20px;
        }

        .t-box .team-name {
            color: #E0B73E;
            margin-left: 20px;
            text-align: right;
        }

        .team-score {
            font-size: 45px;
            font-weight: 900;
        }

        /* MARKAZIY MA'LUMOT (Round & Map) */
        .match-info {
            text-align: center;
            width: 30%;
        }

        .round-text {
            font-size: 22px;
            font-weight: 900;
            letter-spacing: 1px;
        }

        .map-name {
            font-size: 12px;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-top: 5px;
        }

        /* RO'YXATLAR (O'YINCHILAR) */
        .rosters-container {
            display: flex;
            justify-content: space-between;
            padding: 20px;
            gap: 20px;
        }

        .roster {
            width: 48%;
        }

        .player-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            background: rgba(255, 255, 255, 0.02);
            margin-bottom: 5px;
            border-radius: 4px;
            transition: 0.2s;
        }

        .player-row:hover {
            background: rgba(255, 255, 255, 0.08);
        }

        .player-row.header {
            background: transparent;
            border-bottom: 2px solid #444;
            color: #888;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .player-name {
            width: 60%;
            font-weight: 700;
            font-size: 15px;
        }

        .player-stat {
            width: 20%;
            text-align: center;
            font-weight: 700;
            font-size: 16px;
        }

        .header .player-stat {
            font-size: 12px;
        }

        /* O'ziga xos ranglar */
        .ct-roster .player-name {
            color: #E8F0F8;
        }

        .t-roster .player-name {
            color: #FDF9E3;
        }

        .ct-roster .player-stat {
            color: #A8C9E6;
        }

        .t-roster .player-stat {
            color: #F0D481;
        }
    </style>
</head>
<body>

<div class="cs2-scoreboard">
    <div class="score-header">
        <div class="team-box ct-box">
            <div class="team-name">COUNTER-TERRORISTS</div>
            <div class="team-score">8</div>
        </div>

        <div class="match-info">
            <div class="round-text">ROUND 11</div>
            <div class="map-name">de_mirage</div>
        </div>

        <div class="team-box t-box">
            <div class="team-score">3</div>
            <div class="team-name">TERRORISTS</div>
        </div>
    </div>

    <div class="rosters-container">
        <div class="roster ct-roster">
            <div class="player-row header">
                <div class="player-name">O'YINCHI</div>
                <div class="player-stat">K</div>
                <div class="player-stat">D</div>
            </div>
            <div class="player-row">
                <div class="player-name">Mooz</div>
                <div class="player-stat">12</div>
                <div class="player-stat">4</div>
            </div>
            <div class="player-row">
                <div class="player-name">Shooter_Uz</div>
                <div class="player-stat">9</div>
                <div class="player-stat">6</div>
            </div>
            <div class="player-row">
                <div class="player-name">Tornado</div>
                <div class="player-stat">7</div>
                <div class="player-stat">8</div>
            </div>
            <div class="player-row">
                <div class="player-name">Ghost</div>
                <div class="player-stat">5</div>
                <div class="player-stat">9</div>
            </div>
            <div class="player-row">
                <div class="player-name">Alpha</div>
                <div class="player-stat">2</div>
                <div class="player-stat">10</div>
            </div>
        </div>

        <div class="roster t-roster">
            <div class="player-row header">
                <div class="player-name">O'YINCHI</div>
                <div class="player-stat">K</div>
                <div class="player-stat">D</div>
            </div>
            <div class="player-row">
                <div class="player-name">Danger</div>
                <div class="player-stat">15</div>
                <div class="player-stat">5</div>
            </div>
            <div class="player-row">
                <div class="player-name">Eagle_A</div>
                <div class="player-stat">10</div>
                <div class="player-stat">9</div>
            </div>
            <div class="player-row">
                <div class="player-name">Sniper_01</div>
                <div class="player-stat">8</div>
                <div class="player-stat">7</div>
            </div>
            <div class="player-row">
                <div class="player-name">Boomer</div>
                <div class="player-stat">6</div>
                <div class="player-stat">11</div>
            </div>
            <div class="player-row">
                <div class="player-name">Viper</div>
                <div class="player-stat">4</div>
                <div class="player-stat">12</div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
