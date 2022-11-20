
<?php
    include("student_navigation.php");
    echo "<style>
        .profile-text{
            margin-left: 360px;
            margin-top: 40px;
        }
    </style>";
    echo "<h1 class='profile-text'>Мой профиль</h1>";
    include("edit_profile.php");

    if(ISSET($_POST['submit-main-info'])){
        $new_lastname = $_POST["lastname"];
        $new_firstname = $_POST["firstname"];
        $new_fathername = $_POST["fathername"];
        $new_birth_day = $_POST["birth_day"];
        $new_phone_number = $_POST["phone_number"];
        $sql = "UPDATE student SET lastname='$new_lastname', firstname='$new_firstname', fathername='$new_fathername', birth_day='$new_birth_day', phone_number='$new_phone_number' WHERE id_student=$user_id";
        $result = mysqli_query($conn, $sql);
        if ($result == TRUE){
            echo "Данные успешно сохранены!";
            echo "<script> document.location.href = 'student_profile.php' </script>";
        }
        else{
            echo "Ошибка";
        }
    }
    if(ISSET($_POST['submit-data'])){
        $new_username = $_POST["username"];
        $new_password = $_POST["password"];
        $new_email = $_POST["email"];
        $sql = "UPDATE student SET username='$new_username', `password`='$new_password', email='$new_email' WHERE id_student=$user_id";
        $result = mysqli_query($conn, $sql);
        if ($result == TRUE){
            echo "Данные успешно сохранены!";
            echo "<script> document.location.href = 'student_profile.php' </script>";
        }
        else{
            echo "Ошибка";
        }
    }
?>