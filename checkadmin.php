<?php
               session_start();
               include 'databaseinfo.php';
               $valid = false;
               
               try {
                  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                  // set the PDO error mode to exception
                  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                  $stmt = $conn->prepare("SELECT password FROM admindb;");
                  $stmt->execute();
                  while($row = $stmt->fetchAll()) {
                     if($row[0]['password']==$_POST['password']){
                        $valid=true;
                     }
                  }

               } catch(PDOException $e) {
                  echo "Connection failed: " . $e->getMessage();
                }


              if($valid){
                  $_SESSION["valid"] = "yes";
                  header("Location: dataentry.php");
                  exit;             
                }
                else{
                   echo "authentication failed";
                   header("Location: index.html?s=0");
                   exit;              
                }
               
?>