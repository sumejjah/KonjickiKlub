<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/tabelaK.css">
	<link rel="stylesheet" type="text/css" href="css/meni.css">
	<link rel="stylesheet" type="text/css" href="css/dropbtn.css">
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
</body>
</html>
<?php
if(isset($_REQUEST['pretrazi'])){
	$unos = $_REQUEST['unos'];
	
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

	$sql = "SELECT * FROM komentar";
	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
    $q=$unos;
	if (strlen($q)>0) {
		while($row = $result->fetch_assoc()) {
		  //vrsimo pretragu po autoru i komentaru 
		  if (stristr($row["usluga"],$q) || stristr($row["tekst"],$q)) {
				$odgovor=1;
			print "<table>";
			print "<TR>";
			$s = "Usluga: ".$row["usluga"];
			print "<TD>$s</TD></TR>";
			$kom = "Komentar: ".$row["tekst"];
			print "<TD>$kom</TD>";
			print "</TR>";
			print "</table>"; 
		  }
	  }
	}
	
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();

//ako nema odgovora
if($odgovor == 0)
	echo "Nema rezultata!";
}
?>