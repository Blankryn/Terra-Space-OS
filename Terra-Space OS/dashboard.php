<?php 
/* Scientific Layer: Access control to ensure only authorized 
   researchers can interface with the Terra-Space OS engine.
*/
include 'db.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Terra-Space OS | Command Dashboard</title>
  
  <script type="text/javascript" src="lib/d3.min.js"></script>
  <script type="text/javascript" src="lib/d3.geo.projection.min.js"></script>
  <script type="text/javascript" src="celestial.js"></script>
  <link rel="stylesheet" href="celestial.css">
  
  <style type="text/css">
    :root {
      --primary-blue: #1a2a6c;
      --accent-red: #b21f1f;
      --deep-space: #05070a;
      --glow-white: #e0e0e0;
      --jaxa-blue: #002D62;
    }

    body { 
      background-color: var(--deep-space); 
      color: var(--glow-white);
      margin: 0; 
      font-family: 'Consolas', 'Monaco', monospace;
      overflow: hidden;
    }

    /* Professional Navigation Bar */
    .top-nav {
      position: fixed;
      top: 0;
      width: 100%;
      background: rgba(0, 0, 0, 0.8);
      border-bottom: 1px solid #333;
      display: flex;
      justify-content: space-between;
      padding: 10px 20px;
      z-index: 10000;
      box-sizing: border-box;
    }

    .nav-links a {
      color: #888;
      text-decoration: none;
      margin-left: 20px;
      font-size: 12px;
      transition: 0.3s;
    }
    .nav-links a:hover { color: var(--accent-red); }

    /* Mission Control Panel */
    #ts-os-panel {
      position: fixed;
      top: 70px; /* Adjusted for nav bar */
      left: 20px;
      width: 320px;
      background: rgba(5, 7, 10, 0.95);
      border: 1px solid #333;
      border-top: 3px solid var(--accent-red);
      padding: 20px;
      z-index: 9999;
      box-shadow: 0 0 20px rgba(0,0,0,1);
    }

    .header-title h1 { margin: 0; font-size: 18px; letter-spacing: 3px; color: var(--glow-white); }
    .user-tag { font-size: 9px; color: #00ff00; letter-spacing: 1px; margin-top: 5px; text-transform: uppercase; }
    
    .input-row { margin-top: 20px; margin-bottom: 15px; }
    .input-row label { font-size: 10px; color: #888; display: block; margin-bottom: 8px; }
    
    input[type=range] { width: 100%; accent-color: var(--accent-red); cursor: pointer; }

    .action-btn {
      width: 100%;
      background: var(--primary-blue);
      color: var(--glow-white);
      border: 1px solid #444;
      padding: 12px;
      font-weight: bold;
      cursor: pointer;
      transition: 0.3s;
      letter-spacing: 1px;
    }
    .action-btn:hover { background: var(--accent-red); }

    .result-display { margin-top: 20px; border: 1px solid #333; padding: 15px; background: rgba(255,255,255,0.02); }
    #score-val { font-size: 42px; font-weight: bold; }
    #status-msg { font-size: 10px; margin-top: 8px; color: #666; letter-spacing: 1px; }

    #celestial-map { background-color: var(--deep-space); }
    #celestial-form { display: none; }
    
    footer { position: fixed; bottom: 10px; right: 20px; font-size: 9px; color: #444; z-index: 10000; }
  </style>
</head>
<body>

<div class="top-nav">
    <div style="font-weight: bold; letter-spacing: 2px;">TERRA-SPACE OS <span style="color:#b21f1f">v1.0</span></div>
    <div class="nav-links">
        <a href="dashboard.php">ANALYZER</a>
        <a href="logs.php">HISTORY</a>
        <a href="logout.php" style="color: #b21f1f;">TERMINATE_SESSION</a>
    </div>
</div>

<div id="ts-os-panel">
  <div class="header-title">
    <h1>COMMAND CENTER</h1>
    <div class="user-tag">RESEARCHER: <?php echo $_SESSION['username']; ?> // AUTHENTICATED</div>
  </div>

  <div class="input-row">
    <label>TERRA CLOUD COVERAGE (%)</label>
    <input type="range" id="cloudIn" min="0" max="100" value="20">
  </div>

  <div class="input-row">
    <label>SOLAR RADIATION (Kp-INDEX)</label>
    <input type="range" id="solarIn" min="0" max="9" value="3">
  </div>

  <button class="action-btn" onclick="processMission()">EXECUTE MISSION ANALYSIS</button>

  <div class="result-display">
    <div id="score-val">--%</div>
    <div id="status-msg">ENGINE IDLE // AWAITING PARAMETERS</div>
  </div>
</div>

<div id="celestial-map"></div>

<script type="text/javascript">
  /* Scientific Logic:
     1. Animation: Real-time celestial rotation simulation.
     2. Persistence: AJAX synchronization with MySQL logs.
  */

  var cfg = Celestial.settings().set({
      geopos: [23.8, 90.4], 
      projection: "orthographic",
      datapath: "data/", // Path updated to root data folder
      planets: { show: true },
      stars: { names: true, limit: 5 },
      background: { fill: "#05070a" },
      follow: "center"
  });

  var dt = new Date();
  Celestial.display(cfg);

  function animate() {
    dt.setMinutes(dt.getMinutes() + 5); 
    Celestial.date(dt);
    requestAnimationFrame(animate);
  }
  requestAnimationFrame(animate);

  function processMission() {
    const cloud = document.getElementById('cloudIn').value;
    const solar = document.getElementById('solarIn').value;
    
    let sNorm = (solar / 9) * 100;
    let score = 100 - (cloud * 0.6 + sNorm * 0.4);
    score = Math.max(0, Math.round(score));

    const scoreEl = document.getElementById('score-val');
    const msgEl = document.getElementById('status-msg');
    
    scoreEl.innerText = score + "%";
    
    if(score > 80) { 
        msgEl.innerText = "STATUS: GO // MISSION OPTIMAL"; 
        scoreEl.style.color = "#00ff00"; 
    } else if(score > 45) { 
        msgEl.innerText = "STATUS: CAUTION // MARGINAL DATA"; 
        scoreEl.style.color = "#ffff00"; 
    } else { 
        msgEl.innerText = "STATUS: ABORT // CRITICAL INTERFERENCE"; 
        scoreEl.style.color = "#ff0000"; 
    }

    // --- Data Persistence Layer ---
    let formData = new FormData();
    formData.append('score', score);
    formData.append('cloud', cloud);
    formData.append('solar', solar);

    fetch('save.php', {
        method: 'POST',
        body: formData
    })
    .then(res => res.text())
    .then(resData => console.log("DB_SYNC_STATUS:", resData))
    .catch(err => console.error("DB_SYNC_ERROR:", err));
  }
</script>

<footer>TERRA-SPACE OPERATING SYSTEM // NODAL POINT: DHAKA</footer>
</body>
</html>