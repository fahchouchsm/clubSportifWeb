<?php
function getSeance(mysqli $mysqli, int $limit): ?mysqli_result
{
    $stmt = $mysqli->prepare("
        SELECT
            s.seanceId,
            s.dateSeance,
            s.description,
            s.max,
            COUNT(cs.clientId) AS subscribed_count,
            c.nom AS coach_nom,
            c.prenom AS coach_prenom,
            s.tempDebut,
            s.tempFin,
            c.coachId
        FROM
            seance s
        INNER JOIN
            coach c ON s.coachId = c.coachId
        LEFT JOIN
            clientSeance cs ON s.seanceId = cs.seanceId
        WHERE
            s.dateSeance > CURDATE()
        GROUP BY
            s.seanceId, s.dateSeance, s.description, s.max, c.nom, c.prenom, s.tempDebut, s.tempFin, c.coachId
        ORDER BY
            s.dateSeance
        LIMIT ?;
    ");

    if (!$stmt) {
        return null;
    }

    $stmt->bind_param("i", $limit);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    return $result;
}
