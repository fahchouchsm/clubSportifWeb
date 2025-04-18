<?php 
require_once 'connectDB.php';
function getClientByEmail($email) {
    global $conn;

    // Préparation de la requête
    $stmt = $conn->prepare("SELECT clientId, nom, prenom, dateNais, email, tel, password FROM client WHERE email = ?");
    
    if ($stmt) {
        $stmt->bind_param("s", $email); // "s" = string
        $stmt->execute();
        $result = $stmt->get_result();

        // Retourner le client ou false si non trouvé
        return $result->fetch_assoc();
    } else {
        // En cas d'erreur de préparation
        return false;
        echo "erreur de preparation de la requete";
    }
}





?>