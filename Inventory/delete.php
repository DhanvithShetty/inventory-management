<?php 
if (isset($_GET["sno"])){
    $sno = $_GET["sno"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "inventory_management";

    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM inventory WHERE `sno` = $sno";
    $connection->query($sql);

}

header("location: /dbms/Inventory/index.php");
exit;

?>