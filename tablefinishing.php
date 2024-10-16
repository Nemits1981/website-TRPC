<?php include('config.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finishing Results</title>
  <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        table {
            margin-top: 10px;
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px 15px;
            text-align: center;
        }

        th {
            background-color: #4CAF50;
            color: white;
            text-transform: uppercase;
            font-size: 14px;
        }

        td {
            border-bottom: 1px solid #dddddd;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .status {
            padding: 5px 10px;
            border-radius: 5px;
            color: white;
        }

        .prosess {
            background-color: #FFA500; 
        }

        .success {
            background-color: #4CAF50; 
        }

        .pending {
            background-color: #FF6347; 
        }

        td, th {
            text-align: center;
            font-size: 13px;
        }

        @media (max-width: 768px) {
            table {
                font-size: 12px;
            }

            th, td {
                padding: 8px 10px;
            }
        }
        nav {
    text-align: left;
    margin-top: 20px;
}

nav ul {
    list-style: none;
    padding: 0;
}

nav ul li {
    display: inline; 
}

nav ul li a {
    text-decoration: none;
    padding: 10px 20px;
    background-color: #4CAF50; 
    color: white; 
    font-weight: bold;
    border-radius: 5px;
    transition: background-color 0.3s ease; 
}

nav ul li a:hover {
    background-color: #45a049;
}

nav ul li a:active {
    background-color: #3e8e41; 
}
  </style>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body>

<h2>Table Data</h2>
<nav>
<ul>
            <li><a href="index.php">Back To Home</a></li> 
        </ul>
    </nav>
<table>
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
    <tbody>
    <?php
    $sql = "SELECT * FROM tablefinishing"; 
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $no = 1;
        while($row = $result->fetch_assoc()) {
            $statusClass = '';
            if ($row['status'] == 'On Process') {
                $statusClass = 'prosess';
            } elseif ($row['status'] == 'Completed') {
                $statusClass = 'success';
            } elseif ($row['status'] == 'Pending') {
                $statusClass = 'pending';
            }

            echo "<tr>
                    <td>" . $no++ . "</td>
                    <td>" . $row['pi_number'] . "</td>
                    <td>" . $row['man_power'] . "</td>
                    <td>" . $row['brand'] . "</td>
                    <td>" . $row['result'] . "</td>
                    <td>" . $row['date'] . "</td>
                    <td><span class='status " . $statusClass . "'>" . $row['status'] . "</span></td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No data available</td></tr>";
    }
    ?>
    </tbody>
</table>

</body>
</html>
