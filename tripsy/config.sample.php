<?php
$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "tripsy_db"
);

if (!$conn) {
    die("Database connection failed");
}
