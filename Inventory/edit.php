<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "inventory_management";

$connection = new mysqli($servername,$username,$password,$database);

$id = "";
$inv_id = "";
$item_id = "";
$condition = "";

$errorMessage = "";
$successMessage = "";

if( $_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["id"])) {
        header("location: /dbms/Consumables/index.php");
        exit;
    }

    $id = $_GET["id"];

    $sql = "SELECT * FROM inventory WHERE sno = $id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();
    
    if(!$row){
        header("location: /dbms/Inventory/index.php");
        exit;
    }

    if (isset($_GET["inv_id"]) || isset($_GET["item_id"]) || isset($_GET["condition"])) {
        $inv_id = $row["inv_id"];
        $item_id = $row["item_id"];
        $condition = $row["condition"];
    }

}else{

    if(isset($_POST["id"]) || isset($_POST["inv_id"]) || isset($_POST["item_id"]) || isset($_POST["condition"])){

        $id = $_POST["id"];
        $inv_id = $_POST["inv_id"];
        $item_id = $_POST["item_id"];
        $condition = $_POST["condition"];

    }
    

    do {
        if(empty($inv_id) || empty($condition)) {
            $errorMessage = "All the fields are required";
            break;
        }

        $sql = "UPDATE `inventory` SET `inv_id` = '$inv_id', `condition` = '$condition' WHERE `sno` = $id";    
        
        $result = $connection->query($sql);
        
        if(!$result){
            $errorMessage = "Invalid query : " . $connection->error;
            break;
        }

        $successMessage = "Inventory Item updated successfully";

        header("location: /dbms/Inventory/index.php");
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
<body style = "background: linear-gradient(40deg, #a1ffce, #faffd1)">
    <div class="container my-5">
        <h2>Edit Inventory Item</h2>
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
                <label class="col-sm-3 col-form-label">Inv ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="inv_id" value="<?php echo $inv_id; ?>">
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