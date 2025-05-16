<?php
function hasValidSubscription(mysqli $conn, ?int $clientId): bool
{
    if (!$clientId) {
        return false;
    }

    $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM abonnement WHERE clientId = ? AND dateExpiration >= CURDATE()");
    $stmt->bind_param("i", $clientId);
    $stmt->execute();
    $result = $stmt->get_result();
    $count = $result->fetch_assoc()['count'];
    $stmt->close();

    return $count > 0;
}
