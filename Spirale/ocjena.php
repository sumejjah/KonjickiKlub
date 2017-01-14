<!DOCTYPE html>
<html>
<head>
  <META name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" type="text/css" href="css/anketa.css">
  <link rel="stylesheet" type="text/css" href="css/dropbtn.css">
    <link rel="stylesheet" type="text/css" href="css/meni.css">
</head>
<body>
<?php
session_start();
if(isset($_SESSION['loggedin'])){
	print "<form action='login.php' method='POST'><input name='logout' type='submit' value='Logout' id='login'></form>";
	print "<p id='login'>".$_SESSION['username']."je logovan";
}
else{
	print "<form action='login.php' method='POST'><input name='loginPopuni' type='submit' value='Login' id='login'></form>";
}

?>

<div class="meni">
  <div class="kolona prazno"></div>
  <div class="kolona pet"><a href="zadaca.php">O nama</a></div>
  <div class="kolona pet"><a href="ponuda.php">Ponuda</a></div>
  <div class="dropdown">
	<button class="dropbtn">Iskustva</button>
  <div class="dropdown-content">
    <a href="posaljiPricu.php">Recenzije</a>
    <a href="ocjena.php">Anketa</a>
    <a href="pretragaKomentara.php" id="peti">Pretraga</a>
  </div>
</div>
  <div class="kolona pet"><a href="carousel.php">Galerija</a></div>
  <div class="kolona pet"><a href="kontakt.php">Kontakt</a></div>
</div>


<div class = "red">
  <div class="kolona dva">
    <!--forma za pitanja-->
	<form action="ocjena.php" method="POST" class="formaAnketa">
      <h3>Ocijenite stranicu</h3>
      
      <label>
        <span>Da li ste posjetili klub?</span>
        <input id="infoDaKLub" type="radio" name="klub" value="Da" checked/>
        <span>Da</span>
        <input id="infoNeKlub" type="radio" name="klub" value="Ne"/>
        <span>Ne</span>
      </label>
      <label>
        <span>Da li biste preporučili klub?</span>
        <input id="infoDa" type="radio" name="preporuka" value="Da" checked/>
        <span>Da</span>
        <input id="infoNe" type="radio" name="preporuka" value="Ne"/>
        <span>Ne</span>
      </label>
      <label>
        <span>Da li ste dobili traženu informaciju?</span>
        <input id="infoDa" type="radio" name="uspjeh" value="Da" checked/>
        <span>Da</span>
        <input id="infoNe" type="radio" name="uspjeh" value="Ne"/>
        <span>Ne</span>
      </label>

      <label>
        <input type="submit" class="button" name="anketiranje" value="Posalji"/>
      </label>
    </form>    
  </div>
  
  <?php
if(isset($_REQUEST['anketiranje'])){
	$klub = $_REQUEST['klub'];
	$preporuka = $_REQUEST['preporuka'];
	$uspjeh = $_REQUEST['uspjeh'];
	$servername = "localhost";
	$username = "wtuser";
	$password = "wtpassword";
	$dbname = "wt_spirala4";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "INSERT INTO anketa (pitanje1, pitanje2, pitanje3) VALUES ('$klub', '$preporuka', '$uspjeh')";
	if ($conn->query($sql) === TRUE) {
    echo "";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
	
}
	//$podaci = simplexml_load_file('anketa.xml');
	
	
	/*$child = $podaci->addChild("odgovori");
	$child->addChild("prvo", $klub);
	$child->addChild("drugo", $preporuka);
	$child->addChild("trece", $uspjeh);
	
	$podaci->asXML("anketa.xml");
	}
	
	$xml = simplexml_load_file('anketa.xml');
	$da1 = 0; $da2 = 0; $da3=0; $ne1 = 0; $ne2 = 0; $ne3 = 0;
	foreach($xml->odgovori as $u){
		if($u->prvo == 'Da') {$da1 = $da1+1;} else {$ne1 = $ne1 + 1;}
		if($u->drugo == 'Da') {$da2 = $da2+1;} else {$ne2 = $ne2 + 1;}
		if($u->trece == 'Da') {$da3 = $da3+1;} else {$ne3 = $ne3 + 1;}

	}*/
	
	$servername = "localhost";
	$username = "wtuser";
	$password = "wtpassword";
	$dbname = "wt_spirala4";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "SELECT pitanje1, pitanje2, pitanje3 FROM anketa";
	$result = $conn->query($sql);
	
	$da1 = 0; $da2 = 0; $da3=0; $ne1 = 0; $ne2 = 0; $ne3 = 0;
	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			//echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
			if($row["pitanje1"] == 'Da') {$da1 = $da1+1;} else {$ne1 = $ne1 + 1;}
			if($row["pitanje2"] == 'Da') {$da2 = $da2+1;} else {$ne2 = $ne2 + 1;}
			if($row["pitanje3"] == 'Da') {$da3 = $da3+1;} else {$ne3 = $ne3 + 1;}
		}
	} else {
		echo "0 results";
	}
	$conn->close();
	
	print "<div class='kolona dva'><div class='rezultati'><p>Da li ste posjetili klub? Da ".$da1." Ne: ".$ne1."</p><p>Da li biste preporučili klub? Da ".$da2." Ne: ".$ne2."</p><p>Da li ste dobili traženu informaciju? Da ".$da3." Ne: ".$ne3."</p></div></div>";
	
?> 
  </div>
 
 
</body>
</html>
