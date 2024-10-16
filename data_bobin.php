<?php
include 'koneksi.php';

$sql_bobin = "SELECT NO, PAPER_TYPE, WATERMARK,  WIDTH, LENGTH, QTY, UNIT FROM data_bobin";
$result_bobin = $conn->query($sql_bobin);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Bobin</title>
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
    margin-bottom: 5px; 
}
h2 {
    
    color: #e0e0e0;
    font-size: 20px;
    padding: 5px;
    text-align: left;
    margin-bottom: 5px; 
}
.filter-box {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-bottom: 10px;
}

.filter-input[type="text"] {
    padding: 5px 10px;
    width: 100%;
    max-width: 200px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 14px;
    margin-top: 5px;
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
    margin: 20px 0;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    border: 1px solid #ddd; 
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
        .back-button {
    display: inline-block;
    background-color: #ff8000;
    color: white;
    text-decoration: none;
    padding: 6px 15px;
    border-radius: 4px;
    font-size: 16px;
    transition: background-color 0.3s ease;
    margin-top: -30px;
}
     

.logout-button:hover {
    background-color: #B22222;
}
.countbox {
    margin-top: -40px;
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
        .reset-button {
            cursor: pointer; 
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

<h1>DATA BOBIN</h1>

<h2>Status : Prosess Validasi data</h2>
<div id="countbox" class="countbox">
    TOTAL QTY: 0
</div>
<nav>
        <ul>
            <li><a href="index.php">Back To Home</a></li>
        
          
        </ul>
    </nav>
<div class="filter-container"> 
    <!-- Filter Paper Type menggunakan input teks -->
    <input type="text" id="filter-paper-type" class="filter-input" placeholder="Insert paper type">

    <!-- Dropdown untuk Watermark -->
    <label for="filter-watermark"></label>
    <select id="filter-watermark">
        <option value="">Choose Watermark</option>
    </select>

    <!-- Dropdown untuk Width -->
    <label for="filter-width"></label>
    <select id="filter-width">
        <option value="">Choose Width</option>
    </select>

    <button id="reset-filters" class="reset-button">Reset</button>
</div>

<table>
    <thead>
        <tr>
            <th>NO</th>
            <th>PAPER TYPE</th>
            <th>WATERMARK</th>       
            <th>WIDTH</th>
            <th>LENGTH</th>
            <th>QTY</th>
            <th>UNIT</th>
        </tr>
    </thead>
    <tbody>
    <?php
       $watermarks = [];
       $widths = []; // Array untuk ukuran WIDTH
       $no = 1; // Inisialisasi variabel $no sebelum memasuki loop
       if ($result_bobin->num_rows > 0) {
           while($row = $result_bobin->fetch_assoc()) {
               // Format QTY menggunakan number_format
               $formatted_qty = number_format($row['QTY'], 0, ',', '.');
               echo "<tr>
                   <td class='no-column'>{$no}</td>
                   <td>{$row['PAPER_TYPE']}</td>
                   <td>{$row['WATERMARK']}</td>   
                   <td>{$row['WIDTH']}</td>
                   <td>{$row['LENGTH']}</td>
                   <td data-raw-qty='{$row['QTY']}'>{$formatted_qty}</td>
                   <td>{$row['UNIT']}</td>
               </tr>";
               $no++; // Inkrementasi variabel $no untuk setiap iterasi
   
               // Collect unique watermarks
               if (!in_array($row['WATERMARK'], $watermarks)) {
                   $watermarks[] = $row['WATERMARK'];
               }
   
               // Collect unique widths
               if (!in_array($row['WIDTH'], $widths)) {
                   $widths[] = $row['WIDTH'];
               }
           }
       } else {
           echo "<tr><td colspan='7'>Tidak ada data</td></tr>";
       }
    ?>
    </tbody>
</table>

<?php $conn->close(); ?>

<script>
    function updateCountbox() {
        let totalQty = 0;
        document.querySelectorAll('tbody tr').forEach(row => {
            let qtyCell = row.querySelector('td:nth-child(6)');
            if (row.style.display !== 'none') {
                let qtyValue = qtyCell.textContent.trim();
                qtyValue = qtyValue.replace(/\./g, ''); 
                totalQty += parseInt(qtyValue) || 0; 
            }
        });
        document.getElementById('countbox').textContent = 'Total Qty: ' + totalQty.toLocaleString('id-ID');
    }

    function populateDropdown(id, values) {
        let dropdown = document.getElementById(id);
        if (!dropdown) {
            console.error("Dropdown element not found for id:", id);
            return;
        }
        values.forEach(value => {
            let option = document.createElement('option');
            option.value = value;
            option.textContent = value;
            dropdown.appendChild(option);
        });
    }

    window.addEventListener('DOMContentLoaded', function() {
        let watermarks = <?php echo json_encode($watermarks); ?>;
        let widths = <?php echo json_encode($widths); ?>;

        if (watermarks.length === 0) {
            console.warn("Watermarks array is empty");
        }

        if (widths.length === 0) {
            console.warn("Widths array is empty");
        }

        populateDropdown('filter-watermark', watermarks);
        populateDropdown('filter-width', widths);
        updateCountbox();
    });

    function updateRowNumbers() {
        let visibleRows = document.querySelectorAll('tbody tr:not([style*="display: none"])'); 
        visibleRows.forEach((row, index) => {
            row.querySelector('.no-column').textContent = index + 1; 
        });
    }

    function filterTable() {
        let paperTypeFilter = document.getElementById('filter-paper-type').value.toLowerCase();
        let watermarkFilter = document.getElementById('filter-watermark').value.toLowerCase();
        let widthFilter = document.getElementById('filter-width').value.toLowerCase();

        let rows = Array.from(document.querySelectorAll('tbody tr'));

        rows.forEach(row => {
            let paperTypeCell = row.querySelector('td:nth-child(2)');
            let watermarkCell = row.querySelector('td:nth-child(3)');
            let widthCell = row.querySelector('td:nth-child(4)');

            let paperTypeMatch = !paperTypeFilter || (paperTypeCell && paperTypeCell.textContent.toLowerCase().includes(paperTypeFilter));
            let watermarkMatch = !watermarkFilter || (watermarkCell && watermarkCell.textContent.toLowerCase().includes(watermarkFilter));
            let widthMatch = !widthFilter || (widthCell && widthCell.textContent.toLowerCase().includes(widthFilter));

            if (paperTypeMatch && watermarkMatch && widthMatch) {
                row.style.display = '';  // Tampilkan baris
            } else {
                row.style.display = 'none'; // Sembunyikan baris
            }
        });

        updateRowNumbers();
        updateCountbox();
    }

    function resetFilters() {
        document.getElementById('filter-paper-type').value = '';   
        document.getElementById('filter-watermark').value = '';     
        document.getElementById('filter-width').value = '';         
        filterTable();
    }

    document.getElementById('filter-paper-type').addEventListener('input', filterTable);
    document.getElementById('filter-watermark').addEventListener('change', filterTable);
    document.getElementById('filter-width').addEventListener('change', filterTable); 

    document.getElementById('reset-filters').addEventListener('click', function() {
        console.log('Tombol reset diklik');  
        resetFilters();  
    });
  
    document.addEventListener('DOMContentLoaded', function() {
        let noColumn = document.querySelectorAll('th.no-column, td.no-column');
        noColumn.forEach(cell => {
            cell.style.width = '40px'; 
        });
    });


</script>

</body>
</html>
