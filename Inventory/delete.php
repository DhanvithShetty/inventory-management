<?php 
if (isset($_GET["id"])){
    $id = $_GET["id"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "inventory_management";

    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM inventory WHERE inv_id = $id";
    $connection->query($sql);

}

header("location: /dbms/Inventory/index.php");
exit;

?>