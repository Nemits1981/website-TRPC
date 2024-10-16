<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "data_prosesdanpi"; 

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch order data
$sql = "SELECT no, customer, pi_number, product_name, total_order, deadline, status FROM tablepi"; 
$result = $conn->query($sql); // Execute the query

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Data</title>
    <style>
        /* Card styles */
        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            max-width: 800px; 
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<div class="card">
    <h2>Table PI</h2>
    <?php
    if ($result->num_rows > 0) {
        echo '<table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Customer</th>
                        <th>Pi Number</th>
                        <th>Product Name</th>
                        <th>Total Order</th>
                        <th>Deadline</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>';
        while ($row = $result->fetch_assoc()) {
            $totalorderFormatted = formatCurrency($row['total_order']); 
            echo '<tr>
                    <td>'.$row["no"].'</td>
                    <td>'.$row["customer"].'</td>
                    <td>'.$row["pi_number"].'</td>
                    <td>'.$row["product_name"].'</td>
                    <td>'.$totalorderFormatted.'</td>
                    <td>'.$row["deadline"].'</td>
                    <td>'.$row["status"].'</td>
                  </tr>';
        }
        echo '</tbody></table>';
    } else {
        echo "No orders found.";
    }
    ?>
</div>

</body>
</html>

<?php
$conn->close();
?>
