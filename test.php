<?php
require_once "./src/php/connectDB.php";


$coachQuery = "SELECT coachId, CONCAT(prenom, ' ', nom) AS coachName FROM coach";
$coachResult = $conn->query($coachQuery);
while ($coach = $coachResult->fetch_assoc()) {
    echo "<option value='{$coach['coachId']}'>{$coach['coachName']}</option>";
}
