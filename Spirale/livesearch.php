<?php
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
    $q=$_GET["q"];
	$hint = "";
	$brojac = 0;
	if (strlen($q)>0) {
		while($row = $result->fetch_assoc()) {
		  //vrsimo pretragu po autoru i komentaru 
		  if (stristr($row["usluga"],$q) || stristr($row["tekst"],$q)) {
				$brojac = $brojac + 1;
			if ($hint=="") {
				  $hint="<p>".$row["usluga"]." ".$row["tekst"]."</p>";
				} else {
				  $hint=$hint."</br><p>". 
				  $row["usluga"] . 
				  $row["tekst"] . "</p>";
				}
				if($brojac >= 10){
					break;
		  }
	  }
	}
	
	} 
	}
	else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
	
// Set output to "no suggestion" if no hint was found
// or to the correct values
if ($hint=="") {
  $response="no suggestion";
} else {
  $response=$hint;
}

//output the response
echo $response;
?>