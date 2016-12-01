<?php 
if(isset($_COOKIE['login']) && $_COOKIE['login']!==""){    
    if(opendir($_COOKIE['login'])===false){
        mkdir($_COOKIE['login']);
    }
?>
<html>
    <head>
        <title>Twoje pliki</title>
        <meta charset="urf-8">
        <link href="home.css" rel="stylesheet">
    </head>
    <body>
        Witaj! <?php echo $_COOKIE['login']; ?>
    <?php
        if(isset($_COOKIE['status'])){
            echo "<br>Czas ostatniego błędnego logowania: ".$_COOKIE['status'];
        }
        echo "<div>";
    ?>
        <form action="odbierz.php" method="post" enctype="multipart/form-data">
            <input type="file" name="plik">
            <input type="submit" name="submit">
        </form>
    <?php
        $listFiles = new DirectoryIterator($_COOKIE['login']);
        foreach ($listFiles as $file){
            if($file->getFilename()!=="." && $file->getFilename()!==".."){
                if($file->isDir()){
                    echo "<p id='katalog'>".$file->getFilename()."</p>";
                }
                else{
                    echo "<p id='plik'>".$file->getFilename()."</p>";
                }
            }
        }
        echo "</div>";
    ?>
    </body>
</html>
<?php
}
else echo "Brak logowania.";
?>