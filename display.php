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
      <title>All Data in Record</title>
      <link rel="icon" type="image/x-icon" href="favicon.ico" />      
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="cover.css" rel="stylesheet">
   </head>
   <body class="text-center">
      <div class="cover-container  h-100 p-2 mx-auto flex-column">
         <header class="masthead mb-auto">
            <div class="inner">
             <?php include 'navbar.php'; ?>
            </div>
            <hr style="height:35px">
         </header>
         <br><div id="success"></div><br> 
         <form action="display.php" method="GET">
         <div class="form-row ">
            <div class="col">
               <input type="text" class="form-control" placeholder="Name" name="name">
            </div>
            <div class="col">
               <input type="text" class="form-control" placeholder="Email" name="email">
            </div>
            <div class="col">
               <input type="text" class="form-control" placeholder="Address" name="city">
            </div>
            <div class="col">
               <input type="text" class="form-control" placeholder="Phone" name="phone">
            </div>
            <div class="col">
               <input type="text" class="form-control" placeholder="Business" name="profession">
            </div>
            <div class="col">
               <input type="text" class="form-control" placeholder="Addiction" name="addiction">
            </div>
            <div class="col">
                  <button type="submit" class="btn btn-primary">Filter</button>
            </div>
         </div>
         <br><br>
         </form>
         <main role="main" class="inner cover">
            <h1 class="cover-heading">List of Data</h1>

            <div class="btn-group" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-secondary" onclick="sortdata(1)">New Last</button>
            <button type="button" class="btn btn-secondary" onclick="sortdata(0)">New First</button>
            <button type="button" class="btn btn-dark" onclick="removefilter()">Remove Filters</button>
            </div>
<br>
<br>
            <div class="btn-group btn-group-lg" role="group" aria-label="Basic example">
            <a href="" id="downloadpdf" class="btn btn-primary btn" role="button" aria-disabled="true" target="_blank">Download PDF</a>
            <a href="" id="downloadexcel" class="btn btn-primary btn" role="button" aria-disabled="true" target="_blank">Download Excel</a>
            </div>

            <br><br>
            <table class = "table table-bordered table-hover">
               <tbody>
                  <?php
                     $valid= false;
                     include 'databaseinfo.php';

                     
                     try {
                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        // set the PDO error mode to exception
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        //parameters for filter
                        $nameq=$_GET['name'];
                        $emailq=$_GET['email'];
                        $cityq=$_GET['city'];
                        $phoneq=$_GET['phone'];
                        $professionq=$_GET['profession'];
                        $addictionq=$_GET['addiction'];
                        $sort=$_GET['sort'];
                        if(is_null($nameq)){$nameq="";}
                        if(is_null($emailq)){$emailq="";}
                        if(is_null($cityq)){$cityq="";}
                        if(is_null($phoneq)){$phoneq="";}
                        if(is_null($professionq)){$professionq="";}
                        if(is_null($sort)){$sort="DESC";}
                        if($sort=="DESC"){
                           $getallpostsquery = $conn->prepare("SELECT * FROM datatable WHERE name LIKE ? AND email LIKE ? AND phone LIKE ? AND address LIKE ? AND business LIKE ?  AND addiction LIKE ? ORDER BY entrydate DESC");
                        }else{
                           $getallpostsquery = $conn->prepare("SELECT * FROM datatable WHERE name LIKE ? AND email LIKE ? AND phone LIKE ? AND address LIKE ? AND business LIKE ?  AND addiction LIKE ? ORDER BY entrydate ASC");
                        }
                        $getallpostsquery->execute(array("%$nameq%","%$emailq%","$phoneq%","%$cityq%","%$professionq%","%$addictionq%"));
                        $result= $getallpostsquery->fetchAll();
                     } catch(PDOException $e) {
                        echo "Error: " . $e->getMessage();
                      }
      
                     echo "<thead class='thead-dark'>";
                                   echo "<th>#</th>";
                                  echo "<th>Name</th>";
                                  echo "<th>F/H_Name</th>";
                                  echo "<th>Age</th>";
                                  echo "<th>Education</th>";
                                //   echo "<th>Email</th>";
                                  echo "<th>Phone</th>";
                                  echo "<th>Address</th>";
                                  echo "<th>Business</th>";
                                  echo "<th>Gurumantra Place</th>";
                                  echo "<th>Trees</th>";
                                  echo "<th>Addiction</th>";
                                  echo "<th></th>";
                                  echo "<th></th>
                                </tr>
                              </thead>";
                    if($sort=="DESC"){
                        $entryno=count($result);
                    }else{
                        $entryno=1;
                    }
                     foreach($result as $post){
                              echo "<tr>";
                               echo "<td >",$entryno," </td>";
                              echo "<td >",$post['name']," </td>";
                              echo "<td >",$post['fhname']," </td>";
                              echo "<td >",$post['age']," </td>";
                              echo "<td >",$post['education']," </td>";
                            //   echo "<td >".$post['email']." </td>";
                              echo "<td >".$post['phone']." </td>";
                              echo "<td >".$post['address']." </td>";
                              echo "<td >".$post['business']." </td>";
                              echo "<td >".$post['gurumantra']." </td>";
                              echo "<td >".$post['hmt']." </td>";
                              echo "<td >".$post['addiction']." </td>";
                              echo "<td><button onclick=\"location.href = 'change.php?id=".$post['entryid']."';\" type=\"button\" class=\"btn btn-success\">Edit</button></td>";
                              echo "<td><button onclick=\"if(confirm('Are you sure to delete this entry?')){location.href = 'removedata.php?id=".$post['entryid']."';}\" type=\"button\" class=\"btn btn-danger\">Delete</button></td>";
                              echo "</tr>";
                              if($sort=="DESC"){
                                    $entryno--;
                                }else{
                                    $entryno++;
                                }
                        //   $entryno--;
                     }
                     $valid=true;
                     ?>
               </tbody>
               </thead>
            </table>
            <?php if(!$valid){?>
            <h5 class="text-danger">*There are currently no data in our record!*</h5>
            <?php }?>
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
      <script>
         var dpdf="dpdf.php?"+window.location.href.split('?')[1];
         var dexcel="dexcel.php?"+window.location.href.split('?')[1];
         document.getElementById('downloadpdf').href=dpdf;
         document.getElementById('downloadexcel').href=dexcel;
         const urlParams = new URLSearchParams(window.location.search);
         const success= urlParams.get('success');
         var display=document.getElementById("success");
         if(success==1){
            display.innerHTML=`<div class="alert alert-primary" role="alert">
            Success!
            </div>`;
         }
         else if(success==0){
            display.innerHTML=`<div class="alert alert-danger" role="alert">
               An error happened.
               </div>`;
         }
         function sortdata(s){
            var url=new URL(window.location.href);
            if(s){
               url.searchParams.set('sort','ASC');
            }
            else{
               url.searchParams.set('sort','DESC');
            }
            window.location.href=url;
         }
         function removefilter(){
            window.location.href=window.location.href.split('?')[0]
         }
      </script>

   </body>
</html>