<?php 
  session_start();

  if(!isset($_SESSION['valid'])){
    header("Location: index.html?s=1");
    die();
    exit;
  }
  ?>
<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="Data Entry Application">
      
      <link rel="icon" href="jabil.png">
      <title>Remove Data</title>
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="cover.css" rel="stylesheet">
   </head>
   <body class="text-center">
      <div class="cover-container d-flex h-100 p-2 mx-auto flex-column">
         <header class="masthead mb-auto">
            <div class="inner">
            <?php include 'navbar.php'; ?>
            </div>
            <hr style="height:35px">
         </header>
         <main role="main" class="inner cover">
            <?php
               include 'databaseinfo.php';
               $valid = false;
               $lostdate = $_POST['lostdate'];
               
               try {
                  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                  // set the PDO error mode to exception
                  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                  $stmt = $conn->prepare("DELETE from datatable where entryid = ?;");
                  $stmt->execute(array($_GET['id']));
                  $conn=null;
                  if($stmt->rowCount()==0){
                     $valid=false;
                     header("Location: display.php?success=0");
                     exit;             
                  }
                  else
                  {
                     $valid=true;
                     header("Location: display.php?success=1");
                     exit;                               
                  }
                } catch(PDOException $e) {
                  echo "Connection failed: " . $e->getMessage();
                }
               
               ?>
      </div>
      <!-- Bootstrap core JavaScript
         ================================================== -->
      <!-- Placed at the end of the document so the pages load faster -->
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="js/bootstrap.min.js"></script>
   </body>
</html>