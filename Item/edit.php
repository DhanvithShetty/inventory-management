<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "inventory_management";

$connection = new mysqli($servername,$username,$password,$database);

$id = "";
$type = "";
$name = "";

$errorMessage = "";
$successMessage = "";

if( $_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["id"])) {
        header("location: /dbms/Item/index.php");
        exit;
    }

    $id = $_GET["id"];

    $sql = "SELECT * FROM item WHERE item_id = $id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();
    
    if(!$row){
        header("location: /dbms/Item/index.php");
        exit;
    }
    if (isset($_GET["type"]) || isset($_GET["name"])) {
        $type = $row["type"];
        $name = $row["name"];
    }
}else{
    
    $id = $_POST["id"];
    $type = $_POST["type"];
    $name = $_POST["name"];

    do {
        if(empty($id) || empty($type) || empty($name)) {
            $errorMessage = "All the fields are required";
            break;
        }

        $sql = "UPDATE item SET item_type = '$type', item_name = '$name' WHERE item_id = $id";
        
        $result = $connection->query($sql);
        
        if(!$result){
            $errorMessage = "Invalid query : " . $connection->error;
            break;
        }

        $successMessage = "Item updated successfully";

        header("location: /dbms/Item/index.php");
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
        <h2>Edit Item</h2>
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
                <label class="col-sm-3 col-form-label">Item Type</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="type" value="<?php echo $type; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Item Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
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
                    <a class="btn btn-outline-primary" href="/dbms/Item/index.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>