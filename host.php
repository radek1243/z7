<?php
    class Host{
        private $host="";	//pola w klasie z danymi do logowania do bazy danych (trzeba wypełnić)
        private $user="";
        private $password="";
        private $database="";

        function __construct(){}	//konstruktor

        function executeQuery($query){	//metoda wykonująca podane zapytanie jako parametr
            $link = mysqli_connect($this->host, $this->user, $this->password, $this->database, 3306);
            if(mysqli_connect_error()==null){	//jeśli połączenie się uda to
                mysqli_set_charset($link, "utf8");
                $result = mysqli_query($link, $query);	//wykonanie zapytania
                mysqli_close($link);	//zakończenie połączenia z bazą
                return $result;	//zwrócenie wyniku zapytania
            }
            else return null;	//jeśli połączenie się nie uda zwraca null
        }
    }
?>