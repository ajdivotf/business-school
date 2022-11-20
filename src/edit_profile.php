<?php
include('db.php');

$user_id = $_SESSION['id_student'];
$username = $_SESSION['username'];

$sql = "SELECT * FROM student WHERE id_student=$user_id";
$result = mysqli_query($conn, $sql);
$myrow = mysqli_fetch_array($result);
$username = $myrow["username"];
$passw = $myrow["password"];
$lastname = $myrow["lastname"];
$firstname = $myrow["firstname"];
$fathername = $myrow["fathername"];
$day = $myrow["birth_day"];
$birth_day = date("d.m.Y", strtotime($day));
$education = $myrow["education"];
$phone_number = $myrow["phone_number"];
$email = $myrow["email"];
?>
<style>
    .card {
        margin: 30px auto;
    }
</style>
<div class='first-card'>
    <div class='card' id='main-card'>
        <div class='card-header'>
            <span class='text'>Основная информация</span>
            <i id='edit-pen-main' class='fa-solid fa-pen' style='cursor:pointer' onclick='display()'></i>
            <script>
                function display() {
                    const form = document.getElementById('form-main-info');
                    const card = document.getElementById('main-card');
                    if (form.style.display == 'none') {
                        form.style.display = 'block';
                        form.action = 'student_profile.php';
                        card.style.display = 'none';
                    } else {
                        form.style.display = 'none';
                        card.style.display = 'block';
                        form.action = '';
                    }
                }
            </script>
        </div>
        <div class='card-body'>
            <div class='row'>
                <div class='col-5 col-text'>
                    <p>Фамилия</p>
                    <p>Имя</p>
                    <p>Отчество</p>
                    <p>День рождения</p>
                    <p>Телефон</p>
                </div>
                <div class='col-4'>
                    <p id='txt-lastname'><?php echo $lastname ?></p>
                    <p id='txt-firstname'><?php echo $firstname ?></p>
                    <p id='txt-fathername'><?php echo $fathername ?></p>
                    <p id='txt-birth-day'><?php echo $birth_day ?></p>
                    <p id='txt-phone-number'><?php echo $phone_number ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<form action='student_profile.php' onsubmit='return valid()' method='POST' class='form-group' style='margin-bottom: 1%;'>
    <div class='card' id='form-main-info' style='display:none'>
        <div class='card-header'>
            <span class='text'>Основная информация</span>
            <div class='form-buttons'>
                <button type='submit' name='submit-main-info'>Сохранить</button>
                <button onclick='display()'>Отменить</button>
            </div>
        </div>
        <div class='card-body'>
            <div class='row'>
                <div class='col-5 col-text main-form-row'>
                    <p>Фамилия</p>
                    <p>Имя</p>
                    <p>Отчество</p>
                    <p>День рождения</p>
                    <p>Телефон</p>
                </div>
                <div class='col-4'>
                    <input type='text' id='input-lastname' name='lastname' class='form-control' value='<?php echo $lastname ?>'><br>
                    <input type='text' id='input-firstname' name='firstname' class='form-control' value='<?php echo $firstname ?>'><br>
                    <input type='text' id='input-fathername' name='fathername' class='form-control' value='<?php echo $fathername ?>'><br>
                    <input type='date' id='input-birth-day' name='birth_day' class='form-control' value='<?php echo $day ?>'><br>
                    <input type='tel' id='input-phone-number' name='phone_number' class='form-control' value='<?php echo $phone_number ?>'><br>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</form>
</div>
<div class='second-card'>
    <div class='card' id='data-card'>
        <div class='card-header'>
            <span class='text'>Данные для входа</span>
            <i class='fa-solid fa-pen' id='edit-pen-second' style='cursor:pointer' onclick='display1()'></i>

        </div>
        <div class='card-body'>
            <div class='row'>
                <div class='col-5 col-text'>
                    <p>Логин</p>
                    <p>Email для входа</p>
                    <p>Пароль</p>
                </div>
                <div class='col-4'>
                    <p id='txt-username'><?php echo $username ?></p>
                    <p id='txt-email'><?php echo $email ?></p>
                    <p id='txt-password' type='password'><?php echo $passw ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<form action='student_profile.php' onsubmit='return valid1()' method='POST' class='form-group' style='margin-bottom: 1%;'>
    <div class='card' id='form-data-info' style='display:none'>
        <div class='card-header'>
            <span class='text'>Данные для входа</span>
            <div class='form-buttons'>
                <button type='submit' name='submit-data'>Сохранить</button>
                <button onclick='display1()'>Отменить</button>
            </div>
        </div>
        <div class='card-body'>
            <div class='row'>
                <div class='col-5 col-text main-form-row'>
                    <p>Логин</p>
                    <p>Email для входа</p>
                    <p>Пароль</p>
                </div>
                <div class='col-4'>
                    <input type='text' id='input-username' name='username' class='form-control' value='<?php echo $username ?>'><br>
                    <input type='email' id='input-email' name='email' class='form-control' value='<?php echo $email ?>'><br>
                    <input type='password' id='input-password' name='password' class='form-control' value='<?php echo $passw ?>'><br>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</form>
</div>
<script>
    function valid() {
        if (document.getElementById('input-lastname').value != '' && !/^[А-Я][а-я]*([-][А-Я][а-я]*)?$/.test(document.getElementById('input-lastname').value)) {
            alert("Фамилия может состоять только из русских букв");
            return false;
        }
        if (document.getElementById('input-firstname').value != '' && !/^[А-Я][а-я]*$/.test(document.getElementById('input-firstname').value)) {
            alert("Имя может состоять только из русских букв");
            return false;
        }
        if (document.getElementById('input-fathername').value != '' && !/^[А-Я][а-я]*$/.test(document.getElementById('input-fathername').value)) {
            alert("Отчество может состоять только из русских букв");
            return false;
        }
        if (document.getElementById('input-phone-number').value != '' && !/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/im.test(document.getElementById('input-phone-number').value)) {
            alert("Введён неверный формат номера телефона");
            return false;
        }
    }

    function valid1() {
        if (document.getElementById('input-username').value == '' && document.getElementById('input-email').value == '') {
            alert("Введите логин или email");
            return false;
        }
    }

    function display() {
        const form = document.getElementById('form-main-info');
        const pen_second = document.getElementById('edit-pen-second');
        const card = document.getElementById('main-card');
        if (form.style.display == 'none') {
            pen_second.onclick = '';
            form.style.display = 'block';
            form.action = 'student_profile.php';
            card.style.display = 'none';
        } else {
            pen_second.onclick = display1;
            form.style.display = 'none';
            card.style.display = 'block';
            form.action = '';
        }
    }

    function display1() {
        const form = document.getElementById('form-data-info');
        const pen_main = document.getElementById('edit-pen-main');
        const card = document.getElementById('data-card');
        if (form.style.display == 'none') {
            pen_main.onclick = '';
            form.action = 'student_profile.php';
            form.style.display = 'block';
            card.style.display = 'none';
        } else {
            pen_main.onclick = display;
            form.style.display = 'none';
            form.action = '';
            card.style.display = 'block';
        }
    }
    if ($('#txt-username').text() === '')
        $('#txt-username').text('—');
    if ($('#txt-email').text() === '')
        $('#txt-email').text('—');
    if ($('#txt-lastname').text() === '')
        $('#txt-lastname').text('—');
    if ($('#txt-firstname').text() === '')
        $('#txt-firstname').text('—');
    if ($('#txt-fathername').text() === '')
        $('#txt-fathername').text('—');
    if ($('#txt-birth-day').text() == '30.11.-0001')
        $('#txt-birth-day').text('—');
    if ($('#txt-phone-number').text() === '')
        $('#txt-phone-number').text('—');
</script>
<style>
    #form-data-info {
        height: 300px;
    }

    #data-card {
        height: 230px;
    }

    #form-data-info .card-header {
        background-color: rgb(170, 113, 245) !important;
    }

    #form-data-info {
        border-color: rgb(170, 113, 245);
    }

    .first-card #form-main-info {
        height: 400px;
    }

    .first-card #main-card {
        height: 300px;
    }

    .card {
        width: 800px;
        border: solid 5px rgb(236, 239, 255);
        border-radius: 10px !important;
    }

    .card-body {
        color: rgb(107, 113, 140);
    }

    .card-header {
        height: 65px;
        font-size: 20px;
        background-color: rgb(236, 239, 255);
        border: none;
        border-radius: 0px !important;
    }

    .card-header {
        padding-top: 15px;
        padding-left: 20px;
        font-weight: bold;
    }

    .col-text {
        padding-left: 18px;
    }

    .fa-pen {
        position: absolute;
        top: 20px;
        right: 20px;
    }

    .fa-pen:hover {
        color: rgb(170, 113, 245);
    }

    .main-form-row p {
        padding-top: 18px;
    }

    #form-main-info .card-header {
        background-color: rgb(170, 113, 245) !important;
    }

    #form-main-info {
        border-color: rgb(170, 113, 245);
    }

    .form-buttons {
        position: absolute;
        right: 10px;
        top: 10px;
    }

    .form-buttons button {
        background-color: rgb(236, 239, 255);
        border-radius: 5px;
        border: none;
        font-size: 17px;
        padding: 7px 17px 7px 17px;
        margin-right: 10px;
    }
</style>