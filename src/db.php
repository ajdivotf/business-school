<?php
    $servername = '127.0.0.1:3307';
    $username = 'root';
    $password = '';
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    $conn = mysqli_connect($servername, $username, $password, 'business_school');
?>