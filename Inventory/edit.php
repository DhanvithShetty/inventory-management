<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "inventory_management";

$connection = new mysqli($servername,$username,$password,$database);

$id = "";
$item_id = "";
$quantity = "";
$condition = "";

$errorMessage = "";
$successMessage = "";

if( $_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["id"])) {
        header("location: /dbms/Consumables/index.php");
        exit;
    }

    $id = $_GET["id"];

    $sql = "SELECT * FROM inventory WHERE inv_id = $id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();
    
    if(!$row){
        header("location: /dbms/Inventory/index.php");
        exit;
    }

    $item_id = $row["item_id"];
    $quantity = $row["quantity"];
    $condition = $row["condition"];

}else{

    $id = $_POST["id"];
    $item_id = $_POST["item_id"];
    $quantity = $_POST["quantity"];
    $condition = $row["condition"];

    do {
        if(empty($id) || empty($item_id) || empty($quantity) || empty($condition)) {
            $errorMessage = "All the fields are required";
            break;
        }

        $sql = "UPDATE inventory SET item_id = '$item_id', quantity = '$quantity', condition = '$condition' WHERE inv_id = $id";
        
        $result = $connection->query($sql);
        
        if(!$result){
            $errorMessage = "Invalid query : " . $connection->error;
            break;
        }

        $successMessage = "Consumable Item updated successfully";

        header("location: /dbms/Consumables/index.php");
        exit;

    } while (false);


}



?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>Add Consumables</h2>
        <?php
            if (!empty($errorMessage)) {
                echo "
                <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>$errorMessage</strong
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                </div>
                ";
            }
        ?>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Item ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="item_id" value="<?php echo $item_id; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Quantity</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="quantity" value="<?php echo $quantity; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Condition</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="condition" value="<?php echo $condition; ?>">
                </div>
            </div>
            <?php
                if(!empty($successMessage)) {
                echo "
                    <div class='row mb-3'>
                        <div class='offset-sm-3 col-sm-6'>
                            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>$successMessage</strong>
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
                            </div>
                        </div>
                    </div>
                    ";
                }
            ?>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/dbms/Inventory/index.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>