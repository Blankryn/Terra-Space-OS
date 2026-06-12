<?php
/* Short Explanation: 
   This script fetches historical observation data from MySQL 
   and displays it in a technical table format using Vanilla PHP.
*/
include 'db.php';

$query = "SELECT * FROM mission_logs ORDER BY log_time DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Terra-Space OS | Mission Logs</title>
    <style>
        body { background: #05070a; color: #e0e0e0; font-family: 'Consolas', monospace; padding: 40px; }
        h2 { color: #b21f1f; border-bottom: 1px solid #333; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 12px; text-align: center; }
        th { background: #1a2a6c; color: white; font-size: 12px; text-transform: uppercase; }
        tr:nth-child(even) { background: #0a0c10; }
        tr:hover { background: #111; }
        .back-btn { display: inline-block; margin-bottom: 20px; color: #888; text-decoration: none; border: 1px solid #444; padding: 5px 15px; }
        .back-btn:hover { background: #e0e0e0; color: #05070a; }
    </style>
</head>
<body>
    <a href="demo/planets-animation.html" class="back-btn"><- BACK TO SYSTEM</a>
    <h2>MISSION HISTORY LOGS</h2>
    
    <table>
        <thead>
            <tr>
                <th>Log ID</th>
                <th>Score (%)</th>
                <th>Cloud (Terra)</th>
                <th>Solar (Space)</th>
                <th>Timestamp</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td>#<?php echo $row['id']; ?></td>
                <td style="color: <?php echo $row['score'] > 70 ? '#00ff00' : '#ff0000'; ?>;">
                    <?php echo $row['score']; ?>%
                </td>
                <td><?php echo $row['cloud_coverage']; ?>%</td>
                <td><?php echo $row['solar_activity']; ?> Kp</td>
                <td><?php echo $row['log_time']; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</body>
</html>