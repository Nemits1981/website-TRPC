<?php
// Termasuk file konfigurasi untuk koneksi database
include 'config.php';

// Lakukan query untuk mengambil data dari table_bobin
$sql = "SELECT id, pi_number, brand, jenis_product, size, qty, date, status FROM table_bobind";
$resultbobind = $conn->query($sql);

// Cek apakah query berhasil
if (!$resultbobind) {
    die("Error in query: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Gluing</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        
        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
        }
        
        .card-table, .card-form {
            max-width: 1000px; 
            width: 100%; 
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        /* Form input */
        input[type="text"],
        input[type="date"],
        select,
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s; /* Added transition */
        }

        input:focus {
            border-color: #28a745; /* Highlight border on focus */
            outline: none; /* Remove default outline */
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745; 
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s; /* Added transition */
        }

        button:hover {
            background-color: #218838; 
        }

        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background-color: #0073e6;
            color: #ffffff;
        }

        td {
            color: #555;
        }

        #dataTable {
            display: none; 
        }

        .toggle-button {
            margin-top: 10px;
            padding: 10px;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s; /* Added transition */
            width: auto; /* Auto width for toggle button */
        }

        .toggle-button:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }
    </style>
    <script>
        function toggleTable() {
            var table = document.getElementById('dataTable');
            var toggleButton = document.getElementById('toggleButton');
            if (table.style.display === "none" || table.style.display === "") {
                table.style.display = "block";
                toggleButton.innerHTML = "Hide Table Data"; 
            } else {
                table.style.display = "none"; 
                toggleButton.innerHTML = "Show Table Data"; 
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <section class="transactions">
            <h2>Table Data Gluing</h2>
            <button id="toggleButton" class="toggle-button" onclick="toggleTable()">Show Table Data</button>
            <div id="dataTable">
                <?php 
                if ($resultbobind->num_rows > 0) {
                    echo "<table>
                            <tr>
                                <th>No</th>
                                <th>Pi Number</th>
                                <th>Brand</th>
                                <th>Jenis Product</th>
                                <th>Size</th>
                                <th>Qty Bobin</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>";
                    $no = 1;
                    while ($row = $resultbobind->fetch_assoc()) {
                        echo "<tr>
                                <td>" . $no++ . "</td>
                                <td>" . htmlspecialchars($row['pi_number']) . "</td>
                                <td>" . htmlspecialchars($row['brand']) . "</td>
                                <td>" . htmlspecialchars($row['jenis_product']) . "</td>
                                <td>" . htmlspecialchars($row['size']) . "</td>
                                <td>" . htmlspecialchars($row['qty']) . "</td>
                                <td>" . htmlspecialchars($row['date']) . "</td>
                                <td>" . htmlspecialchars($row['status']) . "</td>
                              </tr>";
                    }
                    echo "</table>";
                } else {
                    echo "No data found.";
                }
                ?>
            </div>
        </section>

        <section class="form-section">
            <h2>Form Input Gluing</h2>
            <form action="insert_gluing.php" method="post">
                <label for="pi_number">Pi Number:</label>
                <input type="text" id="pi_number" name="pi_number" required>

                <label for="brand">Brand:</label>
                <input type="text" id="brand" name="brand" required>

                <label for="jenis_product">Jenis Product:</label>
                <input type="text" id="jenis_product" name="jenis_product" required>

                <label for="size">Size:</label>
                <input type="text" id="size" name="size" required>

                <label for="qty">Qty:</label>
                <input type="number" id="qty" name="qty" required>

                <label for="date">Date:</label>
                <input type="date" id="date" name="date" required>

                <label for="status">Status:</label>
                <input type="text" id="status" name="status" required>

                <input type="submit" value="Submit">
            </form>
        </section>
    </div>

    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom@1.0.0"></script>
</body>
</html>

<?php
// Tutup koneksi
$conn->close();
?>
