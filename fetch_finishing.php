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

// Query to fetch finishing data
$sql = "SELECT no, pi_number, man_power, brand, result, date, status FROM tablefinishing";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Pi number</th>
                    <th>Man Power</th>
                    <th>Brand</th>
                    <th>Result</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>';
    while($row = $result->fetch_assoc()) {
        $resultFormatted = formatCurrency($row['result']);
        echo '<tr>
                <td>'.$row["no"].'</td>
                <td>'.$row["pi_number"].'</td>
                <td>'.$row["man_power"].'</td>
                <td>'.$row["brand"].'</td>
                <td>'.$row["result"].'</td>
                <td>'.$row["date"].'</td>
                <td>'.$row["status"].'</td>
              </tr>';
    }
    echo '</tbody></table>';
} else {
    echo "No finishing records found.";
}

$conn->close();
?>
