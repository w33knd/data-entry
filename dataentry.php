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
      <meta name="description" content="Data Entry Form">
      
      <link rel="icon" type="image/x-icon" href="favicon.ico" />      
      <title>Data Entry</title>
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
            <h1 class="cover-heading">New Data Entry</h1>
            <br>
            <form id="formcontainer" action="storing.php" method="POST">
               <div class="form-group row">
                  <label for="inputName" class="col-sm-2 col-form-label">Name:</label>
                  <div class="col-sm-10">
                     <div class="form-row">
                        <div class="col-5">
                        <input type="name" class="form-control" name="name" id="name" placeholder="" required>
                        </div>
                     <label for="inputID" class="col col-form-label">Age:</label>
                        <div>
                        <input type="text" class="form-control" name="age" id="age" placeholder="Age" required>
                        </div>
                     <label for="inputID" class="col col-form-label">Education:</label>
                        <div>
                        <input type="text" class="form-control" name="education" id="education" placeholder="Education" required>
                        </div>
                     </div>
                  </div>
                  
               </div>
               <div class="form-group row">
                  <label for="inputID" class="col-sm-2 col-form-label">Father/Husband Name:</label>
                  <div class="col-sm-10">
                  <input type="text" class="form-control" name="fhname" id="inputID" placeholder="" required>
                  </div>

               </div>
               <div class="form-group row">
                  <label for="inputID" class="col-sm-2 col-form-label">Email:</label>
                  <div class="col">
                     <input type="email" class="form-control" name="email" id="inputID" placeholder="abc@gmail.com">
                  </div>
                    <label for="inputID" class="col-sm-1 col-form-label">Phone:</label>
                  <div class="col">
                     <input type="text" class="form-control" name="phone" id="inputID" placeholder="(+91) xxxxxxxxxx" required>
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
                        <input type="text" class="form-control" name="address" id="inputID" placeholder="123 street, area" required>
                        </div>
                        <div class="col">
                        <input type="text" class="form-control" name="village" id="inputID" placeholder="Village" required>
                        </div>
                        <div class="col">
                        <input type="text" class="form-control" name="district" id="inputID" placeholder="District" required>
                        </div>
                        <div class="col">
                        <input type="text" class="form-control" name="tehsil" id="inputID" placeholder="Tehsil" required>
                        </div>
                        <div class="col">
                        <input type="text" class="form-control" name="state" id="inputID" placeholder="State" required>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="form-group row">
                  <label for="inputID" class="col-sm-2 col-form-label">Business:</label>
                  <div class="col">
                     <input type="text" class="form-control" name="business" id="inputID" placeholder="" required>
                  </div>
                  <label for="inputID" class="col-sm-2 col-form-label">Gurumantra Place:</label>
                  <div class="col">
                     <input type="text" class="form-control" name="gurumantra" id="inputID" placeholder="" required>
                  </div>
               </div>
               <div class="form-group row">
                  <label for="inputID" class="col-sm-2 col-form-label">How many trees:</label>
                  <div class="col-sm-10">
                     <input type="text" class="form-control" name="hmt" id="hmt" placeholder="" required>
                  </div>
               </div>
               <div class="form-group row">
                  <label for="inputID" class="col-sm-2 col-form-label">Addiction, If yes, please specify:</label>
                  <div class="col-sm-10">
                     <input type="text" class="form-control" name="addiction" id="inputID" placeholder="Yes/No" required>
                  </div>
               </div>
               <div>
                  <input type="submit" class="btn btn-primary"  value="Submit">
               </div>
            </form>
         </main>
         <footer class="mastfoot mt-auto">
         </footer>
      </div>
      <!-- Bootstrap core JavaScript
         ================================================== -->
      <!-- Placed at the end of the document so the pages load faster -->
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="js/bootstrap.min.js"></script>
      <script>
         const urlParams = new URLSearchParams(window.location.search);
         const success= urlParams.get('success');
         var display=document.getElementById("success");
         if(success==1){
            display.innerHTML=`<div class="alert alert-primary" role="alert">
  Data was added successfully! Check out at Records.
</div>`;
         }
         else if(success==0){
            display.innerHTML=`<div class="alert alert-danger" role="alert">
               An error happened. Unable to store the
               </div>`;
         }
      </script>
   </body>
</html>
