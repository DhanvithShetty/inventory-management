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
        <h2 class="text-center my-5"><u>Orders Table</u></h2>
        <a class="btn btn-primary mb-5" href="create.php" role="button">Add Order</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Item ID</th>
                    <th>Quantity</th>
                    <th>Date Of Purchase</th>
                    <th>Date of Arrival</th>
                    <th>Price Per Unit</th>
                    <th>Vendor Name</th>
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

                    $sql = "SELECT * FROM `orders`";
                    $result = $connection->query($sql);

                    if(!$result) {
                        die("Invalid query : " . $connection->error);
                    }

                while ($row = $result->fetch_assoc()) {
                    echo "
                        <tr>
                            <td>$row[order_id]</td>
                            <td>$row[item_id]</td>
                            <td>$row[quantity]</td>
                            <td>$row[date_of_purchase]</td>
                            <td>$row[date_of_arrival]</td>
                            <td>$row[price_per_unit]</td>
                            <td>$row[vendor_name]</td>
                            <td>
                                <a class='btn btn-primary btn-sm' href='/dbms/Orders/edit.php?id=$row[order_id]'>Edit</a>
                                <a class='btn btn-danger btn-sm' href='/dbms/Orders/delete.php?id=$row[order_id]'>Delete</a>
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