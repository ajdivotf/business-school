<?php
include "db.php";
$id_education = $_POST['id_education'];
$rating = $_POST['rating'];
$insertquery = "UPDATE education SET rating=$rating WHERE id_education=$id_education";
mysqli_query($conn, $insertquery);
$id_program = mysqli_fetch_array(mysqli_query($conn, "SELECT id_program FROM education WHERE id_education=$id_education"))[0];
$average_rating = mysqli_fetch_array(mysqli_query($conn, "SELECT AVG(rating) FROM education WHERE id_program=$id_program AND rating > 0;"))[0];
$insertquery = "UPDATE training_program SET average_rate=$average_rating WHERE id_program=$id_program";
mysqli_query($conn, $insertquery);
?>
