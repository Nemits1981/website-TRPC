<?php include('config.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Order Information</title>

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


.card-form {
    max-width: 1000px;
}

.card-table {
    max-width: 1000px; 
    width: 100%;
}

h2 {
    margin-top: 0;
    text-align: center;
    color: #333;
}


.form-group {
    margin-bottom: 15px;
}

label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
    color: #555;
}

input[type="text"],
input[type="date"],
input[type="number"],
select {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    transition: border-color 0.3s;
}

input[type="text"]:focus,
input[type="date"]:focus,
input[type="number"]:focus,
select:focus {
    border-color: #28a745;
    outline: none;
}

button {
    width: 30%;
    padding: 10px;
    background-color: #007af4;
    border: none;
    border-radius: 5px;
    color: white;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #218838;
}

/* Table styling */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    border: 1px solid #ddd;
    padding: 8px;
}

th {
    background-color: #0073e6;
    color: white;
}

td {
    color: #555;
}

/* Tombol toggle */
.toggle-button {
    width: auto;
    margin-top: 10px;
    padding: 10px;
    background-color: #007bff;
    border: none;
    border-radius: 5px;
    color: white;
    font-size: 14px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.toggle-button:hover {
    background-color: #0056b3;
}

/* Sembunyikan tabel secara default */
#dataTable {
    display: none;
}
nav ul {
            list-style: none;
            overflow: hidden;
            padding: 0;
            display: flex;
            justify-content: left;
            flex-wrap: wrap;
        }

        nav ul li {
            margin: 0.5rem;
        }

        nav ul li a {
            color: #ffffff;
            text-decoration: none;
            padding: 0.5rem 1rem;
            background-color:#0000d2;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.3s ease;
            white-space: nowrap;
        }

        nav ul li a:hover {
            background-color: #0000ff; 
            transform: scale(1.1);
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
     
    <div class="card card-table">
        <h2>Table Order

        </h2>
        <nav>
        <ul>
            <li><a href="index.php">Back To Home</a></li>
         
          
        </ul>
    </nav>
        <button id="toggleButton" onclick="toggleTable()">Show Table Order </button>
        
        <div id="dataTable">
            <?php

            $query = "SELECT * FROM tablepi";
            $result = mysqli_query($conn, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                echo '<table>';
                echo '<tr><th>No.</th><th>Customer</th><th>Pi Number</th><th>Product Name</th><th>Total Order</th><th>Deadline</th><th>Status</th></tr>';

                $no = 1; 
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $no++ . '</td>'; 
                    echo '<td>' . $row['customer'] . '</td>';
                    echo '<td>' . $row['pi_number'] . '</td>';
                    echo '<td>' . $row['product_name'] . '</td>';
                    echo '<td>' . $row['total_order'] . '</td>';
                    echo '<td>' . $row['deadline'] . '</td>';
                    echo '<td>' . $row['status'] . '</td>';
                    echo '</tr>';
                }

                echo '</table>';
            } else {
                echo '<p>No data found in tablepi.</p>';
            }
            ?>
        </div>

    <div class="card card-form">
        <h2>Form Input Order</h2>
        <form action="insert_order.php" method="POST">
            <div class="form-group">
                <label for="customer">Customer:</label>
                <input type="text" id="customer" name="customer" required>
            </div>

            <div class="form-group">
                <label for="piNumber">Pi Number:</label>
                <input type="text" id="piNumber" name="pi_number" required>
            </div>

            <div class="form-group">
                <label for="productName">Product Name:</label>
                <input type="text" id="productName" name="product_name" required>
            </div>

            <div class="form-group">
                <label for="totalOrder">Total Order:</label>
                <input type="number" id="totalOrder" name="total_order" required>
            </div>

            <div class="form-group">
                <label for="deadline">Deadline:</label>
                <input type="date" id="deadline" name="deadline" required>
            </div>

            <div class="form-group">
                <label for="status">Status:</label>
                <select id="status" name="status">
                    <option value="On Process">On Process</option>
                    <option value="Completed">Completed</option>
                    <option value="Pending">Pending</option>
                </select>
            </div>

            <button type="submit" class="btn">Add to Server</button>
        </form>
    </div>

    </div>

</body>
</html>
