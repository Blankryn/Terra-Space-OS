<?php
/* Short Explanation: 
   This script receives POST data from JavaScript and 
   inserts it into the mission_logs table.
*/

include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $score = $_POST['score'];
    $cloud = $_POST['cloud'];
    $solar = $_POST['solar'];

    $sql = "INSERT INTO mission_logs (score, cloud_coverage, solar_activity) 
            VALUES ('$score', '$cloud', '$solar')";

    if ($conn->query($sql) === TRUE) {
        echo "LOGGED_SUCCESSFULLY";
    } else {
        echo "ERROR: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>