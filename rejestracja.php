<html>
    <head>
        <title>Rejstracja klienta</title>
        <meta charset="utf-8">
        <link href="rejestracja.css" rel="stylesheet">
    </head>
    <body>
    <?php	
    require_once("host.php");	//import pliku host.php
    $err="";	//zmienna z błędem
    if(isset($_POST['log'])){	//jeśli jest wpisany login podczas rejestracji to
        $available=false;	//zmienna dostępny na false
        $host = new Host();	//tworzenie obiektu host
        $query = "select email from users where login='".$_POST['log']."'";	//ułóżenie zapytania
        $result = $host->executeQuery($query);	//wykonanie zapytania
        if($result!=null){	//jeśli jest wynik zapytania to
            if(($row = mysqli_fetch_assoc($result))==null){	//pętla w której sprawdzane jest czy poany login jest dostępny
                $query = "insert into users values('";	
                foreach($_POST as $key => $value){
                    $query = $query.$value."','";
                }
                $query = substr($query, 0, -2).");";
                $result = $host->executeQuery($query);
                if($result){	//wykonanie zapytania
                    echo "<br>Rejestracja udana";
                    echo "<br><a href='index.php'>Przejdź do strony logowania</a>";
                }
                else{	//jeśli zapytanie się nie uda to ponownie wyświetlany jest formularz rejestracji
                    $err="Podany login jest zajęty";
                    ?>
                    <form method="post">
                        <br>Podaj login: <input type="text" name="log" maxlength="30" required>
                        <br>Podaj haslo: <input type="password" name="pas" maxlength="30" required>
                        <br>Podaj email: <input type="email" name="email" maxlength="50" required>
                        <br><input type="submit" id="przycisk" value="Zerejestruj">
                    </form>
                    <?php echo "<p>".$err."</p>"; ?>
                    <?php
                }
            }
            else {	//jeśli login jest zajęty to wyświetlenie ponownie formularza rejestracji
                $err="Podany login jest zajęty";
                ?>
                <form method="post">
                    <br>Podaj login: <input type="text" name="log" maxlength="30" required>
                    <br>Podaj haslo: <input type="password" name="pas" maxlength="30" required>
                    <br>Podaj email: <input type="email" name="email" maxlength="50" required>
                    <br><input type="submit" id="przycisk" value="Zerejestruj">
                </form>
                <?php echo "<p>".$err."</p>"; ?>
                <?php
            }
        }
        else echo "Brak połączenia z bazą danych";
    }
    else{	//jeśli nie był wysłany fomularz to wyświetlenie tego formularza
    ?>
        <form method="post">
            <br>Podaj login: <input type="text" name="log" maxlength="30" required>
            <br>Podaj haslo: <input type="password" name="pas" maxlength="30" required>
            <br>Podaj email: <input type="email" name="email" maxlength="50" required>
            <br><input type="submit" id="przycisk" value="Zerejestruj">
        </form>
    <?php
    }
    ?>
    </body>
</html>