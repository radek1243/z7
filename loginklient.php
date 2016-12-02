<?php
    if(isset($_POST['login'])){ //jeśli podany jest login to
        require_once('host.php');
        $login = $_POST['login'];   //zapamiętanie loginu i hasła
        $haslo = $_POST['haslo'];
        $host = new Host();
        $result = $host->executeQuery("select haslo from users where login='".$login."';");   //sprawdzenie hasła dla podanego loginu
        if($result != null){    
            if($row = mysqli_fetch_row($result)){   //jeśli jest hasło to
                if($haslo===$row[0]){   //sprawdzenie czy się zgadza
                    $query2 = "select id, data_godzina, bledne_proby from logi where login='".$login."'";
                    $result2 = $host->executeQuery($query2);
                    if($result2!=null){
                        if($row2 = mysqli_fetch_assoc($result2)){
                            if($row2['bledne_proby']<3){
                                if($row2['bledne_proby']>0) {setcookie("status",$row2['data_godzina']);}
                                else {
                                    if(isset($_COOKIE['status'])) {setcookie ("status",'',time()-3600);}                                   
                                }
                                setcookie('login', $login);
                                setcookie('sciezka',$login);
                                $query3 = "update logi set bledne_proby=0, data_godzina=null where id=".$row2['id'];
                                $host->executeQuery($query3);
                                header('Location: home.php'); 
                            }
                            else{
                                $seconds = (strtotime(date("Y-m-d H:i:s", time()))-strtotime($row2['data_godzina']));
                                if($seconds<61){
                                    echo "Twoje konto jest zablokowane na 1 minutę.";
                                }
                                else{
                                    setcookie("status",$row2['data_godzina']);
                                    setcookie('login', $login);
                                    setcookie('sciezka',$login);
                                    $query3 = "update logi set bledne_proby=0, data_godzina=null where id=".$row2['id'];
                                    $host->executeQuery($query3);  
                                    header('Location: home.php'); 
                                }
                            }
                        }
                        else{
                            setcookie('login', $login);
                            setcookie('sciezka',$login);
                            $query3 = "insert into logi values(null,'".$login."',null,0);";
                            $host->executeQuery($query3);
                            header('Location: home.php'); 
                        }
                    }
                    else{
                        echo "Brak połączenia z bazą";
                    }
                }
                else{   //w przeciwnym wypadku komunikat
                    echo "Błędne dane logowania.";
                    $query2 = "select id, data_godzina, bledne_proby from logi where login='".$login."'";
                    $result2 = $host->executeQuery($query2);
                    if($result2!=null){
                        if($row2 = mysqli_fetch_assoc($result2)){
                            $query3 = "update logi set bledne_proby=".($row2['bledne_proby']+1).", data_godzina=null where id=".$row2['id'];
                            $host->executeQuery($query3);
                        }
                        else{
                            $query3 = "insert into logi values(null,'".$login."',null,1);";
                            $host->executeQuery($query3);
                        }
                    }
                }
            }
            else{
                echo "Błędne dane logowania.";
            }
        }
    }
?>
