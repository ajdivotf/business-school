<?php
    session_start();
    include("db.php");

    $id_program = $_POST["id_program"];
    $apply_date = date("Y-m-d");
    $status = 0;
    $user_id = $_SESSION['id_student'];
    $query = "INSERT INTO education(id_student, id_program, apply_date, status) 
    VALUES ($user_id, $id_program, '$apply_date', $status)";
    echo $query;
    $result = mysqli_query($conn, $query);
    if ($result == TRUE){
        echo "Ваша заявка добавлена";
        echo "<script>document.location.href = 'my_orders.php'</script>";
    }
    else{
        echo "Ошибка";
    }
?>