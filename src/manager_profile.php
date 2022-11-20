<?php
include("manager_navigation.php");

include("edit_all_programs.php");

if (isset($_POST['submit-data'])) {
    $id_program = $_POST["id_program"];
    $new_icon = $_POST["icon"];
    $new_program_name = $_POST["program_name"];
    $new_program_category = $_POST["program_category"];
    $new_program_type = $_POST["program_type"];
    $new_program_doc = $_POST["program_doc"];
    $new_program_certification = $_POST["certification_type"];
    $new_edu_form = $_POST["education_form"];

    $new_price = $_POST["price"];
    $new_hours = $_POST["hours"];
    $new_description = htmlspecialchars($_POST["description"]);
    $sql = "UPDATE training_program SET icon='$new_icon', name_of_program='$new_program_name', id_subcategory='$new_program_category', type_of_program='$new_program_type', id_form='$new_edu_form', price='$new_price', id_certification='$new_program_certification', number_of_hours='$new_hours', id_document='$new_program_doc', description='$new_description' WHERE id_program=$id_program";
    $result = mysqli_query($conn, $sql);
    if ($result == TRUE) {
        echo "Данные успешно сохранены!";
        echo "<script> document.location.href = 'manager_profile.php' </script>";
    } else {
        echo "Ошибка";
    }
}
if (isset($_POST['save-data'])) {
    $id_program = mysqli_fetch_array(mysqli_query($conn, "SELECT MAX(id_program) AS max FROM training_program;"))[0] + 1;
    $new_icon = $_POST["icon"];
    $new_program_name = $_POST["program_name"];
    $new_program_category = $_POST["program_category"];
    $new_program_type = $_POST["program_type"];
    $new_program_doc = $_POST["program_doc"];
    $new_program_certification = $_POST["certification_type"];
    $new_edu_form = $_POST["education_form"];

    $new_price = $_POST["price"];
    $new_hours = $_POST["hours"];
    $new_description = htmlspecialchars($_POST["description"]);
    $sql1 = "INSERT INTO training_program(id_program, name_of_program, id_subcategory, number_of_hours, price, id_certification, id_document, type_of_program, id_form, description, icon, average_rate) VALUES($id_program, '$new_program_name', '$new_program_category', '$new_hours', '$new_price', '$new_program_certification', '$new_program_doc', '$new_program_type', '$new_edu_form', '$new_description', '$new_icon', 0);";
    echo $sql1;
    $result = mysqli_query($conn, $sql1);
    if ($result == TRUE) {
        echo "Данные успешно сохранены!";
        echo "<script> document.location.href = 'manager_profile.php' </script>";
    } else {
        echo "Ошибка";
    }
}
