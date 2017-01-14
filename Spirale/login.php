<?php
//$xml=simplexml_load_file('korisnici.xml');

if(isset($_REQUEST['login'])){
	$usernameA = htmlspecialchars($_REQUEST['username']);
	$passwordA = htmlspecialchars($_REQUEST['password']);
	
	if(strlen($usernameA)< 4){ $_SESSION['greska'] = 'Korisničko ime je prekratko!';}
	
	if(strlen($passwordA)< 4){ $_SESSION['greska'] = 'Password je prekratak!';}

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

		$sql = "SELECT * FROM administrator";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			
			while($row = $result->fetch_assoc()) {
				if($row["username"] == $usernameA && $row["password"] == $passwordA) {
					session_start();
					$_SESSION['username'] = $username;
					$_SESSION['password'] = $password;
					$_SESSION['loggedin'] = true;
					
					header('Location: zadaca.php');
				}
			}
		} else {
			echo "0 results";
		}
		$conn->close();
	
}

if(isset($_REQUEST['logout'])){
	if (!isset($_SESSION))
  {
    session_start();
  }
	session_destroy();
	header('Location: zadaca.php');
}
?>
<html>
<head>
	<META name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" type="text/css" href="css/prica.css">
  <link rel="stylesheet" type="text/css" href="css/meni.css">
  <link rel="stylesheet" type="text/css" href="css/dropbtn.css">
  <script type="text/javascript" src="js/validacija.js"></script>
</head>

<body>
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
<form action="login.php" method="post" name="posaljiPricu" class="formaPrica" onsubmit="return validirajLogIn();">
    <label>
        <span>Username:</span>
        <input id="name" type="text" name="username" placeholder="Korisničko ime"/>
    </label>

    <label>
        <span>Pasword:</span>
        <input type="password" id="password" name="password" placeholder="Šifra"></textarea>
    </label>

     <label>
        <span>&nbsp;</span>
        <input type="submit" class="button" value="Pošalji" name="login" onclick="spremi()"/>
    </label>
	<label>
	<span>&nbsp;</span>
	<p name="poruka" id="poruka">
	<?php
	if(isset($_SESSION['greska'])){
		print $_SESSION['greska'];
	}
	?>
	</p>
	</label>
</form>

</div>
</body>
</html>