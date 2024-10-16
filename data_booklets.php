<?php
include 'koneksi.php';

$sql_booklets = "SELECT NO, PAPER_TYPE, WATERMARK, QTY, SIZE, UNIT FROM data_booklets";
$result_booklets = $conn->query($sql_booklets);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Booklets</title>
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
    margin-top: -50px;
    padding: 10px;
    background-color: #bfbfff;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-weight: bold;
    font-size: 20px;
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
    <h1>DATA BOOKLETS</h1>
 
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
        <input type="text" id="filter-paper-type" class="filter-input" placeholder=" Insert paper type">

        <!-- Dropdown untuk Watermark -->
        <label for="filter-watermark"></label>
        <select id="filter-watermark">
            <option value=""> Choose Watermark</option>
            <!-- Options will be dynamically populated -->
        </select>
        
        <!-- Dropdown untuk Size -->
        <label for="filter-size"></label>
        <select id="filter-size">
            <option value=""> Choose Size</option>
            <!-- Options will be dynamically populated -->
        </select>
        
        <!-- Dropdown untuk Qty (terendah atau tertinggi) -->
        <label for="filter-qty"></label>
        <select id="filter-qty">
            <option value="">  Sort Qty</option>
            <option value="asc"> A to Z</option>
            <option value="desc"> Z to A</option>
        </select>

        <!-- Tombol Reset -->
        <button id="reset-filters" class="reset-button">Reset</button>
    </div>
 

    <table>
        <thead>
            <tr>
                <th>NO</th>
                <th>PAPER TYPE</th>
                <th>WATERMARK</th>
                <th>SIZE</th>
                <th>QTY</th>
                <th>UNIT</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $watermarkOptions = [];
            $sizeOptions = [];
            $no = 1; // Inisialisasi penghitung nomor
            if ($result_booklets->num_rows > 0) {
                while($row = $result_booklets->fetch_assoc()) {
                    // Tambah opsi untuk dropdown
                    if (!in_array($row['WATERMARK'], $watermarkOptions)) {
                        $watermarkOptions[] = $row['WATERMARK'];
                    }
                    if (!in_array($row['SIZE'], $sizeOptions)) {
                        $sizeOptions[] = $row['SIZE'];
                    }
                    
                    // Format QTY menggunakan number_format
                    $formatted_qty = number_format($row['QTY'], 0, ',', '.');
                    echo "<tr>
                        <td class='no-column'>{$no}</td> <!-- Kolom nomor urut -->
                        <td>{$row['PAPER_TYPE']}</td>
                        <td>{$row['WATERMARK']}</td>
                        <td>{$row['SIZE']}</td>
                        <td data-raw-qty='{$row['QTY']}'>{$formatted_qty}</td>
                        <td>{$row['UNIT']}</td>
                    </tr>";
                    $no++; // Tambah nomor urut
                }
            } else {
                echo "<tr><td colspan='6'>Tidak ada data</td></tr>";
            }
        ?>
        </tbody>
    </table>
    
    <?php $conn->close(); ?>

    <script>
        // Fungsi untuk mengupdate dropdown list dengan opsi unik
        function populateDropdowns() {
            let watermarkSelect = document.getElementById('filter-watermark');
            let sizeSelect = document.getElementById('filter-size');
            let watermarkOptions = <?php echo json_encode($watermarkOptions); ?>;
            let sizeOptions = <?php echo json_encode($sizeOptions); ?>;

            // Populate watermark dropdown
            watermarkOptions.forEach(option => {
                let opt = document.createElement('option');
                opt.value = option;
                opt.textContent = option;
                watermarkSelect.appendChild(opt);
            });

            // Populate size dropdown
            sizeOptions.forEach(option => {
                let opt = document.createElement('option');
                opt.value = option;
                opt.textContent = option;
                sizeSelect.appendChild(opt);
            });
        }

        function updateCountbox() {
            let totalQty = 0;
            document.querySelectorAll('tbody tr').forEach(row => {
                let qtyCell = row.querySelector('td:nth-child(5)'); // Kolom qty di tabel
                if (row.style.display !== 'none') {
                    let qtyValue = qtyCell.textContent.trim();
                    qtyValue = qtyValue.replace(/\./g, ''); 
                    totalQty += parseInt(qtyValue) || 0; 
                }
            });
            document.getElementById('countbox').textContent = 'Total Qty: ' + totalQty.toLocaleString('id-ID');
        }

        function updateRowNumbers() {
            let visibleRows = document.querySelectorAll('tbody tr:not([style*="display: none"])'); // Baris yang terlihat
            visibleRows.forEach((row, index) => {
                row.querySelector('.no-column').textContent = index + 1; // Update nomor urut
            });
        }

        function filterTable() {
            let paperTypeFilter = document.getElementById('filter-paper-type').value.toLowerCase();
            let watermarkFilter = document.getElementById('filter-watermark').value.toLowerCase();
            let sizeFilter = document.getElementById('filter-size').value.toLowerCase();
            let qtySort = document.getElementById('filter-qty').value;

            let rows = Array.from(document.querySelectorAll('tbody tr'));

            // Filter berdasarkan Paper Type, Watermark, dan Size
            rows.forEach(row => {
                let paperTypeCell = row.querySelector('td:nth-child(2)');
                let watermarkCell = row.querySelector('td:nth-child(3)');
                let sizeCell = row.querySelector('td:nth-child(4)');

                let paperTypeMatch = !paperTypeFilter || (paperTypeCell && paperTypeCell.textContent.toLowerCase().includes(paperTypeFilter));
                let watermarkMatch = !watermarkFilter || (watermarkCell && watermarkCell.textContent.toLowerCase() === watermarkFilter);
                let sizeMatch = !sizeFilter || (sizeCell && sizeCell.textContent.toLowerCase() === sizeFilter);

                if (paperTypeMatch && watermarkMatch && sizeMatch) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });

            // Sortir berdasarkan Qty
            if (qtySort) {
                rows.sort((a, b) => {
                    let qtyA = parseInt(a.querySelector('td:nth-child(5)').getAttribute('data-raw-qty'));
                    let qtyB = parseInt(b.querySelector('td:nth-child(5)').getAttribute('data-raw-qty'));

                    return qtySort === 'asc' ? qtyA - qtyB : qtyB - qtyA;
                });

                // Setelah di-sort, update urutan baris di tabel
                let tbody = document.querySelector('tbody');
                rows.forEach(row => {
                    tbody.appendChild(row); // Re-append untuk mengubah urutan
                });
            }

            // Perbarui nomor urut setelah filter dan sortir
            updateRowNumbers();
            updateCountbox();
        }

        // Fungsi untuk mereset semua filter
        function resetFilters() {
            document.getElementById('filter-paper-type').value = '';
            document.getElementById('filter-watermark').value = '';
            document.getElementById('filter-size').value = '';
            document.getElementById('filter-qty').value = '';

            filterTable(); // Terapkan filter setelah reset
        }

        // Event listener untuk filter, dropdown, dan tombol reset
        document.getElementById('filter-paper-type').addEventListener('input', filterTable);
        document.getElementById('filter-watermark').addEventListener('change', filterTable);
        document.getElementById('filter-size').addEventListener('change', filterTable);
        document.getElementById('filter-qty').addEventListener('change', filterTable);
        document.getElementById('reset-filters').addEventListener('click', resetFilters);

        // Panggil fungsi ini ketika halaman dimuat
        window.addEventListener('DOMContentLoaded', function() {
            populateDropdowns();
            updateCountbox();
        });
    </script>
</body>



</html>
