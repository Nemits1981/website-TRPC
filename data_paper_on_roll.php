<?php
include 'koneksi.php';

$sql_paper_on_roll = "SELECT NO, PAPER_TYPE, WATERMARK, QTY, UNIT FROM data_paper_on_roll";
$result_paper_on_roll = $conn->query($sql_paper_on_roll);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Paper On Roll</title>
    <style>
    body{
        font-family: Arial, sans-serif;
        background-color:#282828;
        background-position: center;
        background-repeat: repeat;
     }
     h1 {
  
    color: #e0e0e0;
    font-size: 24px;
    padding: 10px;
    text-align: center;
    margin-bottom: 20px; 
}
h2 {
    
    color: #e0e0e0;
    font-size: 20px;
    padding: 5px;
    text-align: left;
    margin-bottom: 15px; 
}
.filter-box {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-bottom: 10px;
}

.filter-input[type="text"] {
    padding: 5px 0;
    width: 100%;
    max-width: 200px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
}
select {
    padding: 5px 20px;
    width: 100%;
    max-width: 200px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
    margin-top: 5px;
}

.reset-button {
    padding: 8px 15px;
    border: none; 
    border-radius: 5px; 
    background-color: #dc3545;
    color: #fff; 
    font-size: 14px; 
    font-weight: bold; 
    cursor: pointer; 
    transition: background-color 0.3s, box-shadow 0.3s; 
    outline: none;
}

.reset-button:hover {
    background-color: #c82333; 
}

.reset-button:focus {
    box-shadow: 0 0 0 2px rgba(220, 53, 69, 0.5); 
}

table {
    width: 100%;
    border-collapse: collapse;
    margin: 0px;
}

thead th {
    background-color: #008000;
    color: white;
    padding: 10px;
    text-align: left;
    font-weight: bold;
    border: 1px solid #ddd; 
}

tbody tr {
    border-bottom: 1px solid #ddd; 
}

td, th {
    padding: 10px;
    text-align: left;
    border: 1px solid #ddd;
}


tbody tr:nth-child(odd) {
    background-color: #f9f9f9;
}

tbody tr:nth-child(even) {
    background-color: #ffffff;
}

tbody tr:hover {
    background-color: #f1f1f1;
}

table:empty {
    text-align: center;
    color: #888;
}

tbody tr:nth-child(odd) {
    background-color: #f9f9f9;
}

tbody tr:nth-child(even) {
    background-color: #ffffff;
}

tbody tr:hover {
    background-color: #f1f1f1;
}

table:empty {
    text-align: center;
    color: #888;
}

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        thead th {
            background-color: #007bff;
            color: white;
            padding: 10px;
            text-align: left;
            font-weight: bold;
        }

        tbody tr {
            border-bottom: 1px solid #ddd;
        }

        td, th {
            padding: 10px;
            text-align: left;
        }

        tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        tbody tr:nth-child(even) {
            background-color: #ffffff;
        }

        tbody tr:hover {
            background-color: #f1f1f1;
        }

        table:empty {
            text-align: center;
            color: #888;
        }

.countbox {
    margin-top: -30px;
    padding: 10px;
    background-color: #bfbfff;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-weight: bold;
    font-size: 18px;
    text-align: center;
    width: 200px;
    margin-left: auto;
    margin-right: auto;
    color: #333;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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
</head>
<body>
    <h1>DATA PAPER ON ROLL</h1>
    <h2>status : Data belum lengkap </h2>
    <div id="countbox" class="countbox">
        TOTAL QTY: 0
    </div>
    <nav>
        <ul>
            <li><a href="index.php">Back To Home</a></li>
            
          
    </nav>
    <div class="filter-container"> 
        <input type="text" id="filter-paper-type" class="filter-input" placeholder=" Insert paper type">
        <select id="filter-watermark" class="filter-select">
            <option value=""> Choose Watermark</option>
            <!-- Options will be dynamically populated -->
        </select>
        <select id="filter-qty" class="filter-select">
            <option value="">  Sort Qty</option>
            <option value="asc"> A to Z</option>
            <option value="desc"> Z to A</option>
        </select>
        <button id="reset-filters" class="reset-button">Reset</button>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>NO</th>
                <th>PAPER TYPE</th>
                <th>WATERMARK</th>
                <th>QTY</th>
                <th>UNIT</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result_paper_on_roll->num_rows > 0) {
                while($row = $result_paper_on_roll->fetch_assoc()) {
                    // Format QTY menggunakan number_format
                    $formatted_qty = number_format($row['QTY'], 0, ',', '.');
                    echo "<tr>
                        <td>{$row['NO']}</td>
                        <td>{$row['PAPER_TYPE']}</td>
                        <td>{$row['WATERMARK']}</td>
                        <td>{$formatted_qty}</td>
                        <td>{$row['UNIT']}</td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Tidak ada data</td></tr>";
            }
            ?>
        </tbody>
    </table>
    
    <?php $conn->close(); ?>
    
    <script>
        function updateCountbox() {
            let totalQty = 0;

            document.querySelectorAll('tbody tr').forEach(row => {
                let qtyCell = row.querySelector('td:nth-child(4)');
                
                if (row.style.display !== 'none') {
                    let qtyValue = qtyCell.textContent.trim();
                    qtyValue = qtyValue.replace(/\./g, ''); 
                    totalQty += parseInt(qtyValue) || 0;
                }
            });

            document.getElementById('countbox').textContent = 'TOTAL QTY: ' + totalQty.toLocaleString('id-ID');
        }

        function filterTable() {
            let paperTypeFilter = document.getElementById('filter-paper-type').value.toLowerCase();
            let watermarkFilter = document.getElementById('filter-watermark').value.toLowerCase();
            let qtySort = document.getElementById('filter-qty').value;

            document.querySelectorAll('tbody tr').forEach(row => {
                let paperTypeCell = row.querySelector('td:nth-child(2)');
                let watermarkCell = row.querySelector('td:nth-child(3)');
                
                let paperTypeMatch = paperTypeCell && paperTypeCell.textContent.toLowerCase().includes(paperTypeFilter);
                let watermarkMatch = watermarkCell && watermarkCell.textContent.toLowerCase().includes(watermarkFilter);

                if (paperTypeMatch && watermarkMatch) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });

            // Sort based on qty if sorting is selected
            if (qtySort) {
                let rows = Array.from(document.querySelectorAll('tbody tr'));
                rows.sort((a, b) => {
                    let qtyA = parseInt(a.querySelector('td:nth-child(4)').textContent.replace(/\./g, '')) || 0;
                    let qtyB = parseInt(b.querySelector('td:nth-child(4)').textContent.replace(/\./g, '')) || 0;
                    return qtySort === 'asc' ? qtyA - qtyB : qtyB - qtyA;
                });
                let tbody = document.querySelector('tbody');
                tbody.innerHTML = '';
                rows.forEach(row => tbody.appendChild(row));
            }

            // Update countbox
            updateCountbox();
        }

        function populateDropdowns() {
            let watermarkSelect = document.getElementById('filter-watermark');
            let watermarks = new Set();

            document.querySelectorAll('tbody tr').forEach(row => {
                let watermarkCell = row.querySelector('td:nth-child(3)');
                if (watermarkCell) {
                    watermarks.add(watermarkCell.textContent.trim());
                }
            });

            watermarks.forEach(watermark => {
                let option = document.createElement('option');
                option.value = watermark.toLowerCase();
                option.textContent = watermark;
                watermarkSelect.appendChild(option);
            });
        }

        function resetFilters() {
            document.getElementById('filter-paper-type').value = '';
            document.getElementById('filter-watermark').value = '';
            document.getElementById('filter-qty').value = '';
            filterTable();
        }

        document.querySelectorAll('.filter-input, .filter-select').forEach(input => {
            input.addEventListener('input', filterTable);
        });

        document.getElementById('reset-filters').addEventListener('click', resetFilters);

        // Panggil fungsi ini ketika halaman dimuat
        window.addEventListener('DOMContentLoaded', function() {
            populateDropdowns();
            filterTable();
        });
    </script>
</body>



</html>
