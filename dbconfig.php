<?php
$conn = mysqli_connect("localhost", "root", "", "registration");
if (!$conn) {
    echo "Failed to connect" . mysqli_connect_error();
} else {
    mysqli_select_db($conn, "registration");
}
