<!DOCTYPE html>
<html>
<head>
  <META name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" type="text/css" href="css/prica.css">
  <link rel="stylesheet" type="text/css" href="css/meni.css">
  <link rel="stylesheet" type="text/css" href="css/dropbtn.css">
  <script type="text/javascript" src="js/validacija.js"></script>
  <script type="text/javascript" src="js/localstorage.js"></script>
</head>

<body onload="ucitaj()">
</body>
<?php
session_start();
if(isset($_SESSION['loggedin'])){
	print "<form action='login.php' method='POST'><input name='logout' type='submit' value='Logout' id='login'></form>";
	print "<p id='login'>".$_SESSION['username']."je logovan";
}
else{
	print "<form action='login.php' method='POST'><input name='loginPopuni' type='submit' value='Login' id='login'></form>";
}

if(isset($_REQUEST['komentarisi'])){
	$_SESSION['komentarErr']="";
	$ime = htmlspecialchars($_REQUEST['ime']);
	$kom = htmlspecialchars($_REQUEST['message']);
	
	if(strlen($ime)<3) {
		$_SESSION['komentarErr']='Naziv mora biti duži od 3 slova.';
		print "<p>GREŠKA:".$_SESSION['komentarErr']."</p>";
		}
	
	if(strlen($kom)<10) {
		$_SESSION['komentarErr']='Komentar mora biti imati minimalno 10 znakova.';
		print "<p>GREŠKA:".$_SESSION['komentarErr']."</p>";
		}
	
	//$podaci = simplexml_load_file('komentari.xml');
	if(!isset($_SESSION['komentarErr']) || $_SESSION['komentarErr']==""){
		/*$child = $podaci->addChild("link");
		$child->addChild("autor", $ime);
		$child->addChild("mail", $mail);
		$child->addChild("komentar", $kom);
		
		$podaci->asXML("komentari.xml");*/
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
		$sql = "SELECT * FROM usluga WHERE naziv='$ime'";
		$rezultat = $conn->query($sql);
		if ($rezultat === false) {
			echo "greska: " . $conn->error;
		}
		else{
			$row = $rezultat->fetch_assoc();
			echo $row["id"]."majko mila";
			$u = $row["id"];
		}
		$conn->close();
		
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		//dodati komentar za odgovarajuci proizvod
		$sql2 = "INSERT INTO komentar (usluga, tekst) VALUES ('$u', '$kom');";
		if ($conn->query($sql2) === TRUE) {
		echo "Komentar dodan u bazu";
		} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
		}
		$conn->close();

	}
}

?>


<?php

// php select option value from database

$hostname = "localhost";
$username = "wtuser";
$password = "wtpassword";
$databaseName = "wt_spirala4";

// connect to mysql database

$connect = mysqli_connect($hostname, $username, $password, $databaseName);

// mysql select query
$query = "SELECT * FROM `usluga`";

// for method 1

$result1 = mysqli_query($connect, $query);

// for method 2

$result2 = mysqli_query($connect, $query);

$options = "";

while($row2 = mysqli_fetch_array($result2))
{
    $options = $options."<option>$row2[1]</option>";
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

<div class="red">
<form action="posaljiPricu.php" method="post" name="posaljiPricu" class="formaPrica" onsubmit="return validirajPricu();">
    <h1>
        <span>Napišite komentar.</span>
    </h1>
    <label>
        <span>Naziv usluge:</span>
        <!--<input id="name" type="text" name="ime" placeholder="Puno ime"/>-->
		<select name="ime">

            <?php while($row1 = mysqli_fetch_array($result1)):;?>

            <option value="<?php echo $row1[2];?>"><?php echo $row1[2];?></option>

            <?php endwhile;?>

        </select>
	</label>

    <label>
        <span>Komentar :</span>
        <textarea id="message" name="message" placeholder="Vaše iskustvo"></textarea>
		        
	</label>

     <label>
        <span>&nbsp;</span>
        <input type="submit" class="button" value="Pošalji" name="komentarisi" onclick="spremi()"/>
    </label>
	<label>
	<span>&nbsp;</span>
	<p name="poruka" id="poruka"></p>
	</label>
</form>
</div>

</html>
