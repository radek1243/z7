<?php   
    if (is_uploaded_file($_FILES['plik']['tmp_name'])){      
       $path = $_COOKIE['login']."/".$_FILES['plik']['name'];   //$_SERVER['DOCUMENT_ROOT']."/".
       if(move_uploaded_file($_FILES['plik']['tmp_name'],$path)){
            header("Location: home.php");
       }            
       else{
           echo "Błąd przy przesyłaniu pliku.";
       }
    }            
    else {echo 'Błąd przy przesyłaniu danych!';} 
?> 


