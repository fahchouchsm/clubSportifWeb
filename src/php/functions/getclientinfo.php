<?php

<<<<<<< HEAD
function getClientByEmail($conn, $email)
=======
function getClientByEmail(mysqli $mysqli, string $email): null| mysqli_result
>>>>>>> main
{

<<<<<<< HEAD
    $query = $conn->prepare("SELECT * FROM client WHERE email = ?");


    if ($query === false) {
        die("Erreur lors de la préparation de la requête : " . $conn->error);
    }


    $query->bind_param("s", $email);


    $query->execute();


    $resultSet = $query->get_result();

    return $resultSet->fetch_assoc();
}
?>
=======
    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result;
    } else {
        echo "erreur de preparation de la requete";
        return null;
    }
}
>>>>>>> main
