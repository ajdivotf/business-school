<?php
    session_start();
    if (ISSET($_POST['submit'])){
        $email = $_POST['email'];
        $passw = $_POST['password'];
        if (empty($email) or empty($passw)){
            exit("Вы ввели не всю информацию");
        }
        include("db.php");
        if($_POST['action']=="signup")
        {
            $query = "SELECT * FROM student WHERE username='$email' OR email='$email'";
            $result = mysqli_query($conn, $query);
            $myrow = mysqli_fetch_array($result);
            if (!empty($myrow['id_student'])){
                exit("Извините, пользователь с таким email уже существует");
            }
            $query = "INSERT INTO student(email, username, password) VALUES ('$email', '$email', '$passw')";
            $result = mysqli_query($conn, $query);
            if ($result == TRUE){
                echo "Вы успешно зарегестированы. Тeперь Вы можете авторизоваться и перейти в личный кабинет";
                $_SESSION['username'] = $email;
                $query = "SELECT max(id_student) AS id_student FROM student";
                $result = mysqli_query($conn, $query);
                $myrow = mysqli_fetch_array($result);
                $_SESSION['id_student'] = $myrow['id_student'];
                echo "<script> document.location.href = 'student_profile.php'</script>";
            }
            else{
                echo ("Ошибка регистрации");
            }
        }
        if($_POST['action']=="signin"){
            $query = "SELECT * FROM student WHERE username='$email' OR email='$email'";
            $result = mysqli_query($conn, $query);
            $myrow = mysqli_fetch_array($result);
            $username = $myrow['username'];
            $email = $myrow['email'];
            if (empty($username) && empty($email)){
                exit("Извините, пользователь с таким логином/email не зарегестрирован");
            }
            else{
                if ($myrow['password'] == $passw){
                    $_SESSION['username'] = $myrow['username'];
                    $_SESSION['id_student'] = $myrow['id_student'];

                    if ($username == 'manager'){
                        echo "<script> document.location.href = 'manager_profile.php'</script>";
                    }
                    else{
                        echo "<script> document.location.href = 'student_profile.php'</script>";
                    }
                }
                else{
                    exit("Пароль неверный");
                }
            }
        }
    }
    
?>