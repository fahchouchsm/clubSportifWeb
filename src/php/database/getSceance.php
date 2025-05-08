<?php
function get2ProcheSeance(mysqli $mysqli): null| mysqli_result
{
    $stmt = $mysqli->prepare("SELECT seanceId, dateSeance, description, coachId, max
        FROM seance
        WHERE dateSeance > CURDATE()
        ORDER BY dateSeance
        LIMIT 2;");

    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
};
