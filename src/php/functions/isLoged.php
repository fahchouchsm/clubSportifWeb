<?php
function isLoged(): bool
{
<<<<<<< HEAD
    // $key = $_COOKIE['loginToken'] ?? null;
    // echo "key : " . $key;
    // echo "session : " . $_SESSION['loginToken']['key'];
    // if ($key && $key == $_SESSION['loginToken']['key']) {
    //     return true;
    // } else {
    //     // header('Location: ../../pages/login.php');
    //     return false;
    // }
    return false;
}
=======
    $key = $_COOKIE['loginToken'] ?? null;
    echo "key : " . $key;
    echo "session : " . $_SESSION['loginToken']['key'];
    if ($key && $key == $_SESSION['loginToken']['key']) {
        return true;
    } else {
        // header('Location: ../../pages/login.php');
        return false;
    }
}
?>
>>>>>>> c88aaab55263b0a0b3c02dba1b4bf8cdda776a3e
