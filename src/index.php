<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
    <title>Регистрационная форма</title>
    <link rel="stylesheet" href="./styles1.css" />
</head>
<body>
    <form action="login.php" method="post" onsubmit="return valid()">
        <input checked="" id="signin" action="signin" name="action" type="radio" value="signin" onclick="clear_text(event)">
        <label for="signin">Вход</label>
        <input id="signup" action="signup" name="action" type="radio" value="signup" onclick="clear_text(event)">
        <label for="signup">Регистрация</label>
        <div id="wrapper">
            <div id="arrow"></div>
            <input id="email" name="email" placeholder="Email" type="text">
            <input id="pass" name="password" placeholder="Пароль" type="password">
            <input id="repass" name="repass" placeholder="Повторите пароль" type="password">
        </div>
        
        <button type="submit" name="submit">
            <span>
                Reset<br>Вход<br>Регистрация
            </span>
        </button>
    </form>
    <div id="hint">Click on the tabs</div>
    <script type="text/javascript">
        function clear_text(){
            document.getElementById('email').value = "";
            document.getElementById('pass').value = "";
            document.getElementById('repass').value = "";
        }
        function valid(){
            if (document.getElementById('email').value == ""){
                alert("Введите email");
                return false;
            }
            if (document.getElementById('pass').value == ""){
                alert("Введите пароль");
                return false;
            }
            console.log();
            if (document.getElementById('pass').value != document.getElementById('repass').value && document.getElementById('signup').checked){
                alert("Пароли не совпадают");
                return false;
            }
        }
    </script>
</body>
</html>