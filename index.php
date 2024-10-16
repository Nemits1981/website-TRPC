<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard web Produksi</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
    display: flex;
    min-height: 100vh;
    background-color: #f4f4f4;
    padding: 0px;
}
h1 {
    color: black;
    padding: 20px;
    border-radius: 5px;
    text-align: center;
    margin-bottom: 20px;

}
h2 {
    color: black;
    padding: 10px;
    text-align: center;
    margin-bottom: 10px;

}
p {
    margin-left: 30px;
}
h3 {
    color: white;
    padding: 10px;
    text-align: center;
    margin-bottom: 10px;

}
        .sidebar {
    width: 250px;
    background-color: #000066;
    color: white;
    display: flex;
    flex-direction: column;
    padding: 20px;
}
.chart-section, .chart-grid {
    margin-bottom: 20px;
    margin-left: 20px;
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
}

.chart-card {
    overflow-x: auto;
    width: 100%;
    max-width: 100%;
    height: 400px;
    padding: 10px;
}

canvas {
    width: 1000px;
    height: 400px;
}


#otherChart {
    display: block;
    margin: 0 auto;
    max-width: 1300px;
}
        .status {
    padding: 5px;
    border-radius: 4px;
    color: white;
}


.status.process {
    background-color: orange;
}

.status.completed {
    background-color: green; 
}

.status.pending {
    background-color: red; 
}
.nav-btn {
            display: block;
            padding: 10px 15px;
            margin: 12px 0;
            background-color: #d4d4d4;
            color: #333;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
            font-weight: bold;
        }

        .nav-btn:hover {
            background-color: #8080ff;
            color: white;
        }

        td:hover {
            background-color: #c6ffc6;
}
.text-below-barcode {
    max-height: 200px; /* Sesuaikan tinggi maksimum */
    overflow-y: auto;  /* Aktifkan scroll secara vertikal */
    padding: 10px;
}


    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h3 class="sidebar-logo">HOME </h3>

        <nav>
    <ul>
        <li><a href="index.php" class="nav-btn" id="dashboardBtn"><span>📊</span> Dashboard</a></li>
        <li><a href="data_kertas.php" class="nav-btn" id="analyticsBtn"><span>📊</span> Data Kertas Jumbo Rolls</a></li>
        <li><a href="data_bobin.php" class="nav-btn" id="projectsBtn"><span>📊</span> Data Bobin</a></li>
        <li><a href="data_booklets.php" class="nav-btn" id="reportsBtn"><span>📊</span> Data Booklets</a></li>
        <li><a href="data_paper_on_roll.php" class="nav-btn" id="settingsBtn"><span>📊</span> Data Paper On Rolls</a></li>
        <li><a href="data_printedpaper.php" class="nav-btn" id="messagesBtn"><span>📊</span> Data Printed Papers</a></li>
        <li><a href="data_flwl.php" class="nav-btn" id="logoutBtn"><span>📊</span> Data First Leaves Dan Warning Leaves</a></li>
        <li><a href="tablepi.php" class="nav-btn" id="tablepiBtn"><span>📊</span> Table Data Order</a></li> <!-- New Button for Table PI -->
        <li><a href="tablefinishing.php" class="nav-btn" id="tablefinishingBtn"><span>📊</span> Table Proses Finishing</a></li> <!-- New Button for Table Finishing -->
        <li><a href="form_order.php" class="nav-btn" id="orderBtn"><span>📊</span> Form Order</a></li> <!-- New Button for Table Finishing -->
        <li><a href="kalkulasipanjang.html" class="nav-btn" id="panjangBtn"><span>📊</span> Kalkulasi panjang kertas</a></li> <!-- New Button for Table Finishing -->
        <li><a href="jumlahbooklet.html" class="nav-btn" id="jumlahBtn"><span>📊</span> kalkulasi jumlah booklet dari lebar kertas</a></li> <!-- New Button for Table Finishing -->
        <li><a href="hitungberat.html" class="nav-btn" id="hitungBtn"><span>📊</span> Hitung berat kertas</a></li> <!-- New Button for Table Finishing -->
        <li><a href="kalkulator.html" class="nav-btn" id="kalkulatorBtn"><span>📊</span> Kalkulator</a></li> <!-- New Button for Table Finishing -->
        <li><a href="qrcodegenerate.html" class="nav-btn" id="qrcodeBtn"><span>📊</span> Qrcode Master</a></li> <!-- New Button for Table Finishing -->
    </ul>
</nav>

        <footer>
    <p>&copy; 2024 by @utlity.trpc.
         All rights reserved.</p>
</footer>

    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Header -->
        <header>
            <div class="header-title">
                <h1>PT TRPC MANUFACTURING INDONESIA</h1>
                <p>Dashboard Informasi</p>
            </div>
        </header>

        <section class="chart-grid">
    <!-- Chart 1 -->
    <div class="chart-card" style="overflow-x: scroll; width: 100%; max-width: 100%; height: 400px;">
        <canvas id="tablepi" width="1000" height="400"></canvas>
    </div>
</section>


        <section class="chart-grid">
            <div class="chart-card">
            <canvas id="tablefinishing" width="1000" height="400"></canvas>

            </div>
        </section>

       <section class="transactions">
       <h2>Table Informasi Order</h2>
       
    <?php 
    function formatCurrency($number) {
        return number_format($number, 2, ',', '.');
    }
    include 'config.php';

    // Query untuk mengambil data dari tablepi
    // Query tablepi
$sqlPi = "SELECT id, customer, pi_number, product_name, total_order, deadline, status FROM tablepi";
$resultPi = $conn->query($sqlPi);

if ($resultPi && $resultPi->num_rows > 0) {
    echo "<table>
            <tr>
                <th>No</th>
                <th>Customer</th>
                <th>PI Number</th>
                <th>Brand</th>
                <th>Total Order</th>
                <th>Deadline</th>
                <th>Status</th>
            </tr>";
    $no = 1;
    while ($row = $resultPi->fetch_assoc()) {
        $totalOrderFormatted = formatCurrency($row['total_order']);
        $statusClass = '';
        if ($row['status'] == 'On Process') {
            $statusClass = 'process';
        } elseif ($row['status'] == 'Completed') {
            $statusClass = 'completed';
        } elseif ($row['status'] == 'Pending') {
            $statusClass = 'pending';
        }

        echo "<tr>
                <td>" . $no++ . "</td>
                <td>" . htmlspecialchars($row['customer']) . "</td>
                <td>" . htmlspecialchars($row['pi_number']) . "</td>
                <td>" . htmlspecialchars($row['product_name']) . "</td>
                <td>" . htmlspecialchars($totalOrderFormatted) . "</td>  
                <td>" . htmlspecialchars($row['deadline']) . "</td>
                <td><span class='status " . $statusClass . "'>" . htmlspecialchars($row['status']) . "</span></td>   
              </tr>";
    }
    echo "</table>";
} else {
    echo "No data found.";
}
    ?>
</section>


<section class="transactions">
<h2>Table report produksi Finishing</h2>
    <?php 
    // Query untuk mengambil data dari tablefinishing
    $sqlFinishing = "SELECT id, pi_number, man_power, brand, result, date, status FROM tablefinishing";
    $resultFinishing = $conn->query($sqlFinishing);
    
    if ($resultFinishing && $resultFinishing->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>No</th>
                    <th>PI Number</th>
                    <th>Brand</th>
                    <th>Type of Product</th>
                    <th>Result</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>";
        $no = 1;
        while ($row = $resultFinishing->fetch_assoc()) {
            $resultFormatted = formatCurrency($row['result']);
            $statusClass = '';
            if ($row['status'] == 'On Process') {
                $statusClass = 'process';
            } elseif ($row['status'] == 'Completed') {
                $statusClass = 'completed';
            } elseif ($row['status'] == 'Pending') {
                $statusClass = 'pending';
            }
    
            echo "<tr>
                    <td>" . $no++ . "</td>
                    <td>" . htmlspecialchars($row['pi_number']) . "</td>
                    <td>" . htmlspecialchars($row['man_power']) . "</td>
                    <td>" . htmlspecialchars($row['brand']) . "</td>
                    <td>" . htmlspecialchars($resultFormatted) . "</td>
                    <td>" . htmlspecialchars($row['date']) . "</td>
                    <td><span class='status " . $statusClass . "'>" . htmlspecialchars($row['status']) . "</span></td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "No data found.";
    }
    ?>
</section>
<section class="transactions">
    <h2>Table Bobin</h2>
    <?php 
    // Query untuk mengambil data dari tabel table_bobind
    $sqlbobind = "SELECT id, pi_number, brand, jenis_product, size, qty, date, status FROM table_bobind";
    $resultbobind = $conn->query($sqlbobind); // Simpan hasil query dalam $resultbobind

    if ($resultbobind && $resultbobind->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>No</th>
                    <th>Pi number</th>
                    <th>Brand </th>
                    <th>Jenis product</th>
                    <th>Size </th>
                    <th>Qty Bobin</th>
                    <th>Date </th>
                    <th>Status </th>
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
</section>

</div>

    </div>

    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-zoom@1.0.0"></script>
</body>
</html>
