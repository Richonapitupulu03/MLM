<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$database = "mlm-tes";

$conn = new mysqli($servername, $username, $password, $database);

// Periksa koneksi database
if ($conn->connect_error) {
    die("Koneksi Gagal: " . $conn->connect_error);
}

$keyword = $_POST['keyword'];

// Query pencarian data dari database
// Disini saya membagi 2 sisi, sisi atas akan menampilkan dengan downline 2 sedangkan sisi bawah kurang dari 2

$query = "SELECT * FROM members WHERE id LIKE '%$keyword%' OR nama LIKE '%$keyword%' OR alamat LIKE '%$keyword%' OR no_telp LIKE '%$keyword%' OR upline LIKE '%$keyword%' OR downline LIKE '%$keyword%'";
$result = mysqli_query($conn, $query);

echo "<h2>Downline Lebih Dari 2:</h2>";
while ($row = mysqli_fetch_assoc($result)) {
    if ($row['downline'] >= 2) {
        echo "ID: " . $row['id'] . "<br>";
        echo "Nama: " . $row['nama'] . "<br>";
        echo "Alamat: " . $row['alamat'] . "<br>";
        echo "Nomor Telepon: " . $row['no_telp'] . "<br>";
        echo "Upline: " . $row['upline'] . "<br>";
        echo "Downline: " . $row['downline'] . "<br>";
        echo "<hr>";
    }
}

// Mengembalikan pointer hasil ke baris pertama
mysqli_data_seek($result, 0);

$query = "SELECT * FROM members";
$result2 = mysqli_query($conn, $query);
// Menampilkan data dengan downline kurang dari 2
echo "<h2>Downline Kurang Dari 2:</h2>";
while ($row = mysqli_fetch_assoc($result2)) {
    if ($row['downline'] <= 1) {
        echo "ID: " . $row['id'] . "<br>";
        echo "Nama: " . $row['nama'] . "<br>";
        echo "Alamat: " . $row['alamat'] . "<br>";
        echo "Nomor Telepon: " . $row['no_telp'] . "<br>";
        echo "Upline: " . $row['upline'] . "<br>";
        echo "Downline: " . $row['downline'] . "<br>";
        echo "<hr>";
    }
}

$conn->close();
