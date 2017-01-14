<!DOCTYPE HTML>
<HTML>
<head>
  <META name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" type="text/css" href="css/usluge.css">
  <link rel="stylesheet" type="text/css" href="css/meni.css">
  <link rel="stylesheet" type="text/css" href="css/dropbtn.css"></head>

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

<?php

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){

//dodavanje 
if(isset($_REQUEST['dodavanje'])){
	$_SESSION['ponudaErr']="";
	$naziv = htmlspecialchars($_REQUEST['naziv']);
	$trajanje = htmlspecialchars($_REQUEST['trajanje']);
	$cijena = htmlspecialchars($_REQUEST['cijena']);
	
	if(strlen($naziv)<3) {
		$_SESSION['ponudaErr']='Naziv aktivnosti mora biti duži od 3 slova.';
		print "<p>GREŠKA:".$_SESSION['ponudaErr']."</p>";
		}
		
	if(strlen($trajanje)<3) {
		$_SESSION['ponudaErr']='Naziv trajanja aktivnosti mora biti duži od 3 slova i prvi znak mora biti broj';
		print "<p>GREŠKA:".$_SESSION['ponudaErr']."</p>";
		}
		
	if(is_numeric(substr($trajanje, 0, 1))==false) {
		$_SESSION['ponudaErr']='Prvi znak trajanja mora biti broj!';
		print "<p>GREŠKA:".$_SESSION['ponudaErr']."</p>";
		}
	if(is_numeric(substr($cijena, 0, 1))==false) {
		$_SESSION['ponudaErr']='Prvi znak cijene mora biti broj!';
		print "<p>GREŠKA:".$_SESSION['ponudaErr']."</p>";
		}
			
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
	if(!isset($_SESSION['ponudaErr']) || $_SESSION['ponudaErr']==""){
		$sql = "INSERT INTO usluga (administrator, naziv, trajanje, cijena) VALUES (1, '$naziv', '$trajanje', '$cijena');";
		
		if ($conn->multi_query($sql) === TRUE) {
    echo "New records created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
	}
	
	
}
//brisanje
if(isset($_REQUEST['brisanje'])){
	$naziv = htmlspecialchars($_REQUEST['naziv']);
	$trajanje = htmlspecialchars($_REQUEST['trajanje']);
	$cijena = htmlspecialchars($_REQUEST['cijena']);
	$red = $_REQUEST['red'];
		
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

	// sql to delete a record
	$sql = "DELETE FROM usluga WHERE id=$red";

	if ($conn->query($sql) === TRUE) {
		echo "Record deleted successfully";
	} else {
		echo "Error deleting record: " . $conn->error;
	}

	$conn->close();
}

//mijenjanje
if(isset($_REQUEST['mijenjanje'])){
		$_SESSION['ponudaErr']="";

		$naziv = htmlspecialchars($_REQUEST['naziv']);
		$trajanje = htmlspecialchars($_REQUEST['trajanje']);
		$cijena = htmlspecialchars($_REQUEST['cijena']);
		$red = $_REQUEST['red'];
					
		if(strlen($naziv)<3) {
		$_SESSION['ponudaErr']='Naziv aktivnosti mora biti duži od 3 slova.';
		print "<p>GREŠKA:".$_SESSION['ponudaErr']."</p>";
		}
		
	if(strlen($trajanje)<3) {
		$_SESSION['ponudaErr']='Naziv trajanja aktivnosti mora biti duži od 3 slova i prvi znak mora biti broj';
		print "<p>GREŠKA:".$_SESSION['ponudaErr']."</p>";
		}
		
	if(is_numeric(substr($trajanje, 0, 1))==false) {
		$_SESSION['ponudaErr']='Prvi znak trajanje mora biti broj!';
		print "<p>GREŠKA:".$_SESSION['ponudaErr']."</p>";
		}
	if(is_numeric(substr($cijena, 0, 1))==false) {
		$_SESSION['ponudaErr']='Prvi znak cijene mora biti broj!';
		print "<p>GREŠKA:".$_SESSION['ponudaErr']."</p>";
		}
		
		if(!isset($_SESSION['ponudaErr']) || $_SESSION['ponudaErr']==""){
			
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

		$sql = "UPDATE usluga SET naziv='$naziv', trajanje='$trajanje', cijena='$cijena' WHERE id=$red";

		if ($conn->query($sql) === TRUE) {
			echo "Record updated successfully";
		} else {
			echo "Error updating record: " . $conn->error;
		}

		$conn->close();
		}
}

//dodavanje u bazu onih koji nisu dodani
if(isset($_REQUEST['ucitajBaza']))
{
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
	//ucitavam usluge.xml
	$usluge = simplexml_load_file('usluge.xml');
	foreach($usluge->usluga as $u)
	{
		$administrator = 1;
		$naziv = $u->naziv;
		$trajanje = $u->trajanje;
		$cijena = $u->cijena;
		echo $naziv;
		$vecPostoji = "SELECT * FROM usluga where naziv='$naziv' and cijena='$cijena'";
		$result = $conn->query($vecPostoji);
		if($result->num_rows<1)
		{
		$sql = "INSERT INTO usluga (administrator, naziv, trajanje, cijena) VALUES ('$administrator', '$naziv', '$trajanje', '$cijena')";
		
		if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		}
		
		
	}
	
	//ucitavanje komentari.xml
	$komentari = simplexml_load_file('komentari.xml');
	foreach($komentari->link as $u)
	{
		$proizvod = $u->autor;
		$komentar = $u->komentar;
		$vecPostoji = "SELECT * FROM komentar where usluga='$proizvod' and tekst='$komentar'";
		$result = $conn->query($vecPostoji);
		if($result->num_rows<1)
		{
		$sql = "INSERT INTO komentar (usluga, tekst) VALUES ('$proizvod', '$komentar')";
		
		if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		}
		
		
	}
	
	//ucitavanje anketa.xml
	$rAnketa = simplexml_load_file('anketa.xml');
	foreach($rAnketa->odgovori as $u)
	{
		$p1 = $u->prvo;
		$p2 = $u->drugo;
		$p3 = $u->trece;
		$vecPostoji = "SELECT * FROM anketa where pitanje1='$p1' and pitanje2='$p2' and pitanje3='$p3'";
		$result = $conn->query($vecPostoji);
		if($result->num_rows<1)
		{
		$sql = "INSERT INTO anketa (pitanje1, pitanje2, pitanje3) VALUES ('$p1', '$p2', '$p3')";
		
		if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		}
		
		
	}

	$conn->close();
}


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
	
	$sql = "SELECT id, naziv, trajanje, cijena FROM usluga";
	$result = $conn->query($sql);
	
	print "<h1>Ponuda</h1>";
	print "<table>";
	print "<TR><TH>Naziv</TH><TH>Trajanje</TH><TH>Cijena</TH></TR>";

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) 
	{
        //echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
	print "<TR><form action='ponuda.php' method='POST'>";
	print "<TD><input type='text' name='naziv' value='".$row["naziv"]."'></TD>";
	print "<TD><input type='text' name='trajanje' value='".$row["trajanje"]."'></TD>";
	print "<TD><input type='text' name='cijena' value='".$row["cijena"]."'></TD>";
	print "<TD><input type='hidden' name='red' value='".$row["id"]."'><input type='submit' name='brisanje' value='-'> <input type='submit' name='mijenjanje' value= 'E'></TD>";
	print "</form></TR>";
    }
} else {
    echo "0 results";
}
$conn->close();
print "</table>";  
 print "<table>";
 print "<TR><form action='ponuda.php' method='POST'><TD><input type='text' name='naziv'> <input type='text' name='trajanje'> <input type='text' name='cijena'> <input type='submit' name='dodavanje' value='+'></TD></form></TR>";
 print "</table>";
 if(isset($_REQUEST['downloadCSV'])){
	header("Location: downloadCSV.php");
}
print "</br>";
print "<form><input type='submit' name='downloadCSV' value='Download'></form>"; 
print "</br>";
print "<form><input type='submit' name='ucitajBaza' value='Ucitaj u bazu'></form></br>";
}
//ako nije logovan admin
else{
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
	
	$sql = "SELECT id, naziv, trajanje, cijena FROM usluga";
	$result = $conn->query($sql);
print "<h1>Ponuda</h1>";
print "<table>";
print "<TR><TH>Naziv</TH><TH>Trajanje</TH><TH>Cijena</TH></TR>";

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) 
	{	
	print "<TR><form action='ponuda.php' method='POST'>";
	print "<TD><input type='text' name='naziv' value='".$row["naziv"]."'></TD>";
	print "<TD><input type='text' name='trajanje' value='".$row["trajanje"]."'></TD>";
	print "<TD><input type='text' name='cijena' value='".$row["cijena"]."'></TD>";
	print "</form></TR>";
    }
} else {
    echo "0 results";
}
$conn->close();
print "</table>"; 

}
if(isset($_REQUEST['pdfIspis'])){
	echo("<script>location.href = 'izvjestajpdf.php';</script>");

}
print "<form><input type='submit' name='pdfIspis' value='Printaj'></form>";

?>


</body>
</html>
