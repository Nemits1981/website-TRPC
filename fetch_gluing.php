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

// Query to fetch data from table_bobin
$sql = "SELECT id, pi_number, brand, jenis_product, size, qty, date, status FROM table_bobin";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pi number</th>
                    <th>Brand</th>
                    <th>Jenis Product</th>
                    <th>Size</th>
                    <th>Qty</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>';
    $no = 1; // Counter untuk kolom "No"
    while($row = $result->fetch_assoc()) {
        echo '<tr>
                <td>'.$no++.'</td>
                <td>'.$row["pi_number"].'</td>
                <td>'.$row["brand"].'</td>
                <td>'.$row["jenis_product"].'</td>
                <td>'.$row["size"].'</td>
                <td>'.$row["qty"].'</td>
                <td>'.$row["date"].'</td>
                <td>'.$row["status"].'</td>
              </tr>';
    }
    echo '</tbody></table>';
} else {
    echo "No records found.";
}

$conn->close();
?>
