<?php
include 'koneksi.php';
$sql = "SELECT NO, PAPER_TYPE, QTY, UNIT FROM data_kertas";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data kertas Jumbo Roll</title>
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
    <h1>DATA KERTAS JUMBO ROLL</h1>
    <h2>Update: </h2>
    <div id="countbox" class="countbox">
        TOTAL QTY: 0
    </div>

    <nav>
        <ul>
            <li><a href="index.php">Back To Home</a></li>
          
          
    </nav>
    <div class="filter-container"> 
        <input type="text" id="filter-paper-type" class="filter-input" placeholder=" Insert Paper Type">
        <select id="filter-qty">
            <option value=""> Sort Qty</option>
            <option value="asc"> A to Z</option>
            <option value="desc"> Z to A</option>
        </select>
        <button id="reset-filters" class="reset-button">Reset</button>
    </div>

    <!-- Tabel data -->
    <table>
        <thead>
            <tr>
                <th>NO</th>
                <th>PAPER TYPE</th>
                <th>QTY</th>
                <th>UNIT</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $no = 1;  // Inisialisasi nomor urut
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $formatted_qty = number_format($row['QTY'], 0, ',', '.');
                    echo "<tr>
                        <td class='no-column'>{$no}</td>
                        <td>{$row['PAPER_TYPE']}</td>
                        <td data-raw-qty='{$row['QTY']}'>{$formatted_qty}</td>
                        <td>{$row['UNIT']}</td>
                    </tr>";
                    $no++;
                }
            } else {
                echo "<tr><td colspan='4'>Tidak ada data</td></tr>";
            }
        ?>
        </tbody>
    </table>

    <!-- Tutup koneksi ke database -->
    <?php $conn->close(); ?>

    <script>
        // Fungsi untuk update total Qty di countbox
        function updateCountbox() {
            let totalQty = 0;
            document.querySelectorAll('tbody tr').forEach(row => {
                let qtyCell = row.querySelector('td:nth-child(3)');
                if (row.style.display !== 'none') {
                    let qtyValue = qtyCell.textContent.trim();
                    qtyValue = qtyValue.replace(/\./g, ''); 
                    totalQty += parseInt(qtyValue) || 0; 
                }
            });
            document.getElementById('countbox').textContent = 'Total Qty: ' + totalQty.toLocaleString('id-ID');
        }

        // Memuat nilai dropdown dari data PHP
        window.addEventListener('DOMContentLoaded', function() {
            // Panggil fungsi untuk menghitung total Qty
            updateCountbox();
        });

        // Fungsi untuk mengupdate nomor urut baris
        function updateRowNumbers() {
            let visibleRows = document.querySelectorAll('tbody tr:not([style*="display: none"])'); 
            visibleRows.forEach((row, index) => {
                row.querySelector('.no-column').textContent = index + 1;
            });
        }

        // Fungsi filter tabel berdasarkan paper type dan sortir Qty
        function filterTable() {
            let paperTypeFilter = document.getElementById('filter-paper-type').value.toLowerCase();
            let qtySort = document.getElementById('filter-qty').value;
            let rows = Array.from(document.querySelectorAll('tbody tr'));

            // Filter baris berdasarkan paper type
            rows.forEach(row => {
                let paperTypeCell = row.querySelector('td:nth-child(2)');
                let paperTypeMatch = !paperTypeFilter || (paperTypeCell && paperTypeCell.textContent.toLowerCase().includes(paperTypeFilter));
                
                // Tampilkan baris hanya jika sesuai filter
                if (paperTypeMatch) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });

            // Jika ada pilihan sortir Qty
            if (qtySort) {
                rows.sort((a, b) => {
                    let qtyA = parseInt(a.querySelector('td:nth-child(3)').getAttribute('data-raw-qty')) || 0;
                    let qtyB = parseInt(b.querySelector('td:nth-child(3)').getAttribute('data-raw-qty')) || 0;

                    return qtySort === 'asc' ? qtyA - qtyB : qtyB - qtyA;
                });

                // Setelah di-sort, update urutan baris di tabel
                let tbody = document.querySelector('tbody');
                rows.forEach(row => {
                    tbody.appendChild(row); // Re-append the row to reorder
                });
            }

            // Perbarui nomor urut setelah filter
            updateRowNumbers();
            updateCountbox();
        }

        // Fungsi untuk reset filter
        function resetFilters() {
            document.getElementById('filter-paper-type').value = '';
            document.getElementById('filter-qty').value = '';
            filterTable(); 
        }

        // Event listener untuk filter
        document.getElementById('filter-paper-type').addEventListener('input', filterTable);
        document.getElementById('filter-qty').addEventListener('change', filterTable);
        document.getElementById('reset-filters').addEventListener('click', resetFilters);
        document.addEventListener('DOMContentLoaded', function() {
        let noColumn = document.querySelectorAll('th.no-column, td.no-column');
        noColumn.forEach(cell => {
            cell.style.width = '40px'; 
        });
    });

    </script>
</body>
</html>