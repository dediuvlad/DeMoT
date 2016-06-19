<!DOCTYPE HTML>  
<html>
<head>
    <title>Proiect Tehnologii Web</title>
	<meta name="viewport" content="width = device-width, initial-scale = 1.0">
	<link href = "css/bootstrap.min.css" rel= "stylesheet">
	<link href = "css/styles.css" rel= "stylesheet">
	<link href = "css/stil2.css" rel= "stylesheet">
</head>
<body>  
<?php
// define variables and set to empty values
$nume = $prenume = $categorie = "";
session_start();

$id_img = $_SESSION['favcolor'];


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nume = test_input($_POST["nume"]);
  $prenume = test_input($_POST["prenume"]);
  $categorie = test_input($_POST["categorie"]);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>


<div class = "navbar navbar-inverse navbar-static-top">	

	<!-- Ce va contine bara-->
	<div class = "container">
		
			<!-- Brandul-->
			<div class = "navbar-brand"> DeMoT </div> 
		
		<ul class = "nav navbar-nav navbar-right">
		
			<li> <a href="index.html">Home</a></li>
			<li> <a href = "#" class="dropdown-toggle" data-toggle="dropdown">Condamnati <span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">
				<li><a href="condamnatpg1.php">Adauga Condamnat</a></li>
				<li><a href="condamnati.php">Lista Condamnati</a></li>                                          
				</ul> </li>
			<li><a href="statistici.php">Statistici</a></li>

			
		</ul>
				
	</div>		
		
</div>
<div class = "container">
	<div class="jumbotron">
<center>
<?php

   if(isset($_POST['submit']))
   {
    //Do all the submission part or storing in DB work and all here
    header('Location: condamnati.php');
   }

                $con=mysql_connect("localhost","root","");
                mysql_select_db("demotdb",$con);
				$qry = "SELECT imagine from imagini where id_imagine='$id_img'";
                $result=mysql_query($qry,$con);
				while($row = mysql_fetch_array($result))
                {
					echo '<img src="data:image;base64,'.$row[0].'" class="img-thumbnail" style="width:400px;height:400px;">';

					}
             
?>

<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  

<fieldset class="form-group">
    <label for="exampleInputEmail1" class="col-sm-2 form-control-label">Nume</label>
	<div class="col-sm-10">
    <input type="text" class="form-control" name = "nume" placeholder="Numele condamnatului">
	</div>
 </fieldset>
 
 <fieldset class="form-group">
    <label for="exampleInputEmail1" class="col-sm-2 form-control-label">Prenume</label>
	<div class="col-sm-10">
    <input type="text" class="form-control" name = "prenume" placeholder="Prenumele condamnatului">
	</div>
 </fieldset>
  <fieldset class="form-group">
    <label for="exampleSelect1" class="col-sm-2 form-control-label">Categoria pedepsei</label>
	<div class="col-sm-10">
    <select class="form-control" name="categorie">
     <option value="crima">Crima</option>
    <option value="furt">Furt</option>
    <option value="viol">Viol</option>
    <option value="hartuire">Hartuire</option>
    <option value="santaj">Santaj</option>
    <option value="rapire">Rapire</option>
    </select>
	</div>
  </fieldset>
  <input type="submit"  onclick=" return buttonClickd();" name="submit"  class="btn btn-primary btn-lg" value="Submit">  
</form>




<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "demotdb";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$id = uniqid();

$sql = "INSERT INTO condamnat (id_condamnat, nume_condamnat, prenume_condamnat, categoria_pedepsei, id_img) VALUES ('$id','$nume','$prenume','$categorie','$id_img')";

if($nume != '')
{
  IF (mysqli_query($conn, $sql)) {
   echo "Great Job! You've entered it correctly!";
   
  } else {
	  echo "ERROR";
  }
}

$conn->close();



 ?>
 
</div>
</div>
</center>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>