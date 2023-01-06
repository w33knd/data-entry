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
      
      <link rel="icon" href="#">
      <title>Data Entry Status</title>
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
               $id=$_POST['id'];
            //   $name=$_POST['name'];
            //   $email=$_POST['email'];
            //   $phone=$_POST['phone'];
            //   $address=$_POST['address'];
            //   $city=$_POST['city'];
            //   $state=$_POST['state'];
            //   $business=$_POST['business'];
            //   $fhname=$_POST['fhname'];
            //   $age=$_POST['age'];
            //   $education=$_POST['education'];
            //   $hmt=$_POST['hmt'];
            //   $addiction=$_POST['addiction'];
            //   $finaladdress=$address.",".$city.",".$state;
                $name=$_POST['name'];
               $email=$_POST['email'];
               $phone=$_POST['phone'];
               $address=$_POST['address'];
               $village=$_POST['village'];
               $district=$_POST['district'];
               $tehsil=$_POST['tehsil'];
               $state=$_POST['state'];
               $business=$_POST['business'];
               $gurumantra=$_POST['gurumantra'];
               $fhname=$_POST['fhname'];
               $age=$_POST['age'];
               $education=$_POST['education'];
               $hmt=$_POST['hmt'];
               $addiction=$_POST['addiction'];
               $finaladdress=$address.",".$village.",".$district.",".$tehsil.",".$state;
               
               try {
                  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                  // set the PDO error mode to exception
                  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                  $createaccountquery = $conn->prepare("UPDATE datatable SET name=?, fhname=?, age=?, education=?, email=?, phone=?, address=?, business=?, hmt=?, addiction=?, entrydate=current_time(), gurumantra=? WHERE entryid=?");
                  $createaccountquery->execute(array($name,$fhname,$age,$education,$email,$phone,$finaladdress,$business,$hmt,$addiction,$gurumantra,$id));
                  $conn=null;
                  $valid=true;
                  header("Location: dataentry.php?success=1");
                  exit;   
               // try {
               //    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
               //    // set the PDO error mode to exception
               //    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
               //    $createaccountquery = $conn->prepare("UPDATE datatable SET name=?, email=?, phone=?, city=?, profession=?, comments=?, entrydate=current_time() WHERE entryid=?");
               //    $createaccountquery->execute(array($name,$email,$phone,$city,$profession,$comments,$id));
               //    $conn=null;
               //    $valid=true;
               //    header("Location: display.php?success=1");
               //    exit;             

               } catch(PDOException $e) {
                  echo "Connection failed: " . $e->getMessage();
                  header("Location: display.php?success=0");
                  exit;             
                }

               ?>
         </main>
         <footer class="mastfoot mt-auto">
         </footer>
      </div>
      <!-- Bootstrap core JavaScript
         ================================================== -->
      <!-- Placed at the end of the document so the pages load faster -->
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="js/bootstrap.min.js"></script>
   </body>
</html>