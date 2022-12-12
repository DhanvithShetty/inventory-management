<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "inventory_management";

$connection = new mysqli($servername,$username,$password,$database);

$name = "";
$brand = "";
$price = "";

$errorMessage = "";
$successMessage = "";

if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
    $name = $_POST['name'];
    $brand = $_POST['brand'];
    $price = $_POST['price'];

    do{
        if(empty($name) || empty($brand) || empty($price)) {
            $errorMessage = "All the fields are required";
            break;
        }

        //Insert new item into the database
        $sql = "INSERT INTO item (item_name, brand, price) VALUES ('$name', '$brand','$price')";
        $result = $connection->query($sql);

        if(!$result){
            $errorMessage = "Invalid Query : " . $connection->error;
            break;
        }


        $name = "";
        $brand = "";
        $price = "";

        $successMessage = "Item added successfully";

        header("location: /dbms/Item/index.php");
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
<body>
    <div class="container my-5">
        <h2>Add Item</h2>
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
                <label class="col-sm-3 col-form-label">Item Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Brand</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="brand" value="<?php echo $brand; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Price</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="price" value="<?php echo $price; ?>">
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