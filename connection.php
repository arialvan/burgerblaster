<?php
try {
            $db_host = 'localhost';  
            $db_name = 'mannco_blester_shop'; 
            $db_user = 'root';  
            $user_pw = '';  

            $con = new PDO('mysql:host='.$db_host.'; dbname='.$db_name, $db_user, $user_pw);  
            $con->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
            $con->exec("SET CHARACTER SET utf8");  
        }
        catch (PDOException $err) {  
            echo "Database Connection Error...";
            $err->getMessage() . "<br/>";
            file_put_contents('PDOErrors.txt',$err, FILE_APPEND);   
            die();  
        }
?>

