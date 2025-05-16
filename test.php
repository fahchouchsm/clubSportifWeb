<?php

echo "hello";
require_once "./src/php/connectDB.php";
require_once "./src/php/functions/isSubscribed.php";

$result = hasValidSubscription($conn, 1);

if ($result) {
    echo "<p style='color: green;'>Subscription is valid</p>";
} else {
    echo "<p style='color: red;'>Subscription is not valid</p>";
}
