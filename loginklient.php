<?php
    if(isset($_POST['login'])){ //jeśli podany jest login to
        require_once('host.php');
        $login = $_POST['login'];   //zapamiętanie loginu i hasła
        $haslo = $_POST['haslo'];
        $host = new Host();
        $result = $host->executeQuery("select haslo from users where login='".$login."';");   //sprwadzenie hasła dla podanego loginu
        if($result != null){    
            if($row = mysqli_fetch_row($result)){   //jeśli jest hasło to
                if($haslo===$row[0]){   //sprawdzenie czy się zgadza
                    setcookie('login', $login);
                    header('Location: home.php');
                }
                else{   //w przeciwnym wypadku komunikat
                    echo "Błędne dane logowania.";
                }
            }
            else{
                echo "Błędne dane logowania.";
            }
        }
    }
?>
