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
      <link rel="icon" type="image/x-icon" href="favicon.ico" />      
      <title>Changing Data</title>
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="cover.css" rel="stylesheet">
   </head>
   <body class="text-center">
      <div class="cover-container d-flex h-100 w-100 p-2 mx-auto flex-column">
         <header class="masthead mb-auto">
            <div class="inner">
            <?php include 'navbar.php'; ?>
            </div>
            <hr style="height:35px">
         </header>
         <div id="success"></div>
         <main role="main" class="inner cover">
            <h1 class="cover-heading">Change Data Entry</h1>
            <br>
            <form id="formcontainer" action="changing.php" method="POST">

            <?php
               include 'databaseinfo.php';

               $valid = false;
               
               try {
                  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                  // set the PDO error mode to exception
                  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                  $id=$_GET['id'];
                  $stmt = $conn->prepare("select * from datatable where entryid = ?;");
                  $stmt->execute(array($id));
                  global $result;
                  $result=$stmt->fetchAll();
                  $conn=null;
                  $valid=true;

               } catch(PDOException $e) {
                  echo "Connection failed: " . $e->getMessage();
                }
?>
                <div class="form-group row">
                  <label for="inputName" class="col-sm-2 col-form-label">Name:</label>
                  <div class="col-sm-10">
                     <div class="form-row">
                        <div class="col-5">
                        <input type="name" class="form-control" name="name" id="name" placeholder="" required value="<?php echo $result[0]['name']; ?>">
                        </div>
                     <label for="inputID" class="col col-form-label">Age:</label>
                        <div>
                        <input type="text" class="form-control" name="age" id="age" placeholder="Age" required  value="<?php echo $result[0]['age']; ?>">
                        </div>
                     <label for="inputID" class="col col-form-label">Education:</label>
                        <div>
                        <input type="text" class="form-control" name="education" id="education" placeholder="Education" required value="<?php echo $result[0]['education']; ?>">
                        </div>
                     </div>
                  </div>
                  
               </div>
               <div class="form-group row">
                  <label for="inputID" class="col-sm-2 col-form-label">Father/Husband Name:</label>
                  <div class="col-sm-10">
                  <input type="text" class="form-control" name="fhname" id="inputID" placeholder="" required value="<?php echo $result[0]['fhname']; ?>">
                  </div>

               </div>
               <div class="form-group row">
                  <label for="inputID" class="col-sm-2 col-form-label">Email:</label>
                  <div class="col">
                     <input type="email" class="form-control" name="email" id="inputID" placeholder="abc@gmail.com" value="<?php echo $result[0]['email']; ?>">
                  </div>
                    <label for="inputID" class="col-sm-1 col-form-label">Phone:</label>
                  <div class="col">
                     <input type="text" class="form-control" name="phone" id="inputID" placeholder="(+91) xxxxxxxxxx" required value="<?php echo $result[0]['phone']; ?>" >
                  </div>
               </div>
               <!--<div class="form-group row">-->
                  <!--<label for="inputID" class="col-sm-2 col-form-label">Phone:</label>-->
               <!--   <div class="col-sm-10">-->
               <!--      <input type="text" class="form-control" name="phone" id="inputID" placeholder="(+91) xxxxxxxxxx" required>-->
               <!--   </div>-->
               <!--</div>-->
               <div class="form-group row">
                  <label for="inputID" class="col-sm-2 col-form-label">Address:</label>
                  <div class="col-sm-10">
                     <div class="form-row">
                        <div class="col-4">
                        <input type="text" class="form-control" name="address" id="inputID" placeholder="123 street, area" required value="<?php echo $result[0]['address']; ?>" >
                        </div>
                        <div class="col">
                        <input type="text" class="form-control" name="village" id="inputID" placeholder="Village">
                        </div>
                        <div class="col">
                        <input type="text" class="form-control" name="district" id="inputID" placeholder="District">
                        </div>
                        <div class="col">
                        <input type="text" class="form-control" name="tehsil" id="inputID" placeholder="Tehsil">
                        </div>
                        <div class="col">
                        <input type="text" class="form-control" name="state" id="inputID" placeholder="State">
                        </div>
                     </div>
                  </div>
               </div>
               <div class="form-group row">
                  <label for="inputID" class="col-sm-2 col-form-label">Business:</label>
                  <div class="col">
                     <input type="text" class="form-control" name="business" id="inputID" placeholder="" required value="<?php echo $result[0]['business']; ?>">
                  </div>
                  <label for="inputID" class="col-sm-2 col-form-label">Gurumantra Place:</label>
                  <div class="col">
                     <input type="text" class="form-control" name="gurumantra" id="inputID" placeholder="" required value="<?php echo $result[0]['gurumantra']; ?>">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="inputID" class="col-sm-2 col-form-label">How many trees:</label>
                  <div class="col-sm-10">
                     <input type="text" class="form-control" name="hmt" id="hmt" placeholder="" required value="<?php echo $result[0]['hmt']; ?>">
                  </div>
               </div>
               <div class="form-group row">
                  <label for="inputID" class="col-sm-2 col-form-label">Addiction, If yes, please specify:</label>
                  <div class="col-sm-10">
                     <input type="text" class="form-control" name="addiction" id="inputID" placeholder="Yes/No" required value="<?php echo $result[0]['addiction']; ?>">
                  </div>
               </div>
               <div>
                  <input type="submit" class="btn btn-primary"  value="Submit">
               </div>
               <!--<div class="form-group row">-->
               <!--   <label for="inputName" class="col-sm-2 col-form-label">Name:</label>-->
               <!--   <div class="col-sm-10">-->
               <!--      <div class="form-row">-->
               <!--         <div class="col-6">-->
               <!--         <input type="name" class="form-control" name="name" id="name" placeholder="" required  value="<?php echo $result[0]['name']; ?>">-->
               <!--         </div>-->
               <!--      <div class="col-sm-3 my-1">-->
               <!--      <label class="sr-only" for="inlineFormInputGroupUsername">age</label>-->
               <!--      <div class="input-group">-->
               <!--      <div class="input-group-prepend">-->
               <!--      <div class="input-group-text">Age</div>-->
               <!--      </div>-->
               <!--      <input type="text" class="form-control" name="age" id="age" placeholder="Age"   value="<?php echo $result[0]['age']; ?>" required>-->
               <!--      </div>                        -->
               <!--      </div>-->
               <!--         <div class="col">-->
               <!--         <input type="text" class="form-control" name="education" id="education" placeholder="Education"   value="<?php echo $result[0]['education']; ?>" required>-->
               <!--         </div>-->
               <!--      </div>-->
               <!--   </div>-->
               <!--</div>-->
               <!--<div class="form-group row">-->
               <!--   <label for="inputID" class="col-sm-2 col-form-label">Father/Husband Name:</label>-->
               <!--   <div class="col-sm-10">-->
               <!--   <input type="text" class="form-control" name="fhname" id="inputID" placeholder=""   value="<?php echo $result[0]['fhname']; ?>" required>-->
               <!--   </div>-->

               <!--</div>-->
               <!--<div class="form-group row">-->
               <!--   <label for="inputID" class="col-sm-2 col-form-label">Email:</label>-->
               <!--   <div class="col-sm-10">-->
               <!--      <input type="email" class="form-control" name="email" id="inputID" placeholder="abc@gmail.com" required  value="<?php echo $result[0]['email']; ?>" required>-->
               <!--   </div>-->
               <!--</div>-->
               <!--<div class="form-group row">-->
               <!--   <label for="inputID" class="col-sm-2 col-form-label">Phone:</label>-->
               <!--   <div class="col-sm-10">-->
               <!--      <input type="text" class="form-control" name="phone" id="inputID" placeholder="(+91) xxxxxxxxxx" required  value="<?php echo $result[0]['phone']; ?>" required>-->
               <!--   </div>-->
               <!--</div>-->
               <!--<div class="form-group row">-->
               <!--   <label for="inputID" class="col-sm-2 col-form-label">Address:</label>-->
               <!--   <div class="col-sm-10">-->
               <!--      <div class="form-row">-->
               <!--         <div class="col-4">-->
               <!--         <input type="text" class="form-control" name="address" id="inputID" placeholder="123 street, area" required>-->
               <!--         </div>-->
               <!--         <div class="col">-->
               <!--         <input type="text" class="form-control" name="village" id="inputID" placeholder="Village" required>-->
               <!--         </div>-->
               <!--         <div class="col">-->
               <!--         <input type="text" class="form-control" name="district" id="inputID" placeholder="District" required>-->
               <!--         </div>-->
               <!--         <div class="col">-->
               <!--         <input type="text" class="form-control" name="tehsil" id="inputID" placeholder="Tehsil" required>-->
               <!--         </div>-->
               <!--         <div class="col">-->
               <!--         <input type="text" class="form-control" name="state" id="inputID" placeholder="State" required>-->
               <!--         </div>-->
               <!--      </div>-->
               <!--   </div>-->
               <!--</div>-->
               <!--<div class="form-group row">-->
               <!--   <label for="inputID" class="col-sm-2 col-form-label">Business:</label>-->
               <!--   <div class="col-sm-10">-->
               <!--      <input type="text" class="form-control" name="business" id="inputID" placeholder=""  value="<?php echo $result[0]['business']; ?>" required>-->
               <!--   </div>-->
               <!--</div>-->
               <!--<div class="form-group row">-->
               <!--   <label for="inputID" class="col-sm-2 col-form-label">How many trees:</label>-->
               <!--   <div class="col-sm-10">-->
               <!--      <input type="text" class="form-control" name="hmt" id="hmt" placeholder=""  value="<?php echo $result[0]['hmt']; ?>" required>-->
               <!--   </div>-->
               <!--</div>-->
               <!--<div class="form-group row">-->
               <!--   <label for="inputID" class="col-sm-2 col-form-label">Addiction, If yes, please specify:</label>-->
               <!--   <div class="col-sm-10">-->
               <!--      <input type="text" class="form-control" name="addiction" id="inputID" placeholder="Yes/No" required  value="<?php echo $result[0]['addiction']; ?>" required>-->
               <!--   </div>-->
               <!--</div>-->
               <!--<div>-->
               <!--   <input type="submit" class="btn btn-primary"  value="Submit">-->
               <!--</div>-->
               <input type="hidden" id="entryId" name="id" value="<?php echo $id; ?>"> 
            </form>
         </main>
         <footer class="mastfoot mt-auto">
         </footer>
      </div>

      <!-- Bootstrap core JavaScript
         ================================================== -->
      <!-- Placed at the end of the document so the pages load faster -->
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
      <script src="js/bootstrap.min.js"></script>
   </body>
</html>