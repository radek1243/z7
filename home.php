<?php 
if(isset($_COOKIE['login']) && $_COOKIE['login']!==""){    
    if(opendir($_COOKIE['login'])===false){
        mkdir($_COOKIE['login']);
    }
    if(isset($_COOKIE['sciezka'])){
        if($_COOKIE['sciezka']===""){
            setcookie("sciezka", $_COOKIE['login']);
        }
    } 
    else{   
        setcookie("sciezka", $_COOKIE['login']);
    }
?>
<html>
    <head>
        <title>Twoje pliki</title>
        <meta charset="utf-8">
        <link href="home.css" rel="stylesheet">
    </head>
    <body>
        <a href="index.php" id="wyloguj">Wyloguj</a>
        <p>Witaj! <?php echo $_COOKIE['login']; ?></p>
    <?php
        if(isset($_COOKIE['status'])){
            echo "<p>Czas ostatniego błędnego logowania: ".$_COOKIE['status']."</p>";
        }
        echo "<div>";
        if($_COOKIE['sciezka']!==$_COOKIE['login']){
            echo "<form method='post' action='operacje.php'>";
            echo "<input type='submit' name='powrot' value='Powrót'>";
            echo "</form>";
        }
    ?>
        <form action="odbierz.php" method="post" enctype="multipart/form-data">
            <input type="file" name="plik">
            <input type="submit" name="odbierz">
        </form>
        <?php
            if(isset($_COOKIE['sciezka']) && $_COOKIE['sciezka']===$_COOKIE['login']){
        ?>
        <form action="operacje.php" method="post">
            <label>Nazwa katalogu: </label><input type="text" name="nazwa_katalogu" required>
            <input type="submit" name="katalog" value="Stwórz katalog">
        </form>
        <?php
            }
        ?>
        <p>Lista plików i katalogów w folderze: <?php echo $_COOKIE['sciezka']; ?></p>
    <?php
        echo "<form action='operacje.php' method=post>";
        echo "<input type='submit' name='usun' value='Usuń'>";
        $listFiles = new DirectoryIterator($_COOKIE['sciezka']);
        foreach ($listFiles as $file){
            if($file->getFilename()!=="." && $file->getFilename()!==".."){
                if($file->isDir()){
                    echo "<p id='katalog'><input type='checkbox' name='".$file->getFilename()."' value='".$file->getPathname()."'>";
                    echo "<input type='submit' name='otworz' value='".$file->getFilename()."'>";
                    echo "</p>";   
                }
                else{
                    echo "<p id='plik'><input type='checkbox' name='".$file->getFilename()."' value='".$file->getPathname()."'><a href='".$file->getPathname()."' download title='Pobierz plik'>".$file->getFilename()."</a></p>";
                }
            }
        }
        echo "</form>";
        echo "</div>";
    ?>
    </body>
</html>
<?php
}
else echo "Brak logowania.";
?>