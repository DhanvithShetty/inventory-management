<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
</head>
<body style = "background: linear-gradient(40deg, #a1ffce, #faffd1)">
    <button class="btn btn-primary" onclick="location.href='../home.php'">Back</button>
    <div class = "container my-5">
        <h2 class="text-center my-5"><u>Inventory Table</u></h2>
        <a class="btn btn-primary mb-5" href="create.php" role="button">Add Item</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Serial No.</th>
                    <th>Inventory ID</th>
                    <th>Item ID</th>
                    <th>Item Type</th>
                    <th>Item Name</th>
                    <th>Condition</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $database = "inventory_management";

                    $connection = new mysqli($servername,$username,$password,$database);

                    if($connection->connect_error) {
                        die("Connection failed: ". $connection->connect_error);
                    }

                    $sql = "SELECT * FROM `inventory`,`item` where inventory.item_id = item.item_id";
                    $result = $connection->query($sql);

                    if(!$result) {
                        die("Invalid query : " . $connection->error);
                    }

                while ($row = $result->fetch_assoc()) {
                    echo "
                        <tr>
                            <td>$row[sno]</td>
                            <td>$row[inv_id]</td>
                            <td>$row[item_id]</td>
                            <td>$row[item_type]</td>
                            <td>$row[item_name]</td>
                            <td>$row[condition]</td>
                            <td>
                                <a class='btn btn-primary btn-sm' href='/dbms/Inventory/edit.php?id=$row[sno]'>Edit</a>
                                <a class='btn btn-danger btn-sm' href='/dbms/Inventory/delete.php?id=$row[sno]'>Delete</a>
                            </td>
                        </tr>
                        ";
                    }
                    ?> 
            </tbody>
        </table>
    </div>
</body>
</html>