<?php
    if(isset($_COOKIE['login'])){
        setcookie("login","",time()-3600);
    }
    if(isset($_COOKIE['status'])){
        setcookie("status","",time()-3600);
    }
    if(isset($_COOKIE['sciezka'])){
        setcookie("sciezka","", time()-3600);
    }
?>
<html>
    <head>
        <meta charset="utf-8">
        <link href="log.css" rel="stylesheet">
    </head>
    <body>  <!-- formularz logowania dla klienta -->
        <p>Logowanie klienta do chmury</p>
        <form method="post" action="loginklient.php">	<!-- formularz do logowania ma 2 pola tekstowe i przycisk -->
            <br>Login: <input type="text" name="login" maxlength="30" required>
            <br>Hasło: <input type="password" name="haslo" maxlength="30" required>
            <br><input type="submit" id="przycisk" value="Zaloguj">
        </form>
        <br><a href="rejestracja.php">Zarejestruj się</a>	<!-- link do strony z rejetracją -->
    </body>
</html>