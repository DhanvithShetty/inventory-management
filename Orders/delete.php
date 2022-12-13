<?php 
if (isset($_GET["id"])){
    $id = $_GET["id"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "inventory_management";

    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "DELETE FROM orders WHERE order_id = $id";
    $connection->query($sql);

}

header("location: /dbms/Orders/index.php");
exit;

?>