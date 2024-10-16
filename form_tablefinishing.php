<?php include('config.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Hasil Produksi Finishing</title>
 
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
       /* Umum untuk semua card */
.card {
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    margin: 20px auto;
}

.card-table {
    max-width: 1000px; 
    width: 100%; 
}

.card-form {
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
select {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
}



        h2 {
            margin-top: 0;
            text-align: center;
            color: #333; /* Changed color */
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555; /* Changed color */
        }
        input[type="text"],
        input[type="date"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s; /* Added transition */
        }
        input[type="text"]:focus,
        input[type="date"]:focus,
        select:focus {
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
            if (table.style.display === "none") {
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

    <!-- Tabel Data di Atas -->
    <div class="card card-table">
        <h2>Table Data</h2>
        <button id="toggleButton" class="toggle-button" onclick="toggleTable()">Show Table Data</button>
        
        <div id="dataTable">
            <?php
            $query = "SELECT * FROM tablefinishing";
            $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                echo '<table>';
                echo '<tr><th>No.</th><th>Pi Number</th><th>Brand</th><th>Type of Product</th><th>Result</th><th>Date</th><th>Status</th></tr>';
                
                $no = 1; // Inisialisasi nomor urut
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $no++ . '</td>'; // Nomor urut
                    echo '<td>' . $row['pi_number'] . '</td>';
                    echo '<td>' . $row['man_power'] . '</td>';
                    echo '<td>' . $row['brand'] . '</td>';
                    echo '<td>' . $row['result'] . '</td>';
                    echo '<td>' . $row['date'] . '</td>';
                    echo '<td>' . $row['status'] . '</td>';
                    echo '</tr>';
                }

                echo '</table>';
            } else {
                echo '<p>No data found in tablefinishing.</p>';
            }
            ?>
        </div>
    </div>

    <!-- Form Input di Bawah -->
    <div class="card card-form">
        <h2>Form Input</h2>
        <form action="insert_finishing.php" method="POST">
            <label for="piNumber">Pi Number:</label>
            <input type="text" id="piNumber" name="pi_number" required>

            <label for="manPower">Brand:</label>
            <input type="text" id="manPower" name="man_power" required>

            <label for="brand">Type of Product:</label>
            <input type="text" id="brand" name="brand" required>

            <label for="result">Result:</label>
            <input type="text" id="result" name="result" required>

            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>

            <label for="status">Status:</label>
            <select id="status" name="status">
                <option value="On Process">On Process</option>
                <option value="Completed">Completed</option>
                <option value="Pending">Pending</option>
            </select>

            <button type="submit">Add to server</button>
        </form>
    </div>

</body>
</html>
