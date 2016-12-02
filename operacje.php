<?php
    if(isset($_POST['katalog'])){
        if(mkdir($_COOKIE['login']."/".$_POST['nazwa_katalogu'])){
            header("Location: home.php");
        }
        else echo "Błąd";
    }
    if(isset($_POST['usun'])){
        foreach($_POST as $key => $value){
            if($key!=="usun"){
                if(is_dir($value)){
                    if(!rmdir($value)){
                        $listFiles = new DirectoryIterator($value);
                        foreach ($listFiles as $file){
                            unlink($file->getPathname());
                        }
                        rmdir($value);
                    }
                }
                else{
                    unlink($value);
                }
            }
        }
        header("Location: home.php");
    }
    if(isset($_POST['otworz'])){
        setcookie("sciezka", $_COOKIE['login']."/".$_POST['otworz']);
        header("Location: home.php");
    }
    if(isset($_POST['powrot'])){
        setcookie("sciezka",$_COOKIE['login']);
        header("Location: home.php");
    }
?>

