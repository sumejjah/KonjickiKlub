<?php
 header('Content-type: application/json');
    class InventoryAPI {
    private $db;
    function __construct() 
	{
		$this->db = new mysqli('localhost', 'wtuser', 'wtpassword', 'wt_spirala4');
		$this->db->autocommit(FALSE);
    }
    function __destruct() 
	{
		$this->db->close();
    }
    function checkInv() {
    $query = "SELECT * FROM usluga";
    $result = $this->db->query($query);
    $rows = array();
    $i = 0;
    while($row = $result->fetch_assoc())
    {
        $rows[] = $row;
        $i++;
    }
    $result->close();
    $this->db->close();
    echo json_encode($rows);
    }
}
$api = new InventoryAPI;
$api->checkInv();
?>