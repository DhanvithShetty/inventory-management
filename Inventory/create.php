<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "inventory_management";

$connection = new mysqli($servername,$username,$password,$database);

$inv_id = "";
$item_id = "";
$condition = "";

$errorMessage = "";
$successMessage = "";

if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    
    $inv_id = $_POST['inv_id'];
    $item_id = $_POST['item_id'];
    $condition = $_POST['condition'];

    do{
        if(empty($item_id) || empty($condition) || empty($inv_id)) {
            $errorMessage = "All the fields are required";
            break;
        }

        //Insert new item into the database
        $sql = "INSERT INTO `inventory` (`inv_id`, `item_id`, `condition`) VALUES ('$inv_id', '$item_id', '$condition')";
        $result = $connection->query($sql);

        if(!$result){
            $errorMessage = "Invalid Query : " . $connection->error;
            break;
        }


        $item_id = "";
        $inv_id = "";
        $condition = "";

        $successMessage = "Inventory Item added successfully";

        header("location: /dbms/Inventory/index.php");
        exit;

    }while(false);
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
        <h2>Add Inventory Item</h2>
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
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Inventory ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="inv_id" value="<?php echo $inv_id; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Item ID</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="item_id" value="<?php echo $item_id; ?>">
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